<?php
namespace App\Http\Controllers;
use App\Models\DaftarPoli;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PendaftaranController extends Controller {
    public function index() {
        $user = Auth::user();
        if ($user->role === 'dokter') {
            return redirect('/jadwal');
        }
        $polis = Poli::with(['dokters.jadwals'])->get();
        $daftars = DaftarPoli::where('id_pasien', $user->id)->with(['jadwalPeriksa.dokter'])->latest()->get();
        return view('pendaftaran.index', compact('polis','daftars'));
    }
    public function store(Request $request) {
        $keluhan = $request->keluhan ?? 'Tidak ada keluhan';
        $no = DaftarPoli::where('id_jadwal', $request->id_jadwal)->whereDate('created_at', today())->count() + 1;
        \App\Events\AntrianUpdated::dispatch(['poli_id'=>$request->id_jadwal,'total'=>\App\Models\DaftarPoli::where('id_jadwal',$request->id_jadwal)->whereDate('created_at',today())->count()+1]);
        DaftarPoli::create(['id_pasien'=>Auth::id(),'id_jadwal'=>$request->id_jadwal,'keluhan'=>$keluhan,'no_antrian'=>$no]);
        return redirect('/pendaftaran')->with('success','Pendaftaran berhasil! No antrian: '.$no);
    }
}