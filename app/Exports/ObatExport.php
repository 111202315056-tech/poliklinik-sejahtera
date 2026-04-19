<?php
namespace App\Exports;
use App\Models\Obat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class ObatExport implements FromCollection, WithHeadings, WithStyles {
    public function collection() {
        return Obat::all()->map(function($o,$i) {
            return [$i+1, $o->nama_obat, $o->kemasan, 'Rp '.number_format($o->harga,0,',','.'), $o->stok];
        });
    }
    public function headings(): array {
        return ['No','Nama Obat','Kemasan','Harga','Stok'];
    }
    public function styles(Worksheet $sheet) {
        return [1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F5F3FF']]]];
    }
}