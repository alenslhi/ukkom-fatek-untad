<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function login()
    {
        return view('auth.login');
    }

    // Memproses data login (Cek Email & Password)
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Jika email & password cocok dengan di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Masuk ke dashboard admin
            return redirect()->intended('/admin/settings')->with('success', 'Selamat datang kembali, Pengurus!');
        }

        // Jika salah, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}