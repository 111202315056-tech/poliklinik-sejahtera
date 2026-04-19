@extends('layouts.app')
@section('content')
<div style="display:grid;grid-template-columns:1fr 2fr;gap:24px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-user-plus" style="color:#16a34a;margin-right:8px;"></i>{{ isset($pasien) ? 'Edit Pasien' : 'Tambah Pasien' }}</h2>
<form action="{{ isset($pasien) ? '/pasien/'.$pasien->id.'/update' : '/pasien' }}" method="POST">
@csrf
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Nama Lengkap</label>
<input type="text" name="nama" placeholder="Nama pasien" value="{{ isset($pasien) ? $pasien->nama : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Email (untuk login)</label>
<input type="email" name="email" placeholder="email@gmail.com" value="{{ isset($pasien) ? $pasien->email : '' }}" {{ isset($pasien) ? 'readonly' : '' }} style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Password {{ isset($pasien) ? '(kosongkan jika tidak diubah)' : '(default: pasien123)' }}</label>
<input type="text" name="password" placeholder="{{ isset($pasien) ? 'Kosongkan jika tidak diubah' : 'pasien123' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">No KTP</label>
<input type="text" name="no_ktp" placeholder="No KTP" value="{{ isset($pasien) ? $pasien->no_ktp : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">No HP</label>
<input type="text" name="no_hp" placeholder="No HP" value="{{ isset($pasien) ? $pasien->no_hp : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Alamat</label>
<input type="text" name="alamat" placeholder="Alamat" value="{{ isset($pasien) ? $pasien->alamat : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="display:flex;gap:8px;">
<button type="submit" style="background:#16a34a;color:white;border:none;padding:10px 16px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;flex:1;"><i class="fa fa-save" style="margin-right:6px;"></i>Simpan</button>
@if(isset($pasien))<a href="/pasien" style="background:#94a3b8;color:white;padding:10px 16px;border-radius:8px;font-size:14px;text-decoration:none;display:flex;align-items:center;"><i class="fa fa-times"></i></a>@endif
</div>
</form>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;"><h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:0;"><i class="fa fa-list" style="color:#16a34a;margin-right:8px;"></i>Daftar Pasien</h2><a href="/export/pasien" style="background:#16a34a;color:white;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;"><i class="fa fa-file-excel" style="margin-right:6px;"></i>Export Excel</a></div>
<table style="width:100%;border-collapse:collapse;font-size:13px;">
<thead>
<tr style="background:#f0fdf4;">
<th style="padding:10px 12px;text-align:left;color:#16a34a;font-weight:600;">#</th>
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
<td style="padding:12px;font-weight:600;color:#1e293b;">{{ $p->nama }}</td>
<td style="padding:12px;color:#64748b;">{{ $p->email }}</td>
<td style="padding:12px;color:#64748b;">{{ $p->no_ktp ?? '-' }}</td>
<td style="padding:12px;color:#64748b;">{{ $p->no_hp ?? '-' }}</td>
<td style="padding:12px;">
<div style="display:flex;gap:6px;">
<a href="/pasien/{{ $p->id }}/edit" style="background:#22c55e;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-edit"></i></a>
<a href="/pasien/{{ $p->id }}/delete" onclick="return confirm('Yakin hapus?')" style="background:#ef4444;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-trash"></i></a>
</div>
</td>
</tr>
@empty
<tr><td colspan="6" style="text-align:center;padding:30px;color:#94a3b8;">Belum ada pasien</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
@endsection