@extends('layouts.admin')

@section('content')
<div class="bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Daftar Jadwal Kegiatan</h1>
        <a href="/admin/activities/create" class="bg-ukkom-tosca hover:bg-teal-300 text-black font-bold py-2 px-4 rounded-xl shadow-[0_0_15px_rgba(45,212,191,0.3)] transition">
            + Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 p-4 mb-6 rounded-r-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5 border-b border-white/10">
                    <th class="p-4 font-semibold text-gray-400 rounded-tl-xl">Tanggal</th>
                    <th class="p-4 font-semibold text-gray-400">Kegiatan</th>
                    <th class="p-4 font-semibold text-gray-400">Kategori</th>
                    <th class="p-4 font-semibold text-gray-400">Lokasi</th>
                    <th class="p-4 font-semibold text-gray-400 rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $act)
                <tr class="border-b border-white/5 hover:bg-white/5 text-gray-300 transition">
                    <td class="p-4">{{ \Carbon\Carbon::parse($act->event_date)->format('d M Y') }}</td>
                    <td class="p-4 font-bold text-white">{{ $act->title }}</td>
                    <td class="p-4"><span class="bg-ukkom-tosca/10 text-ukkom-tosca border border-ukkom-tosca/20 text-xs px-2 py-1 rounded-lg">{{ $act->category }}</span></td>
                    <td class="p-4 text-sm">{{ $act->location }}</td>
                    <td class="p-4">
                        <form action="/admin/activities/{{ $act->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-bold bg-red-500/10 px-3 py-1 rounded-lg border border-red-500/20 hover:bg-red-500/20 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection