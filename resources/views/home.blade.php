@extends('layouts.app')

@section('content')

<div class="bg-ukkom-navy rounded-2xl overflow-hidden shadow-xl mb-12 relative">
    <div class="absolute inset-0 opacity-20 bg-center bg-cover" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
    
    <div class="relative px-8 py-16 md:py-24 max-w-4xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
            {{ $settings->hero_title ?? 'Selamat Datang di UKKOM FATEK' }}
        </h1>
        <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            {{ $settings->hero_subtitle ?? 'Wadah Mahasiswa Kristen Fakultas Teknik' }}
        </p>
        <a href="#jadwal" class="inline-block bg-ukkom-orange hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300">
            Lihat Jadwal Terdekat
        </a>
    </div>
</div>

@if($settings && $settings->quote_text)
<div class="max-w-3xl mx-auto text-center mb-16 px-4">
    <svg class="w-10 h-10 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
    <blockquote class="text-xl md:text-2xl font-medium text-gray-700 italic">
        "{{ $settings->quote_text }}"
    </blockquote>
    <p class="mt-4 text-sm font-bold text-gray-500 uppercase tracking-widest">- {{ $settings->quote_author }} -</p>
</div>
@endif

<div id="jadwal" class="mb-12">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-ukkom-navy border-l-4 border-ukkom-orange pl-3">Agenda Terdekat (Bulan Ini)</h2>
    </div>

    @if($activities->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($activities as $kegiatan)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                @if($kegiatan->pamphlet)
                    <div class="h-48 w-full bg-gray-200 bg-cover bg-center" style="background-image: url('{{ asset('storage/activities/' . $kegiatan->pamphlet) }}')"></div>
                @else
                    <div class="h-32 w-full bg-blue-50 flex items-center justify-center text-blue-200">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                
                <div class="p-5">
                    <span class="inline-block px-2 py-1 bg-orange-100 text-orange-800 text-xs font-bold rounded mb-3">
                        {{ $kegiatan->category }}
                    </span>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $kegiatan->title }}</h3>
                    
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $kegiatan->event_date->format('d F Y, H:i') }} WITA
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $kegiatan->location }}
                    </div>

                    <p class="text-sm text-gray-600 line-clamp-2">
                        {{ $kegiatan->description }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-50 rounded-lg p-8 text-center border border-dashed border-gray-300">
            <p class="text-gray-500">Belum ada agenda kegiatan dalam 1 bulan ke depan.</p>
        </div>
    @endif
</div>

@endsection