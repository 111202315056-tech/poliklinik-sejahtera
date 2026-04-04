@extends('layouts.app')
@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-1">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4"><i class="fa fa-pills mr-2 text-purple-500"></i>{{ isset($obat) ? "Edit Obat" : "Tambah Obat" }}</h2>
            <form action="{{ isset($obat) ? '/obat/'.$obat->id.'/update' : '/obat' }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm text-gray-600 mb-1">Nama Obat</label>
                    <input type="text" name="nama_obat" placeholder="Nama obat" value="{{ isset($obat) ? $obat->nama_obat : '' }}" class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div class="mb-3">
                    <label class="block text-sm text-gray-600 mb-1">Kemasan</label>
                    <input type="text" name="kemasan" placeholder="Kemasan" value="{{ isset($obat) ? $obat->kemasan : '' }}" class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div class="mb-3">
                    <label class="block text-sm text-gray-600 mb-1">Harga</label>
                    <input type="number" name="harga" placeholder="Harga" value="{{ isset($obat) ? $obat->harga : '' }}" class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg w-full transition"><i class="fa fa-save mr-1"></i>Simpan</button>
                    @if(isset($obat))
                    <a href="/obat" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg text-center transition"><i class="fa fa-times"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4"><i class="fa fa-list mr-2 text-purple-500"></i>Daftar Obat</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-purple-50 text-purple-700">
                        <tr>
                            <th class="px-4 py-3 text-left rounded-tl-lg">#</th>
                            <th class="px-4 py-3 text-left">Nama Obat</th>
                            <th class="px-4 py-3 text-left">Kemasan</th>
                            <th class="px-4 py-3 text-left">Harga</th>
                            <th class="px-4 py-3 text-left rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($obats as $i => $o)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $i + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $o->nama_obat }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $o->kemasan }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($o->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 flex gap-2">
                                <a href="/obat/{{ $o->id }}/edit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs transition"><i class="fa fa-edit mr-1"></i>Ubah</a>
                                <a href="/obat/{{ $o->id }}/delete" onclick="return confirm('Yakin hapus?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs transition"><i class="fa fa-trash mr-1"></i>Hapus</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-6 text-gray-400"><i class="fa fa-inbox text-3xl block mb-2"></i>Belum ada data obat</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
