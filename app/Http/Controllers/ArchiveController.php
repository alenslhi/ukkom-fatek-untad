<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Archive; // Kita akan buat modelnya nanti

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Archive::orderBy('event_date', 'desc');

        // Jika ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        $archives = $query->get()->groupBy('category');
        return view('arsip.index', compact('archives'));
    }

    // Fungsi untuk memproses upload
    public function store(Request $request)
    {
        // 1. Validasi: Pastikan yang diupload itu gambar dan ukurannya maksimal 10MB
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'event_date' => 'required|date'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // 2. Buat nama file unik (Format: WaktuUpload_NamaAsli.jpg)
            $filename = time() . '_' . $image->getClientOriginalName();
            
            // 3. Tentukan lokasi simpan di folder storage/app/public/archives
            $destinationPath = storage_path('app/public/archives');

            // Cek kalau foldernya belum ada, otomatis buatkan
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // 4. PROSES KOMPRESI (Sihir terjadi di sini)
            // Membaca gambar -> mengubah ukuran max lebar 1200px (tinggi menyesuaikan) -> simpan dengan kualitas 70%
            Image::read($image)
                ->scale(width: 1200)
                ->save($destinationPath . '/' . $filename, 70);

            // 5. Simpan data teks ke Database
            Archive::create([
                'title' => $request->title,
                'category' => $request->category, // Input manual sesuai permintaanmu
                'image_path' => 'archives/' . $filename,
                'event_date' => $request->event_date,
            ]);

            // 6. Kembalikan admin ke halaman sebelumnya dengan pesan sukses
            return back()->with('success', 'Foto dokumentasi berhasil diupload dan dikompres!');
        }

        return back()->with('error', 'Gagal mengupload gambar.');
    }

    // Menampilkan halaman admin upload berserta daftar arsip
    public function create()
    {
        // Ambil semua foto arsip, urutkan dari yang terbaru
        $archives = \App\Models\Archive::orderBy('created_at', 'desc')->get();
        return view('admin.archives.create', compact('archives'));
    }

    // Menghapus arsip (foto)
    public function destroy($id)
    {
        $archive = \App\Models\Archive::findOrFail($id);
        
        // Hapus file fisik fotonya dari folder storage
        if (\Illuminate\Support\Facades\Storage::exists('public/' . $archive->image_path)) {
            \Illuminate\Support\Facades\Storage::delete('public/' . $archive->image_path);
        }
        
        $archive->delete();
        
        return back()->with('success', 'Foto dokumentasi berhasil dihapus permanen!');
    }

}