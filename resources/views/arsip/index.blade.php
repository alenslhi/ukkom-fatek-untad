@extends('layouts.app')

@section('content')
<div class="relative pt-32 pb-20 px-6 max-w-7xl mx-auto z-10">

    <div class="text-center mb-16">
        <h1 class="text-4xl font-extrabold text-white mb-4 uppercase tracking-widest">Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-ukkom-tosca to-ukkom-purple">Kegiatan</span></h1>
        <p class="text-gray-400">Dokumentasi momen kebersamaan dan pelayanan UKKOM FATEK.</p>
        
        <form action="/arsip" method="GET" class="mt-8 max-w-md mx-auto relative">
            <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-ukkom-tosca transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari album kegiatan..." class="w-full bg-white/5 border border-white/10 text-white rounded-full py-3 pl-12 pr-4 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none placeholder-gray-500 shadow-lg transition">
        </form>
    </div>

    @forelse($archives as $kategori => $albums)
        <div class="mb-16">
            <div class="flex items-center mb-6">
                <div class="w-2 h-8 bg-ukkom-tosca rounded-full mr-4 shadow-[0_0_10px_rgba(45,212,191,0.5)]"></div>
                <h2 class="text-2xl font-bold text-white">{{ $kategori }}</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($albums as $album)
                    @php
                        // Siapkan array gambar
                        $imgArray = is_array($album->images) ? $album->images : [];
                        $count = count($imgArray);
                        $thumbnail = $count > 0 ? asset('storage/' . $imgArray[0]) : '';
                        
                        // Buat URL lengkap untuk JS
                        $fullUrlArray = array_map(function($path) { return asset('storage/' . $path); }, $imgArray);
                        $jsonImages = json_encode($fullUrlArray);
                    @endphp

                    <div onclick="openLightbox(this)" data-images="{{ $jsonImages }}" data-title="{{ $album->title }}" class="group relative overflow-hidden rounded-[2rem] bg-white/5 border border-white/10 aspect-[4/3] shadow-xl hover:shadow-2xl hover:border-ukkom-tosca/50 transition-all duration-500 cursor-zoom-in">
                        
                        <div class="absolute top-4 right-4 z-20 bg-black/60 backdrop-blur-md text-white text-sm font-bold px-3 py-1.5 rounded-xl border border-white/10 flex items-center gap-2 shadow-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v16H4V4zm2 4v10h12V8H6zm2 2h8v6H8v-6z"/></svg>
                            {{ $count }}
                        </div>

                        <img src="{{ $thumbnail }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 opacity-90 group-hover:opacity-100">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-ukkom-darknavy via-ukkom-darknavy/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        <div class="absolute bottom-0 left-0 w-full p-6 translate-y-6 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition duration-500 z-20">
                            <h3 class="text-xl font-bold text-white mb-1 drop-shadow-md">{{ $album->title }}</h3>
                            <p class="text-sm font-medium text-ukkom-tosca drop-shadow-md">{{ \Carbon\Carbon::parse($album->event_date)->format('d M Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-center bg-white/5 backdrop-blur-md p-12 rounded-3xl border border-dashed border-white/20">
            <p class="text-gray-400 font-medium text-lg">Belum ada album dokumentasi yang ditemukan.</p>
        </div>
    @endforelse
</div>

<div id="lightbox" class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-opacity duration-300">
    
    <button onclick="closeLightbox(event)" class="absolute top-6 right-6 text-white/50 hover:text-ukkom-tosca transition cursor-pointer z-50 bg-white/5 p-2 rounded-full border border-white/10">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>

    <div id="lightbox-counter" class="absolute top-8 left-1/2 -translate-x-1/2 text-white/70 font-mono font-bold tracking-widest z-50 bg-black/50 px-4 py-1 rounded-full border border-white/10"></div>

    <div class="relative w-full max-w-6xl px-4 flex items-center justify-center h-full">
        
        <button id="btn-prev" onclick="changeSlide(-1, event)" class="absolute left-2 md:left-10 z-50 bg-black/50 hover:bg-ukkom-tosca text-white hover:text-black p-3 md:p-4 rounded-full backdrop-blur-md transition border border-white/20">
            <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
        </button>

        <img id="lightbox-img" src="" class="max-w-full max-h-[75vh] object-contain rounded-xl shadow-[0_0_50px_rgba(0,0,0,0.5)] transform scale-95 transition-transform duration-300">
        
        <button id="btn-next" onclick="changeSlide(1, event)" class="absolute right-2 md:right-10 z-50 bg-black/50 hover:bg-ukkom-tosca text-white hover:text-black p-3 md:p-4 rounded-full backdrop-blur-md transition border border-white/20">
            <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>

    <p id="lightbox-caption" class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white font-bold text-lg md:text-xl drop-shadow-lg bg-black/60 border border-white/10 px-8 py-2.5 rounded-full backdrop-blur-md z-50 text-center w-max max-w-[90vw] truncate"></p>
</div>

<script>
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const btnPrev = document.getElementById('btn-prev');
    const btnNext = document.getElementById('btn-next');

    let imagesArray = [];
    let currentIndex = 0;

    // PERBAIKAN: Fungsi penangkap data yang aman
    function openLightbox(element) {
        // Ambil data dari attribute
        imagesArray = JSON.parse(element.getAttribute('data-images'));
        let caption = element.getAttribute('data-title');
        
        currentIndex = 0;
        lightboxCaption.innerText = caption;
        
        // Sembunyikan panah jika gambar cuma 1
        if (imagesArray.length <= 1) {
            btnPrev.style.display = 'none';
            btnNext.style.display = 'none';
            lightboxCounter.style.display = 'none';
        } else {
            btnPrev.style.display = 'block';
            btnNext.style.display = 'block';
            lightboxCounter.style.display = 'block';
        }

        updateImage();

        // Tampilkan Modal
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        setTimeout(() => {
            lightbox.classList.remove('opacity-0');
            lightboxImg.classList.remove('scale-95');
        }, 10);
    }

    function changeSlide(direction, event) {
        event.stopPropagation(); // Mencegah modal tertutup saat klik tombol
        
        // Tambahkan efek transisi cepat saat ganti gambar
        lightboxImg.classList.add('opacity-50', 'scale-95');
        
        setTimeout(() => {
            currentIndex += direction;
            
            // Infinite loop
            if (currentIndex >= imagesArray.length) currentIndex = 0;
            if (currentIndex < 0) currentIndex = imagesArray.length - 1;
            
            updateImage();
            
            // Kembalikan efek setelah ganti src
            lightboxImg.classList.remove('opacity-50', 'scale-95');
        }, 150); // Jeda sangat singkat biar smooth
    }

    function updateImage() {
        lightboxImg.src = imagesArray[currentIndex];
        lightboxCounter.innerText = (currentIndex + 1) + " / " + imagesArray.length;
    }

    function closeLightbox(event) {
        if(event) event.stopPropagation();
        lightbox.classList.add('opacity-0');
        lightboxImg.classList.add('scale-95');
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            lightboxImg.src = '';
        }, 300);
    }

    // Tutup modal kalau klik di area hitam (bukan di gambar/tombol)
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox || e.target.closest('.w-full.max-w-6xl') === e.target) {
            closeLightbox();
        }
    });

    // Support keyboard panah kanan & kiri + ESC
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('hidden')) {
            if (e.key === 'ArrowRight') changeSlide(1, e);
            if (e.key === 'ArrowLeft') changeSlide(-1, e);
            if (e.key === 'Escape') closeLightbox(e);
        }
    });
</script>
@endsection