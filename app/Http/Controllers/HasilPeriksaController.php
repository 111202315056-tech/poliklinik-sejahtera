<?php
namespace App\Http\Controllers;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;
class HasilPeriksaController extends Controller {
    public function index() {
        $daftars = DaftarPoli::where('id_pasien', Auth::id())
            ->with(['jadwalPeriksa.dokter','periksa.detailPeriksa.obat'])
            ->latest()->get();
        return view('hasil_periksa', compact('daftars'));
    }
    public function cetak($id) {
        $daftar = DaftarPoli::with(['pasien','jadwalPeriksa.dokter','periksa.detailPeriksa.obat'])->findOrFail($id);
        return view('cetak_struk', compact('daftar'));
    }
}