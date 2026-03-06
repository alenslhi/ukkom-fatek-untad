@extends('layouts.app')

@section('content')
<div class="relative pt-32 pb-20 px-6 max-w-7xl mx-auto z-10">

    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Tentang <span class="text-transparent bg-clip-text bg-gradient-to-r from-ukkom-tosca to-ukkom-purple">UKKOM</span></h1>
        <div class="w-24 h-1 bg-gradient-to-r from-ukkom-tosca to-ukkom-purple mx-auto rounded-full"></div>
    </div>

    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 md:p-12 mb-16 shadow-2xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-2xl font-bold text-white mb-4">Sejarah & Visi Pelayanan</h2>
                <p class="text-gray-400 mb-4 leading-relaxed text-justify">
                    Sejak berdirinya tahun 1996, pengurus secara terus-menerus menggumuli visi pelayanan UKKOM dengan melihat kondisi yang Tuhan bukakan baik melalui Firman-Nya maupun melalui keadaan mahasiswa Teknik itu sendiri. Akhirnya pada tahun 2002, berhasil dirumuskan visi dan misi yang menjadi pedoman arah pelayanan UKKOM ke depan.
                </p>
                <div class="bg-ukkom-tosca/10 border-l-4 border-ukkom-tosca p-6 rounded-r-lg mt-6">
                    <h3 class="text-lg font-bold text-ukkom-tosca mb-2">VISI UKKOM:</h3>
                    <p class="text-white font-medium italic">
                        "Menghasilkan mahasiswa dan alumni kristen Fakultas Teknik Untad yang dewasa dalam Kristus, menjadi berkat dalam profesinya (bidang keteknikan)."
                    </p>
                </div>
            </div>
            <div class="hidden md:flex justify-center">
                <svg class="w-64 h-64 text-white/5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
        </div>
    </div>

    <div class="mb-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-white mb-3">Misi Pelayanan (4P)</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Visi tanpa misi ibarat orang yang tidur sambil bermimpi namun tidak dapat mewujudkannya. Berikut adalah langkah konkret UKKOM:</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $misi = [
                    ['title' => '1. Pemberitaan Injil', 'ayat' => '(Kisah Para Rasul 2:38)', 'desc' => 'Melakukan pemberitaan Injil untuk membawa orang tertarik kepada kekristenan, menyadari dirinya berdosa, mau bertobat, dan menerima Tuhan Yesus.', 'strat' => 'Kamp PMB, Retreat, PIPA, PI Pribadi'],
                    ['title' => '2. Pembinaan / Pemuridan', 'ayat' => '(II Petrus 2:2)', 'desc' => 'Membimbing mereka yang telah menerima Kristus agar menjadi dewasa dalam iman, karakter, pengetahuan, keterampilan, dan mampu mandiri mempelajari Firman.', 'strat' => 'SSB, Ibadah Persekutuan, Training'],
                    ['title' => '3. Pelipatgandaan', 'ayat' => '(II Timotius 2:2)', 'desc' => 'Melatih dan memotivasi agar setiap orang yang dibina rindu melayani, bersaksi, membina orang lain, dan terlibat dalam kepengurusan atau tim pelayanan.', 'strat' => 'Training, Lokakarya, Pengkaderan'],
                    ['title' => '4. Pengutusan', 'ayat' => '', 'desc' => 'Membantu pra-alumni mengerti misi Tuhan, mengetahui kehendak-Nya untuk karier, dan membina pra-alumni agar siap menjadi garam dan terang di dunia profesi.', 'strat' => 'Fokus: Persiapan Karier & Alumni'],
                ];
            @endphp

            @foreach($misi as $item)
            <div class="bg-white/5 border border-white/10 p-8 rounded-2xl hover:border-ukkom-tosca/50 transition duration-300">
                <h3 class="text-xl font-bold text-white mb-1">{{ $item['title'] }}</h3>
                @if($item['ayat']) <span class="inline-block text-xs font-semibold text-ukkom-tosca mb-4">{{ $item['ayat'] }}</span> @endif
                <p class="text-gray-400 text-sm mb-4">{{ $item['desc'] }}</p>
                <div class="text-xs font-semibold text-ukkom-purple bg-ukkom-purple/10 border border-ukkom-purple/20 inline-block px-3 py-1 rounded-full">{{ $item['strat'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection