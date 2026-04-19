@extends('layouts.app')
@section('content')
<div style="display:grid;grid-template-columns:1fr 2fr;gap:24px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-user-doctor" style="color:#2563eb;margin-right:8px;"></i>{{ isset($dokter) ? 'Edit Dokter' : 'Tambah Dokter' }}</h2>
<form action="{{ isset($dokter) ? '/dokter/'.$dokter->id.'/update' : '/dokter' }}" method="POST">
@csrf
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Nama Lengkap</label>
<input type="text" name="nama" placeholder="Contoh: dr. Budi Santoso" value="{{ isset($dokter) ? $dokter->nama : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Email (untuk login)</label>
<input type="email" name="email" placeholder="email@poliklinik.com" value="{{ isset($dokter) ? $dokter->email : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Password {{ isset($dokter) ? '(kosongkan jika tidak diubah)' : '(default: dokter123)' }}</label>
<input type="text" name="password" placeholder="{{ isset($dokter) ? 'Kosongkan jika tidak diubah' : 'dokter123' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Alamat</label>
<input type="text" name="alamat" placeholder="Alamat dokter" value="{{ isset($dokter) ? $dokter->alamat : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">No HP</label>
<input type="text" name="no_hp" placeholder="No HP" value="{{ isset($dokter) ? $dokter->no_hp : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Poli</label>
<select name="id_poli" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
<option value="">-- Pilih Poli --</option>
@foreach($polis as $p)
<option value="{{ $p->id }}" {{ isset($dokter) && $dokter->id_poli == $p->id ? 'selected' : '' }}>{{ $p->nama_poli }}</option>
@endforeach
</select>
</div>
<div style="display:flex;gap:8px;">
<button type="submit" style="background:#2563eb;color:white;border:none;padding:10px 16px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;flex:1;"><i class="fa fa-save" style="margin-right:6px;"></i>Simpan</button>
@if(isset($dokter))<a href="/dokter" style="background:#94a3b8;color:white;padding:10px 16px;border-radius:8px;font-size:14px;text-decoration:none;display:flex;align-items:center;"><i class="fa fa-times"></i></a>@endif
</div>
</form>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;"><h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:0;"><i class="fa fa-list" style="color:#2563eb;margin-right:8px;"></i>Daftar Dokter</h2><a href="/export/dokter" style="background:#16a34a;color:white;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;"><i class="fa fa-file-excel" style="margin-right:6px;"></i>Export Excel</a></div>
<table style="width:100%;border-collapse:collapse;font-size:13px;">
<thead>
<tr style="background:#eff6ff;">
<th style="padding:10px 12px;text-align:left;color:#2563eb;font-weight:600;border-radius:8px 0 0 8px;">#</th>
<th style="padding:10px 12px;text-align:left;color:#2563eb;font-weight:600;">Nama</th>
<th style="padding:10px 12px;text-align:left;color:#2563eb;font-weight:600;">Email</th>
<th style="padding:10px 12px;text-align:left;color:#2563eb;font-weight:600;">Poli</th>
<th style="padding:10px 12px;text-align:left;color:#2563eb;font-weight:600;">No HP</th>
<th style="padding:10px 12px;text-align:left;color:#2563eb;font-weight:600;border-radius:0 8px 8px 0;">Aksi</th>
</tr>
</thead>
<tbody>
@forelse($dokters as $i => $d)
<tr style="border-bottom:1px solid #f1f5f9;">
<td style="padding:12px;">{{ $i+1 }}</td>
<td style="padding:12px;font-weight:600;color:#1e293b;">{{ $d->nama }}</td>
<td style="padding:12px;color:#64748b;">{{ $d->email }}</td>
<td style="padding:12px;">
@if($d->poli)<span style="background:#dbeafe;color:#2563eb;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;">{{ $d->poli->nama_poli }}</span>
@else<span style="background:#f1f5f9;color:#94a3b8;padding:2px 10px;border-radius:20px;font-size:11px;">Belum ada poli</span>@endif
</td>
<td style="padding:12px;color:#64748b;">{{ $d->no_hp }}</td>
<td style="padding:12px;">
<div style="display:flex;gap:6px;">
<a href="/dokter/{{ $d->id }}/edit" style="background:#22c55e;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-edit"></i></a>
<a href="/dokter/{{ $d->id }}/delete" onclick="return confirm('Yakin hapus?')" style="background:#ef4444;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-trash"></i></a>
</div>
</td>
</tr>
@empty
<tr><td colspan="6" style="text-align:center;padding:30px;color:#94a3b8;">Belum ada dokter</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
@endsection