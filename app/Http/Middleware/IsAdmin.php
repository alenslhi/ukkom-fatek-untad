<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah dia sudah login dan apakah jabatannya BUKAN admin
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/'); // Tendang kembali ke beranda
        }

        // Jika dia admin sejati, persilakan lewat
        return $next($request);
    }
}