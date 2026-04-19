<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk Pemeriksaan</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:Arial,sans-serif;font-size:13px;background:#f3f4f6;}
.container{max-width:500px;margin:20px auto;background:white;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.1);overflow:hidden;}
.header{background:linear-gradient(135deg,#1e3a5f,#2563eb);color:white;padding:24px;text-align:center;}
.header h1{font-size:20px;font-weight:700;margin-bottom:4px;}
.header p{font-size:12px;opacity:0.8;}
.body{padding:24px;}
.section{margin-bottom:16px;}
.section-title{font-size:11px;font-weight:700;text-transform:uppercase;color:#64748b;margin-bottom:8px;padding-bottom:4px;border-bottom:1px solid #e2e8f0;}
.row{display:flex;justify-content:space-between;padding:4px 0;font-size:13px;}
.row .label{color:#64748b;}
.row .value{font-weight:600;color:#1e293b;text-align:right;}
.badge{display:inline-block;background:#dcfce7;color:#16a34a;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;}
.obat-item{background:#fefce8;border:1px solid #fde68a;padding:6px 12px;border-radius:20px;font-size:12px;color:#92400e;display:inline-block;margin:3px;}
.total{background:#eff6ff;border-radius:8px;padding:16px;margin-top:16px;}
.total .label{font-size:13px;color:#2563eb;font-weight:600;}
.total .value{font-size:22px;font-weight:700;color:#1e293b;}
.footer{text-align:center;padding:16px;background:#f8fafc;border-top:1px solid #e2e8f0;font-size:11px;color:#94a3b8;}
.print-btn{display:block;margin:16px auto;padding:12px 32px;background:#2563eb;color:white;border:none;border-radius:8px;cursor:pointer;font-size:14px;font-weight:600;}
.print-btn:hover{background:#1d4ed8;}
@media print{
.print-btn{display:none;}
body{background:white;}
.container{box-shadow:none;margin:0;border-radius:0;}
}
</style>
</head>
<body>
<div class="container">
<div class="header">
<h1> Poliklinik Sejahtera</h1>
<p>Jl. Kesehatan No. 1, Semarang | Telp: (024) 123456</p>
<p style="margin-top:8px;font-size:14px;font-weight:600;">BUKTI PEMERIKSAAN</p>
</div>
<div class="body">
<div class="section">
<div class="section-title">Informasi Kunjungan</div>
<div class="row"><span class="label">Tanggal Periksa</span><span class="value">{{ $daftar->periksa ? date('d F Y', strtotime($daftar->periksa->tgl_periksa)) : '-' }}</span></div>
<div class="row"><span class="label">No. Antrian</span><span class="value">{{ $daftar->no_antrian }}</span></div>
<div class="row"><span class="label">No. Rekam Medis</span><span class="value">{{ $daftar->pasien->no_rm ?? '-' }}</span></div>
</div>
<div class="section">
<div class="section-title">Data Pasien</div>
<div class="row"><span class="label">Nama</span><span class="value">{{ $daftar->pasien->nama }}</span></div>
<div class="row"><span class="label">No. KTP</span><span class="value">{{ $daftar->pasien->no_ktp ?? '-' }}</span></div>
<div class="row"><span class="label">No. HP</span><span class="value">{{ $daftar->pasien->no_hp ?? '-' }}</span></div>
<div class="row"><span class="label">Alamat</span><span class="value">{{ $daftar->pasien->alamat ?? '-' }}</span></div>
</div>
<div class="section">
<div class="section-title">Data Dokter & Poli</div>
<div class="row"><span class="label">Dokter</span><span class="value">{{ $daftar->jadwalPeriksa->dokter->nama ?? '-' }}</span></div>
<div class="row"><span class="label">Hari Praktek</span><span class="value">{{ $daftar->jadwalPeriksa->hari ?? '-' }}</span></div>
<div class="row"><span class="label">Jam</span><span class="value">{{ substr($daftar->jadwalPeriksa->jam_mulai ?? '',0,5) }} - {{ substr($daftar->jadwalPeriksa->jam_selesai ?? '',0,5) }}</span></div>
</div>
<div class="section">
<div class="section-title">Hasil Pemeriksaan</div>
<div class="row"><span class="label">Keluhan</span><span class="value">{{ $daftar->keluhan }}</span></div>
<div class="row"><span class="label">Catatan Dokter</span><span class="value">{{ $daftar->periksa->catatan ?? '-' }}</span></div>
</div>
@if($daftar->periksa && $daftar->periksa->detailPeriksa->count() > 0)
<div class="section">
<div class="section-title">Obat yang Diberikan</div>
<div style="padding:8px 0;">
@foreach($daftar->periksa->detailPeriksa as $dp)
<span class="obat-item">{{ $dp->obat->nama_obat ?? '-' }} ({{ $dp->obat->kemasan ?? '' }})</span>
@endforeach
</div>
</div>
@endif
<div class="total">
<div class="row">
<span class="label">Total Biaya Periksa</span>
<span class="value">Rp {{ number_format($daftar->periksa->biaya_periksa ?? 0,0,',','.') }}</span>
</div>
</div>
</div>
<div class="footer">
<p>Terima kasih telah mempercayai Poliklinik Sejahtera</p>
<p>Semoga lekas sembuh! </p>
</div>
</div>
<button class="print-btn" onclick="window.print()"> Cetak Struk</button>
</body>
</html>