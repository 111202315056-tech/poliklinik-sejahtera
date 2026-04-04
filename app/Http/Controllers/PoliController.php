<?php
namespace App\Http\Controllers;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
class PoliController extends Controller {
    public function index() {
        $polis = Poli::withCount("dokters as jumlah_dokter")->with(["dokters.jadwals"])->get();
        $dokters = User::where("role", "dokter")->get();
        return view("poli.index", compact("polis", "dokters"));
    }
    public function store(Request $request) {
        $poli = Poli::create(["nama_poli" => $request->nama_poli, "keterangan" => $request->keterangan]);
        if ($request->id_dokter) {
            User::whereIn("id", $request->id_dokter)->update(["id_poli" => $poli->id]);
        }
        return redirect("/poli")->with("success", "Poli berhasil ditambahkan!");
    }
    public function edit($id) {
        $poli = Poli::findOrFail($id);
        $polis = Poli::withCount("dokters as jumlah_dokter")->with(["dokters.jadwals"])->get();
        $dokters = User::where("role", "dokter")->get();
        return view("poli.index", compact("poli", "polis", "dokters"));
    }
    public function update(Request $request, $id) {
        Poli::findOrFail($id)->update(["nama_poli" => $request->nama_poli, "keterangan" => $request->keterangan]);
        User::where("id_poli", $id)->update(["id_poli" => null]);
        if ($request->id_dokter) {
            User::whereIn("id", $request->id_dokter)->update(["id_poli" => $id]);
        }
        return redirect("/poli")->with("success", "Poli berhasil diubah!");
    }
    public function destroy($id) {
        User::where("id_poli", $id)->update(["id_poli" => null]);
        Poli::findOrFail($id)->delete();
        return redirect("/poli")->with("success", "Poli berhasil dihapus!");
    }
}
