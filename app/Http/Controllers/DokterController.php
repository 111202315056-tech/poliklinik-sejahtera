<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function index() {
        $dokters = User::where('role','dokter')->get();
        $polis = Poli::all();
        return view('dokter.index', compact('dokters','polis'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'alamat'   => 'required',
            'no_hp'    => 'required',
            'id_poli'  => 'required',
        ], [
            'email.unique' => 'Email sudah digunakan, gunakan email lain.',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'alamat'   => $request->alamat,
            'no_hp'    => $request->no_hp,
            'role'     => 'dokter',
            'id_poli'  => $request->id_poli,
        ]);

        return redirect('/dokter')->with('success','Dokter berhasil ditambahkan');
    }

    public function edit($id) {
        $dokter = User::findOrFail($id);
        $polis = Poli::all();
        return view('dokter.edit', compact('dokter','polis'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama'    => 'required',
            'email'   => 'required|email|unique:users,email,'.$id,
            'alamat'  => 'required',
            'no_hp'   => 'required',
            'id_poli' => 'required',
        ], [
            'email.unique' => 'Email sudah digunakan, gunakan email lain.',
        ]);

        $dokter = User::findOrFail($id);
        $dokter->update([
            'nama'    => $request->nama,
            'email'   => $request->email,
            'alamat'  => $request->alamat,
            'no_hp'   => $request->no_hp,
            'id_poli' => $request->id_poli,
        ]);

        if($request->password) {
            $dokter->update(['password' => Hash::make($request->password)]);
        }

        return redirect('/dokter')->with('success','Dokter berhasil diupdate');
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect('/dokter')->with('success','Dokter berhasil dihapus');
    }
}
