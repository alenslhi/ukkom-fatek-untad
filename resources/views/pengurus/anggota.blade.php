@extends('layouts.app')

@section('content')
<div class="relative pt-32 pb-20 px-6 max-w-7xl mx-auto z-10">
    
    <div class="mb-8 flex flex-col md:flex-row justify-between items-end gap-4 border-b border-white/10 pb-6">
        <div>
            <a href="/pengurus/dashboard" class="text-ukkom-tosca hover:text-white text-sm font-bold flex items-center gap-2 mb-4 transition">
                <span>←</span> Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-extrabold text-white">Master Data <span class="text-transparent bg-clip-text bg-gradient-to-r from-ukkom-tosca to-ukkom-purple">Anggota</span></h1>
            <p class="text-gray-400 mt-2">Kelola, edit, dan hapus data anggota UKKOM secara manual.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500 text-green-400 p-4 mb-8 rounded-xl flex items-center gap-3 font-bold">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-4 mb-6 flex justify-between items-center gap-4">
        <form action="/pengurus/anggota" method="GET" class="flex w-full md:w-1/2">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, jurusan, atau angkatan 2021..." class="w-full bg-black/40 border border-white/10 rounded-l-xl px-4 py-2.5 text-white focus:outline-none focus:border-ukkom-tosca">
            <button type="submit" class="bg-ukkom-tosca text-black px-6 font-bold rounded-r-xl hover:bg-teal-300 transition">Cari</button>
        </form>
        <div class="text-gray-400 text-sm font-bold hidden md:block">
            Total Data: <span class="text-ukkom-tosca">{{ $members->total() }}</span> Anggota
        </div>
    </div>

    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px]">
                <thead>
                    <tr class="bg-black/40 text-sm text-gray-400 border-b border-white/10">
                        <th class="p-4 font-semibold">Nama Lengkap & Gelar</th>
                        <th class="p-4 font-semibold">Jurusan & Angkatan</th>
                        <th class="p-4 font-semibold">Nomor HP</th>
                        <th class="p-4 font-semibold">Tanggal Lahir</th>
                        <th class="p-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $m)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition text-sm">
                        <td class="p-4">
                            <div class="font-bold text-white">{{ $m->name }}</div>
                            <div class="text-xs text-ukkom-tosca mt-0.5">{{ $m->title ?? 'Belum ada gelar' }}</div>
                        </td>
                        <td class="p-4">
                            <div class="text-gray-300">{{ $m->major }} <span class="text-gray-500">| Akt: {{ $m->angkatan ?? '?' }}</span></div>
                            <div class="text-[10px] uppercase tracking-wider mt-1 {{ $m->status == 'Alumni' ? 'text-ukkom-purple' : 'text-green-400' }} font-bold">
                                {{ $m->status }}
                            </div>
                        </td>
                        <td class="p-4 text-gray-400 font-mono">{{ $m->phone ?? '-' }}</td>
                        <td class="p-4 text-gray-400">{{ $m->birth_date ? \Carbon\Carbon::parse($m->birth_date)->translatedFormat('d M Y') : 'Belum diisi' }}</td>
                        <td class="p-4 flex justify-center gap-2">
                            <button onclick="openEditModal({{ $m }})" class="bg-blue-500/20 text-blue-400 hover:bg-blue-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                Edit
                            </button>
                            <form action="/pengurus/anggota/{{ $m->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $m->name }} dari sistem?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">Tidak ada data anggota ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-black/20 border-t border-white/10">
            {{ $members->links() }}
        </div>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 backdrop-blur-sm px-4">
    <div class="bg-ukkom-darknavy border border-white/10 rounded-3xl w-full max-w-2xl overflow-hidden shadow-2xl relative">
        <div class="bg-black/40 p-6 border-b border-white/10 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">✏️ Edit Data Anggota</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-white text-2xl leading-none">&times;</button>
        </div>
        
        <form id="editForm" method="POST" class="p-6">
            @csrf @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="edit_name" required class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-ukkom-tosca">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Gelar (S.T, dll)</label>
                    <input type="text" name="title" id="edit_title" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-ukkom-tosca">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Jurusan</label>
                    <input type="text" name="major" id="edit_major" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-ukkom-tosca">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Angkatan (Contoh: 2021)</label>
                    <input type="text" name="angkatan" id="edit_angkatan" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-ukkom-tosca">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Status</label>
                    <select name="status" id="edit_status" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-ukkom-tosca">
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Alumni">Alumni</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Nomor HP (Awali 62)</label>
                    <input type="text" name="phone" id="edit_phone" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-ukkom-tosca">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2">Tanggal Lahir</label>
                    <input type="date" name="birth_date" id="edit_birth_date" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-gray-300 focus:outline-none focus:border-ukkom-tosca [color-scheme:dark]">
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-400 mb-2">Alamat Lengkap</label>
                <textarea name="address" id="edit_address" rows="2" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-ukkom-tosca"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-white/10">
                <button type="button" onclick="closeEditModal()" class="px-6 py-2.5 rounded-xl text-gray-400 hover:bg-white/5 font-bold transition">Batal</button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-ukkom-tosca hover:bg-teal-300 text-black font-extrabold shadow-lg transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('editModal');
    
    function openEditModal(member) {
        document.getElementById('edit_name').value = member.name;
        document.getElementById('edit_title').value = member.title || '';
        document.getElementById('edit_major').value = member.major || '';
        document.getElementById('edit_angkatan').value = member.angkatan || '';
        document.getElementById('edit_status').value = member.status;
        document.getElementById('edit_phone').value = member.phone || '';
        document.getElementById('edit_birth_date').value = member.birth_date || '';
        document.getElementById('edit_address').value = member.address || '';
        
        document.getElementById('editForm').action = '/pengurus/anggota/' + member.id;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection