<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image; // Kita pakai lagi fitur kompresinya!

class AdminActivityController extends Controller
{
    // 1. Menampilkan daftar jadwal
    public function index()
    {
        $activities = Activity::orderBy('event_date', 'desc')->get();
        return view('admin.activities.index', compact('activities'));
    }

    // 2. Menampilkan form tambah jadwal
    public function create()
    {
        return view('admin.activities.create');
    }

    // 3. Menyimpan data jadwal ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'event_date' => 'required|date',
            'location' => 'required',
            'description' => 'nullable',
            'pamphlet' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Opsional, maks 5MB
        ]);

        $filename = null;

        // Jika ada upload gambar pamflet, kita kompres!
        if ($request->hasFile('pamphlet')) {
            $image = $request->file('pamphlet');
            $filename = time() . '_' . $image->getClientOriginalName();
            $destinationPath = storage_path('app/public/activities');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            Image::read($image)
                ->scale(width: 800) // Pamflet tidak perlu terlalu besar, 800px cukup
                ->save($destinationPath . '/' . $filename, 80);
        }

        // Simpan ke database
        Activity::create([
            'title' => $request->title,
            'category' => $request->category,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'description' => $request->description,
            'pamphlet' => $filename, // Bisa kosong kalau tidak ada gambar
        ]);

        return redirect('/admin/activities')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // 4. Menghapus jadwal
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        
        // Hapus juga file gambar pamfletnya dari server kalau ada
        if ($activity->pamphlet) {
            Storage::delete('public/activities/' . $activity->pamphlet);
        }
        
        $activity->delete();
        return back()->with('success', 'Kegiatan berhasil dihapus!');
    }
}