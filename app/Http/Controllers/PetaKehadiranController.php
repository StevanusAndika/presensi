<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model\PetaKehadiran as PetaModel;

class PetaKehadiranController extends Controller
{
    /**
     * Menampilkan semua data peta kehadiran
     */
    public function lihatData(): array
    {
        try {
            $peta = PetaModel::all();
            return [
                'success' => true,
                'count' => $peta->count(),
                'data' => $peta
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'count' => 0,
                'data' => [],
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Mengambil data peta kehadiran berdasarkan ID
     */
    public function ambilData($id): array
    {
        try {
            $peta = PetaModel::find($id);

            if ($peta) {
                return [
                    'success' => true,
                    'count' => 1,
                    'data' => $peta
                ];
            } else {
                return [
                    'success' => true,
                    'count' => 0,
                    'data' => null,
                    'message' => 'Data tidak ditemukan untuk ID: ' . $id
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'count' => 0,
                'data' => null,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Menyimpan data peta kehadiran (create atau update)
     */
    public function simpanData(Request $request): array
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'no_hari' => 'required|integer|min:1|max:7',
                'jam_masuk' => 'required',
                'jam_keluar' => 'required'
            ]);

            $id = $request->input('id');

            if ($id) {
                // Update data existing
                $peta = PetaModel::find($id);
                if (is_null($peta)) {
                    return [
                        'success' => false,
                        'message' => 'Data tidak ditemukan untuk update'
                    ];
                }
            } else {
                // Create data baru
                $peta = new PetaModel();
            }

            $peta->no_hari = $request->input('no_hari');
            $peta->jam_masuk = $request->input('jam_masuk');
            $peta->jam_keluar = $request->input('jam_keluar');
            $ret = $peta->save();

            return [
                'result' => $ret,
                'success' => $ret,
                'message' => $ret ? 'Data berhasil disimpan' : 'Gagal menyimpan data',
                'data' => $peta
            ];

        } catch (\Exception $e) {
            return [
                'result' => false,
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Menghapus data peta kehadiran berdasarkan ID
     */
    public function hapusData($id): array
    {
        try {
            $peta = PetaModel::find($id);
            if (!is_null($peta)) {
                $ret = $peta->delete();
                return [
                    'result' => $ret,
                    'success' => $ret,
                    'message' => $ret ? 'Data berhasil dihapus' : 'Gagal menghapus data'
                ];
            } else {
                return [
                    'result' => false,
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ];
            }
        } catch (\Exception $e) {
            return [
                'result' => false,
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Cek koneksi database untuk peta kehadiran
     */
    public function cekKoneksi(): array
    {
        try {
            $count = PetaModel::count();
            return [
                'success' => true,
                'message' => 'Koneksi database peta kehadiran berhasil',
                'total_data' => $count
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Koneksi database gagal: ' . $e->getMessage()
            ];
        }
    }
}
