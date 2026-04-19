@extends('layouts.app')
@section('content')
<div style="margin-bottom:20px;">
<h1 style="font-size:22px;font-weight:700;color:#1e293b;">Dashboard Admin</h1>
<p style="color:#64748b;font-size:13px;">Selamat datang, {{ Auth::user()->nama }}!</p>
</div>
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:16px;margin-bottom:24px;">
<div style="background:linear-gradient(135deg,#0ea5e9,#2563eb);border-radius:12px;padding:20px;color:white;position:relative;overflow:hidden;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Total Poli</p>
<p style="font-size:32px;font-weight:700;">{{ $totalPoli }}</p>
<i class="fa fa-hospital" style="font-size:40px;opacity:0.15;position:absolute;right:12px;bottom:8px;"></i>
</div>
<div style="background:linear-gradient(135deg,#8b5cf6,#6d28d9);border-radius:12px;padding:20px;color:white;position:relative;overflow:hidden;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Total Dokter</p>
<p style="font-size:32px;font-weight:700;">{{ $totalDokter }}</p>
<i class="fa fa-user-doctor" style="font-size:40px;opacity:0.15;position:absolute;right:12px;bottom:8px;"></i>
</div>
<div style="background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;padding:20px;color:white;position:relative;overflow:hidden;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Total Pasien</p>
<p style="font-size:32px;font-weight:700;">{{ $totalPasien }}</p>
<i class="fa fa-users" style="font-size:40px;opacity:0.15;position:absolute;right:12px;bottom:8px;"></i>
</div>
<div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:12px;padding:20px;color:white;position:relative;overflow:hidden;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Total Obat</p>
<p style="font-size:32px;font-weight:700;">{{ $totalObat }}</p>
<i class="fa fa-pills" style="font-size:40px;opacity:0.15;position:absolute;right:12px;bottom:8px;"></i>
</div>
<div style="background:linear-gradient(135deg,#ef4444,#dc2626);border-radius:12px;padding:20px;color:white;position:relative;overflow:hidden;">
<p style="font-size:11px;font-weight:700;text-transform:uppercase;opacity:0.8;margin-bottom:8px;">Total Periksa</p>
<p style="font-size:32px;font-weight:700;">{{ $totalPeriksa }}</p>
<i class="fa fa-stethoscope" style="font-size:40px;opacity:0.15;position:absolute;right:12px;bottom:8px;"></i>
</div>
</div>
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-chart-line" style="color:#2563eb;margin-right:8px;"></i>Grafik Kunjungan 7 Hari Terakhir</h2>
<canvas id="chartKunjungan" height="100"></canvas>
</div>
<div style="background:white;border-radius:12px;box-shadow:0 1px 4px rgba(0,0,0,0.08);padding:24px;">
<h2 style="font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;"><i class="fa fa-bolt" style="color:#f59e0b;margin-right:8px;"></i>Akses Cepat</h2>
<div style="display:flex;flex-direction:column;gap:8px;">
<a href="/poli" style="background:#eff6ff;color:#2563eb;padding:10px 14px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fa fa-hospital"></i>Kelola Poli</a>
<a href="/dokter" style="background:#f5f3ff;color:#7c3aed;padding:10px 14px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fa fa-user-doctor"></i>Kelola Dokter</a>
<a href="/pasien" style="background:#f0fdf4;color:#16a34a;padding:10px 14px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fa fa-users"></i>Kelola Pasien</a>
<a href="/obat" style="background:#fffbeb;color:#d97706;padding:10px 14px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;"><i class="fa fa-pills"></i>Kelola Obat</a>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('chartKunjungan').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartData->pluck('tgl')),
        datasets: [{
            label: 'Kunjungan',
            data: @json($chartData->pluck('total')),
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.1)',
            tension: 0.4, fill: true,
            pointBackgroundColor: '#2563eb', pointRadius: 5
        }]
    },
    options: { responsive:true, plugins:{ legend:{display:false} }, scales:{ y:{ beginAtZero:true, ticks:{stepSize:1} } } }
});
</script>
@endsection