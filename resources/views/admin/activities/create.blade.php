@extends('layouts.admin')

@section('content')
<div class="max-w-2xl bg-white rounded-xl shadow-sm border border-gray-100 p-8">
    <div class="flex items-center mb-6 border-b pb-4">
        <a href="/admin/activities" class="text-gray-400 hover:text-ukkom-navy mr-4">⬅️ Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Kegiatan Baru</h1>
    </div>

    <form action="/admin/activities/store" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Kegiatan</label>
            <input type="text" name="title" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label>
                <input type="text" name="category" placeholder="Contoh: Ibadah / Funsport" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Waktu Pelaksanaan</label>
                <input type="datetime-local" name="event_date" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Lokasi</label>
            <input type="text" name="location" required class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Singkat</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy"></textarea>
        </div>

        <div class="bg-gray-50 p-4 border border-gray-200 rounded">
            <label class="block text-sm font-bold text-gray-700 mb-1">Upload Pamflet (Opsional)</label>
            <p class="text-xs text-gray-500 mb-2">Jika tidak ada, akan diganti icon otomatis. Maks 5MB (otomatis terkompres).</p>
            <input type="file" name="pamphlet" accept="image/*" class="w-full text-sm">
        </div>

        <button type="submit" class="w-full bg-ukkom-navy hover:bg-blue-900 text-white font-bold py-3 px-4 rounded transition">
            Simpan Kegiatan
        </button>
    </form>
</div>
@endsection