<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Activity;
use App\Models\Member; // REVISI: Wajib memanggil model Member
use Carbon\Carbon; 

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

        // REVISI: Ambil data ulang tahun HARI INI
        $today = Carbon::today();
        $ultahHariIni = Member::whereMonth('birth_date', $today->month)
                              ->whereDay('birth_date', $today->day)
                              ->get();

        // REVISI: Lempar variabel $ultahHariIni ke view
        return view('home', compact('settings', 'activities', 'ultahHariIni'));
    }
}