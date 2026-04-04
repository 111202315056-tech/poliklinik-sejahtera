<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable {
    use Notifiable;
    protected $fillable = ['nama','alamat','no_ktp','no_hp','no_rm','role','email','password','id_poli'];
    protected $hidden = ['password','remember_token'];
    public function poli() { return $this->belongsTo(Poli::class, 'id_poli'); }
    public function jadwals() { return $this->hasMany(JadwalPeriksa::class, 'id_dokter'); }
    public function jadwalPeriksa() { return $this->hasMany(JadwalPeriksa::class, 'id_dokter'); }
    public function daftarPoli() { return $this->hasMany(DaftarPoli::class, 'id_pasien'); }
}