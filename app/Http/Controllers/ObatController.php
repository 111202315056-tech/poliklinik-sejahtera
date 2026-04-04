<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('obat.index', compact('obats'));
    }

    public function store(Request $request)
    {
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
        return redirect('/obat')->with('success', 'Obat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $obats = Obat::all();
        return view('obat.index', compact('obat', 'obats'));
    }

    public function update(Request $request, $id)
    {
        Obat::findOrFail($id)->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
        return redirect('/obat')->with('success', 'Obat berhasil diubah!');
    }

    public function destroy($id)
    {
        Obat::findOrFail($id)->delete();
        return redirect('/obat')->with('success', 'Obat berhasil dihapus!');
    }
}
