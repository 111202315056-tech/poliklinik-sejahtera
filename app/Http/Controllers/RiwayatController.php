<?php
namespace App\Http\Controllers;
use App\Models\DaftarPoli;
use Illuminate\Support\Facades\Auth;
class RiwayatController extends Controller {
    public function index() {
        $riwayats = DaftarPoli::where('id_pasien', Auth::id())
            ->with(['jadwalPeriksa.dokter.poli','periksa.detailPeriksa.obat'])
            ->latest()->get();
        return view('riwayat', compact('riwayats'));
    }
    public function detail($id) {
        $daftar = DaftarPoli::with(['pasien','jadwalPeriksa.dokter.poli','periksa.detailPeriksa.obat'])
            ->where('id_pasien', Auth::id())
            ->findOrFail($id);
        return view('riwayat_detail', compact('daftar'));
    }
}