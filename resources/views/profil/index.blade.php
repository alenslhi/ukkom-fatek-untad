@extends('layouts.app')

@section('content')
<div class="relative pt-32 pb-20 px-6 max-w-7xl mx-auto z-10 flex flex-col items-center">

    <div class="text-center mb-16 w-full">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Tentang <span class="text-transparent bg-clip-text bg-gradient-to-r from-ukkom-tosca to-ukkom-purple">UKKOM</span></h1>
        <div class="w-24 h-1 bg-gradient-to-r from-ukkom-tosca to-ukkom-purple mx-auto rounded-full"></div>
    </div>

    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 md:p-12 mb-20 shadow-2xl w-full">
        <div class="w-full">
            <h2 class="text-3xl font-bold text-white mb-6">Sejarah & Visi Pelayanan</h2>
            <p class="text-gray-300 mb-6 leading-relaxed text-justify md:text-lg">
                Sejak berdirinya tahun 1996, pengurus secara terus-menerus menggumuli visi pelayanan UKKOM dengan melihat kondisi yang Tuhan bukakan baik melalui Firman-Nya maupun melalui keadaan mahasiswa Teknik itu sendiri. Akhirnya pada tahun 2002, berhasil dirumuskan visi dan misi yang menjadi pedoman arah pelayanan UKKOM ke depan.
            </p>
            <div class="bg-ukkom-tosca/10 border-l-4 border-ukkom-tosca p-8 rounded-r-2xl mt-8">
                <h3 class="text-xl font-bold text-ukkom-tosca mb-3 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.83L19.17 19H4.83L12 5.83zM11 16h2v2h-2v-2zm0-7h2v5h-2V9z"/></svg>
                    VISI UKKOM:
                </h3>
                <p class="text-white font-medium italic text-lg leading-relaxed">
                    "Menghasilkan mahasiswa dan alumni kristen Fakultas Teknik Untad yang dewasa dalam Kristus, menjadi berkat dalam profesinya (bidang keteknikan)."
                </p>
            </div>
        </div>
    </div>

    <div class="mb-24 w-full">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-white mb-3">Misi Pelayanan (4P)</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Langkah konkret UKKOM dalam mewujudkan visi pelayanan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
            @php
                $misi = [
                    ['title' => '1. Pemberitaan Injil', 'ayat' => '(Kisah Para Rasul 2:38)', 'desc' => 'Membawa orang tertarik kepada kekristenan, menyadari dirinya berdosa, dan menerima Tuhan Yesus.', 'strat' => 'Kamp PMB, Retreat, PIPA'],
                    ['title' => '2. Pembinaan / Pemuridan', 'ayat' => '(II Petrus 2:2)', 'desc' => 'Membimbing mereka agar menjadi dewasa dalam iman, karakter, pengetahuan, dan keterampilan.', 'strat' => 'SSB, Ibadah Persekutuan, Training'],
                    ['title' => '3. Pelipatgandaan', 'ayat' => '(II Timotius 2:2)', 'desc' => 'Melatih dan memotivasi agar rindu melayani, bersaksi, dan terlibat dalam kepengurusan.', 'strat' => 'Training, Lokakarya, Pengkaderan'],
                    ['title' => '4. Pengutusan', 'ayat' => '', 'desc' => 'Membantu pra-alumni mengerti kehendak-Nya untuk karier, agar siap menjadi garam dan terang.', 'strat' => 'Persiapan Karier & Alumni'],
                ];
            @endphp

            @foreach($misi as $item)
            <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:border-ukkom-tosca/50 transition duration-300">
                <h3 class="text-xl font-bold text-white mb-1">{{ $item['title'] }}</h3>
                @if($item['ayat']) <span class="inline-block text-xs font-semibold text-ukkom-tosca mb-4">{{ $item['ayat'] }}</span> @endif
                <p class="text-gray-400 text-sm mb-4">{{ $item['desc'] }}</p>
                <div class="text-xs font-semibold text-ukkom-purple bg-ukkom-purple/10 border border-ukkom-purple/20 inline-block px-3 py-1 rounded-full">{{ $item['strat'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="w-full">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-3 uppercase tracking-widest">Pengurus UKKOM</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Keluarga besar pelayan Tuhan di Fakultas Teknik Universitas Tadulako.</p>
        </div>

        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($pengurus as $p)
            <div class="group relative bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 text-center hover:-translate-y-2 hover:bg-ukkom-tosca hover:border-ukkom-tosca transition duration-500 overflow-hidden shadow-xl w-full">
                
                <div class="absolute top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-ukkom-tosca/30 rounded-full blur-xl group-hover:bg-white/40 transition duration-500"></div>
                
                @php 
                    $imgUrl = $p->image ? asset('storage/' . $p->image) : 'https://ui-avatars.com/api/?name='.urlencode($p->name).'&background=2dd4bf&color=fff&size=128'; 
                @endphp
                <img src="{{ $imgUrl }}" alt="{{ $p->name }}" class="relative w-24 h-24 mx-auto rounded-full object-cover mb-5 border-4 border-white/10 group-hover:border-white/40 transition shadow-lg">
                
                <h3 class="text-lg font-bold text-white mb-1 group-hover:text-black transition truncate">{{ $p->name }}</h3>
                <p class="text-xs font-mono text-ukkom-tosca group-hover:text-black/70 mb-5 tracking-wider transition truncate">{{ $p->position }}</p>
                
                <p class="text-sm text-gray-400 italic mb-6 line-clamp-3 group-hover:text-black/80 transition">
                    "{{ $p->quote }}"
                </p>
                
                <div class="flex justify-center gap-4 text-gray-500 group-hover:text-black/60">
                    @if($p->ig_link)
                    <a href="{{ $p->ig_link }}" target="_blank" class="hover:text-white group-hover:hover:text-black transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    @endif
                    @if($p->tiktok_link)
                    <a href="{{ $p->tiktok_link }}" target="_blank" class="hover:text-white group-hover:hover:text-black transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.12-3.44-3.17-3.8-5.46-.4-2.46.33-5.06 1.95-6.9 1.59-1.8 4.02-2.8 6.42-2.61v4.06c-1.05-.08-2.14.28-2.92.97-.7.63-1.16 1.55-1.18 2.51-.03.96.38 1.9 1.05 2.56.7.67 1.68 1.02 2.65.98 1.05-.04 2.05-.53 2.67-1.35.61-.8.92-1.82.9-2.84-.04-4.83-.01-9.67-.02-14.51z"/></svg>
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 text-center bg-white/5 backdrop-blur-md p-12 rounded-3xl border border-dashed border-white/20 w-full">
                <p class="text-gray-400 font-medium text-lg">Belum ada data pengurus di-upload.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection