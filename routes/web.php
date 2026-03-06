<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemerhatiController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminActivityController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminArchiveController;
use App\Http\Controllers\AuthController;

// --- AREA PUBLIK (Bisa diakses siapa saja) ---
Route::get('/', [HomeController::class, 'index']);
Route::get('/profil', [ProfileController::class, 'index']);
Route::get('/arsip', [ArchiveController::class, 'index']);
Route::get('/pemerhati', [PemerhatiController::class, 'index']);

// --- AREA LOGIN & LOGOUT ---
// Jika user memaksa masuk admin tapi belum login, Laravel otomatis mencari route bernama 'login'
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- AREA ADMIN (GEMBOK TERPASANG: Hanya yang sudah login yang bisa masuk) ---
Route::middleware(['auth'])->group(function () {
    
    // 1. Pengaturan Beranda
    Route::get('/admin/settings', [AdminSettingController::class, 'edit']);
    Route::post('/admin/settings/update', [AdminSettingController::class, 'update']);

    // 2. Kelola Jadwal
    Route::get('/admin/activities', [AdminActivityController::class, 'index']);
    Route::get('/admin/activities/create', [AdminActivityController::class, 'create']);
    Route::post('/admin/activities/store', [AdminActivityController::class, 'store']);
    Route::delete('/admin/activities/{id}', [AdminActivityController::class, 'destroy']);

    // 3. Kelola Arsip Dokumentasi
    Route::get('/admin/archives', [AdminArchiveController::class, 'index']);
    Route::post('/admin/archives/store', [AdminArchiveController::class, 'store']);
    Route::delete('/admin/archives/{id}', [AdminArchiveController::class, 'destroy']);

    // 4. Kelola Kontak WA Pemerhati
    Route::get('/admin/contacts', [AdminContactController::class, 'index']);
    Route::post('/admin/contacts/store', [AdminContactController::class, 'store']);
    Route::delete('/admin/contacts/{id}', [AdminContactController::class, 'destroy']);

});