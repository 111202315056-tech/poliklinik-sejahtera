@extends('layouts.app')
@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-clipboard-list" style="color:#2563eb;margin-right:8px;"></i>Daftar Periksa</h2>
<form action="/pendaftaran" method="POST">
@csrf
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Pilih Poli</label>
<select name="id_poli" id="id_poli" onchange="loadJadwal(this.value)" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
<option value="">-- Pilih Poli --</option>
@foreach($polis as $p)
<option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
@endforeach
</select>
</div>
<div style="margin-bottom:12px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Pilih Jadwal Dokter</label>
<select name="id_jadwal" id="id_jadwal" style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;">
<option value="">-- Pilih jadwal --</option>
</select>
</div>
<div style="margin-bottom:16px;">
<label style="font-size:13px;color:#64748b;display:block;margin-bottom:6px;font-weight:500;">Keluhan</label>
<textarea name="keluhan" rows="3" placeholder="Tuliskan keluhan Anda..." style="border:1px solid #e2e8f0;border-radius:8px;width:100%;padding:8px 12px;font-size:14px;outline:none;resize:none;"></textarea>
</div>
<button type="submit" style="background:#2563eb;color:white;border:none;padding:10px 16px;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;width:100%;"><i class="fa fa-paper-plane" style="margin-right:6px;"></i>Daftar Sekarang</button>
</form>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:16px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-list-check" style="color:#2563eb;margin-right:8px;"></i>Riwayat Pendaftaran</h2>
@forelse($daftars as $d)
<div style="border:1px solid #e2e8f0;border-radius:10px;padding:16px;margin-bottom:12px;">
<div style="display:flex;justify-content:space-between;align-items:center;">
<div>
<p style="font-weight:700;color:#1e293b;font-size:14px;margin-bottom:4px;">{{ $d->jadwalPeriksa->dokter->nama ?? '-' }}</p>
<p style="font-size:12px;color:#64748b;">{{ $d->jadwalPeriksa->hari }} | {{ $d->jadwalPeriksa->jam_mulai }} - {{ $d->jadwalPeriksa->jam_selesai }}</p>
<p style="font-size:12px;color:#94a3b8;margin-top:4px;">Keluhan: {{ $d->keluhan }}</p>
</div>
<div style="text-align:center;">
<div style="background:#dbeafe;color:#2563eb;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;margin:0 auto 4px;">{{ $d->no_antrian }}</div>
<p style="font-size:11px;color:#94a3b8;">No. Antrian</p>
</div>
</div>
</div>
@empty
<div style="text-align:center;padding:40px;color:#94a3b8;">
<i class="fa fa-clipboard" style="font-size:40px;display:block;margin-bottom:8px;"></i>Belum ada pendaftaran
</div>
@endforelse
</div>
</div>
<script>
var pd = @json($polis->map(function($p){return ['id'=>$p->id,'jadwals'=>$p->dokters->flatMap(function($d){return $d->jadwals->map(function($j) use($d){return ['id'=>$j->id,'label'=>$d->nama.' - '.$j->hari.' '.$j->jam_mulai.'-'.$j->jam_selesai];});})-> values()];})->keyBy('id'));
function loadJadwal(v){var s=document.getElementById('id_jadwal');s.innerHTML='<option value="">-- Pilih jadwal --</option>';if(!v||!pd[v])return;pd[v].jadwals.forEach(function(j){s.innerHTML+='<option value="'+j.id+'">'+j.label+'</option>';});}
</script>
@endsection