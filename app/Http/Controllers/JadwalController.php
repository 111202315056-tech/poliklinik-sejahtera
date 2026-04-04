<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jadwals = JadwalPeriksa::where('id_dokter', $user->id)->with('dokter')->get();
        $polis = Poli::all();
        return view('jadwal.index', compact('jadwals', 'polis', 'user'));
    }

    public function store(Request $request)
    {
        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);
        return redirect('/jadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        JadwalPeriksa::findOrFail($id)->delete();
        return redirect('/jadwal')->with('success', 'Jadwal berhasil dihapus!');
    }
}
