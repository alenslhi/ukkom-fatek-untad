@extends('layouts.admin')

@section('content')
<div class="max-w-2xl bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-8">
    <div class="flex items-center mb-6 border-b border-white/10 pb-4">
        <a href="/admin/activities" class="text-gray-400 hover:text-ukkom-tosca mr-4 transition">⬅️ Kembali</a>
        <h1 class="text-2xl font-bold text-white">Tambah Kegiatan Baru</h1>
    </div>

    <form action="/admin/activities/store" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-sm font-bold text-gray-300 mb-2">Nama Kegiatan</label>
            <input type="text" name="title" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Kategori</label>
                <input type="text" name="category" placeholder="Contoh: Ibadah / Funsport" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Waktu Pelaksanaan</label>
                <input type="datetime-local" name="event_date" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition color-scheme-dark">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-300 mb-2">Lokasi</label>
            <input type="text" name="location" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-300 mb-2">Deskripsi Singkat</label>
            <textarea name="description" rows="3" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition"></textarea>
        </div>

        <div class="bg-white/5 p-4 border border-white/10 rounded-xl">
            <label class="block text-sm font-bold text-gray-300 mb-1">Upload Pamflet (Opsional)</label>
            <p class="text-xs text-gray-500 mb-3">Jika tidak ada, akan diganti icon otomatis. Maks 5MB (otomatis terkompres).</p>
            <input type="file" name="pamphlet" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-ukkom-tosca/20 file:text-ukkom-tosca hover:file:bg-ukkom-tosca/30 transition">
        </div>

        <button type="submit" class="w-full bg-ukkom-tosca hover:bg-teal-300 text-black font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(45,212,191,0.2)] transition">
            Simpan Kegiatan
        </button>
    </form>
</div>

<style>
/* Hack untuk memutar ikon kalender jadi putih di mode dark */
input[type="datetime-local"]::-webkit-calendar-picker-indicator { filter: invert(1); opacity: 0.6; }
</style>
@endsection