@extends('layouts.app')
@section('content')
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
<h2 style="font-size:18px;font-weight:700;color:#1e293b;"><i class="fa fa-hospital" style="color:#14b8a6;margin-right:8px;"></i>Manajemen Poli</h2>
<a href="{{ route('polis.create') }}" style="background:#14b8a6;color:white;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;"><i class="fa fa-plus" style="margin-right:6px;"></i>Tambah Poli</a>
</div>
@if(session('success'))<div style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:16px;"><i class="fa fa-check-circle" style="margin-right:8px;"></i>{{ session('success') }}</div>@endif
<table style="width:100%;border-collapse:collapse;font-size:13px;">
<thead><tr style="background:#f0fdfa;">
<th style="padding:12px;text-align:left;color:#0d9488;">#</th>
<th style="padding:12px;text-align:left;color:#0d9488;">Nama Poli</th>
<th style="padding:12px;text-align:left;color:#0d9488;">Keterangan</th>
<th style="padding:12px;text-align:left;color:#0d9488;">Aksi</th>
</tr></thead>
<tbody>
@forelse($polis as $i => $p)
<tr style="border-bottom:1px solid #f1f5f9;">
<td style="padding:12px;">{{ $i+1 }}</td>
<td style="padding:12px;font-weight:600;color:#1e293b;">{{ $p->nama_poli }}</td>
<td style="padding:12px;color:#64748b;">{{ $p->keterangan ?? '-' }}</td>
<td style="padding:12px;">
<div style="display:flex;gap:6px;">
<a href="{{ route('polis.edit',$p->id) }}" style="background:#22c55e;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-edit"></i></a>
<form action="{{ route('polis.destroy',$p->id) }}" method="POST" style="display:inline;">
@csrf @method('DELETE')
<button type="submit" onclick="return confirm('Yakin hapus?')" style="background:#ef4444;color:white;padding:5px 10px;border-radius:6px;font-size:12px;border:none;cursor:pointer;"><i class="fa fa-trash"></i></button>
</form>
</div>
</td>
</tr>
@empty
<tr><td colspan="4" style="text-align:center;padding:30px;color:#94a3b8;">Belum ada data poli</td></tr>
@endforelse
</tbody></table>
</div>
@endsection