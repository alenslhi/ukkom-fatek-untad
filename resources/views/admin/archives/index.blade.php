@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Kelola Dokumentasi (Arsip)</h1>
    <p class="text-gray-400 text-sm">Upload banyak foto sekaligus untuk ditampilkan di halaman galeri publik.</p>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 p-4 mb-6 rounded-r-lg">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-col xl:flex-row gap-6 w-full">

    <div class="w-full xl:w-1/3 bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-6 h-fit shrink-0">
        <h2 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Upload Foto Baru</h2>

        <form action="/admin/archives/store" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Judul Kegiatan</label>
                <input type="text" name="title" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Kategori / Divisi</label>
                <input type="text" name="category" placeholder="Contoh: Ibadah Padang" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Tanggal Kegiatan</label>
                <input type="date" name="event_date" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition">
            </div>

            <div class="bg-white/5 p-4 border border-white/10 rounded-xl">
                <label class="block text-sm font-bold text-gray-300 mb-2">Pilih Foto (Bisa Blok Banyak)</label>
                <input type="file" name="images[]" multiple accept="image/*" required class="w-full text-xs text-gray-400 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-ukkom-tosca/20 file:text-ukkom-tosca hover:file:bg-ukkom-tosca/30 transition overflow-hidden">
            </div>

            <button type="submit" class="w-full bg-ukkom-tosca hover:bg-teal-300 text-black font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(45,212,191,0.2)] transition">
                Upload & Kompres Semua
            </button>
        </form>
    </div>

    <div class="w-full xl:w-2/3 bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-6 overflow-hidden">
        <h2 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Daftar Foto Tersimpan</h2>

        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead>
                    <tr class="bg-white/5 border-b border-white/10 text-sm">
                        <th class="p-4 font-semibold text-gray-400 rounded-tl-xl w-24">Preview</th>
                        <th class="p-4 font-semibold text-gray-400">Judul & Kategori</th>
                        <th class="p-4 font-semibold text-gray-400 rounded-tr-xl w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($archives as $arsip)
                    @php 
                        $fotoCount = is_array($arsip->images) ? count($arsip->images) : 0;
                        $thumbnail = $fotoCount > 0 ? asset('storage/' . $arsip->images[0]) : '';
                    @endphp
                    <tr class="border-b border-white/5 hover:bg-white/5 text-gray-300 transition text-sm">
                        <td class="p-4 relative">
                            <img src="{{ $thumbnail }}" class="w-16 h-16 object-cover rounded-xl shadow-sm border border-white/10">
                            <span class="absolute top-2 right-2 bg-black/70 text-white text-[10px] font-bold px-1.5 py-0.5 rounded">{{ $fotoCount }}</span>
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-white text-base truncate max-w-[200px]">{{ $arsip->title }}</div>
                            <div class="text-xs text-ukkom-tosca bg-ukkom-tosca/10 border border-ukkom-tosca/20 inline-block px-2 py-1 rounded-lg mt-2">{{ $arsip->category }}</div>
                        </td>
                        <td class="p-4">
                            <form action="/admin/archives/{{ $arsip->id }}" method="POST" onsubmit="return confirm('Yakin hapus album ini ({{ $fotoCount }} foto akan ikut terhapus)?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-bold bg-red-500/10 border border-red-500/20 px-3 py-1.5 rounded-lg hover:bg-red-500/20 transition">Hapus Album</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-8 text-center text-gray-500">Belum ada album dokumentasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); opacity: 0.6; }
</style>
@endsection