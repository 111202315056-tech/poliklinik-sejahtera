@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:20px;font-weight:700;color:#1e293b;"><i class="fa fa-credit-card" style="color:#2563eb;margin-right:8px;"></i>Pembayaran</h1>
<p style="color:#64748b;font-size:13px;">Upload bukti pembayaran hasil pemeriksaan Anda.</p>
</div>
@if(session('success'))<div style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px;border-radius:8px;margin-bottom:16px;font-size:13px;"><i class="fa fa-check-circle" style="margin-right:6px;"></i>{{ session('success') }}</div>@endif
@forelse($daftars as $d)
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;margin-bottom:16px;">
<div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;">
<div>
<p style="font-weight:700;color:#1e293b;font-size:15px;margin-bottom:4px;">{{ $d->jadwalPeriksa->dokter->nama ?? '-' }}</p>
<p style="font-size:12px;color:#64748b;">{{ $d->jadwalPeriksa->hari ?? '' }} | {{ substr($d->jadwalPeriksa->jam_mulai ?? '',0,5) }}</p>
<p style="font-size:12px;color:#94a3b8;margin-top:4px;">Keluhan: {{ $d->keluhan }}</p>
</div>
<div style="text-align:right;">
<p style="font-size:22px;font-weight:700;color:#1e293b;">Rp {{ number_format($d->periksa->biaya_periksa ?? 0,0,',','.') }}</p>
@if(!isset($d->pembayaran) || !in_array($d->pembayaran->status, ['sudah_bayar','lunas']))
<span style="background:#fee2e2;color:#dc2626;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">Belum Bayar</span>
@elseif($d->pembayaran->status === 'sudah_bayar')
<span style="background:#fef9c3;color:#ca8a04;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">Menunggu Konfirmasi</span>
@else
<span style="background:#dcfce7;color:#16a34a;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;"><i class="fa fa-check" style="margin-right:4px;"></i>Lunas</span>
@endif
</div>
</div>
@if(!isset($d->pembayaran) || $d->pembayaran->status === 'menunggu')
<form action="/pembayaran/{{ $d->id }}/upload" method="POST" enctype="multipart/form-data" style="border-top:1px solid #f1f5f9;padding-top:16px;">
@csrf
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:8px;font-weight:500;"><i class="fa fa-upload" style="margin-right:6px;"></i>Upload Bukti Pembayaran</label>
<div style="display:flex;gap:8px;align-items:center;">
<input type="file" name="bukti" accept="image/*" style="border:1px solid #e2e8f0;border-radius:8px;padding:8px;font-size:13px;flex:1;">
<button type="submit" style="background:#2563eb;color:white;border:none;padding:10px 20px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;white-space:nowrap;"><i class="fa fa-upload" style="margin-right:6px;"></i>Upload</button>
</div>
</form>
@elseif($d->pembayaran->status === 'sudah_bayar')
<div style="border-top:1px solid #f1f5f9;padding-top:16px;">
<p style="font-size:13px;color:#64748b;margin-bottom:8px;">Bukti yang diupload:</p>
<img src="{{ asset('storage/'.$d->pembayaran->bukti_pembayaran) }}" style="max-width:200px;border-radius:8px;border:1px solid #e2e8f0;">
<p style="font-size:11px;color:#94a3b8;margin-top:6px;">Diupload: {{ $d->pembayaran->tgl_bayar }}</p>
</div>
@elseif($d->pembayaran->status === 'lunas')
<div style="border-top:1px solid #f1f5f9;padding-top:16px;background:#f0fdf4;border-radius:8px;padding:12px;">
<p style="font-size:13px;color:#16a34a;font-weight:600;"><i class="fa fa-check-circle" style="margin-right:6px;"></i>Pembayaran telah dikonfirmasi pada {{ $d->pembayaran->tgl_konfirmasi }}</p>
</div>
@endif
</div>
@empty
<div style="background:white;border-radius:12px;padding:60px;text-align:center;">
<i class="fa fa-credit-card" style="font-size:48px;color:#cbd5e1;display:block;margin-bottom:12px;"></i>
<p style="color:#94a3b8;">Belum ada tagihan</p>
</div>
@endforelse
@endsection