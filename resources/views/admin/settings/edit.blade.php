@extends('layouts.admin')

@section('content')
<div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-100 p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Pengaturan Halaman Beranda</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="/admin/settings/update" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 mb-6 text-sm text-blue-800">
            <strong>Catatan:</strong> Perubahan di sini akan langsung tampil di halaman depan (Home) website.
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Judul Utama (Hero Title)</label>
            <input type="text" name="hero_title" value="{{ $settings->hero_title }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-ukkom-navy focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Sub-judul (Deskripsi Singkat)</label>
            <textarea name="hero_subtitle" rows="3" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-ukkom-navy focus:outline-none">{{ $settings->hero_subtitle }}</textarea>
        </div>

        <hr class="my-6 border-gray-200">

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Ayat / Kutipan Inspiratif (Quote of the Week)</label>
            <textarea name="quote_text" rows="3" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-ukkom-navy focus:outline-none">{{ $settings->quote_text }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Sumber Kutipan (Misal: Filipi 4:13)</label>
            <input type="text" name="quote_author" value="{{ $settings->quote_author }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-ukkom-navy focus:outline-none">
        </div>

        <div class="pt-6 border-t border-gray-200">
            <button type="submit" class="bg-ukkom-navy hover:bg-blue-900 text-white font-bold py-3 px-8 rounded-lg transition duration-300 shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection