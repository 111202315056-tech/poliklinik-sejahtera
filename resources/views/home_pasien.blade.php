@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:22px;font-weight:700;color:#1e293b;">Selamat Datang, {{ Auth::user()->nama }}!</h1>
<p style="color:#64748b;font-size:14px;">Kelola pendaftaran dan hasil pemeriksaan Anda.</p>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;margin-bottom:24px;">
<div style="background:#22c55e;border-radius:12px;padding:20px;color:white;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Total Pemeriksaan</p>
<p style="font-size:32px;font-weight:700;">{{ $totalPeriksa }}</p>
</div>
<div style="background:#06b6d4;border-radius:12px;padding:20px;color:white;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Menunggu Antrian</p>
<p style="font-size:32px;font-weight:700;">{{ $totalAntrian }}</p>
</div>
<div style="background:#2563eb;border-radius:12px;padding:20px;color:white;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Pemeriksaan Terakhir</p>
<p style="font-size:14px;font-weight:600;">{{ $lastPeriksa ?? '-' }}</p>
</div>
</div>
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:20px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;">Riwayat Pendaftaran</h2>
@forelse($daftars as $d)
<div style="border:1px solid #e2e8f0;border-radius:10px;padding:14px;margin-bottom:10px;display:flex;justify-content:space-between;align-items:center;">
<div>
<p style="font-weight:600;color:#1e293b;font-size:14px;margin-bottom:3px;">{{ $d->jadwalPeriksa->dokter->nama ?? '-' }}</p>
<p style="font-size:12px;color:#64748b;">{{ $d->jadwalPeriksa->hari }}</p>
<p style="font-size:12px;color:#94a3b8;margin-top:3px;">{{ $d->keluhan }}</p>
</div>
<div style="text-align:center;">
<div style="background:#dbeafe;color:#2563eb;border-radius:50%;width:44px;height:44px;display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:700;margin:0 auto 3px;">{{ $d->no_antrian }}</div>
<p style="font-size:10px;color:#94a3b8;">Antrian</p>
</div>
</div>
@empty
<p style="text-align:center;color:#94a3b8;padding:30px 0;">Belum ada riwayat</p>
@endforelse
<a href="/pendaftaran" style="display:block;text-align:center;background:#2563eb;color:white;padding:10px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;margin-top:12px;">Daftar Periksa Baru</a>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:20px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;">Informasi Pasien</h2>
<div style="text-align:center;margin-bottom:16px;">
<div style="background:#2563eb;border-radius:50%;width:56px;height:56px;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:700;color:white;margin:0 auto 10px;">{{ strtoupper(substr(Auth::user()->nama,0,1)) }}</div>
<p style="font-weight:700;color:#1e293b;">{{ Auth::user()->nama }}</p>
</div>
<div style="font-size:13px;color:#64748b;display:flex;flex-direction:column;gap:8px;border-top:1px solid #f1f5f9;padding-top:14px;">
<div><i class="fa fa-envelope" style="width:20px;color:#94a3b8;"></i>{{ Auth::user()->email }}</div>
@if(Auth::user()->no_hp)<div><i class="fa fa-phone" style="width:20px;color:#94a3b8;"></i>{{ Auth::user()->no_hp }}</div>@endif
@if(Auth::user()->alamat)<div><i class="fa fa-map-marker-alt" style="width:20px;color:#94a3b8;"></i>{{ Auth::user()->alamat }}</div>@endif
</div>
</div>
</div>
@endsection