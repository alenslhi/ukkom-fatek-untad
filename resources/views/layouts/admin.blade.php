<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Dashboard - UKKOM FATEK</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-ukkom-darknavy text-gray-300 font-sans antialiased flex h-screen overflow-hidden selection:bg-ukkom-tosca selection:text-ukkom-darknavy">

    <aside class="relative w-72 bg-white/5 backdrop-blur-xl flex-col hidden md:flex shadow-2xl overflow-hidden border-r border-white/10">
        <div class="absolute top-0 left-0 w-48 h-48 bg-ukkom-purple/20 rounded-full mix-blend-screen filter blur-[50px] animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 bg-ukkom-tosca/20 rounded-full mix-blend-screen filter blur-[50px]" style="animation-delay: 1s;"></div>
        
        <div class="relative z-10 h-24 flex items-center justify-center border-b border-white/10 bg-black/20">
            <div class="flex items-center gap-3 font-extrabold text-2xl tracking-widest text-white">
                <svg class="w-8 h-8 text-ukkom-tosca drop-shadow-[0_0_10px_rgba(45,212,191,0.5)]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13h-13L12 6.5z"/></svg>
                UKKOM
            </div>
        </div>
        
        <nav class="relative z-10 flex-1 px-5 py-8 space-y-3 overflow-y-auto">
            <div class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4 px-2">Menu Kendali</div>
            
            <a href="/admin/settings" class="flex items-center gap-3 px-4 py-3.5 rounded-xl border border-white/5 hover:border-ukkom-tosca/50 hover:bg-ukkom-carddark text-gray-400 hover:text-white transition duration-300 group shadow-inner">
                <span class="text-xl group-hover:scale-110 group-hover:rotate-45 transition duration-300"></span> 
                <span class="font-medium">Pengaturan Web</span>
            </a>
            <a href="/admin/activities" class="flex items-center gap-3 px-4 py-3.5 rounded-xl border border-white/5 hover:border-ukkom-tosca/50 hover:bg-ukkom-carddark text-gray-400 hover:text-white transition duration-300 group shadow-inner">
                <span class="text-xl group-hover:scale-110 group-hover:-translate-y-1 transition duration-300"></span> 
                <span class="font-medium">Kelola Jadwal</span>
            </a>
            <a href="/admin/archives" class="flex items-center gap-3 px-4 py-3.5 rounded-xl border border-white/5 hover:border-ukkom-tosca/50 hover:bg-ukkom-carddark text-gray-400 hover:text-white transition duration-300 group shadow-inner">
                <span class="text-xl group-hover:scale-110 group-hover:rotate-12 transition duration-300"></span> 
                <span class="font-medium">Dokumentasi</span>
            </a>
            <a href="/admin/contacts" class="flex items-center gap-3 px-4 py-3.5 rounded-xl border border-white/5 hover:border-ukkom-tosca/50 hover:bg-white/5 text-gray-400 hover:text-white transition duration-300 group shadow-inner">
                <span class="text-xl group-hover:scale-110 group-hover:-rotate-12 transition duration-300"></span> 
                <span class="font-medium">Kontak WhatsApp</span>
            </a>
        </nav>

        <div class="relative z-10 p-6 border-t border-white/10 bg-black/40">
            <a href="/" target="_blank" class="flex justify-center items-center gap-2 w-full bg-ukkom-tosca hover:bg-teal-300 text-black py-3 rounded-xl shadow-[0_0_20px_rgba(45,212,191,0.3)] transition text-sm font-bold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                Lihat Website
            </a>
            
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full text-left py-2 px-4 rounded-lg hover:bg-red-500/20 text-red-400 hover:text-red-300 text-sm font-bold transition flex items-center justify-center gap-2 border border-transparent hover:border-red-500/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Kunci Dapur (Logout)
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <div class="absolute top-1/2 left-1/2 w-[500px] h-[500px] bg-ukkom-navy/10 rounded-full mix-blend-screen filter blur-[100px] animate-pulse pointer-events-none"></div>

        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMSkiLz48L3N2Zz4=')] z-0 pointer-events-none opacity-50"></div>

        <header class="relative z-10 mt-6 mx-6 md:mx-10 h-16 bg-white/5 backdrop-blur-xl shadow-2xl border border-white/10 rounded-2xl flex items-center justify-between px-6">
            <div class="font-extrabold text-white md:hidden flex items-center gap-2">
                <svg class="w-6 h-6 text-ukkom-tosca" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13h-13L12 6.5z"/></svg>
                ADMIN
            </div>
            
            <div class="hidden md:flex items-center gap-3">
                <span class="bg-ukkom-tosca/10 text-ukkom-tosca text-xs font-bold px-3 py-1 rounded-full border border-ukkom-tosca/20 shadow-inner flex items-center gap-1.5">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-ukkom-tosca opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-ukkom-tosca"></span>
                    </span>
                    Sistem Online
                </span>
                <span class="text-sm text-gray-500 font-medium capitalize">{{ request()->segment(2) ?? 'Beranda' }}</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-bold text-white">Administrator UKKOM</div>
                    <div class="text-xs text-gray-500 font-medium mt-0.5">Fakultas Teknik UNTAD</div>
                </div>
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-ukkom-navy to-ukkom-purple border-2 border-white/20 shadow-lg flex items-center justify-center text-white font-bold text-lg relative">
                    A
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-ukkom-darknavy shadow-md"></div>
                </div>
            </div>
        </header>

        <div class="relative z-10 flex-1 overflow-y-auto p-6 md:p-10">
            @yield('content')
        </div>
    </main>

</body>
</html>