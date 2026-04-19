<?php
namespace App\Http\Controllers;
use App\Models\DaftarPoli;
use App\Models\Periksa;
class AdminPeriksaController extends Controller {
    public function index() {
        $daftars = DaftarPoli::with(['pasien','jadwalPeriksa.dokter','periksa.detailPeriksa.obat'])->latest()->get();
        return view('admin_periksa', compact('daftars'));
    }
}