<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Obat;
use App\Models\Poli;
use App\Models\DaftarPoli;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller {
    public function index() {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $totalPoli = Poli::count();
            $totalDokter = User::where('role','dokter')->count();
            $totalPasien = User::where('role','pasien')->count();
            $totalObat = Obat::count();
            return view('home_admin', compact('totalPoli','totalDokter','totalPasien','totalObat'));
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