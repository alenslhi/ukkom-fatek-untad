<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardMember;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AdminBoardMemberController extends Controller
{
    public function index() {
        $members = BoardMember::all();
        return view('admin.board.index', compact('members'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required', 'position' => 'required', 'image' => 'required|image|max:5120'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_pengurus_' . $image->getClientOriginalName();
            $destinationPath = storage_path('app/public/pengurus');
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);
            
            // Kompres foto pengurus jadi ukuran persegi (crop)
            Image::read($image)->cover(500, 500)->save($destinationPath . '/' . $filename, 80);
            $imagePath = 'pengurus/' . $filename;
        }

        BoardMember::create([
            'name' => $request->name, 'position' => $request->position, 
            'quote' => $request->quote, 'image' => $imagePath,
            'ig_link' => $request->ig_link, 'tiktok_link' => $request->tiktok_link
        ]);

        return back()->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function destroy($id) {
        $member = BoardMember::findOrFail($id);
        if ($member->image && Storage::exists('public/' . $member->image)) {
            Storage::delete('public/' . $member->image);
        }
        $member->delete();
        return back()->with('success', 'Pengurus berhasil dihapus!');
    }
}