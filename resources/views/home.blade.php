@extends('layouts.app')

@section('content')

<div class="relative overflow-hidden min-h-screen flex items-center pt-20">
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-ukkom-purple/30 rounded-full mix-blend-screen filter blur-[100px] animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-ukkom-tosca/20 rounded-full mix-blend-screen filter blur-[100px] animate-pulse" style="animation-delay: 2s;"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-24 flex flex-col items-center text-center z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-ukkom-tosca text-sm font-semibold mb-8 backdrop-blur-md">
            <span class="flex h-2 w-2 rounded-full bg-ukkom-tosca animate-ping"></span>
            Fakultas Teknik Universitas Tadulako
        </div>

        <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight max-w-4xl">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-ukkom-tosca to-ukkom-purple">Menjadi Berkat</span> <br> 
            dalam Profesi Keteknikan.
        </h1>
        
        <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl">
            {{ $settings->hero_subtitle ?? 'Wadah pembinaan spiritual dan karakter mahasiswa Kristen Fakultas Teknik.' }}
        </p>

        <div class="flex flex-col sm:flex-row gap-4">
            <a href="#jadwal" class="px-8 py-4 rounded-full bg-ukkom-tosca hover:bg-teal-300 text-black font-bold text-lg transition duration-300 shadow-[0_0_30px_rgba(45,212,191,0.3)]">Lihat Jadwal Ibadah</a>
            <a href="/pemerhati" class="px-8 py-4 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/10 font-bold text-lg backdrop-blur-md transition duration-300">Layanan Pemerhati</a>
        </div>
    </div>
</div>

@if($settings && $settings->quote_text)
<div class="relative z-20 max-w-5xl mx-auto px-6 -mt-20 mb-20">
    <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-3xl p-10 text-center shadow-2xl">
        <svg class="w-10 h-10 text-ukkom-tosca/50 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
        <blockquote class="text-2xl font-medium text-white mb-6">"{{ $settings->quote_text }}"</blockquote>
        <div class="inline-block px-4 py-1 bg-ukkom-tosca/10 text-ukkom-tosca border border-ukkom-tosca/20 rounded-full text-sm font-bold tracking-widest uppercase">{{ $settings->quote_author }}</div>
    </div>
</div>
@endif

<div id="jadwal" class="py-10 mb-10">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-12 text-center md:text-left md:flex justify-between items-end">
            <div>
                <h2 class="text-4xl font-extrabold text-white mb-2">Agenda Terdekat</h2>
                <p class="text-gray-400">Jangan lewatkan kegiatan UKKOM dalam 30 hari ke depan.</p>
            </div>
            <a href="/arsip" class="hidden md:inline-block text-ukkom-tosca font-bold hover:text-white transition">Lihat Dokumentasi &rarr;</a>
        </div>

        @if($activities->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($activities as $kegiatan)
                <div class="bg-white/5 backdrop-blur-sm rounded-3xl p-6 border border-white/10 shadow-lg hover:shadow-2xl hover:bg-white/10 hover:-translate-y-2 transition duration-300 group relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-ukkom-tosca to-ukkom-purple transform origin-left scale-x-0 group-hover:scale-x-100 transition duration-300"></div>

                    @if($kegiatan->pamphlet)
                        <div class="h-48 w-full rounded-2xl mb-6 bg-cover bg-center shadow-inner" style="background-image: url('{{ asset('storage/activities/' . $kegiatan->pamphlet) }}')"></div>
                    @else
                        <div class="h-40 w-full rounded-2xl mb-6 bg-white/5 border border-white/10 flex items-center justify-center relative overflow-hidden">
                            <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    
                    <div class="flex justify-between items-start mb-4">
                        <span class="px-3 py-1 bg-ukkom-tosca/20 text-ukkom-tosca text-xs font-bold rounded-lg border border-ukkom-tosca/30">{{ $kegiatan->category }}</span>
                        <div class="text-right">
                            <div class="text-2xl font-black text-white leading-none">{{ $kegiatan->event_date->format('d') }}</div>
                            <div class="text-xs font-bold text-gray-400 uppercase">{{ $kegiatan->event_date->format('M') }}</div>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-ukkom-tosca transition">{{ $kegiatan->title }}</h3>
                    <p class="text-gray-400 text-sm mb-6 line-clamp-2">{{ $kegiatan->description }}</p>

                    <div class="flex items-center text-sm font-medium text-gray-300 bg-white/5 px-4 py-3 rounded-xl border border-white/10">
                        <svg class="w-5 h-5 text-ukkom-tosca mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $kegiatan->location }}
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-white/5 backdrop-blur-sm rounded-3xl p-12 text-center border border-white/10">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4"><svg class="w-10 h-10 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                <h3 class="text-xl font-bold text-white mb-2">Belum ada jadwal terdekat</h3>
                <p class="text-gray-400">Saat ini belum ada agenda kegiatan dalam 30 hari ke depan.</p>
            </div>
        @endif
    </div>
</div>

@if(isset($ultahHariIni) && $ultahHariIni->count() > 0)
<div class="pb-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-gradient-to-r from-ukkom-tosca/5 to-ukkom-purple/5 border border-ukkom-tosca/20 rounded-3xl p-6 md:p-8 relative overflow-hidden backdrop-blur-md">
            
            <div class="absolute top-0 right-0 w-48 h-48 bg-ukkom-tosca/10 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="text-center md:text-left md:w-1/3 shrink-0">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/5 border border-white/10 mb-4 shadow-lg">
                        <span class="text-xl">🎉</span>
                    </div>
                    <h2 class="text-2xl font-extrabold text-white mb-2">Ulang Tahun <br><span class="text-ukkom-tosca">Hari Ini!</span></h2>
                    <p class="text-gray-400 text-xs leading-relaxed max-w-xs mx-auto md:mx-0">Mari mendoakan rekan kita yang bersukacita merayakan hari kelahirannya.</p>
                </div>

                <div class="md:w-2/3 w-full max-h-[220px] overflow-y-auto pr-2 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-ukkom-tosca/30 [&::-webkit-scrollbar-thumb]:rounded-full hover:[&::-webkit-scrollbar-thumb]:bg-ukkom-tosca/50">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full">
                        @foreach($ultahHariIni as $m)
                        <div class="bg-black/20 backdrop-blur-sm border border-white/5 rounded-xl p-4 hover:border-ukkom-tosca/40 transition duration-300 flex flex-col justify-center">
                            <h3 class="text-sm font-bold text-white mb-1 truncate" title="{{ $m->name }}">{{ $m->name }} {{ $m->title ? ', '.$m->title : '' }}</h3>
                            <div class="text-xs text-gray-400 font-medium truncate">{{ $m->major }}</div>
                            <div class="mt-2"><span class="text-[10px] text-ukkom-tosca font-mono bg-ukkom-tosca/10 px-2 py-0.5 rounded">Angkatan {{ $m->angkatan ?? '-' }}</span></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endif
@endsection