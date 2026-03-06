@extends('layouts.app')

@section('content')
<div class="relative pt-32 pb-20 px-6 max-w-7xl mx-auto z-10">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-white mb-4">Galeri & <span class="text-transparent bg-clip-text bg-gradient-to-r from-ukkom-tosca to-ukkom-purple">Dokumentasi</span></h1>
        <p class="text-gray-400">Arsip kegiatan, ibadah, dan program kerja UKKOM FATEK.</p>
    </div>

    @forelse($archives as $kategori => $fotos)
        <div class="mb-12 bg-white/5 backdrop-blur-md border border-white/10 p-6 md:p-8 rounded-3xl shadow-xl">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-ukkom-tosca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ $kategori }}
                <span class="ml-3 text-sm font-normal text-ukkom-tosca bg-ukkom-tosca/10 border border-ukkom-tosca/20 px-3 py-1 rounded-full">{{ $fotos->count() }} Foto</span>
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($fotos as $foto)
                    <div class="group relative overflow-hidden rounded-xl shadow-sm hover:shadow-2xl hover:ring-2 hover:ring-ukkom-tosca transition-all duration-300 aspect-square bg-white/5 border border-white/10">
                        <img src="{{ asset('storage/' . $foto->image_path) }}" alt="{{ $foto->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                            <div class="text-white translate-y-4 group-hover:translate-y-0 transition duration-300">
                                <p class="font-bold text-sm line-clamp-1">{{ $foto->title }}</p>
                                <p class="text-xs text-ukkom-tosca mt-1">{{ \Carbon\Carbon::parse($foto->event_date)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-center bg-white/5 backdrop-blur-md p-12 rounded-3xl border border-dashed border-white/20">
            <svg class="w-16 h-16 text-white/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <p class="text-gray-400 font-medium text-lg">Belum ada dokumentasi yang diunggah.</p>
        </div>
    @endforelse
</div>
@endsection