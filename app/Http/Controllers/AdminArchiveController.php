<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AdminArchiveController extends Controller
{
    public function index()
    {
        $archives = Archive::orderBy('event_date', 'desc')->get();
        return view('admin.archives.index', compact('archives'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'event_date' => 'required|date',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240'
        ]);

        $imagePaths = []; // Array penampung foto

        if ($request->hasFile('images')) {
            $destinationPath = storage_path('app/public/archives');
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);

            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::read($image)->scale(width: 1200)->save($destinationPath . '/' . $filename, 70);
                $imagePaths[] = 'archives/' . $filename; // Masukkan ke array
            }

            // Simpan sebagai 1 Data Album
            Archive::create([
                'title' => $request->title,
                'category' => $request->category,
                'event_date' => $request->event_date,
                'images' => $imagePaths, // Otomatis jadi JSON
            ]);

            return back()->with('success', 'Album dokumentasi berhasil diupload!');
        }

        return back()->with('error', 'Pilih minimal 1 foto.');
    }

    public function destroy($id)
    {
        $archive = Archive::findOrFail($id);
        
        // Hapus semua foto di dalam array
        if (is_array($archive->images)) {
            foreach ($archive->images as $path) {
                if (Storage::exists('public/' . $path)) Storage::delete('public/' . $path);
            }
        }
        $archive->delete();
        
        return back()->with('success', 'Album beserta seluruh fotonya berhasil dihapus!');
    }
}