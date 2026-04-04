<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
class DokterController extends Controller {
    public function index() {
        $dokters = User::where('role','dokter')->with('poli')->get();
        $polis = Poli::all();
        return view('dokter.index', compact('dokters','polis'));
    }
    public function store(Request $request) {
        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password ?? 'dokter123'),
            'role' => 'dokter',
            'id_poli' => $request->id_poli,
        ]);
        return redirect('/dokter')->with('success','Dokter berhasil ditambahkan! Password default: dokter123');
    }
    public function edit($id) {
        $dokter = User::findOrFail($id);
        $dokters = User::where('role','dokter')->with('poli')->get();
        $polis = Poli::all();
        return view('dokter.index', compact('dokter','dokters','polis'));
    }
    public function update(Request $request, $id) {
        $data = ['nama'=>$request->nama,'alamat'=>$request->alamat,'no_hp'=>$request->no_hp,'id_poli'=>$request->id_poli];
        if($request->password) $data['password'] = bcrypt($request->password);
        User::findOrFail($id)->update($data);
        return redirect('/dokter')->with('success','Dokter berhasil diubah!');
    }
    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect('/dokter')->with('success','Dokter berhasil dihapus!');
    }
}