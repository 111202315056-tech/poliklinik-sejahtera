<?php
namespace App\Http\Controllers;
use App\Exports\DokterExport;
use App\Exports\PasienExport;
use App\Exports\ObatExport;
use App\Exports\JadwalExport;
use App\Exports\RiwayatPasienExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
class ExportController extends Controller {
    public function dokter() {
        return Excel::download(new DokterExport, 'data-dokter.xlsx');
    }
    public function pasien() {
        return Excel::download(new PasienExport, 'data-pasien.xlsx');
    }
    public function obat() {
        return Excel::download(new ObatExport, 'data-obat.xlsx');
    }
    public function jadwal() {
        return Excel::download(new JadwalExport(Auth::id()), 'jadwal-periksa.xlsx');
    }
    public function riwayatPasien() {
        return Excel::download(new RiwayatPasienExport(Auth::id()), 'riwayat-pasien.xlsx');
    }
}