@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Jadwal Kegiatan</h1>
        <a href="/admin/activities/create" class="bg-ukkom-orange hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow transition">
            + Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-4 font-semibold text-gray-600">Tanggal</th>
                    <th class="p-4 font-semibold text-gray-600">Kegiatan</th>
                    <th class="p-4 font-semibold text-gray-600">Kategori</th>
                    <th class="p-4 font-semibold text-gray-600">Lokasi</th>
                    <th class="p-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $act)
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="p-4">{{ \Carbon\Carbon::parse($act->event_date)->format('d M Y') }}</td>
                    <td class="p-4 font-bold text-ukkom-navy">{{ $act->title }}</td>
                    <td class="p-4"><span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $act->category }}</span></td>
                    <td class="p-4 text-sm text-gray-500">{{ $act->location }}</td>
                    <td class="p-4">
                        <form action="/admin/activities/{{ $act->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection