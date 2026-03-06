@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Kelola Kontak Layanan Pemerhati</h1>
    <p class="text-gray-400 text-sm">Nomor WhatsApp ini akan tampil sebagai tombol di halaman Layanan Pemerhati.</p>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 p-4 mb-6 rounded-r-lg">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-col md:flex-row gap-6">
    
    <div class="md:w-1/3 bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-6 h-fit">
        <h2 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Tambah Pengurus</h2>
        
        <form action="/admin/contacts/store" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Nama Lengkap / Panggilan</label>
                <input type="text" name="name" required placeholder="Misal: Budi" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Jabatan / Posisi</label>
                <input type="text" name="position" required placeholder="Misal: Koord. Kerohanian" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Nomor WhatsApp</label>
                <p class="text-xs text-gray-500 mb-2">Wajib diawali dengan 62 (Tanpa 0 atau +)</p>
                <input type="number" name="phone_number" required placeholder="6281234567890" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600">
            </div>

            <button type="submit" class="w-full bg-ukkom-tosca hover:bg-teal-300 text-black font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(45,212,191,0.2)] transition mt-2">
                Simpan Kontak
            </button>
        </form>
    </div>

    <div class="md:w-2/3 bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-6">
        <h2 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Daftar Kontak Aktif</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 border-b border-white/10 text-sm">
                        <th class="p-4 font-semibold text-gray-400 rounded-tl-xl">Nama</th>
                        <th class="p-4 font-semibold text-gray-400">Jabatan</th>
                        <th class="p-4 font-semibold text-gray-400">Nomor WA</th>
                        <th class="p-4 font-semibold text-gray-400 rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr class="border-b border-white/5 hover:bg-white/5 text-gray-300 transition text-sm">
                        <td class="p-4 font-bold text-white">{{ $contact->name }}</td>
                        <td class="p-4 text-gray-400">{{ $contact->position }}</td>
                        <td class="p-4 text-ukkom-tosca font-mono">{{ $contact->phone_number }}</td>
                        <td class="p-4">
                            <form action="/admin/contacts/{{ $contact->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kontak ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-bold bg-red-500/10 border border-red-500/20 px-3 py-1.5 rounded-lg hover:bg-red-500/20 transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Belum ada kontak pengurus.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection