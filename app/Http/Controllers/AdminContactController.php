<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    // 1. Menampilkan daftar kontak
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    // 2. Menyimpan kontak baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'phone_number' => 'required|numeric', // Harus angka
        ]);

        Contact::create([
            'name' => $request->name,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
        ]);

        return back()->with('success', 'Kontak pengurus berhasil ditambahkan!');
    }

    // 3. Menghapus kontak
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return back()->with('success', 'Kontak berhasil dihapus!');
    }
}