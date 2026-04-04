@extends('layouts.app')
@section('content')

<div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-lg font-bold text-gray-700 mb-4"><i class="fa fa-stethoscope mr-2 text-green-500"></i>Daftar Pasien Periksa</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-green-50 text-green-700">
                <tr>
                    <th class="px-4 py-3 text-left rounded-tl-lg">#</th>
                    <th class="px-4 py-3 text-left">Nama Pasien</th>
                    <th class="px-4 py-3 text-left">Hari</th>
                    <th class="px-4 py-3 text-left">Keluhan</th>
                    <th class="px-4 py-3 text-left">No Antrian</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left rounded-tr-lg">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftars as $i => $d)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $i + 1 }}</td>
                    <td class="px-4 py-3 font-medium">{{ $d->pasien->nama }}</td>
                    <td class="px-4 py-3">{{ $d->jadwalPeriksa->hari }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ Str::limit($d->keluhan, 40) }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-bold">{{ $d->no_antrian }}</span>
                    </td>
                    <td class="px-4 py-3">
                        @if($d->periksa)
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-medium"><i class="fa fa-check mr-1"></i>Sudah Diperiksa</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs font-medium"><i class="fa fa-clock mr-1"></i>Menunggu</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <a href="/periksa/{{ $d->id }}/form" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs transition"><i class="fa fa-notes-medical mr-1"></i>Periksa</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-6 text-gray-400"><i class="fa fa-inbox text-3xl block mb-2"></i>Belum ada pasien yang mendaftar</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
