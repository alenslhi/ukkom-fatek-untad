<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKKOM FATEK UNTAD</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-ukkom-darknavy text-gray-300 font-sans antialiased selection:bg-ukkom-tosca selection:text-ukkom-darknavy flex flex-col min-h-screen">

    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/5 backdrop-blur-xl border-b border-white/10 shadow-lg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                <a href="/" class="flex items-center gap-3 text-xl font-extrabold text-white tracking-widest group">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo UKKOM" class="w-10 h-10 object-contain drop-shadow-[0_0_10px_rgba(45,212,191,0.5)] group-hover:scale-110 transition duration-300">
                    UKKOM
                </a>

                <div class="hidden md:flex space-x-8 items-center font-bold text-sm">
                    <a href="/" class="text-gray-300 hover:text-white hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.8)] transition">Beranda</a>
                    <a href="/profil" class="text-gray-300 hover:text-white hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.8)] transition">Profil</a>
                    <a href="/arsip" class="text-gray-300 hover:text-white hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.8)] transition">Arsip</a>
                    <a href="/pemerhati" class="text-gray-300 hover:text-white hover:drop-shadow-[0_0_8px_rgba(255,255,255,0.8)] transition">Pemerhati</a>
                    
                    @auth
                        <a href="/admin/settings" class="px-6 py-2.5 rounded-full bg-ukkom-tosca hover:bg-teal-300 text-black font-extrabold shadow-[0_0_15px_rgba(45,212,191,0.4)] hover:shadow-[0_0_25px_rgba(45,212,191,0.6)] transition">Dapur Admin</a>
                    @else
                        <a href="/login" class="px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold transition">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow relative">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-ukkom-purple/20 rounded-full mix-blend-screen filter blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40rem] h-[40rem] bg-ukkom-tosca/10 rounded-full mix-blend-screen filter blur-[100px]" style="animation-delay: 2s;"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMSkiLz48L3N2Zz4=')] opacity-50"></div>
        </div>
        
        @yield('content')
    </main>

    <footer class="bg-black/40 backdrop-blur-xl text-gray-400 py-12 border-t border-white/10 mt-auto relative z-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo UKKOM" class="w-8 h-8 object-contain grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition">
                    <h3 class="text-white font-extrabold text-xl tracking-widest">UKKOM FATEK</h3>
                </div>
                <p class="text-sm leading-relaxed mb-4 text-justify">
                    Wadah pembinaan spiritual dan karakter mahasiswa Kristen Fakultas Teknik Universitas Tadulako. Menjadi berkat dalam profesi keteknikan.
                </p>
                <div class="flex gap-4 mt-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-ukkom-tosca hover:text-black transition border border-white/10">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-3 border-b border-white/10 pb-2 flex items-center gap-2">
                    <svg class="w-4 h-4 text-ukkom-tosca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    Sekretariat Internal
                </h4>
                <p class="text-xs mb-3">Area Fakultas Teknik, Universitas Tadulako, Palu.</p>
                <div class="w-full h-32 rounded-xl overflow-hidden border border-white/10 bg-white/5">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.349642646369!2d119.8893!3d-0.8406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwNTAnMjYuMiJTIDExOcKwNTMnMjEuNSJF!5e0!3m2!1sen!2sid!4v1611234567890!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-3 border-b border-white/10 pb-2 flex items-center gap-2">
                    <svg class="w-4 h-4 text-ukkom-tosca" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    Sekretariat Eksternal
                </h4>
                <p class="text-xs mb-3">Palu, Sulawesi Tengah.</p>
                <div class="w-full h-32 rounded-xl overflow-hidden border border-white/10 bg-white/5">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3!2d119.8!3d-0.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z!5e0!3m2!1sen!2sid!4v1611234567890!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

        </div>

        <div class="max-w-7xl mx-auto px-6 mt-10 pt-6 border-t border-white/5 text-center text-sm flex flex-col md:flex-row justify-between items-center">
            <p>© 2026 Hak Cipta Dilindungi.</p>
            <p class="mt-2 md:mt-0">Built with ⚡ by <span class="text-ukkom-tosca font-bold">RVPS Studio</span></p>
        </div>
    </footer>
</body>
</html>