<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Untuk saat ini, kita langsung kembalikan tampilan halamannya
        return view('profil.index');
    }
}