<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Activity;
use Carbon\Carbon; // Library waktu bawaan Laravel

class HomeController extends Controller
{
    public function index()
    {
        // Ambil pengaturan web (ambil baris pertama saja)
        $settings = SiteSetting::first();

        // Ambil kegiatan mulai hari ini sampai 30 hari ke depan, urutkan dari yang paling dekat
        $activities = Activity::whereBetween('event_date', [Carbon::now(), Carbon::now()->addDays(30)])
                              ->orderBy('event_date', 'asc')
                              ->get();

        return view('home', compact('settings', 'activities'));
    }
}