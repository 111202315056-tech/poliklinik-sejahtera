@extends('layouts.app')
@section('content')
<div style="max-width:600px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:18px;font-weight:700;color:#1e293b;margin-bottom:20px;"><i class="fa fa-plus" style="color:#14b8a6;margin-right:8px;"></i>Tambah Poli</h2>
<form action="{{ route('polis.store') }}" method="POST">
@csrf
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Nama Poli</label>
<input type="text" name="nama_poli" placeholder="Contoh: Poli Anak" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:10px 12px;font-size:14px;outline:none;">
@error('nama_poli')<p style="color:#ef4444;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
</div>
<div style="margin-bottom:20px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Keterangan</label>
<textarea name="keterangan" rows="3" placeholder="Keterangan poli..." style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:10px 12px;font-size:14px;outline:none;resize:none;"></textarea>
</div>
<div style="display:flex;gap:8px;">
<button type="submit" style="background:#14b8a6;color:white;border:none;padding:10px 20px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;"><i class="fa fa-save" style="margin-right:6px;"></i>Simpan</button>
<a href="{{ route('polis.index') }}" style="background:#94a3b8;color:white;padding:10px 20px;border-radius:8px;font-size:14px;text-decoration:none;">Batal</a>
</div>
</form>
</div>
</div>
@endsection