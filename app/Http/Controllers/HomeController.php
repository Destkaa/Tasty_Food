<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak;

class HomeController extends Controller
{
    /**
     * Halaman Beranda (Home)
     * Menampilkan limit berita dan galeri terbaru
     */
    public function index()
    {
        // Mengambil 4 berita terbaru
        $beritas = Berita::latest()->take(4)->get();

        // Mengambil 6 foto galeri terbaru
        $galeris = Galeri::latest()->take(6)->get();

        return view('home', compact('beritas', 'galeris'));
    }

    /**
     * Halaman Daftar Berita (Public)
     */
    public function berita()
    {
        // Menggunakan paginate agar tidak berat jika berita sudah banyak
        $beritas = Berita::latest()->paginate(9);
        return view('berita', compact('beritas'));
    }

    /**
     * Halaman Detail Berita
     */
    public function showBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita_detail', compact('berita'));
    }

    /**
     * Halaman Galeri (Public)
     */
    public function galeri()
    {
        // Menampilkan semua galeri terbaru
        $galeris = Galeri::latest()->get();
        return view('galeri', compact('galeris'));
    }

    /**
     * Proses Kirim Pesan dari Halaman Kontak
     */
    public function kirimPesan(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subjek'  => 'required|string|max:255',
            'pesan'   => 'required|string',
        ], [
            // Custom pesan error jika diperlukan
            'required' => ':attribute tidak boleh kosong!',
            'email'    => 'Format email tidak valid!',
        ]);

        // 2. Simpan ke Database
        Kontak::create([
            'nama'    => $request->nama,
            'email'   => $request->email,
            'subjek'  => $request->subjek,
            'pesan'   => $request->pesan,
        ]);

        // 3. Redirect kembali dengan notifikasi sukses
        return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim ke admin.');
    }
}