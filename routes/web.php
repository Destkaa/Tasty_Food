<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/tentang', function () { return view('tentang'); })->name('tentang');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/kontak', function () { return view('kontak'); })->name('kontak');
Route::post('/kontak/kirim', [HomeController::class, 'kirimPesan'])->name('kontak.kirim');

/*
|--------------------------------------------------------------------------
| 2. RUTE TERPROTEKSI (Harus Login untuk Baca Detail)
|--------------------------------------------------------------------------
| Di sini kita simpan route detail berita agar jika diklik, 
| Laravel otomatis menyuruh login.
*/
/*
|--------------------------------------------------------------------------
| RUTE TERPROTEKSI (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/berita/{id}', [HomeController::class, 'showBerita'])->name('berita.show');
    Route::get('/tentang', function () { return view('tentang'); })->name('tentang'); // Pindahkan ke sini
    Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri'); // Pindahkan ke sini
});

/*
|--------------------------------------------------------------------------
| 3. AUTENTIKASI & REDIRECT SYSTEM
|--------------------------------------------------------------------------
*/
Auth::routes();

// Google Login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Filter role setelah login
Route::get('/redirect-filter', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }
    return redirect()->route('home');
})->middleware('auth');

// Mencegah error 404 dari redirect bawaan Laravel
Route::get('/home', function () {
    return redirect('/redirect-filter');
});

/*
|--------------------------------------------------------------------------
| 4. RUTE KHUSUS ADMIN (Prefix: /admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role_admin'])->prefix('admin')->group(function () {

    // --- Dashboard ---
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/hapus-riwayat', [AdminController::class, 'clearHistory'])->name('admin.hapus_riwayat');

    // --- Manajemen Berita ---
    Route::get('/berita', [AdminController::class, 'indexBerita'])->name('admin.berita.index');
    Route::get('/berita/tambah', [AdminController::class, 'createBerita'])->name('admin.berita.create');
    Route::post('/berita/simpan', [AdminController::class, 'storeBerita'])->name('admin.berita.store');
    Route::get('/berita/edit/{id}', [AdminController::class, 'editBerita'])->name('admin.berita.edit');
    Route::put('/berita/update/{id}', [AdminController::class, 'updateBerita'])->name('admin.berita.update');
    Route::delete('/berita/hapus/{id}', [AdminController::class, 'destroyBerita'])->name('admin.berita.destroy');

    // --- Manajemen Galeri ---
    Route::get('/galeri', [AdminController::class, 'indexGaleri'])->name('admin.galeri.index');
    Route::post('/galeri/simpan', [AdminController::class, 'storeGaleri'])->name('admin.galeri.store');
    Route::put('/galeri/update/{id}', [AdminController::class, 'updateGaleri'])->name('admin.galeri.update');
    Route::delete('/galeri/hapus/{id}', [AdminController::class, 'destroyGaleri'])->name('admin.galeri.destroy');

    // --- Manajemen Pesan Masuk ---
    Route::get('/pesan', [AdminController::class, 'indexPesan'])->name('admin.pesan.index');
    Route::delete('/pesan/hapus/{id}', [AdminController::class, 'destroyPesan'])->name('admin.pesan.destroy');

});