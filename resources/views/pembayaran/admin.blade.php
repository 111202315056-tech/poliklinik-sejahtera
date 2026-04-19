@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:20px;font-weight:700;color:#1e293b;"><i class="fa fa-credit-card" style="color:#2563eb;margin-right:8px;"></i>Verifikasi Pembayaran</h1>
<p style="color:#64748b;font-size:13px;">Kelola dan konfirmasi pembayaran pasien.</p>
</div>
@if(session('success'))<div style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px;border-radius:8px;margin-bottom:16px;font-size:13px;">{{ session('success') }}</div>@endif
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<table style="width:100%;border-collapse:collapse;font-size:13px;">
<thead><tr style="background:#eff6ff;">
<th style="padding:12px;text-align:left;color:#2563eb;font-weight:600;">#</th>
<th style="padding:12px;text-align:left;color:#2563eb;font-weight:600;">Pasien</th>
<th style="padding:12px;text-align:left;color:#2563eb;font-weight:600;">Biaya</th>
<th style="padding:12px;text-align:left;color:#2563eb;font-weight:600;">Bukti</th>
<th style="padding:12px;text-align:left;color:#2563eb;font-weight:600;">Status</th>
<th style="padding:12px;text-align:left;color:#2563eb;font-weight:600;">Tgl Upload</th>
<th style="padding:12px;text-align:left;color:#2563eb;font-weight:600;">Aksi</th>
</tr></thead>
<tbody>
@forelse($pembayarans as $i => $p)
<tr style="border-bottom:1px solid #f1f5f9;">
<td style="padding:12px;">{{ $i+1 }}</td>
<td style="padding:12px;font-weight:600;color:#1e293b;">{{ $p->daftarPoli->pasien->nama ?? '-' }}</td>
<td style="padding:12px;font-weight:600;">Rp {{ number_format($p->daftarPoli->periksa->biaya_periksa ?? 0,0,',','.') }}</td>
<td style="padding:12px;">
@if($p->bukti_pembayaran)
<a href="{{ asset('storage/'.$p->bukti_pembayaran) }}" target="_blank">
<img src="{{ asset('storage/'.$p->bukti_pembayaran) }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
</a>
@else
<span style="color:#94a3b8;font-size:12px;">Belum upload</span>
@endif
</td>
<td style="padding:12px;">
@if($p->status === 'menunggu')
<span style="background:#fee2e2;color:#dc2626;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">Belum Bayar</span>
@elseif($p->status === 'sudah_bayar')
<span style="background:#fef9c3;color:#ca8a04;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">Menunggu Konfirmasi</span>
@else
<span style="background:#dcfce7;color:#16a34a;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">Lunas</span>
@endif
</td>
<td style="padding:12px;color:#64748b;font-size:12px;">{{ $p->tgl_bayar ?? '-' }}</td>
<td style="padding:12px;">
@if($p->status === 'sudah_bayar')
<a href="/pembayaran/{{ $p->id_daftar_poli }}/konfirmasi" onclick="return confirm('Konfirmasi pembayaran ini?')" style="background:#16a34a;color:white;padding:6px 14px;border-radius:8px;font-size:12px;text-decoration:none;font-weight:600;"><i class="fa fa-check" style="margin-right:4px;"></i>Konfirmasi</a>
@elseif($p->status === 'lunas')
<span style="color:#16a34a;font-size:12px;font-weight:600;"><i class="fa fa-check-circle" style="margin-right:4px;"></i>Terkonfirmasi</span>
@else
<span style="color:#94a3b8;font-size:12px;">Menunggu upload</span>
@endif
</td>
</tr>
@empty
<tr><td colspan="7" style="text-align:center;padding:40px;color:#94a3b8;">Belum ada data pembayaran</td></tr>
@endforelse
</tbody>
</table>
</div>
@endsection