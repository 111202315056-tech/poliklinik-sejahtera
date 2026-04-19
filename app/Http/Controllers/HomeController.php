<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Obat;
use App\Models\Poli;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller {
    public function index() {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $totalPoli = Poli::count();
            $totalDokter = User::where('role','dokter')->count();
            $totalPasien = User::where('role','pasien')->count();
            $totalObat = Obat::count();
            $totalPeriksa = Periksa::count();
            $chartData = DaftarPoli::select(DB::raw('DATE(created_at) as tgl'), DB::raw('count(*) as total'))->groupBy('tgl')->orderBy('tgl','desc')->limit(7)->get()->reverse()->values();
            return view('home_admin', compact('totalPoli','totalDokter','totalPasien','totalObat','totalPeriksa','chartData'));
        }
        if ($user->role === 'dokter') {
            $totalPeriksa = DaftarPoli::whereHas('jadwalPeriksa', function($q) use($user){ $q->where('id_dokter',$user->id); })->whereHas('periksa')->count();
            $totalMenunggu = DaftarPoli::whereHas('jadwalPeriksa', function($q) use($user){ $q->where('id_dokter',$user->id); })->doesntHave('periksa')->count();
            return view('home_dokter', compact('user','totalPeriksa','totalMenunggu'));
        }
        if ($user->role === 'pasien') {
            $daftars = DaftarPoli::where('id_pasien',$user->id)->with(['jadwalPeriksa.dokter'])->latest()->get();
            $totalPeriksa = $daftars->count();
            $totalAntrian = $daftars->count();
            $lastPeriksa = $daftars->first() ? $daftars->first()->jadwalPeriksa->hari : '-';
            return view('home_pasien', compact('user','daftars','totalPeriksa','totalAntrian','lastPeriksa'));
        }
        return redirect('/login');
    }
}