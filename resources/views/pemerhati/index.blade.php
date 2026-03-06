@extends('layouts.app')

@section('content')
<div class="relative pt-32 pb-20 px-6 max-w-5xl mx-auto z-10 flex flex-col md:flex-row gap-8">
    
    <div class="md:w-1/2 bg-white/5 backdrop-blur-md p-8 rounded-3xl border border-white/10 shadow-xl h-fit">
        <h2 class="text-3xl font-extrabold text-white mb-2">Layanan <span class="text-ukkom-tosca">Pemerhati</span></h2>
        <p class="text-gray-400 mb-8 text-sm">Beritahu kami jika ada rekan mahasiswa Teknik yang sedang sakit atau berduka.</p>

        <div class="space-y-5">
            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Nama Pelapor</label>
                <input type="text" id="nama_pelapor" placeholder="Nama Anda" class="w-full bg-white/5 border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none placeholder-gray-500 transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-300 mb-2">Pesan / Informasi Singkat</label>
                <textarea id="pesan_info" rows="4" placeholder="Misal: Info, teman kita [Nama] sedang dirawat di RS..." class="w-full bg-white/5 border border-white/10 text-white rounded-xl py-3 px-4 focus:ring-2 focus:ring-ukkom-tosca focus:outline-none placeholder-gray-500 transition"></textarea>
            </div>
            
            <div class="p-4 bg-ukkom-tosca/10 text-ukkom-tosca text-sm rounded-xl border border-ukkom-tosca/20 font-medium">
                👉 Langkah selanjutnya: Silakan klik salah satu tombol pengurus di sebelah kanan untuk mengirimkan pesan via WhatsApp.
            </div>
        </div>
    </div>

    <div class="md:w-1/2">
        <h3 class="text-xl font-bold text-white mb-6">Pilih Pengurus Tujuan:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($contacts as $contact)
            <button onclick="kirimWA('{{ $contact->phone_number }}', '{{ $contact->name }}')" class="flex items-center justify-between bg-white/5 border border-white/10 hover:border-ukkom-tosca hover:bg-white/10 text-white p-4 rounded-2xl shadow-lg transition duration-300 group">
                <div class="text-left">
                    <div class="font-bold text-sm text-ukkom-tosca group-hover:text-teal-300 transition">{{ $contact->position }}</div>
                    <div class="text-xs text-gray-400 mt-1">{{ $contact->name }}</div>
                </div>
                <svg class="w-6 h-6 text-green-400 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/></svg>
            </button>
            @endforeach
        </div>
    </div>
</div>

<script>
    function kirimWA(nomorWA, namaPengurus) {
        let namaPelapor = document.getElementById('nama_pelapor').value;
        let pesanInfo = document.getElementById('pesan_info').value;
        if (namaPelapor === '' || pesanInfo === '') {
            alert('Mohon isi Nama Pelapor dan Pesan terlebih dahulu!');
            return;
        }
        let textWA = `Syalom ${namaPengurus}, saya ${namaPelapor}.\n\nIngin menginfokan:\n${pesanInfo}\n\nTerima kasih.`;
        window.open(`https://wa.me/${nomorWA}?text=${encodeURIComponent(textWA)}`, '_blank');
    }
</script>
@endsection