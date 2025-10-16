<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model\Pengguna as PenggunaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * Menampilkan semua data pengguna
     */
    public function lihatData(): array
    {
        try {
            $r = PenggunaModel::all();
            return [
                'success' => true,
                'count' => $r->count(),
                'data' => $r
            ];
        } catch (\Exception $e) {
            Log::error("Error lihatData: " . $e->getMessage());
            return [
                'success' => false,
                'count' => 0,
                'data' => [],
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Mengambil data pengguna berdasarkan NIP
     */
    public function ambilData($nip = ''): array
    {
        try {
            // Log::info("Mencari data dengan NIP: " . $nip);

            $r = PenggunaModel::where('nip', $nip)->first();

            // Log::info("Hasil pencarian: " . ($r ? 'Ditemukan' : 'Tidak ditemukan'));

            if ($r) {
                return [
                    'success' => true,
                    'count' => 1,
                    'data' => [
                        'nip' => $r->nip,
                        'nama' => $r->nama,
                        'level' => $r->level,
                        'sandi' => $r->sandi
                    ]
                ];
            } else {
                return [
                    'success' => true,
                    'count' => 0,
                    'data' => null,
                    'message' => 'Data tidak ditemukan untuk NIP: ' . $nip
                ];
            }
        } catch (\Exception $e) {
            // Log::error("Error ambilData: " . $e->getMessage());
            return [
                'success' => false,
                'count' => 0,
                'data' => null,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Menyimpan data pengguna (create atau update)
     */
    public function simpanData(Request $request): array
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nip' => 'required|string|size:9',
                'nama' => 'required|string|max:100',
                'level' => 'required|string|size:1|in:A,S,O', // A=Admin, S=Staff, O=Operator
                'sandi' => 'required|string|min:3'
            ]);

            if ($validator->fails()) {
                return [
                    'result' => false,
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()->toArray()
                ];
            }

            $nip = $request->input('nip');
            $r = PenggunaModel::find($nip);

            $isNew = is_null($r);
            if ($isNew) {
                $r = new PenggunaModel();
            }

            $r->nip = $request->input('nip');
            $r->nama = $request->input('nama');
            $r->level = $request->input('level');

            // Only hash password if it's provided and not empty
            $sandi = $request->input('sandi');
            if (!empty($sandi)) {
                $r->sandi = md5($sandi);
            }

            $ret = $r->save();

            return [
                'result' => $ret,
                'success' => $ret,
                'message' => $ret ?
                    ($isNew ? 'Data berhasil ditambahkan' : 'Data berhasil diupdate') :
                    'Gagal menyimpan data',
                'data' => [
                    'nip' => $r->nip,
                    'nama' => $r->nama,
                    'level' => $r->level
                ]
            ];

        } catch (\Exception $e) {
            // Log::error("Error simpanData: " . $e->getMessage());
            return [
                'result' => false,
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Menghapus data pengguna berdasarkan NIP
     */
    public function hapusData($nip): array
    {
        try {
            $r = PenggunaModel::find($nip);
            if (!is_null($r)) {
                $ret = $r->delete();
                return [
                    'result' => $ret,
                    'success' => $ret,
                    'message' => $ret ? 'Data berhasil dihapus' : 'Gagal menghapus data'
                ];
            } else {
                return [
                    'result' => false,
                    'success' => false,
                    'message' => 'Data tidak ditemukan untuk NIP: ' . $nip
                ];
            }
        } catch (\Exception $e) {
            // Log::error("Error hapusData: " . $e->getMessage());
            return [
                'result' => false,
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Cek koneksi database
     */
    public function cekKoneksi(): array
    {
        try {
            DB::connection()->getPdo();
            return [
                'success' => true,
                'message' => 'Koneksi database berhasil',
                'database' => DB::connection()->getDatabaseName()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Koneksi database gagal: ' . $e->getMessage()
            ];
        }
    }

    


    /**
     * Cari pengguna berdasarkan nama
     */
    public function cariData(Request $request): array
    {
        try {
            $keyword = $request->get('keyword', '');

            if (empty($keyword)) {
                return $this->lihatData();
            }

            $results = PenggunaModel::where('nama', 'like', '%' . $keyword . '%')
                ->orWhere('nip', 'like', '%' . $keyword . '%')
                ->get();

            return [
                'success' => true,
                'count' => $results->count(),
                'data' => $results,
                'keyword' => $keyword
            ];

        } catch (\Exception $e) {
            // Log::error("Error cariData: " . $e->getMessage());
            return [
                'success' => false,
                'count' => 0,
                'data' => [],
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
}
