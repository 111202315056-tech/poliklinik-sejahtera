@extends('layouts.app')
@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-1">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4"><i class="fa fa-calendar-plus mr-2 text-blue-500"></i>Tambah Jadwal</h2>
            <form action="/jadwal" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm text-gray-600 mb-1">Hari</label>
                    <select name="hari" class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                        <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm text-gray-600 mb-1">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div class="mb-3">
                    <label class="block text-sm text-gray-600 mb-1">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full transition"><i class="fa fa-save mr-1"></i>Simpan</button>
            </form>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4"><i class="fa fa-calendar-days mr-2 text-blue-500"></i>Jadwal Praktek Saya</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-blue-50 text-blue-700">
                        <tr>
                            <th class="px-4 py-3 text-left rounded-tl-lg">#</th>
                            <th class="px-4 py-3 text-left">Hari</th>
                            <th class="px-4 py-3 text-left">Jam Mulai</th>
                            <th class="px-4 py-3 text-left">Jam Selesai</th>
                            <th class="px-4 py-3 text-left rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $i => $j)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $i + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $j->hari }}</td>
                            <td class="px-4 py-3">{{ $j->jam_mulai }}</td>
                            <td class="px-4 py-3">{{ $j->jam_selesai }}</td>
                            <td class="px-4 py-3">
                                <a href="/jadwal/{{ $j->id }}/delete" onclick="return confirm('Yakin hapus?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs transition"><i class="fa fa-trash mr-1"></i>Hapus</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-6 text-gray-400"><i class="fa fa-inbox text-3xl block mb-2"></i>Belum ada jadwal</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
