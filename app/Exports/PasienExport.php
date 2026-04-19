<?php
namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class PasienExport implements FromCollection, WithHeadings, WithStyles {
    public function collection() {
        return User::where('role','pasien')->get()->map(function($p,$i) {
            return [$i+1, $p->nama, $p->email, $p->no_rm ?? '-', $p->no_ktp ?? '-', $p->no_hp ?? '-', $p->alamat ?? '-'];
        });
    }
    public function headings(): array {
        return ['No','Nama Pasien','Email','No RM','No KTP','No HP','Alamat'];
    }
    public function styles(Worksheet $sheet) {
        return [1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DCFCE7']]]];
    }
}