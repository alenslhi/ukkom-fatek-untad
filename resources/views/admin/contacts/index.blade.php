@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Kontak Layanan Pemerhati</h1>
    <p class="text-gray-500 text-sm">Nomor WhatsApp ini akan tampil sebagai tombol di halaman Layanan Pemerhati.</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-col md:flex-row gap-6">
    
    <div class="md:w-1/3 bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-fit">
        <h2 class="text-lg font-bold text-ukkom-navy mb-4 border-b pb-2">Tambah Pengurus</h2>
        
        <form action="/admin/contacts/store" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap / Panggilan</label>
                <input type="text" name="name" required placeholder="Misal: Budi" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Jabatan / Posisi</label>
                <input type="text" name="position" required placeholder="Misal: Koord. Kerohanian" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nomor WhatsApp</label>
                <p class="text-xs text-gray-400 mb-1">Wajib diawali dengan 62 (Tanpa 0 atau +)</p>
                <input type="number" name="phone_number" required placeholder="6281234567890" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-ukkom-navy">
            </div>

            <button type="submit" class="w-full bg-ukkom-orange hover:bg-orange-600 text-white font-bold py-2 px-4 rounded transition">
                Simpan Kontak
            </button>
        </form>
    </div>

    <div class="md:w-2/3 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Daftar Kontak Aktif</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                        <th class="p-3 font-semibold text-gray-600">Nama</th>
                        <th class="p-3 font-semibold text-gray-600">Jabatan</th>
                        <th class="p-3 font-semibold text-gray-600">Nomor WA</th>
                        <th class="p-3 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 text-sm">
                        <td class="p-3 font-bold text-ukkom-navy">{{ $contact->name }}</td>
                        <td class="p-3 text-gray-600">{{ $contact->position }}</td>
                        <td class="p-3 text-gray-600">{{ $contact->phone_number }}</td>
                        <td class="p-3">
                            <form action="/admin/contacts/{{ $contact->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kontak ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">Belum ada kontak pengurus.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection