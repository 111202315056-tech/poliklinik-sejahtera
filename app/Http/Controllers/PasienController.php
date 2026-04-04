<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
class PasienController extends Controller {
    public function index() {
        $pasiens = User::where('role','pasien')->get();
        return view('pasien.index', compact('pasiens'));
    }
    public function store(Request $request) {
        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password ?? 'pasien123'),
            'role' => 'pasien',
        ]);
        return redirect('/pasien')->with('success','Pasien berhasil ditambahkan! Password default: pasien123');
    }
    public function edit($id) {
        $pasien = User::findOrFail($id);
        $pasiens = User::where('role','pasien')->get();
        return view('pasien.index', compact('pasien','pasiens'));
    }
    public function update(Request $request, $id) {
        $data = ['nama'=>$request->nama,'alamat'=>$request->alamat,'no_ktp'=>$request->no_ktp,'no_hp'=>$request->no_hp];
        if($request->password) $data['password'] = bcrypt($request->password);
        User::findOrFail($id)->update($data);
        return redirect('/pasien')->with('success','Pasien berhasil diubah!');
    }
    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect('/pasien')->with('success','Pasien berhasil dihapus!');
    }
}