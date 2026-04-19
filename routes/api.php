<?php
use Illuminate\Support\Facades\Route;
use App\Models\DaftarPoli;
Route::get('/antrian/{id_pasien}', function($id_pasien) {
    return DaftarPoli::where('id_pasien',$id_pasien)
        ->with(['jadwalPeriksa.dokter','periksa'])
        ->latest()->get()
        ->map(function($d) {
            return [
                'id' => $d->id,
                'dokter' => $d->jadwalPeriksa->dokter->nama ?? '-',
                'hari' => $d->jadwalPeriksa->hari ?? '-',
                'keluhan' => $d->keluhan,
                'no_antrian' => $d->no_antrian,
                'selesai' => $d->periksa ? true : false,
            ];
        });
});