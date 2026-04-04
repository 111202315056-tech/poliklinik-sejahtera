@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:22px;font-weight:700;color:#1e293b;">Selamat Datang, {{ $user->nama }}!</h1>
<p style="color:#64748b;font-size:14px;">Kelola jadwal dan pemeriksaan pasien Anda.</p>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:20px;display:flex;align-items:center;gap:16px;">
<div style="background:#dbeafe;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
<i class="fa fa-calendar-check" style="color:#2563eb;font-size:20px;"></i>
</div>
<div>
<p style="font-size:12px;color:#94a3b8;text-transform:uppercase;font-weight:600;">Sudah Diperiksa</p>
<p style="font-size:28px;font-weight:700;color:#1e293b;">{{ $totalPeriksa }}</p>
</div>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:20px;display:flex;align-items:center;gap:16px;">
<div style="background:#fef3c7;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
<i class="fa fa-clock" style="color:#d97706;font-size:20px;"></i>
</div>
<div>
<p style="font-size:12px;color:#94a3b8;text-transform:uppercase;font-weight:600;">Menunggu Periksa</p>
<p style="font-size:28px;font-weight:700;color:#1e293b;">{{ $totalMenunggu }}</p>
</div>
</div>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
<a href="/jadwal" style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:20px;display:flex;align-items:center;gap:16px;border-left:4px solid #2563eb;text-decoration:none;">
<div style="background:#dbeafe;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
<i class="fa fa-calendar-days" style="color:#2563eb;font-size:20px;"></i>
</div>
<div>
<p style="font-weight:600;color:#1e293b;font-size:14px;">Jadwal Periksa</p>
<p style="color:#94a3b8;font-size:12px;">Lihat jadwal praktek Anda</p>
</div>
<i class="fa fa-chevron-right" style="color:#cbd5e1;margin-left:auto;"></i>
</a>
<a href="/periksa" style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:20px;display:flex;align-items:center;gap:16px;border-left:4px solid #16a34a;text-decoration:none;">
<div style="background:#dcfce7;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
<i class="fa fa-stethoscope" style="color:#16a34a;font-size:20px;"></i>
</div>
<div>
<p style="font-weight:600;color:#1e293b;font-size:14px;">Periksa Pasien</p>
<p style="color:#94a3b8;font-size:12px;">Kelola pemeriksaan pasien</p>
</div>
<i class="fa fa-chevron-right" style="color:#cbd5e1;margin-left:auto;"></i>
</a>
</div>
@endsection