<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKKOM FATEK UNTAD</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-ukkom-darknavy text-gray-300 font-sans antialiased selection:bg-ukkom-tosca selection:text-ukkom-darknavy"></body>

    <nav class="absolute z-50 w-full top-0 py-6 px-4">
        <div class="max-w-5xl mx-auto bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-6 py-3 flex justify-between items-center shadow-lg">
            <a href="/" class="text-xl font-extrabold text-white tracking-widest flex items-center gap-2">
                <svg class="w-6 h-6 text-ukkom-tosca" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13h-13L12 6.5z"/></svg>
                UKKOM
            </a>
            
            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-200">
                <a href="/" class="hover:text-ukkom-tosca transition">Beranda</a>
                <a href="/profil" class="hover:text-ukkom-tosca transition">Profil</a>
                <a href="/arsip" class="hover:text-ukkom-tosca transition">Arsip</a>
                <a href="/pemerhati" class="hover:text-ukkom-tosca transition">Pemerhati</a>
            </div>

            <a href="/login" class="bg-white text-black text-sm font-bold px-5 py-2 rounded-full hover:bg-ukkom-tosca hover:text-white transition duration-300">
                Login
            </a>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-ukkom-darknavy text-gray-400 py-12 border-t border-white/10">
        <div class="max-w-6xl mx-auto px-6 text-center md:flex md:justify-between md:text-left">
            <div>
                <h3 class="text-white font-bold text-xl mb-2">UKKOM FATEK UNTAD</h3>
                <p class="text-sm max-w-xs">Wadah pembinaan spiritual dan karakter mahasiswa Kristen Fakultas Teknik.</p>
            </div>
            <div class="mt-6 md:mt-0 text-sm">
                <p>&copy; 2026 Hak Cipta Dilindungi.</p>
                <p class="mt-1">Built with ⚡ by <span class="text-ukkom-tosca font-bold">RVPS Studio</span></p>
            </div>
        </div>
    </footer>

</body>
</html>