@extends('layouts.app')
@section('content')
<div style="max-width:700px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-notes-medical" style="color:#16a34a;margin-right:8px;"></i>Form Pemeriksaan</h2>
@if($errors->has('error'))<div style="background:#fee2e2;border:1px solid #fca5a5;color:#dc2626;padding:14px;border-radius:8px;margin-bottom:16px;font-size:13px;font-weight:600;"><i class="fa fa-triangle-exclamation" style="margin-right:8px;"></i>{{ $errors->first('error') }}</div>@endif
<div style="background:#eff6ff;border-radius:8px;padding:16px;margin-bottom:16px;font-size:13px;">
<p><span style="color:#94a3b8;">Pasien:</span> <strong>{{ $daftar->pasien->nama }}</strong></p>
<p><span style="color:#94a3b8;">Hari:</span> {{ $daftar->jadwalPeriksa->hari }}</p>
<p><span style="color:#94a3b8;">Keluhan:</span> {{ $daftar->keluhan }}</p>
<p><span style="color:#94a3b8;">No Antrian:</span> {{ $daftar->no_antrian }}</p>
</div>
<form action="/periksa/{{ $daftar->id }}/store" method="POST">
@csrf
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Catatan Dokter</label>
<textarea name="catatan" rows="3" placeholder="Masukkan catatan pemeriksaan..." style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;resize:none;">{{ isset($periksa) ? $periksa->catatan : '' }}</textarea>
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Obat yang Diberikan</label>
@if(isset($obatsHabis) && $obatsHabis->count() > 0)
<div style="background:#fef9c3;border:1px solid #fde68a;border-radius:8px;padding:10px;margin-bottom:8px;font-size:12px;color:#92400e;">
<i class="fa fa-triangle-exclamation" style="margin-right:6px;"></i><strong>Stok Habis:</strong> {{ $obatsHabis->pluck('nama_obat')->join(', ') }}
</div>
@endif
<div style="border:1px solid #e2e8f0;border-radius:8px;padding:12px;max-height:200px;overflow-y:auto;">
@forelse($obats as $o)
<label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;padding:6px;border-radius:6px;margin-bottom:4px;">
<input type="checkbox" name="obat[]" value="{{ $o->id }}" {{ isset($periksa) && $periksa->detailPeriksa->pluck('id_obat')->contains($o->id) ? 'checked' : '' }} style="width:16px;height:16px;">
<span>{{ $o->nama_obat }} <span style="color:#94a3b8;">({{ $o->kemasan }})</span></span>
<span style="margin-left:auto;background:#dcfce7;color:#16a34a;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;">Stok: {{ $o->stok }}</span>
</label>
@empty
<p style="text-align:center;color:#94a3b8;font-size:13px;padding:16px;"><i class="fa fa-triangle-exclamation" style="margin-right:6px;"></i>Semua stok obat habis!</p>
@endforelse
</div>
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Biaya Periksa (Rp)</label>
<input type="number" name="biaya_periksa" placeholder="Contoh: 50000" value="{{ isset($periksa) ? $periksa->biaya_periksa : '' }}" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
</div>
<div style="display:flex;gap:12px;">
<button type="submit" style="background:#16a34a;color:white;border:none;padding:10px 20px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;"><i class="fa fa-save" style="margin-right:6px;"></i>Simpan</button>
<a href="/periksa" style="background:#94a3b8;color:white;padding:10px 20px;border-radius:8px;font-size:14px;text-decoration:none;">Kembali</a>
</div>
</form>
</div>
</div>
@endsection