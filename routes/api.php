<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PetaKehadiranController;
use App\Http\Controllers\PresensiHarianController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routes untuk Pengguna dengan prefix
Route::prefix('pengguna')->group(function () {
    Route::get('/list-data', [PenggunaController::class, 'lihatData']);
    Route::get('/ambil-data/{nip}', [PenggunaController::class, 'ambilData']);
    Route::post('/simpan-data', [PenggunaController::class, 'simpanData']);
    Route::delete('/hapus-data/{nip}', [PenggunaController::class, 'hapusData']);
    Route::get('/cek-koneksi', [PenggunaController::class, 'cekKoneksi']);
});

// Routes untuk Peta Kehadiran dengan prefix
Route::prefix('peta-kehadiran')->group(function () {
    Route::get('/list-data', [PetaKehadiranController::class, 'lihatData']);
    Route::get('/ambil-data/{id}', [PetaKehadiranController::class, 'ambilData']);
    Route::post('/simpan-data', [PetaKehadiranController::class, 'simpanData']);
    Route::delete('/hapus-data/{id}', [PetaKehadiranController::class, 'hapusData']);
    Route::get('/cek-koneksi', [PetaKehadiranController::class, 'cekKoneksi']);
});

Route::prefix('presensi-harian')->group(function(){
    Route::get('/list-data', [PresensiHarianController::class, 'lihatData']);
    Route::get('/ambil-data/{id}', [PresensiHarianController::class, 'ambilData']);
    Route::post('/simpan-data', [PresensiHarianController::class, 'simpanData']);
    Route::delete('/hapus-data/{id}', [PresensiHarianController::class, 'hapusData']);
    Route::get('/cek-koneksi', [PresensiHarianController::class, 'cekKoneksi']);
});
