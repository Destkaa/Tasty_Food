<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * DASHBOARD - Menampilkan Log Aktivitas Gabungan
     */
    public function index()
    {
        $adminName = Auth::user()->name;

        // 1. Riwayat Berita
        $historyBerita = Berita::latest('updated_at')->get()->map(function ($item) use ($adminName) {
            $isUpdated = $item->updated_at->gt($item->created_at);
            return [
                'tipe'  => 'Berita',
                'judul' => $isUpdated ? "{$adminName} mengupdate berita: {$item->judul}" : "Menambahkan berita: {$item->judul}",
                'waktu' => $item->updated_at,
            ];
        });

        // 2. Riwayat Galeri
        $historyGaleri = Galeri::latest('updated_at')->get()->map(function ($item) use ($adminName) {
            $isUpdated = $item->updated_at->gt($item->created_at);
            return [
                'tipe'  => 'Galeri',
                'judul' => $isUpdated ? "{$adminName} memperbarui foto galeri" : "Mengunggah foto baru ke galeri",
                'waktu' => $item->updated_at,
            ];
        });

        // 3. Riwayat Pesan Masuk
        $historyPesan = Kontak::latest()->get()->map(function ($item) {
            return [
                'tipe'  => 'Pesan',
                'judul' => "Menerima pesan baru dari: {$item->nama}",
                'waktu' => $item->created_at,
            ];
        });

        // Gabungkan dan urutkan
        $histories = $historyBerita->concat($historyGaleri)
            ->concat($historyPesan)
            ->sortByDesc('waktu')
            ->take(10);

        return view('admin.dashboard', compact('histories'));
    }

    /**
     * FITUR NUKLIR: Bersihkan Semua Konten
     */
    public function clearHistory()
    {
        // Hapus fisik file secara efisien
        $filesBerita = Berita::pluck('foto')->toArray();
        $filesGaleri = Galeri::pluck('foto')->toArray();
        $allFiles = array_merge($filesBerita, $filesGaleri);

        foreach ($allFiles as $file) {
            if ($file) Storage::disk('public')->delete($file);
        }

        // Kosongkan tabel
        Berita::truncate();
        Galeri::truncate();
        Kontak::truncate();

        return back()->with('success', 'Seluruh data dan riwayat telah dibersihkan!');
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN BERITA
    |--------------------------------------------------------------------------
    */
    public function indexBerita()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function createBerita()
    {
        return view('admin.berita.create');
    }

    public function storeBerita(Request $request)
    {
        $request->validate([
            'judul'  => 'required|max:255',
            'konten' => 'required',
            'foto'   => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = $request->file('foto')->store('berita', 'public');

        Berita::create([
            'judul'  => $request->judul,
            'konten' => $request->konten,
            'foto'   => $path
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function editBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function updateBerita(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $request->validate([
            'judul'  => 'required|max:255',
            'konten' => 'required',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($berita->foto) Storage::disk('public')->delete($berita->foto);
            $berita->foto = $request->file('foto')->store('berita', 'public');
        }

        $berita->update([
            'judul'  => $request->judul,
            'konten' => $request->konten,
            'foto'   => $berita->foto
        ]);

        return redirect()->route('admin.berita.index')->with('success', "Berita \"{$berita->judul}\" berhasil diperbarui!");
    }

    public function destroyBerita($id)
    {
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
    public function indexGaleri()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function storeGaleri(Request $request)
    {
        $request->validate(['foto' => 'required|image|max:2048']);
        $path = $request->file('foto')->store('galeri', 'public');
        
        Galeri::create(['foto' => $path]);
        return back()->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }

    public function updateGaleri(Request $request, $id)
    {
        $request->validate(['foto' => 'required|image|mimes:jpeg,png,jpg|max:2048']);
        $galeri = Galeri::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) Storage::disk('public')->delete($galeri->foto);
            $path = $request->file('foto')->store('galeri', 'public');
            $galeri->update(['foto' => $path]);
        }

        return back()->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroyGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->foto) Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN PESAN (INBOX)
    |--------------------------------------------------------------------------
    */
    public function indexPesan()
    {
        $pesans = Kontak::latest()->get();
        return view('admin.pesan.index', compact('pesans'));
    }

    public function destroyPesan($id)
    {
        Kontak::findOrFail($id)->delete();
        return back()->with('success', 'Pesan berhasil dihapus!');
    }
}