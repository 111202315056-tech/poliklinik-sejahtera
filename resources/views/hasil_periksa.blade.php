@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:20px;font-weight:700;color:#1e293b;"><i class="fa fa-file-medical" style="color:#16a34a;margin-right:8px;"></i>Hasil Pemeriksaan</h1>
<p style="color:#64748b;font-size:13px;">Riwayat pemeriksaan Anda di poliklinik.</p>
</div>
@forelse($daftars as $d)
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;margin-bottom:16px;">
<div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;">
<div style="display:flex;align-items:center;gap:12px;">
<div style="background:#dbeafe;border-radius:50%;width:44px;height:44px;display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:700;color:#2563eb;">{{ $d->no_antrian }}</div>
<div>
<p style="font-weight:700;color:#1e293b;font-size:15px;">{{ $d->jadwalPeriksa->dokter->nama ?? '-' }}</p>
<p style="font-size:12px;color:#64748b;">{{ $d->jadwalPeriksa->hari ?? '' }} | {{ substr($d->jadwalPeriksa->jam_mulai ?? '',0,5) }} - {{ substr($d->jadwalPeriksa->jam_selesai ?? '',0,5) }}</p>
</div>
</div>
@if($d->periksa)
<span style="background:#dcfce7;color:#16a34a;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;"><i class="fa fa-check" style="margin-right:4px;"></i>Sudah Diperiksa</span>
@else
<span style="background:#fef9c3;color:#ca8a04;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;"><i class="fa fa-clock" style="margin-right:4px;"></i>Menunggu</span>
@endif
</div>
<div style="background:#f8fafc;border-radius:8px;padding:12px;margin-bottom:12px;font-size:13px;">
<p style="color:#64748b;"><span style="font-weight:600;">Keluhan:</span> {{ $d->keluhan }}</p>
</div>
@if($d->periksa)
<div style="border-top:1px solid #f1f5f9;padding-top:16px;">
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:12px;">
<div style="background:#f0fdf4;border-radius:8px;padding:14px;">
<p style="font-size:11px;color:#16a34a;font-weight:700;text-transform:uppercase;margin-bottom:6px;">Catatan Dokter</p>
<p style="font-size:13px;color:#1e293b;">{{ $d->periksa->catatan ?? '-' }}</p>
</div>
<div style="background:#eff6ff;border-radius:8px;padding:14px;">
<p style="font-size:11px;color:#2563eb;font-weight:700;text-transform:uppercase;margin-bottom:6px;">Biaya Periksa</p>
<p style="font-size:18px;font-weight:700;color:#1e293b;">Rp {{ number_format($d->periksa->biaya_periksa ?? 0,0,',','.') }}</p>
</div>
</div>
@if($d->periksa->detailPeriksa && $d->periksa->detailPeriksa->count() > 0)
<div style="background:#fefce8;border-radius:8px;padding:14px;margin-bottom:12px;">
<p style="font-size:11px;color:#ca8a04;font-weight:700;text-transform:uppercase;margin-bottom:8px;"><i class="fa fa-pills" style="margin-right:4px;"></i>Obat yang Diberikan</p>
<div style="display:flex;flex-wrap:wrap;gap:8px;">
@foreach($d->periksa->detailPeriksa as $dp)
<span style="background:white;border:1px solid #fde68a;color:#92400e;padding:4px 12px;border-radius:20px;font-size:12px;">{{ $dp->obat->nama_obat ?? '-' }} ({{ $dp->obat->kemasan ?? '' }})</span>
@endforeach
</div>
</div>
@endif
<p style="font-size:11px;color:#94a3b8;">Diperiksa pada: {{ $d->periksa->tgl_periksa }}</p>
<a href="/cetak-struk/{{ $d->id }}" target="_blank" style="display:inline-block;margin-top:10px;background:#2563eb;color:white;padding:8px 20px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;"><i class="fa fa-print" style="margin-right:6px;"></i>Cetak Struk</a>
</div>
@else
<div style="text-align:center;padding:16px;color:#94a3b8;font-size:13px;">
<i class="fa fa-hourglass-half" style="font-size:24px;display:block;margin-bottom:8px;"></i>Menunggu diperiksa oleh dokter
</div>
@endif
</div>
@empty
<div style="background:white;border-radius:12px;padding:60px;text-align:center;">
<i class="fa fa-file-medical" style="font-size:48px;color:#cbd5e1;display:block;margin-bottom:12px;"></i>
<p style="color:#94a3b8;">Belum ada riwayat pemeriksaan</p>
<a href="/pendaftaran" style="display:inline-block;margin-top:12px;background:#2563eb;color:white;padding:8px 20px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;">Daftar Periksa Sekarang</a>
</div>
@endforelse
@endsection