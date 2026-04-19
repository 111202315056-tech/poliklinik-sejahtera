<?php
namespace App\Http\Controllers;
use App\Models\DaftarPoli;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PembayaranController extends Controller {
    public function index() {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $pembayarans = Pembayaran::with(['daftarPoli.pasien','daftarPoli.periksa'])->latest()->get();
            return view('pembayaran.admin', compact('pembayarans'));
        }
        $daftars = DaftarPoli::where('id_pasien', $user->id)
            ->with(['jadwalPeriksa.dokter','periksa','pembayaran'])
            ->whereHas('periksa')
            ->latest()->get();
        return view('pembayaran.index', compact('daftars'));
    }
    public function upload(Request $request, $id) {
        $request->validate(['bukti' => 'required|image|max:2048']);
        $path = $request->file('bukti')->store('bukti_pembayaran', 'public');
        Pembayaran::updateOrCreate(
            ['id_daftar_poli' => $id],
            ['bukti_pembayaran' => $path, 'status' => 'sudah_bayar', 'tgl_bayar' => now()]
        );
        return redirect('/pembayaran')->with('success', 'Bukti pembayaran berhasil diupload!');
    }
    public function konfirmasi($id) {
        Pembayaran::where('id_daftar_poli', $id)->update(['status' => 'lunas', 'tgl_konfirmasi' => now()]);
        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}