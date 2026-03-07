<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardMember; // Wajib memanggil model pengurus

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil semua data pengurus dari database
        $pengurus = BoardMember::all();
        
        // Kirim data pengurus ke halaman profil
        return view('profil.index', compact('pengurus'));
    }
}