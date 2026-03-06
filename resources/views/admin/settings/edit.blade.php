@extends('layouts.admin')

@section('content')
<div class="max-w-3xl bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-8">
    <h1 class="text-2xl font-bold text-white mb-6 border-b border-white/10 pb-4">Pengaturan Halaman Beranda</h1>

    @if(session('success'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 p-4 mb-6 rounded-r-lg">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="/admin/settings/update" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-ukkom-tosca/10 p-4 rounded-xl border border-ukkom-tosca/20 mb-6 text-sm text-ukkom-tosca">
            <strong>Catatan:</strong> Perubahan di sini akan langsung tampil di halaman depan (Home) website.
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-300 mb-2">Judul Utama (Hero Title)</label>
            <input type="text" name="hero_title" value="{{ $settings->hero_title }}" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-300 mb-2">Sub-judul (Deskripsi Singkat)</label>
            <textarea name="hero_subtitle" rows="3" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition">{{ $settings->hero_subtitle }}</textarea>
        </div>

        <hr class="my-6 border-white/10">

        <div>
            <label class="block text-sm font-bold text-gray-300 mb-2">Ayat / Kutipan Inspiratif (Quote of the Week)</label>
            <textarea name="quote_text" rows="3" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition">{{ $settings->quote_text }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-300 mb-2">Sumber Kutipan (Misal: Filipi 4:13)</label>
            <input type="text" name="quote_author" value="{{ $settings->quote_author }}" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition">
        </div>

        <div class="pt-6 border-t border-white/10">
            <button type="submit" class="bg-ukkom-tosca hover:bg-teal-300 text-black font-bold py-3 px-8 rounded-xl shadow-[0_0_20px_rgba(45,212,191,0.2)] hover:shadow-[0_0_30px_rgba(45,212,191,0.4)] transition duration-300">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection