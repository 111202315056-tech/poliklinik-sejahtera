<?php
namespace App\Http\Controllers;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PeriksaController extends Controller {
    public function index() {
        $user = Auth::user();
        $daftars = DaftarPoli::whereHas('jadwalPeriksa', function($q) use ($user) {
            $q->where('id_dokter', $user->id);
        })->with(['pasien','jadwalPeriksa','periksa'])->get();
        return view('periksa.index', compact('daftars'));
    }
    public function form($id) {
        $daftar = DaftarPoli::with(['pasien','jadwalPeriksa'])->findOrFail($id);
        $obats = Obat::where('stok','>',0)->get();
        $obatsHabis = Obat::where('stok','<=',0)->get();
        $periksa = Periksa::where('id_daftar_poli',$id)->with('detailPeriksa.obat')->first();
        return view('periksa.form', compact('daftar','obats','obatsHabis','periksa'));
    }
    public function store(Request $request, $id) {
        DB::beginTransaction();
        try {
            if ($request->obat) {
                foreach ($request->obat as $id_obat) {
                    $obat = Obat::findOrFail($id_obat);
                    if ($obat->stok <= 0) {
                        DB::rollBack();
                        return redirect()->back()->withErrors(['error' => 'Stok obat '.$obat->nama_obat.' sudah habis! Silakan pilih obat lain.'])->withInput();
                    }
                }
            }
            $periksa = Periksa::updateOrCreate(
                ['id_daftar_poli' => $id],
                ['tgl_periksa' => now(), 'catatan' => $request->catatan, 'biaya_periksa' => $request->biaya_periksa]
            );
            DetailPeriksa::where('id_periksa', $periksa->id)->delete();
            if ($request->obat) {
                foreach ($request->obat as $id_obat) {
                    DetailPeriksa::create(['id_periksa' => $periksa->id, 'id_obat' => $id_obat]);
                    Obat::where('id', $id_obat)->decrement('stok', 1);
                }
            }
            DB::commit();
            return redirect('/periksa')->with('success', 'Data pemeriksaan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: '.$e->getMessage()])->withInput();
        }
    }
}