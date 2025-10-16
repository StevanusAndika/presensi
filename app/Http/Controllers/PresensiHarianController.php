<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model\PresensiHarian as PresensiModel;

class PresensiHarianController extends Controller
{
    /**
     * Menampilkan semua data presensi harian
     */
    public function lihatData(): array
    {
        try {
            $presensi = PresensiModel::with('pengguna')->get();
            return [
                'success' => true,
                'count' => $presensi->count(),
                'data' => $presensi
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
     * Mengambil data presensi harian berdasarkan ID
     */
    public function ambilData($id): array
    {
        try {
            $presensi = PresensiModel::with('pengguna')->find($id);

            if ($presensi) {
                return [
                    'success' => true,
                    'count' => 1,
                    'data' => $presensi
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
     * Menyimpan data presensi harian (create atau update)
     */
    public function simpanData(Request $request): array
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'tgl_masuk' => 'required|date',
                'tgl_pulang' => 'nullable|date',
                'ket_hari' => 'required|string|size:1',
                'nip' => 'required|string|size:9',
                'ip_masuk' => 'required|string|max:15',
                'ip_keluar' => 'nullable|string|max:15',
                'peta_kehadiran_id' => 'required|integer',
                'jam_harus_masuk' => 'required',
                'jam_harus_pulang' => 'required'
            ]);

            $id = $request->input('id');

            if ($id) {
                // Update data existing
                $presensi = PresensiModel::find($id);
                if (is_null($presensi)) {
                    return [
                        'success' => false,
                        'message' => 'Data tidak ditemukan untuk update'
                    ];
                }
            } else {
                // Create data baru
                $presensi = new PresensiModel();
            }

            // Set field data
            $presensi->tgl_masuk = $request->input('tgl_masuk');
            $presensi->tgl_pulang = $request->input('tgl_pulang');
            $presensi->ket_hari = $request->input('ket_hari');
            $presensi->nip = $request->input('nip');
            $presensi->ip_masuk = $request->input('ip_masuk');
            $presensi->ip_keluar = $request->input('ip_keluar');
            $presensi->peta_kehadiran_id = $request->input('peta_kehadiran_id');
            $presensi->jam_harus_masuk = $request->input('jam_harus_masuk');
            $presensi->jam_harus_pulang = $request->input('jam_harus_pulang');

            $ret = $presensi->save();

            return [
                'result' => $ret,
                'success' => $ret,
                'message' => $ret ? 'Data berhasil disimpan' : 'Gagal menyimpan data',
                'data' => $presensi
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
     * Menghapus data presensi harian berdasarkan ID
     */
    public function hapusData($id): array
    {
        try {
            $presensi = PresensiModel::find($id);
            if (!is_null($presensi)) {
                $ret = $presensi->delete();
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
     * Cek koneksi database untuk presensi harian
     */
    public function cekKoneksi(): array
    {
        try {
            $count = PresensiModel::count();
            return [
                'success' => true,
                'message' => 'Koneksi database presensi harian berhasil',
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
