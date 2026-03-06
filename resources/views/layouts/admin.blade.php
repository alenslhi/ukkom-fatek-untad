<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - UKKOM FATEK</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-ukkom-navy text-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-blue-800 font-bold text-xl tracking-widest">
            Admin Panel
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="/admin/settings" class="block px-4 py-3 rounded hover:bg-blue-800 transition">Pengaturan Web</a>
            <a href="/admin/activities" class="block px-4 py-3 rounded hover:bg-blue-800 transition">Kelola Jadwal</a>
            <a href="/admin/archives" class="block px-4 py-3 rounded hover:bg-blue-800 transition">Upload Dokumentasi</a>
            <a href="/admin/contacts" class="block px-4 py-3 rounded hover:bg-blue-800 transition">Kelola Kontak WA</a>
            <hr class="border-blue-800 my-4">
            <form action="/logout" method="POST" class="px-4">
                @csrf
                <button type="submit" class="w-full text-left py-3 px-4 rounded hover:bg-red-600 hover:text-white text-red-300 font-bold transition">
                    Keluar (Logout)
                </button>
            </form>
            </nav>
        <div class="p-4 border-t border-blue-800">
            <a href="/" target="_blank" class="block w-full text-center bg-ukkom-orange hover:bg-orange-600 text-white py-2 rounded transition text-sm font-bold">Lihat Website</a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6">
            <div class="font-bold text-gray-700 md:hidden">Admin Panel</div>
            <div class="text-sm text-gray-500 ml-auto">Halo, Admin!</div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            @yield('content')
        </div>
    </main>

</body>
</html>