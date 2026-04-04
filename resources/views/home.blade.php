@extends('layouts.app')
@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4 border-l-4 border-blue-500">
        <div class="bg-blue-100 p-4 rounded-full"><i class="fa fa-user-doctor text-blue-500 text-2xl"></i></div>
        <div>
            <p class="text-gray-500 text-sm">Total Dokter</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalDokter }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4 border-l-4 border-green-500">
        <div class="bg-green-100 p-4 rounded-full"><i class="fa fa-users text-green-500 text-2xl"></i></div>
        <div>
            <p class="text-gray-500 text-sm">Total Pasien</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalPasien }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4 border-l-4 border-purple-500">
        <div class="bg-purple-100 p-4 rounded-full"><i class="fa fa-pills text-purple-500 text-2xl"></i></div>
        <div>
            <p class="text-gray-500 text-sm">Total Obat</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalObat }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-lg font-bold text-gray-700 mb-4"><i class="fa fa-clock-rotate-left mr-2 text-blue-500"></i>Selamat Datang</h2>
    <p class="text-gray-500">Sistem Informasi Poliklinik membantu pengelolaan data dokter, pasien, obat, dan pemeriksaan secara efisien.</p>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="/dokter" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-4 text-center transition">
            <i class="fa fa-user-doctor text-3xl mb-2 block"></i>Kelola Dokter
        </a>
        <a href="/pasien" class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-4 text-center transition">
            <i class="fa fa-users text-3xl mb-2 block"></i>Kelola Pasien
        </a>
        <a href="/obat" class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg p-4 text-center transition">
            <i class="fa fa-pills text-3xl mb-2 block"></i>Kelola Obat
        </a>
    </div>
</div>

@endsection
