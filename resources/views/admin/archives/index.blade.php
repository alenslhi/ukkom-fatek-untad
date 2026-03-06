@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Dokumentasi (Arsip)</h1>
    <p class="text-gray-500 text-sm">Upload foto kegiatan untuk ditampilkan di halaman galeri publik.</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-col lg:flex-row gap-6">

    <div class="lg:w-1/3 bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-fit">
        <h2 class="text-lg font-bold text-ukkom-navy mb-4 border-b pb-2">Upload Foto Baru</h2>

        <form action="/admin/archives/store" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Judul Kegiatan</label>
                <input type="text" name="title" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Kategori / Divisi</label>
                <input type="text" name="category" placeholder="Contoh: Ibadah Padang" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="event_date" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
            </div>

            <div class="bg-gray-50 p-3 border border-gray-200 rounded">
                <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Foto (Maks 10MB)</label>
                <input type="file" name="image" accept="image/*" required class="w-full text-sm">
            </div>

            <button type="submit" class="w-full bg-ukkom-navy hover:bg-blue-900 text-white font-bold py-2 px-4 rounded transition">
                Upload & Kompres
            </button>
        </form>
    </div>

    <div class="lg:w-2/3 flex-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Daftar Foto Tersimpan</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                        <th class="p-3 font-semibold text-gray-600">Preview</th>
                        <th class="p-3 font-semibold text-gray-600">Judul & Kategori</th>
                        <th class="p-3 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($archives as $arsip)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 text-sm">
                        <td class="p-3">
                            <img src="{{ asset('storage/' . $arsip->image_path) }}" class="w-16 h-16 object-cover rounded shadow-sm border">
                        </td>
                        <td class="p-3">
                            <div class="font-bold text-ukkom-navy">{{ $arsip->title }}</div>
                            <div class="text-xs text-gray-500 bg-gray-100 inline-block px-2 py-1 rounded mt-1">{{ $arsip->category }}</div>
                        </td>
                        <td class="p-3">
                            <form action="/admin/archives/{{ $arsip->id }}" method="POST" onsubmit="return confirm('Yakin hapus foto ini permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold bg-red-50 px-3 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-6 text-center text-gray-500">Belum ada foto dokumentasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection