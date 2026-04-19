@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;display:flex;align-items:center;gap:12px;">
<a href="/riwayat" style="background:#f1f5f9;color:#64748b;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:13px;"><i class="fa fa-arrow-left" style="margin-right:6px;"></i>Kembali</a>
<h1 style="font-size:20px;font-weight:700;color:#1e293b;">Detail Pemeriksaan</h1>
</div>
<div style="max-width:700px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;margin-bottom:16px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-info-circle" style="color:#2563eb;margin-right:8px;"></i>Informasi Kunjungan</h2>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
<div style="background:#f8fafc;border-radius:8px;padding:12px;">
<p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-bottom:4px;">Nama Poli</p>
<p style="font-size:14px;font-weight:600;color:#1e293b;">{{ $daftar->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</p>
</div>
<div style="background:#f8fafc;border-radius:8px;padding:12px;">
<p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-bottom:4px;">Dokter</p>
<p style="font-size:14px;font-weight:600;color:#1e293b;">{{ $daftar->jadwalPeriksa->dokter->nama ?? '-' }}</p>
</div>
<div style="background:#f8fafc;border-radius:8px;padding:12px;">
<p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-bottom:4px;">Jadwal</p>
<p style="font-size:14px;font-weight:600;color:#1e293b;">{{ $daftar->jadwalPeriksa->hari ?? '-' }} | {{ substr($daftar->jadwalPeriksa->jam_mulai ?? '',0,5) }}-{{ substr($daftar->jadwalPeriksa->jam_selesai ?? '',0,5) }}</p>
</div>
<div style="background:#f8fafc;border-radius:8px;padding:12px;">
<p style="font-size:11px;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-bottom:4px;">No Antrian</p>
<p style="font-size:14px;font-weight:600;color:#1e293b;">{{ $daftar->no_antrian }}</p>
</div>
</div>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;margin-bottom:16px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-stethoscope" style="color:#16a34a;margin-right:8px;"></i>Hasil Pemeriksaan</h2>
<div style="margin-bottom:12px;">
<p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-bottom:6px;">Keluhan</p>
<p style="font-size:14px;color:#1e293b;">{{ $daftar->keluhan }}</p>
</div>
<div style="margin-bottom:12px;">
<p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-bottom:6px;">Catatan Dokter</p>
<p style="font-size:14px;color:#1e293b;">{{ $daftar->periksa->catatan ?? '-' }}</p>
</div>
@if($daftar->periksa && $daftar->periksa->detailPeriksa->count() > 0)
<div style="margin-bottom:12px;">
<p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;margin-bottom:8px;">Obat Diberikan</p>
<div style="display:flex;flex-wrap:wrap;gap:8px;">
@foreach($daftar->periksa->detailPeriksa as $dp)
<span style="background:#fefce8;border:1px solid #fde68a;color:#92400e;padding:4px 12px;border-radius:20px;font-size:12px;">{{ $dp->obat->nama_obat ?? '-' }} ({{ $dp->obat->kemasan ?? '' }})</span>
@endforeach
</div>
</div>
@endif
<div style="background:#eff6ff;border-radius:8px;padding:16px;margin-top:16px;">
<p style="font-size:12px;color:#2563eb;font-weight:600;text-transform:uppercase;margin-bottom:4px;">Total Biaya</p>
<p style="font-size:24px;font-weight:700;color:#1e293b;">Rp {{ number_format($daftar->periksa->biaya_periksa ?? 0,0,',','.') }}</p>
</div>
<p style="font-size:11px;color:#94a3b8;margin-top:12px;">Diperiksa: {{ $daftar->periksa->tgl_periksa }}</p>
</div>
</div>
@endsection