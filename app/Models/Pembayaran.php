<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pembayaran extends Model {
    protected $table = 'pembayaran';
    protected $fillable = ['id_daftar_poli','bukti_pembayaran','status','tgl_bayar','tgl_konfirmasi'];
    public function daftarPoli() { return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli'); }
}