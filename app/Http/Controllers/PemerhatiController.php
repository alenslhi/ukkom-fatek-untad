<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class PemerhatiController extends Controller
{
    public function index()
    {
        // Mengambil semua data kontak pengurus dari database
        $contacts = Contact::all();

        return view('pemerhati.index', compact('contacts'));
    }
}