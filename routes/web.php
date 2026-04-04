<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\PendaftaranController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::get('/dokter', [DokterController::class, 'index']);
    Route::post('/dokter', [DokterController::class, 'store']);
    Route::get('/dokter/{id}/edit', [DokterController::class, 'edit']);
    Route::post('/dokter/{id}/update', [DokterController::class, 'update']);
    Route::get('/dokter/{id}/delete', [DokterController::class, 'destroy']);

    Route::get('/pasien', [PasienController::class, 'index']);
    Route::post('/pasien', [PasienController::class, 'store']);
    Route::get('/pasien/{id}/edit', [PasienController::class, 'edit']);
    Route::post('/pasien/{id}/update', [PasienController::class, 'update']);
    Route::get('/pasien/{id}/delete', [PasienController::class, 'destroy']);

    Route::get('/obat', [ObatController::class, 'index']);
    Route::post('/obat', [ObatController::class, 'store']);
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit']);
    Route::post('/obat/{id}/update', [ObatController::class, 'update']);
    Route::get('/obat/{id}/delete', [ObatController::class, 'destroy']);

    Route::get('/poli', [PoliController::class, 'index']);
    Route::post('/poli', [PoliController::class, 'store']);
    Route::get('/poli/{id}/edit', [PoliController::class, 'edit']);
    Route::post('/poli/{id}/update', [PoliController::class, 'update']);
    Route::get('/poli/{id}/delete', [PoliController::class, 'destroy']);

    Route::get('/jadwal', [JadwalController::class, 'index']);
    Route::post('/jadwal', [JadwalController::class, 'store']);
    Route::get('/jadwal/{id}/delete', [JadwalController::class, 'destroy']);

    Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
    Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
    Route::get('/periksa', [PeriksaController::class, 'index']);
    Route::get('/periksa/{id}/form', [PeriksaController::class, 'form']);
    Route::get('/hasil-periksa', [App\Http\Controllers\HasilPeriksaController::class, 'index']);
    Route::get('/hasil-periksa', [App\Http\Controllers\HasilPeriksaController::class, 'index']);
    Route::post('/periksa/{id}/store', [PeriksaController::class, 'store']);
});