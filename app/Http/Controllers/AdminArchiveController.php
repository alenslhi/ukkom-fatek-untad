<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AdminArchiveController extends Controller
{
    // Menampilkan halaman utama Kelola Arsip (Form + Tabel sekaligus)
    public function index()
    {
        $archives = Archive::orderBy('created_at', 'desc')->get();
        return view('admin.archives.index', compact('archives'));
    }

    // Memproses upload dan kompresi
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'event_date' => 'required|date'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $destinationPath = storage_path('app/public/archives');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            Image::read($image)
                ->scale(width: 1200)
                ->save($destinationPath . '/' . $filename, 70);

            Archive::create([
                'title' => $request->title,
                'category' => $request->category,
                'image_path' => 'archives/' . $filename,
                'event_date' => $request->event_date,
            ]);

            return back()->with('success', 'Foto dokumentasi berhasil diupload!');
        }

        return back()->with('error', 'Gagal mengupload gambar.');
    }

    // Menghapus foto
    public function destroy($id)
    {
        $archive = Archive::findOrFail($id);
        if (Storage::exists('public/' . $archive->image_path)) {
            Storage::delete('public/' . $archive->image_path);
        }
        $archive->delete();
        
        return back()->with('success', 'Foto dokumentasi berhasil dihapus permanen!');
    }
}