@extends('layouts.app')

@section('content')

<div class="text-center mb-16">
    <h1 class="text-4xl font-extrabold text-ukkom-navy mb-4">Tentang UKKOM FATEK</h1>
    <div class="w-24 h-1 bg-ukkom-orange mx-auto rounded"></div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 mb-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Sejarah & Visi Pelayanan</h2>
            <p class="text-gray-600 mb-4 leading-relaxed text-justify">
                Sejak berdirinya tahun 1996, pengurus secara terus-menerus menggumuli visi pelayanan UKKOM dengan melihat kondisi yang Tuhan bukakan baik melalui Firman-Nya maupun melalui keadaan mahasiswa Teknik itu sendiri. Akhirnya pada tahun 2002, berhasil dirumuskan visi dan misi yang menjadi pedoman arah pelayanan UKKOM ke depan.
            </p>
            <div class="bg-blue-50 border-l-4 border-ukkom-navy p-6 rounded-r-lg mt-6">
                <h3 class="text-lg font-bold text-ukkom-navy mb-2">VISI UKKOM:</h3>
                <p class="text-blue-900 font-medium italic">
                    "Menghasilkan mahasiswa dan alumni kristen Fakultas Teknik Untad yang dewasa dalam Kristus, menjadi berkat dalam profesinya (bidang keteknikan)."
                </p>
            </div>
        </div>
        
        <div class="hidden md:flex justify-center">
            <svg class="w-64 h-64 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
        </div>
    </div>
</div>

<div class="mb-12">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">Misi</h2>
        <p class="text-gray-500 max-w-2xl mx-auto">Visi tanpa misi ibarat orang yang tidur sambil bermimpi namun tidak dapat mewujudkannya. Berikut adalah langkah konkret UKKOM:</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-t-4 border-ukkom-navy">
            <h3 class="text-xl font-bold text-ukkom-navy mb-2">1. Pemberitaan Injil</h3>
            <span class="inline-block text-xs font-semibold text-gray-400 mb-4">(Kisah Para Rasul 2:38)</span>
            <p class="text-gray-600 text-sm mb-4">Melakukan pemberitaan Injil untuk membawa orang tertarik kepada kekristenan, menyadari dirinya berdosa, mau bertobat, dan menerima Tuhan Yesus.</p>
            <div class="text-xs font-semibold text-ukkom-orange bg-orange-50 inline-block px-2 py-1 rounded">Strategi: Kamp PMB, Retreat, PIPA, PI Pribadi</div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-t-4 border-ukkom-navy">
            <h3 class="text-xl font-bold text-ukkom-navy mb-2">2. Pembinaan / Pemuridan</h3>
            <span class="inline-block text-xs font-semibold text-gray-400 mb-4">(II Petrus 2:2)</span>
            <p class="text-gray-600 text-sm mb-4">Membimbing mereka yang telah menerima Kristus agar menjadi dewasa dalam iman, karakter, pengetahuan, keterampilan, dan mampu mandiri mempelajari Firman.</p>
            <div class="text-xs font-semibold text-ukkom-orange bg-orange-50 inline-block px-2 py-1 rounded">Strategi: SSB, Ibadah Persekutuan, Training</div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-t-4 border-ukkom-navy">
            <h3 class="text-xl font-bold text-ukkom-navy mb-2">3. Pelipatgandaan</h3>
            <span class="inline-block text-xs font-semibold text-gray-400 mb-4">(II Timotius 2:2)</span>
            <p class="text-gray-600 text-sm mb-4">Melatih dan memotivasi agar setiap orang yang dibina rindu melayani, bersaksi, membina orang lain, dan terlibat dalam kepengurusan atau tim pelayanan.</p>
            <div class="text-xs font-semibold text-ukkom-orange bg-orange-50 inline-block px-2 py-1 rounded">Strategi: Training, Lokakarya, Pengkaderan</div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition border-t-4 border-ukkom-navy">
            <h3 class="text-xl font-bold text-ukkom-navy mb-2">4. Pengutusan</h3>
            <p class="text-gray-600 text-sm mb-4">Membantu pra-alumni mengerti misi Tuhan, mengetahui kehendak-Nya untuk karier, dan membina pra-alumni agar siap menjadi garam dan terang di dunia profesi.</p>
            <div class="text-xs font-semibold text-ukkom-orange bg-orange-50 inline-block px-2 py-1 rounded">Fokus: Persiapan Karier & Alumni</div>
        </div>
    </div>
</div>

@endsection