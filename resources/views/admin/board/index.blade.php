@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Kelola Pengurus UKKOM</h1>
    <p class="text-gray-400 text-sm">Data ini akan tampil di bagian bawah halaman Profil publik.</p>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 p-4 mb-6 rounded-r-lg">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-col xl:flex-row gap-6">

    <div class="xl:w-1/3 bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-6 h-fit">
        <h2 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Tambah Pengurus</h2>

        <form action="/admin/board/store" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Nama Pengurus</label>
                <input type="text" name="name" required placeholder="Misal: Richard" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Jabatan</label>
                <input type="text" name="position" required placeholder="Misal: Ketua Umum" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Quote / Moto (Opsional)</label>
                <textarea name="quote" rows="2" placeholder="Misal: Melayani dengan sungguh..." class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Link IG (Opsional)</label>
                    <input type="url" name="ig_link" placeholder="https://instagram.com/..." class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Link TikTok (Opsional)</label>
                    <input type="url" name="tiktok_link" placeholder="https://tiktok.com/..." class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none transition placeholder-gray-600 text-sm">
                </div>
            </div>

            <div class="bg-white/5 p-4 border border-white/10 rounded-xl">
                <label class="block text-sm font-bold text-gray-300 mb-2">Foto Wajah (Maks 5MB)</label>
                <input type="file" name="image" accept="image/*" required class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-ukkom-tosca/20 file:text-ukkom-tosca hover:file:bg-ukkom-tosca/30 transition">
            </div>

            <button type="submit" class="w-full bg-ukkom-tosca hover:bg-teal-300 text-black font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(45,212,191,0.2)] transition">
                Simpan Pengurus
            </button>
        </form>
    </div>

    <div class="xl:w-2/3 flex-1 bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 p-6">
        <h2 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Daftar Pengurus Aktif</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 border-b border-white/10 text-sm">
                        <th class="p-4 font-semibold text-gray-400 rounded-tl-xl">Foto</th>
                        <th class="p-4 font-semibold text-gray-400">Nama & Jabatan</th>
                        <th class="p-4 font-semibold text-gray-400">Sosmed</th>
                        <th class="p-4 font-semibold text-gray-400 rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                    <tr class="border-b border-white/5 hover:bg-white/5 text-gray-300 transition text-sm">
                        <td class="p-4">
                            <img src="{{ asset('storage/' . $member->image) }}" class="w-14 h-14 object-cover rounded-full shadow-sm border border-white/10">
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-white text-base">{{ $member->name }}</div>
                            <div class="text-xs text-ukkom-tosca bg-ukkom-tosca/10 border border-ukkom-tosca/20 inline-block px-2 py-1 rounded-lg mt-1">{{ $member->position }}</div>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                @if($member->ig_link) <span class="bg-purple-500/20 text-purple-400 px-2 py-1 rounded text-xs">IG</span> @endif
                                @if($member->tiktok_link) <span class="bg-gray-500/20 text-gray-400 px-2 py-1 rounded text-xs">TikTok</span> @endif
                            </div>
                        </td>
                        <td class="p-4">
                            <form action="/admin/board/{{ $member->id }}" method="POST" onsubmit="return confirm('Yakin hapus pengurus ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-bold bg-red-500/10 border border-red-500/20 px-3 py-1.5 rounded-lg hover:bg-red-500/20 transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Belum ada data pengurus.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection