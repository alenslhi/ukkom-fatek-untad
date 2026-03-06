<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKKOM FATEK UNTAD</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <header class="bg-ukkom-navy text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wider">UKKOM FATEK</h1>
            <nav class="hidden md:flex space-x-6 font-medium">
                <a href="/" class="hover:text-ukkom-orange transition">Beranda</a>
                <a href="/profil" class="hover:text-ukkom-orange transition">Profil</a>
                <a href="/arsip" class="hover:text-ukkom-orange transition">Arsip</a>
                <a href="/pemerhati" class="hover:text-ukkom-orange transition">Pemerhati</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-400 text-center py-6">
        <p>&copy; 2026 UKKOM FATEK UNTAD. Built by RVPS Studio.</p>
    </footer>

</body>
</html>