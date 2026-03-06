@extends('layouts.app')

@section('content')

<div class="text-center mb-12">
    <h1 class="text-4xl font-extrabold text-ukkom-navy mb-4">Galeri & Dokumentasi</h1>
    <p class="text-gray-500">Arsip kegiatan, ibadah, dan program kerja UKKOM FATEK UNTAD.</p>
</div>

@forelse($archives as $kategori => $fotos)
    <div class="mb-12 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-ukkom-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            {{ $kategori }}
            <span class="ml-3 text-sm font-normal text-gray-400 bg-gray-100 px-3 py-1 rounded-full">{{ $fotos->count() }} Foto</span>
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($fotos as $foto)
                <div class="group relative overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square bg-gray-100">
                    <img src="{{ asset('storage/' . $foto->image_path) }}" alt="{{ $foto->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
                            <p class="font-bold text-sm line-clamp-1">{{ $foto->title }}</p>
                            <p class="text-xs text-gray-300 mt-1">{{ \Carbon\Carbon::parse($foto->event_date)->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@empty
    <div class="text-center bg-white p-12 rounded-2xl shadow-sm border border-dashed border-gray-300">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <p class="text-gray-500 font-medium text-lg">Belum ada dokumentasi yang diunggah.</p>
        <p class="text-gray-400 text-sm mt-2">Gunakan halaman admin untuk mengunggah foto kegiatan.</p>
    </div>
@endforelse

@endsection