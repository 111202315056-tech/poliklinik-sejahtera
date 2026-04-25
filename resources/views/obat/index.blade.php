@extends('layouts.app')
@section('content')
<div style="display:flex;flex-wrap:wrap;gap:24px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-pills" style="color:#8b5cf6;margin-right:8px;"></i>{{ isset($obat) ? 'Edit Obat' : 'Tambah Obat' }}</h2>
<form action="{{ isset($obat) ? '/obat/'.$obat->id.'/update' : '/obat' }}" method="POST">
@csrf
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Nama Obat</label>
<input type="text" name="nama_obat" placeholder="Nama obat" value="{{ isset($obat) ? $obat->nama_obat : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Kemasan</label>
<input type="text" name="kemasan" placeholder="Contoh: Tablet, Sirup" value="{{ isset($obat) ? $obat->kemasan : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Harga (Rp)</label>
<input type="number" name="harga" placeholder="Contoh: 5000" value="{{ isset($obat) ? $obat->harga : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Stok</label>
<input type="number" name="stok" placeholder="Jumlah stok" min="0" value="{{ isset($obat) ? $obat->stok : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="display:flex;gap:8px;">
<button type="submit" style="background:#8b5cf6;color:white;border:none;padding:10px 16px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;flex:1;"><i class="fa fa-save" style="margin-right:6px;"></i>Simpan</button>
@if(isset($obat))<a href="/obat" style="background:#94a3b8;color:white;padding:10px 16px;border-radius:8px;font-size:14px;text-decoration:none;display:flex;align-items:center;"><i class="fa fa-times"></i></a>@endif
</div>
</form>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;"><h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:0;"><i class="fa fa-list" style="color:#8b5cf6;margin-right:8px;"></i>Daftar Obat</h2><a href="/export/obat" style="background:#16a34a;color:white;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;"><i class="fa fa-file-excel" style="margin-right:6px;"></i>Export Excel</a></div></div>
@if(session('success'))<div style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px;border-radius:8px;margin-bottom:16px;font-size:13px;">{{ session('success') }}</div>@endif
<table style="width:100%;border-collapse:collapse;font-size:13px;">
<thead><tr style="background:#f5f3ff;">
<th style="padding:10px 12px;text-align:left;color:#8b5cf6;font-weight:600;">#</th>
<th style="padding:10px 12px;text-align:left;color:#8b5cf6;font-weight:600;">Nama Obat</th>
<th style="padding:10px 12px;text-align:left;color:#8b5cf6;font-weight:600;">Kemasan</th>
<th style="padding:10px 12px;text-align:left;color:#8b5cf6;font-weight:600;">Harga</th>
<th style="padding:10px 12px;text-align:left;color:#8b5cf6;font-weight:600;">Stok</th>
<th style="padding:10px 12px;text-align:left;color:#8b5cf6;font-weight:600;">Aksi</th>
</tr></thead>
<tbody>
@forelse($obats as $i => $o)
<tr style="border-bottom:1px solid #f1f5f9;">
<td style="padding:12px;">{{ $i+1 }}</td>
<td style="padding:12px;font-weight:600;color:#1e293b;">{{ $o->nama_obat }}</td>
<td style="padding:12px;color:#64748b;">{{ $o->kemasan }}</td>
<td style="padding:12px;">Rp {{ number_format($o->harga,0,',','.') }}</td>
<td style="padding:12px;">
@if($o->stok <= 0)
<span style="background:#fee2e2;color:#dc2626;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">Habis</span>
@elseif($o->stok <= 10)
<span style="background:#fef9c3;color:#ca8a04;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">{{ $o->stok }} (Menipis)</span>
@else
<span style="background:#dcfce7;color:#16a34a;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">{{ $o->stok }}</span>
@endif
</td>
<td style="padding:12px;">
<div style="display:flex;gap:6px;">
<a href="/obat/{{ $o->id }}/edit" style="background:#f59e0b;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-edit"></i></a>
<a href="/obat/{{ $o->id }}/delete" onclick="return confirm('Yakin hapus?')" style="background:#ef4444;color:white;padding:5px 10px;border-radius:6px;font-size:12px;text-decoration:none;"><i class="fa fa-trash"></i></a>
</div>
</td>
</tr>
@empty
<tr><td colspan="6" style="text-align:center;padding:30px;color:#94a3b8;">Belum ada data obat</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
@endsection