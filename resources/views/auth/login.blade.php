<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - UKKOM FATEK</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-ukkom-darknavy text-gray-300 font-sans antialiased flex items-center justify-center min-h-screen relative overflow-hidden selection:bg-ukkom-tosca selection:text-ukkom-darknavy">

    <div class="absolute top-0 left-0 w-96 h-96 bg-ukkom-purple/20 rounded-full mix-blend-screen filter blur-[100px] animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-ukkom-tosca/20 rounded-full mix-blend-screen filter blur-[100px] animate-pulse" style="animation-delay: 2s;"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]"></div>

    <div class="relative z-10 max-w-md w-full px-6">
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl overflow-hidden">
            
            <div class="p-8 text-center border-b border-white/10">
                <h1 class="text-3xl font-extrabold text-white tracking-widest flex items-center justify-center gap-2">
                    <svg class="w-8 h-8 text-ukkom-tosca" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13h-13L12 6.5z"/></svg>
                    UKKOM
                </h1>
                <p class="text-gray-400 mt-2 text-sm">Dashboard Administrator</p>
            </div>

            <div class="p-8">
                @error('email')
                    <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-sm p-4 rounded-xl mb-6 flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                <form action="/login" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-2">Email Pengurus</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none placeholder-gray-500 transition shadow-inner">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none placeholder-gray-500 transition shadow-inner">
                    </div>

                    <button type="submit" class="w-full bg-ukkom-tosca hover:bg-teal-300 text-black font-bold py-3 px-4 rounded-xl shadow-[0_0_20px_rgba(45,212,191,0.2)] hover:shadow-[0_0_30px_rgba(45,212,191,0.4)] transition duration-300">
                        Masuk Sebagai Admin
                    </button>
                </form>
            </div>
            
            <div class="p-6 text-center border-t border-white/10 bg-black/20">
                <a href="/" class="text-sm text-gray-400 hover:text-ukkom-tosca transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Beranda
                </a>
            </div>
            
        </div>
    </div>

</body>
</html>