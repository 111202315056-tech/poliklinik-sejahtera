<?php
namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class DokterExport implements FromCollection, WithHeadings, WithStyles {
    public function collection() {
        return User::where('role','dokter')->with('poli')->get()->map(function($d,$i) {
            return [$i+1, $d->nama, $d->email, $d->no_ktp ?? '-', $d->no_hp ?? '-', $d->alamat ?? '-', $d->poli->nama_poli ?? 'Belum ada poli'];
        });
    }
    public function headings(): array {
        return ['No','Nama Dokter','Email','No KTP','No HP','Alamat','Poli'];
    }
    public function styles(Worksheet $sheet) {
        return [1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DBEAFE']]]];
    }
}