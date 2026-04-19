@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:20px;font-weight:700;color:#1e293b;">Edit Dokter</h1>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
@if($errors->any())
<div style="background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
@foreach($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach
</div>
@endif
<form action="/dokter/{{ $dokter->id }}/update" method="POST">
@csrf
<div style="margin-bottom:16px;">
<label style="font-size:13px;font-weight:600;color:#374151;display:block;margin-bottom:6px;">Nama</label>
<input type="text" name="nama" value="{{ $dokter->nama }}" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;" required>
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;font-weight:600;color:#374151;display:block;margin-bottom:6px;">Email</label>
<input type="email" name="email" value="{{ $dokter->email }}" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;" required>
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;font-weight:600;color:#374151;display:block;margin-bottom:6px;">Password Baru (kosongkan jika tidak diubah)</label>
<input type="password" name="password" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;">
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;font-weight:600;color:#374151;display:block;margin-bottom:6px;">Alamat</label>
<input type="text" name="alamat" value="{{ $dokter->alamat }}" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;" required>
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;font-weight:600;color:#374151;display:block;margin-bottom:6px;">No HP</label>
<input type="text" name="no_hp" value="{{ $dokter->no_hp }}" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;" required>
</div>
<div style="margin-bottom:20px;">
<label style="font-size:13px;font-weight:600;color:#374151;display:block;margin-bottom:6px;">Poliklinik</label>
<select name="id_poli" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;" required>
@foreach($polis as $poli)
<option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>{{ $poli->nama_poli }}</option>
@endforeach
</select>
</div>
<div style="display:flex;gap:12px;">
<button type="submit" style="background:#2563eb;color:white;padding:10px 24px;border-radius:8px;border:none;font-size:14px;font-weight:600;cursor:pointer;">Update</button>
<a href="/dokter" style="background:#f1f5f9;color:#374151;padding:10px 24px;border-radius:8px;font-size:14px;font-weight:600;text-decoration:none;">Batal</a>
</div>
</form>
</div>
@endsection
