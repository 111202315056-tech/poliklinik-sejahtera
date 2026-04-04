@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
    <p class="text-gray-500 text-sm">Ringkasan statistik dan aktivitas terbaru sistem klinik.</p>
</div>
<div class="flex justify-end mb-4">
    <span class="bg-white border rounded-lg px-4 py-2 text-sm text-gray-600">
        <i class="fa fa-calendar mr-2 text-blue-500"></i>{{ now()->translatedFormat('d F Y') }}
    </span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow p-5 flex items-center gap-4">
        <div class="bg-teal-400 rounded-full w-12 h-12 flex items-center justify-center">
            <i class="fa fa-hospital text-white text-xl"></i>
        </div>
        <div>
            <p class="text-xs text-gray-400 uppercase">Total Poliklinik</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalPoli }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-5 flex items-center gap-4">
        <div class="bg-green-400 rounded-full w-12 h-12 flex items-center justify-center">
            <i class="fa fa-user-doctor text-white text-xl"></i>
        </div>
        <div>
            <p class="text-xs text-gray-400 uppercase">Total Dokter</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalDokter }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-5 flex items-center gap-4">
        <div class="bg-blue-400 rounded-full w-12 h-12 flex items-center justify-center">
            <i class="fa fa-users text-white text-xl"></i>
        </div>
        <div>
            <p class="text-xs text-gray-400 uppercase">Total Pasien</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalPasien }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-5 flex items-center gap-4">
        <div class="bg-yellow-400 rounded-full w-12 h-12 flex items-center justify-center">
            <i class="fa fa-stethoscope text-white text-xl"></i>
        </div>
        <div>
            <p class="text-xs text-gray-400 uppercase">Pemeriksaan</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalPeriksa ?? 0 }}</p>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow p-5">
        <h2 class="font-bold text-gray-700 mb-4 text-sm">
            <i class="fa fa-clock-rotate-left mr-2 text-blue-500"></i>Pendaftaran Terbaru
        </h2>
        <p class="text-gray-400 text-sm text-center py-6">Belum Ada Pendaftaran</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5">
        <h2 class="font-bold text-gray-700 mb-4 text-sm">
            <i class="fa fa-check-circle mr-2 text-green-500"></i>Pemeriksaan Selesai
        </h2>
        <p class="text-gray-400 text-sm text-center py-6">Belum Ada Pemeriksaan</p>
    </div>
</div>
@endsection
