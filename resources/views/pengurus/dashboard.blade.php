@extends('layouts.app')

@section('content')
<div class="relative pt-32 pb-20 px-6 max-w-7xl mx-auto z-10">
    
    <div class="mb-12 border-b border-white/10 pb-6 flex flex-col md:flex-row justify-between items-end gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-ukkom-tosca/10 border border-ukkom-tosca/20 text-ukkom-tosca text-sm font-bold mb-4">
                <span class="flex h-2 w-2 rounded-full bg-ukkom-tosca animate-ping"></span>
                Divisi Doa & Diakonia
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white">Dashboard <span class="text-transparent bg-clip-text bg-gradient-to-r from-ukkom-tosca to-ukkom-purple">Pengurus</span></h1>
            <p class="text-gray-400 mt-2">Bulan: <strong class="text-white">{{ $today->translatedFormat('F Y') }}</strong></p>
        </div>
        
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="px-6 py-2 rounded-xl bg-red-500/10 hover:bg-red-500/20 text-red-400 font-bold border border-red-500/20 transition">Keluar</button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500 text-green-400 p-4 mb-8 rounded-xl flex items-center gap-3 font-bold">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500 text-red-400 p-4 mb-8 rounded-xl flex items-center gap-3 font-bold">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6 mb-8 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h2 class="text-xl font-bold text-white mb-2">📥 Import Database Anggota (Excel)</h2>
            <p class="text-sm text-gray-400">Pastikan baris pertama Excel (Header) adalah: <br><code class="text-ukkom-tosca font-mono">nama, gelar, no_hp, jurusan, alamat, status, tanggal_lahir</code></p>
        </div>
        <form action="/pengurus/import" method="POST" enctype="multipart/form-data" class="flex w-full md:w-auto items-center gap-3">
            @csrf
            <input type="file" name="file_excel[]" multiple accept=".xlsx, .xls, .csv" required class="block w-full md:w-64 text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-ukkom-purple/20 file:text-ukkom-purple hover:file:bg-ukkom-purple/30 transition cursor-pointer">
            <button type="submit" class="bg-ukkom-purple hover:bg-fuchsia-400 text-white font-bold py-2.5 px-6 rounded-full shadow-lg transition whitespace-nowrap">
                Mulai Import
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-8">
            
            <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-md border border-ukkom-tosca/30 rounded-3xl p-6 shadow-[0_0_30px_rgba(45,212,191,0.1)] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-ukkom-tosca/10 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none"></div>
                
                <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                    <span>🎂</span> Ulang Tahun Hari Ini
                </h2>

                @if($ultahHariIni->count() > 0)
                    <div class="space-y-3 mb-6">
                        @foreach($ultahHariIni as $m)
                        <div class="bg-black/30 p-3 rounded-xl border border-white/5">
                            <div class="font-bold text-ukkom-tosca">{{ $m->name }} {{ $m->title ? ', '.$m->title : '' }}</div>
                            <div class="text-xs text-gray-400 mt-1">{{ $m->major }} • {{ $m->status }} - Angkatan {{ $m->angkatan ?? '-' }}</div>
                            <div class="text-xs text-gray-300 font-mono mt-1">📞 {{ $m->phone ?? 'Tidak ada nomor' }}</div>
                        </div>
                        @endforeach
                    </div>

                    <button onclick="copyUltahHariIni()" class="w-full py-3 bg-ukkom-tosca hover:bg-teal-300 text-black font-bold rounded-xl shadow-lg transition flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                        Copy List Hari Ini
                    </button>
                    <p id="copy-status" class="text-center text-xs text-green-400 mt-2 hidden font-bold">List berhasil disalin! ✅</p>

                @else
                    <div class="bg-black/20 p-6 rounded-xl border border-white/5 text-center">
                        <p class="text-gray-400 text-sm">Tidak ada yang berulang tahun hari ini.</p>
                    </div>
                @endif
            </div>

            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6 shadow-xl">
                <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                    <span>🔜</span> Ulang Tahun Besok
                </h2>

                @if($ultahBesok->count() > 0)
                    <div class="space-y-3">
                        @foreach($ultahBesok as $m)
                        <div class="bg-black/20 p-3 rounded-xl border border-white/5">
                            <div class="font-bold text-white">{{ $m->name }}</div>
                            <div class="text-xs text-gray-400">{{ $m->major }} • Angkatan {{ $m->angkatan ?? '-' }}</div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center p-4">
                        <p class="text-gray-500 text-sm">Tidak ada yang berulang tahun besok.</p>
                    </div>
                @endif
            </div>

        </div>

        <div class="lg:col-span-2">
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-6 shadow-xl h-full flex flex-col">
                
                <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-white/10 pb-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        @if($isSearching)
                            <span>🔍</span> Hasil Pencarian: "{{ $search }}"
                        @else
                            <span>📅</span> Daftar Ulang Tahun Bulan {{ $today->translatedFormat('F') }}
                        @endif
                    </h2>
                    
                    <form action="/pengurus/dashboard" method="GET" class="w-full sm:w-auto relative flex items-center gap-2">
                        <div class="relative w-full sm:w-64">
                            <input type="text" name="search" value="{{ $search }}" placeholder="Cari di database..." class="w-full bg-black/30 border border-white/10 text-white text-sm rounded-full focus:ring-ukkom-tosca focus:border-ukkom-tosca block pl-10 pr-4 py-2 transition placeholder-gray-500">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                        @if($isSearching)
                            <a href="/pengurus/dashboard" class="text-gray-400 hover:text-red-400 transition" title="Hapus Pencarian">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto flex-grow">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <thead>
                            <tr class="bg-white/5 text-sm text-gray-400">
                                <th class="p-3 rounded-tl-lg w-32">Tanggal Lahir</th>
                                <th class="p-3">Nama Lengkap & Gelar</th>
                                <th class="p-3">Jurusan</th>
                                <th class="p-3 rounded-tr-lg">Nomor HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tableData as $m)
                                @php
                                    $hasBirthDate = !empty($m->birth_date);
                                    $isToday = false;
                                    
                                    if($hasBirthDate) {
                                        $birthDate = \Carbon\Carbon::parse($m->birth_date);
                                        $isToday = $birthDate->day == $today->day && $birthDate->month == $today->month;
                                    }
                                @endphp
                                <tr class="border-b border-white/5 {{ $isToday ? 'bg-ukkom-tosca/10 border-ukkom-tosca/30' : 'hover:bg-white/5' }} text-gray-300 transition text-sm">
                                    <td class="p-3 font-bold {{ $isToday ? 'text-ukkom-tosca' : 'text-white' }}">
                                        @if($hasBirthDate)
                                            @if($isSearching)
                                                {{ $birthDate->format('d M Y') }}
                                            @else
                                                {{ $birthDate->format('d M') }}
                                            @endif
                                            @if($isToday) <span class="text-[10px] bg-ukkom-tosca text-black px-1.5 py-0.5 rounded ml-1 mt-1 block w-max">HARI INI</span> @endif
                                        @else
                                            <span class="text-gray-500 font-normal italic text-xs">Belum diisi</span>
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        <div class="font-bold">{{ $m->name }} {{ $m->title ? ', '.$m->title : '' }}</div>
                                        <div class="text-xs text-gray-500">{{ $m->status }} - Angkatan {{ $m->angkatan ?? '-' }}</div>
                                    </td>
                                    <td class="p-3 text-gray-400">{{ $m->major }}</td>
                                    <td class="p-3 font-mono text-xs">{{ $m->phone ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-500">
                                        @if($isSearching)
                                            Data tidak ditemukan untuk pencarian <span class="text-white font-bold">"{{ $search }}"</span>.
                                        @else
                                            Belum ada data ulang tahun di bulan ini.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6">
                    {{ $tableData->links('components.pagination') }}
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function copyUltahHariIni() {
        // Menambahkan format hari dan tanggal di judul text
        let textToCopy = "🎉 *INFORMASI ULANG TAHUN HARI INI - {{ $today->translatedFormat('l, d F Y') }}* 🎉\n\n";
        
        @foreach($ultahHariIni as $index => $m)
            textToCopy += "{{ $index + 1 }}. *{{ $m->name }} {{ $m->title ? ', '.$m->title : '' }} *\n";
            textToCopy += "   Jurusan: {{ $m->major }} ({{ $m->status }} - Angkatan {{ $m->angkatan ?? '-' }})\n";
            textToCopy += "   No. HP: {{ $m->phone ?? '-' }}\n\n";
        @endforeach

        // Teks pembuka dan penutup (Syalom... dan Tuhan Yesus...) sudah dihapus sesuai permintaan

        navigator.clipboard.writeText(textToCopy).then(function() {
            let statusText = document.getElementById('copy-status');
            statusText.classList.remove('hidden');
            setTimeout(() => {
                statusText.classList.add('hidden');
            }, 3000); 
        }).catch(function(err) {
            console.error('Gagal menyalin teks: ', err);
            alert('Gagal menyalin teks. Silakan coba lagi.');
        });
    }
</script>
@endsection