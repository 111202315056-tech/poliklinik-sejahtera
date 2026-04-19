<?php
namespace App\Exports;
use App\Models\JadwalPeriksa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class JadwalExport implements FromCollection, WithHeadings, WithStyles {
    protected $id_dokter;
    public function __construct($id_dokter) { $this->id_dokter = $id_dokter; }
    public function collection() {
        return JadwalPeriksa::where('id_dokter',$this->id_dokter)->with('dokter')->get()->map(function($j,$i) {
            return [$i+1, $j->dokter->nama ?? '-', $j->hari, substr($j->jam_mulai,0,5), substr($j->jam_selesai,0,5)];
        });
    }
    public function headings(): array {
        return ['No','Dokter','Hari','Jam Mulai','Jam Selesai'];
    }
    public function styles(Worksheet $sheet) {
        return [1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DBEAFE']]]];
    }
}