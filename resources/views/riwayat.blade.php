@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:20px;font-weight:700;color:#1e293b;"><i class="fa fa-clock-rotate-left" style="color:#2563eb;margin-right:8px;"></i>Riwayat Pendaftaran</h1>
<p style="color:#64748b;font-size:13px;">Semua riwayat pendaftaran poli Anda.</p>
</div>
@forelse($riwayats as $r)
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:20px;margin-bottom:12px;">
<div style="display:flex;justify-content:space-between;align-items:flex-start;">
<div style="display:flex;gap:16px;align-items:flex-start;">
<div style="background:#dbeafe;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;color:#2563eb;flex-shrink:0;">{{ $r->no_antrian }}</div>
<div>
<p style="font-weight:700;color:#1e293b;font-size:15px;margin-bottom:4px;">{{ $r->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}</p>
<p style="font-size:13px;color:#2563eb;font-weight:600;margin-bottom:4px;">{{ $r->jadwalPeriksa->dokter->nama ?? '-' }}</p>
<p style="font-size:12px;color:#64748b;margin-bottom:4px;"><i class="fa fa-calendar" style="margin-right:4px;"></i>{{ $r->jadwalPeriksa->hari ?? '-' }} | {{ substr($r->jadwalPeriksa->jam_mulai ?? '',0,5) }} - {{ substr($r->jadwalPeriksa->jam_selesai ?? '',0,5) }}</p>
<p style="font-size:12px;color:#94a3b8;"><i class="fa fa-clock" style="margin-right:4px;"></i>Didaftarkan: {{ $r->created_at->format('d M Y H:i') }}</p>
</div>
</div>
<div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;">
@if($r->periksa)
<span style="background:#dcfce7;color:#16a34a;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;"><i class="fa fa-check" style="margin-right:4px;"></i>Sudah Diperiksa</span>
<a href="/riwayat/{{ $r->id }}/detail" style="background:#2563eb;color:white;padding:6px 16px;border-radius:8px;font-size:12px;text-decoration:none;font-weight:600;"><i class="fa fa-eye" style="margin-right:4px;"></i>Detail</a>
@else
<span style="background:#fef9c3;color:#ca8a04;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;"><i class="fa fa-clock" style="margin-right:4px;"></i>Menunggu</span>
@endif
</div>
</div>
<div style="margin-top:12px;padding-top:12px;border-top:1px solid #f1f5f9;font-size:13px;color:#64748b;">
<i class="fa fa-comment" style="margin-right:6px;"></i>Keluhan: {{ $r->keluhan }}
</div>
</div>
@empty
<div style="background:white;border-radius:12px;padding:60px;text-align:center;">
<i class="fa fa-clipboard" style="font-size:48px;color:#cbd5e1;display:block;margin-bottom:12px;"></i>
<p style="color:#94a3b8;">Belum ada riwayat pendaftaran</p>
<a href="/pendaftaran" style="display:inline-block;margin-top:12px;background:#2563eb;color:white;padding:8px 20px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;">Daftar Sekarang</a>
</div>
@endforelse
@endsection