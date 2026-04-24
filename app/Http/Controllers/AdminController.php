<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak; 
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Dashboard Admin - Menampilkan Log Aktivitas Gabungan
     */
    public function index()
    {
        $beritas = Berita::latest()->get();
        $galeris = Galeri::latest()->get();
        $pesans = Kontak::latest()->get();

        // Riwayat Berita
        $historyBerita = $beritas->map(function ($item) {
            return [
                'tipe'  => 'Berita',
                'judul' => 'Menambahkan berita: ' . $item->judul,
                'waktu' => $item->created_at,
            ];
        });

        // Riwayat Galeri
        $historyGaleri = $galeris->map(function ($item) {
            return [
                'tipe'  => 'Galeri',
                'judul' => 'Mengunggah foto baru ke galeri',
                'waktu' => $item->created_at,
            ];
        });

        // Riwayat Pesan Masuk
        $historyPesan = $pesans->map(function ($item) {
            return [
                'tipe'  => 'Pesan',
                'judul' => 'Menerima pesan baru dari: ' . $item->nama,
                'waktu' => $item->created_at,
            ];
        });

        // Menggabungkan semua riwayat, urutkan dari yang terbaru, ambil 10 saja
        $histories = $historyBerita->concat($historyGaleri)->concat($historyPesan)
                     ->sortByDesc('waktu')->take(10);

        return view('admin.dashboard', compact('histories'));
    }

    /**
     * Fitur Nuklir: Hapus SEMUA data konten dan riwayat
     */
    public function clearHistory()
    {
        // Hapus fisik file foto berita
        $allBerita = Berita::all();
        foreach ($allBerita as $b) {
            if ($b->foto) Storage::disk('public')->delete($b->foto);
        }

        // Hapus fisik file foto galeri
        $allGaleri = Galeri::all();
        foreach ($allGaleri as $g) {
            if ($g->foto) Storage::disk('public')->delete($g->foto);
        }

        // Kosongkan tabel database
        Berita::truncate();
        Galeri::truncate();
        Kontak::truncate(); 

        return back()->with('success', 'Semua riwayat, konten, dan pesan berhasil dibersihkan!');
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN PESAN (INBOX)
    |--------------------------------------------------------------------------
    */
    public function indexPesan() {
        $pesans = Kontak::latest()->get();
        return view('admin.pesan.index', compact('pesans'));
    }

    public function destroyPesan($id) {
        $pesan = Kontak::findOrFail($id);
        $pesan->delete();
        return back()->with('success', 'Pesan berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN BERITA
    |--------------------------------------------------------------------------
    */
    public function indexBerita() {
        $beritas = Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function createBerita() {
        return view('admin.berita.create');
    }

    public function storeBerita(Request $request) {
        $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $path = $request->file('foto')->store('berita', 'public');
        Berita::create(['judul' => $request->judul, 'konten' => $request->konten, 'foto' => $path]);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function editBerita($id) {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function updateBerita(Request $request, $id) {
        $berita = Berita::findOrFail($id);
        $request->validate(['judul' => 'required', 'konten' => 'required', 'foto' => 'image|max:2048']);
        if ($request->hasFile('foto')) {
            if ($berita->foto) Storage::disk('public')->delete($berita->foto);
            $berita->foto = $request->file('foto')->store('berita', 'public');
        }
        $berita->update(['judul' => $request->judul, 'konten' => $request->konten]);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroyBerita($id) {
        $berita = Berita::findOrFail($id);
        if ($berita->foto) Storage::disk('public')->delete($berita->foto);
        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN GALERI
    |--------------------------------------------------------------------------
    */
    public function indexGaleri() {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function storeGaleri(Request $request) {
        $request->validate(['foto' => 'required|image|max:2048']);
        $path = $request->file('foto')->store('galeri', 'public');
        Galeri::create(['foto' => $path]);
        return back()->with('success', 'Foto berhasil ditambah!');
    }

    public function updateGaleri(Request $request, $id) {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $galeri = Galeri::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $path = $request->file('foto')->store('galeri', 'public');
            $galeri->update(['foto' => $path]);
        }

        return back()->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroyGaleri($id) {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->foto) Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
    }
}