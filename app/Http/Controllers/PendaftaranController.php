<?php
namespace App\Http\Controllers;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PendaftaranController extends Controller {
    public function index() {
        $polis = Poli::with(['dokters.jadwals'])->get();
        $daftars = DaftarPoli::where('id_pasien', Auth::id())->with(['jadwalPeriksa.dokter'])->latest()->get();
        return view('pendaftaran.index', compact('polis','daftars'));
    }
    public function store(Request $request) {
        $request->validate(['id_jadwal'=>'required','keluhan'=>'required|string|min:3']);
        $no = DaftarPoli::where('id_jadwal', $request->id_jadwal)->whereDate('created_at', today())->count() + 1;
        DaftarPoli::create(['id_pasien'=>Auth::id(),'id_jadwal'=>$request->id_jadwal,'keluhan'=>$request->keluhan,'no_antrian'=>$no]);
        return redirect('/pendaftaran')->with('success','Pendaftaran berhasil! No antrian: '.$no);
    }
}