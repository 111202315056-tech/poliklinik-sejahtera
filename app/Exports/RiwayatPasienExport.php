<?php
namespace App\Exports;
use App\Models\DaftarPoli;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class RiwayatPasienExport implements FromCollection, WithHeadings, WithStyles {
    protected $id_dokter;
    public function __construct($id_dokter) { $this->id_dokter = $id_dokter; }
    public function collection() {
        return DaftarPoli::whereHas('jadwalPeriksa', function($q) {
            $q->where('id_dokter',$this->id_dokter);
        })->with(['pasien','jadwalPeriksa','periksa'])->get()->map(function($d,$i) {
            return [$i+1, $d->pasien->nama ?? '-', $d->pasien->no_rm ?? '-', $d->jadwalPeriksa->hari ?? '-', $d->keluhan, $d->no_antrian, $d->periksa ? 'Sudah Diperiksa' : 'Menunggu', $d->periksa ? 'Rp '.number_format($d->periksa->biaya_periksa,0,',','.') : '-'];
        });
    }
    public function headings(): array {
        return ['No','Nama Pasien','No RM','Hari','Keluhan','No Antrian','Status','Biaya'];
    }
    public function styles(Worksheet $sheet) {
        return [1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DCFCE7']]]];
    }
}