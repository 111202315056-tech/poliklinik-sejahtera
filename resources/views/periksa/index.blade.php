@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:20px;font-weight:700;color:#1e293b;"><i class="fa fa-stethoscope" style="color:#16a34a;margin-right:8px;"></i>Daftar Pasien Periksa</h1><a href="/export/riwayat-pasien" style="background:#16a34a;color:white;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;display:inline-block;margin-top:8px;\"><i class="fa fa-file-excel" style="margin-right:6px;"></i>Export Riwayat Pasien</a>
<p style="color:#64748b;font-size:13px;">Kelola pemeriksaan pasien Anda hari ini.</p>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<table style="width:100%;border-collapse:collapse;font-size:13px;">
<thead>
<tr style="background:#f0fdf4;">
<th style="padding:12px;text-align:left;color:#16a34a;font-weight:600;">#</th>
<th style="padding:12px;text-align:left;color:#16a34a;font-weight:600;">Nama Pasien</th>
<th style="padding:12px;text-align:left;color:#16a34a;font-weight:600;">Hari</th>
<th style="padding:12px;text-align:left;color:#16a34a;font-weight:600;">Keluhan</th>
<th style="padding:12px;text-align:left;color:#16a34a;font-weight:600;">No Antrian</th>
<th style="padding:12px;text-align:left;color:#16a34a;font-weight:600;">Status</th>
<th style="padding:12px;text-align:left;color:#16a34a;font-weight:600;">Aksi</th>
</tr>
</thead>
<tbody>
@forelse($daftars as $i => $d)
<tr style="border-bottom:1px solid #f1f5f9;">
<td style="padding:12px;">{{ $i+1 }}</td>
<td style="padding:12px;font-weight:600;color:#1e293b;">{{ $d->pasien->nama }}</td>
<td style="padding:12px;">{{ $d->jadwalPeriksa->hari }}</td>
<td style="padding:12px;color:#64748b;">{{ Str::limit($d->keluhan,30) }}</td>
<td style="padding:12px;text-align:center;">
<span style="background:#dbeafe;color:#2563eb;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:700;">{{ $d->no_antrian }}</span>
</td>
<td style="padding:12px;">
@if($d->periksa)
<span style="background:#dcfce7;color:#16a34a;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;"><i class="fa fa-check" style="margin-right:4px;"></i>Sudah Diperiksa</span>
@else
<span style="background:#fef9c3;color:#ca8a04;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;"><i class="fa fa-clock" style="margin-right:4px;"></i>Menunggu</span>
@endif
</td>
<td style="padding:12px;">
<div style="display:flex;gap:6px;">
@if(!$d->periksa)
<a href="/periksa/{{ $d->id }}/form" style="background:#16a34a;color:white;padding:6px 12px;border-radius:8px;font-size:12px;text-decoration:none;font-weight:500;"><i class="fa fa-notes-medical" style="margin-right:4px;"></i>Periksa</a>
@else
<a href="/periksa/{{ $d->id }}/form" style="background:#f59e0b;color:white;padding:6px 12px;border-radius:8px;font-size:12px;text-decoration:none;font-weight:500;"><i class="fa fa-edit" style="margin-right:4px;"></i>Edit</a>
<a href="/cetak-struk/{{ $d->id }}" target="_blank" style="background:#2563eb;color:white;padding:6px 12px;border-radius:8px;font-size:12px;text-decoration:none;font-weight:500;"><i class="fa fa-print" style="margin-right:4px;"></i>Cetak Struk</a>
@endif
</div>
</td>
</tr>
@empty
<tr><td colspan="7" style="text-align:center;padding:40px;color:#94a3b8;">
<i class="fa fa-inbox" style="font-size:40px;display:block;margin-bottom:8px;"></i>Belum ada pasien yang mendaftar
</td></tr>
@endforelse
</tbody>
</table>
</div>
@endsection