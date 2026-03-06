<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;

class AdminSettingController extends Controller
{
    // Menampilkan form edit
    public function edit()
    {
        // Ambil data pertama, kalau kosong buat objek baru (fallback)
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.settings.edit', compact('settings'));
    }

    // Menyimpan perubahan
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string',
            'quote_text' => 'required|string',
            'quote_author' => 'required|string|max:100',
        ]);

        // Ambil data pertama
        $settings = SiteSetting::first();

        // Kalau datanya belum ada di database, kita buat baru
        if (!$settings) {
            $settings = new SiteSetting();
        }

        // Timpa data lama dengan data baru dari form
        $settings->hero_title = $request->hero_title;
        $settings->hero_subtitle = $request->hero_subtitle;
        $settings->quote_text = $request->quote_text;
        $settings->quote_author = $request->quote_author;
        
        // Nanti kamu bisa tambah input untuk alamat/medsos di sini

        $settings->save();

        return back()->with('success', 'Pengaturan Website Berhasil Diperbarui!');
    }
}