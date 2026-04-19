@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:22px;font-weight:700;color:#1e293b;">Dashboard Pasien</h1>
<p style="color:#64748b;font-size:13px;">Selamat datang, {{ $user->nama }}!</p>
</div>
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
<div style="background:linear-gradient(135deg,#2563eb,#0ea5e9);border-radius:12px;padding:20px;color:white;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Total Pendaftaran</p>
<p style="font-size:32px;font-weight:700;">{{ $totalPeriksa }}</p>
</div>
<div style="background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;padding:20px;color:white;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">No RM</p>
<p style="font-size:24px;font-weight:700;">{{ $user->no_rm ?? '-' }}</p>
</div>
<div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:12px;padding:20px;color:white;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Hari Terakhir Periksa</p>
<p style="font-size:24px;font-weight:700;">{{ $lastPeriksa }}</p>
</div>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;"><i class="fa fa-list-ol" style="color:#2563eb;margin-right:8px;"></i>Antrian Saya</h2>
<div style="display:flex;align-items:center;gap:6px;font-size:12px;color:#16a34a;">
<span style="width:8px;height:8px;background:#16a34a;border-radius:50%;display:inline-block;animation:pulse 2s infinite;"></span>
<span>Real-time aktif</span>
</div>
</div>
<div id="antrian-table">
@forelse($daftars as $d)
<div style="border:1px solid #e2e8f0;border-radius:10px;padding:16px;margin-bottom:10px;display:flex;justify-content:space-between;align-items:center;">
<div>
<p style="font-weight:700;color:#1e293b;font-size:14px;">{{ $d->jadwalPeriksa->dokter->nama ?? '-' }}</p>
<p style="font-size:12px;color:#64748b;">{{ $d->jadwalPeriksa->hari ?? '' }} | {{ substr($d->jadwalPeriksa->jam_mulai ?? '',0,5) }}</p>
<p style="font-size:12px;color:#94a3b8;margin-top:3px;">{{ $d->keluhan }}</p>
</div>
<div style="text-align:center;">
<div style="background:#dbeafe;color:#2563eb;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;margin:0 auto 4px;">{{ $d->no_antrian }}</div>
@if($d->periksa)
<span style="background:#dcfce7;color:#16a34a;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;">Selesai</span>
@else
<span style="background:#fef9c3;color:#ca8a04;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;">Menunggu</span>
@endif
</div>
</div>
@empty
<div style="text-align:center;padding:40px;color:#94a3b8;"><i class="fa fa-clipboard" style="font-size:40px;display:block;margin-bottom:8px;"></i>Belum ada antrian</div>
@endforelse
</div>
</div>
<style>@keyframes pulse{0%,100%{opacity:1}50%{opacity:0.3}}</style>
<script>
if(window.Echo) {
  Echo.channel('antrian').listen('.antrian.updated', function() {
    fetch('/api/antrian/{{ $user->id }}')
    .then(r=>r.json()).then(data=>{
      var t=document.getElementById('antrian-table');
      if(!data.length){t.innerHTML='<div style="text-align:center;padding:40px;color:#94a3b8;">Belum ada antrian</div>';return;}
      t.innerHTML=data.map(d=>'<div style="border:1px solid #e2e8f0;border-radius:10px;padding:16px;margin-bottom:10px;display:flex;justify-content:space-between;align-items:center;"><div><p style="font-weight:700;color:#1e293b;font-size:14px;">'+d.dokter+'</p><p style="font-size:12px;color:#64748b;">'+d.hari+'</p><p style="font-size:12px;color:#94a3b8;">'+d.keluhan+'</p></div><div style="text-align:center;"><div style="background:#dbeafe;color:#2563eb;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;margin:0 auto 4px;">'+d.no_antrian+'</div><span style="background:'+(d.selesai?'#dcfce7':'#fef9c3')+';color:'+(d.selesai?'#16a34a':'#ca8a04')+';padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;">'+(d.selesai?'Selesai':'Menunggu')+'</span></div></div>').join('');
    });
  });
}
</script>
@endsection