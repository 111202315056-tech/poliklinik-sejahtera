@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:20px;font-weight:700;color:#1e293b;"><i class="fa fa-users" style="color:#16a34a;margin-right:8px;"></i>Manajemen Pasien</h1>
<p style="color:#64748b;font-size:13px;">Daftar semua pasien terdaftar.</p>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
<h2 style="font-size:16px;font-weight:700;color:#1e293b;"><i class="fa fa-list" style="color:#16a34a;margin-right:8px;"></i>Daftar Pasien</h2>
<a href="/export/pasien" style="background:#16a34a;color:white;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;"><i class="fa fa-file-excel" style="margin-right:6px;"></i>Export Excel</a>
</div>
@if(session('success'))<div style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px;border-radius:8px;margin-bottom:16px;font-size:13px;">{{ session('success') }}</div>@endif
<table style="width:100%;border-collapse:collapse;font-size:13px;">
<thead>
<tr style="background:#f0fdf4;">
<th style="padding:10px 12px;text-align:left;color:#16a34a;font-weight:600;">#</th>
<th style="padding:10px 12px;text-align:left;color:#16a34a;font-weight:600;">No RM</th>
<th style="padding:10px 12px;text-align:left;color:#16a34a;font-weight:600;">Nama</th>
<th style="padding:10px 12px;text-align:left;color:#16a34a;font-weight:600;">Email</th>
<th style="padding:10px 12px;text-align:left;color:#16a34a;font-weight:600;">No KTP</th>
<th style="padding:10px 12px;text-align:left;color:#16a34a;font-weight:600;">No HP</th>
<th style="padding:10px 12px;text-align:left;color:#16a34a;font-weight:600;">Aksi</th>
</tr>
</thead>
<tbody>
@forelse($pasiens as $i => $p)
<tr style="border-bottom:1px solid #f1f5f9;">
<td style="padding:12px;">{{ $i+1 }}</td>
<td style="padding:12px;font-weight:600;color:#2563eb;">{{ $p->no_rm ?? '-' }}</td>
<td style="padding:12px;font-weight:600;color:#1e293b;">{{ $p->nama }}</td>
<td style="padding:12px;color:#64748b;">{{ $p->email }}</td>
<td style="padding:12px;color:#64748b;">{{ $p->no_ktp ?? '-' }}</td>
<td style="padding:12px;color:#64748b;">{{ $p->no_hp ?? '-' }}</td>
<td style="padding:12px;">
<div style="display:flex;gap:6px;">
<a href="/pasien/{{ $p->id }}/edit" style="background:#f59e0b;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-edit"></i></a>
<a href="/pasien/{{ $p->id }}/delete" onclick="return confirm('Yakin hapus?')" style="background:#ef4444;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-trash"></i></a>
</div>
</td>
</tr>
@empty
<tr><td colspan="7" style="text-align:center;padding:30px;color:#94a3b8;">Belum ada pasien terdaftar</td></tr>
@endforelse
</tbody>
</table>
</div>
@endsection