<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - UKKOM FATEK</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full px-6">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-ukkom-navy p-8 text-center">
                <h1 class="text-3xl font-extrabold text-white tracking-widest">LOGIN ADMIN</h1>
                <p class="text-blue-200 mt-2 text-sm">Dashboard Administrator</p>
            </div>

            <div class="p-8">
                @error('email')
                    <div class="bg-red-50 text-red-600 text-sm p-3 rounded mb-6 border border-red-100">
                        ⚠️ {{ $message }}
                    </div>
                @enderror

                <form action="/login" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Admin</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-ukkom-navy focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-ukkom-navy focus:outline-none">
                    </div>

                    <button type="submit" class="w-full bg-ukkom-orange hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300">
                        Masuk
                    </button>
                </form>
            </div>
            
            <div class="bg-gray-50 p-4 text-center border-t border-gray-100">
                <a href="/" class="text-sm text-gray-500 hover:text-ukkom-navy transition">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

</body>
</html>