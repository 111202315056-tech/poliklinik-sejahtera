@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:20px;font-weight:700;color:#1e293b;">Pendaftaran Periksa</h1>
<p style="color:#64748b;font-size:13px;">Daftar antrian pemeriksaan dokter.</p>
</div>
@if(session('success'))<div style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px;border-radius:8px;margin-bottom:16px;font-size:13px;">{{ session('success') }}</div>@endif
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;">Form Pendaftaran</h2>
<form action="/pendaftaran" method="POST">
@csrf
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;">Pilih Poli</label>
<select name="id_poli" id="id_poli" onchange="loadJadwal(this.value)" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
<option value="">-- Pilih Poli --</option>
@foreach($polis as $p)
<option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
@endforeach
</select>
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;">Pilih Jadwal Dokter</label>
<select name="id_jadwal" id="id_jadwal" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
<option value="">-- Pilih jadwal --</option>
</select>
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;">Keluhan</label>
<textarea name="keluhan" rows="3" placeholder="Tuliskan keluhan Anda..." style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;resize:none;"></textarea>
</div>
<button type="submit" style="background:#2563eb;color:white;border:none;padding:10px 16px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;width:100%;">Daftar Sekarang</button>
</form>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;">Riwayat Pendaftaran</h2>
@forelse($daftars as $d)
<div style="border:1px solid #e2e8f0;border-radius:10px;padding:14px;margin-bottom:10px;">
<p style="font-weight:700;color:#1e293b;font-size:14px;">{{ $d->jadwalPeriksa->dokter->nama ?? '-' }}</p>
<p style="font-size:12px;color:#64748b;">{{ $d->jadwalPeriksa->hari ?? '' }}</p>
<p style="font-size:12px;color:#94a3b8;">{{ $d->keluhan }}</p>
<span style="background:#dbeafe;color:#2563eb;padding:3px 10px;border-radius:20px;font-size:12px;">No. {{ $d->no_antrian }}</span>
</div>
@empty
<div style="text-align:center;padding:40px;color:#94a3b8;">Belum ada pendaftaran</div>
@endforelse
</div>
</div>
<script>
var pd = {};
@foreach($polis as $pp)
pd[{{ $pp->id }}] = {
    jadwals: [
        @foreach($pp->dokters as $dd)
        @foreach($dd->jadwals as $jj)
        {id: {{ $jj->id }}, label: "{{ $dd->nama }} - {{ $jj->hari }} {{ substr($jj->jam_mulai,0,5) }}-{{ substr($jj->jam_selesai,0,5) }}"},
        @endforeach
        @endforeach
    ]
};
@endforeach
function loadJadwal(v) {
    var s = document.getElementById('id_jadwal');
    s.innerHTML = '<option value="">-- Pilih jadwal --</option>';
    if (!v || !pd[v]) return;
    pd[v].jadwals.forEach(function(j) {
        s.innerHTML += '<option value="' + j.id + '">' + j.label + '</option>';
    });
}
</script>
@endsection