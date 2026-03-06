@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto flex flex-col md:flex-row gap-8">
    
    <div class="md:w-1/2 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-ukkom-navy mb-2">Layanan Pemerhati</h2>
        <p class="text-gray-500 mb-6 text-sm">Beritahu kami jika ada rekan mahasiswa Teknik yang sedang sakit atau berduka.</p>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Pelapor</label>
                <input type="text" id="nama_pelapor" placeholder="Nama Anda" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-ukkom-navy focus:border-ukkom-navy">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Pesan / Informasi Singkat</label>
                <textarea id="pesan_info" rows="4" placeholder="Misal: Info, teman kita [Nama] sedang dirawat di RS Madani kamar..." class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:ring-ukkom-navy focus:border-ukkom-navy"></textarea>
            </div>
            
            <div class="p-3 bg-blue-50 text-blue-800 text-xs rounded border border-blue-100">
                Langkah selanjutnya: Setelah mengisi form di atas, silakan klik salah satu tombol pengurus di sebelah kanan untuk mengirimkan pesan via WhatsApp.
            </div>
        </div>
    </div>

    <div class="md:w-1/2">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Pilih Pengurus yang Dihubungi:</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach($contacts as $contact)
            <button onclick="kirimWA('{{ $contact->phone_number }}', '{{ $contact->name }}')" class="flex items-center justify-between bg-green-500 hover:bg-green-600 text-white p-3 rounded-lg shadow transition">
                <div class="text-left">
                    <div class="font-bold text-sm">{{ $contact->position }}</div>
                    <div class="text-xs opacity-90">{{ $contact->name }}</div>
                </div>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/></svg>
            </button>
            @endforeach
        </div>
    </div>

</div>

<script>
    function kirimWA(nomorWA, namaPengurus) {
        // Ambil isi input
        let namaPelapor = document.getElementById('nama_pelapor').value;
        let pesanInfo = document.getElementById('pesan_info').value;

        // Validasi simpel: Cegah kirim kalau kosong
        if (namaPelapor === '' || pesanInfo === '') {
            alert('Mohon isi Nama Pelapor dan Pesan terlebih dahulu!');
            return;
        }

        // Format teks yang akan masuk ke WhatsApp
        let textWA = `Syalom ${namaPengurus}, saya ${namaPelapor}.\n\nIngin menginfokan:\n${pesanInfo}\n\nTerima kasih.`;

        // Ubah teks jadi format URL (spasi jadi %20, enter jadi %0A)
        let textEncoded = encodeURIComponent(textWA);

        // Buka tab baru ke link wa.me
        let linkWA = `https://wa.me/${nomorWA}?text=${textEncoded}`;
        window.open(linkWA, '_blank');
    }
</script>
@endsection