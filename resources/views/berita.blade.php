<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terkini - Tasty Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .fade-in { animation: fadeIn 0.8s ease-out forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-white">

    <nav class="flex justify-between items-center px-20 py-8 absolute w-full z-50 text-white">
        <div class="text-2xl font-black uppercase tracking-widest">Tasty Food</div>
        <ul class="flex gap-10 text-sm font-bold uppercase">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->is('tentang') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Tentang</a></li>
            <li><a href="{{ route('berita') }}" class="{{ request()->is('berita*') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Berita</a></li>
            <li><a href="{{ route('galeri') }}" class="{{ request()->is('galeri') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" class="{{ request()->is('kontak') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Kontak</a></li>
        </ul>
    </nav>

    <header class="relative h-[60vh] bg-cover bg-center flex items-center px-20" 
            style="background-image: url('https://images.unsplash.com/photo-1543353071-873f17a7a088?q=80&w=1500');">
        <div class="absolute inset-0 bg-black/50"></div>
        
        <div class="relative fade-in">
            <h1 class="text-7xl font-black text-white uppercase tracking-tighter">Berita Kami</h1>
            <div class="w-24 h-2 bg-yellow-500 mt-4"></div>
        </div>
    </header>

    <section class="px-20 py-24 bg-white">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse($beritas as $item)
            <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_60px_rgba(0,0,0,0.1)] transition-all duration-500 fade-in">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->foto) }}" 
                         alt="{{ $item->judul }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-2xl shadow-sm">
                        <p class="text-[10px] font-black uppercase tracking-widest text-zinc-800">
                            {{ $item->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <div class="p-10">
                    <h3 class="text-xl font-black text-zinc-800 uppercase leading-tight mb-6 group-hover:text-yellow-600 transition-colors">
                        {{ Str::limit($item->judul, 55) }}
                    </h3>
                    <p class="text-zinc-400 text-sm font-bold italic leading-loose mb-8">
                        {{ Str::limit(strip_tags($item->konten), 120) }}
                    </p>
                    <a href="{{ route('berita.show', $item->id) }}" 
                       class="inline-block text-xs font-black uppercase tracking-[0.2em] text-zinc-800 border-b-2 border-zinc-800 pb-1 hover:text-yellow-600 hover:border-yellow-600 transition-all">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-40">
                <h3 class="text-xl font-black text-zinc-400 uppercase tracking-widest">Belum ada berita terbaru</h3>
            </div>
            @endforelse
        </div>

        <div class="mt-24 flex justify-center">
            {{ $beritas->links() }}
        </div>
    </section>

    <footer class="bg-zinc-900 text-white px-20 pt-28 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-20 mb-24">
            <div>
                <h3 class="text-2xl font-black uppercase mb-8 tracking-widest text-white">Tasty Food</h3>
                <p class="text-zinc-400 text-sm leading-loose italic font-bold">Inspirasi kuliner terbaik untuk hari-hari Anda yang lebih lezat.</p>
            </div>
            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider text-yellow-500">Quick Links</h4>
                <ul class="text-zinc-400 text-sm space-y-4 italic font-bold">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('galeri') }}">Galeri Foto</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider text-yellow-500">Support</h4>
                <ul class="text-zinc-400 text-sm space-y-4 italic font-bold">
                    <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}">Hubungi Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider text-yellow-500">Social</h4>
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-yellow-600 transition-all cursor-pointer font-bold">IG</div>
                    <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-yellow-600 transition-all cursor-pointer font-bold">FB</div>
                </div>
            </div>
        </div>
        <div class="border-t border-zinc-800 pt-10 text-center text-zinc-500 text-[10px] uppercase tracking-[0.4em] font-black">
            Copyright ©2026 Tasty Food • All Rights Reserved
        </div>
    </footer>

</body>
</html>