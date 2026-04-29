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
        #mobile-menu { display: none; }
        #mobile-menu.open { display: flex; }
    </style>
</head>
<body class="bg-white">

    <!-- ===== NAVBAR ===== -->
    <nav class="flex justify-between items-center px-6 md:px-20 py-6 md:py-8 absolute w-full z-50 text-white">
        <div class="text-xl md:text-2xl font-black uppercase tracking-widest">Tasty Food</div>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex gap-10 text-sm font-bold uppercase">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->is('tentang') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Tentang</a></li>
            <li><a href="{{ route('berita') }}" class="{{ request()->is('berita*') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Berita</a></li>
            <li><a href="{{ route('galeri') }}" class="{{ request()->is('galeri') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" class="{{ request()->is('kontak') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Kontak</a></li>
        </ul>

        <!-- Hamburger (Mobile) -->
        <button onclick="toggleMenu()" class="md:hidden flex flex-col gap-1.5 z-50" aria-label="Menu">
            <span class="w-6 h-0.5 bg-white block"></span>
            <span class="w-6 h-0.5 bg-white block"></span>
            <span class="w-6 h-0.5 bg-white block"></span>
        </button>
    </nav>

    <!-- Mobile Fullscreen Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-zinc-900 z-40 flex-col items-center justify-center gap-8 text-center">
        <button onclick="toggleMenu()" class="absolute top-6 right-6 text-white text-3xl font-light">&times;</button>
        <ul class="flex flex-col gap-6 text-lg font-black uppercase text-white">
            <li><a href="{{ route('home') }}" onclick="toggleMenu()">Home</a></li>
            <li><a href="{{ route('tentang') }}" onclick="toggleMenu()">Tentang</a></li>
            <li><a href="{{ route('berita') }}" onclick="toggleMenu()">Berita</a></li>
            <li><a href="{{ route('galeri') }}" onclick="toggleMenu()">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" onclick="toggleMenu()">Kontak</a></li>
        </ul>
    </div>

    <!-- ===== HERO HEADER ===== -->
    <header class="relative h-[45vh] md:h-[60vh] bg-cover bg-center flex items-center px-6 md:px-20"
            style="background-image: url('https://images.unsplash.com/photo-1543353071-873f17a7a088?q=80&w=1500');">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative fade-in">
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-black text-white uppercase tracking-tighter">Berita Kami</h1>
            <div class="w-16 md:w-24 h-1.5 md:h-2 bg-yellow-500 mt-4"></div>
        </div>
    </header>

    <!-- ===== BERITA GRID ===== -->
    <section class="px-6 md:px-20 py-16 md:py-24 bg-white">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
            @forelse($beritas as $item)
            <div class="group bg-white rounded-[1.5rem] md:rounded-[2.5rem] overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.06)] hover:shadow-[0_30px_60px_rgba(0,0,0,0.1)] transition-all duration-500 fade-in">
                <div class="relative h-56 md:h-72 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->foto) }}"
                         alt="{{ $item->judul }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute top-4 left-4 md:top-6 md:left-6 bg-white/90 backdrop-blur-sm px-3 py-1.5 md:px-4 md:py-2 rounded-xl md:rounded-2xl shadow-sm">
                        <p class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-zinc-800">
                            {{ $item->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <div class="p-6 md:p-10">
                    <h3 class="text-base md:text-xl font-black text-zinc-800 uppercase leading-tight mb-4 md:mb-6 group-hover:text-yellow-600 transition-colors">
                        {{ Str::limit($item->judul, 55) }}
                    </h3>
                    <p class="text-zinc-400 text-xs md:text-sm font-bold italic leading-loose mb-6 md:mb-8">
                        {{ Str::limit(strip_tags($item->konten), 120) }}
                    </p>
                    <a href="{{ route('berita.show', $item->id) }}"
                       class="inline-block text-[10px] md:text-xs font-black uppercase tracking-[0.2em] text-zinc-800 border-b-2 border-zinc-800 pb-1 hover:text-yellow-600 hover:border-yellow-600 transition-all">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-24 md:py-40">
                <h3 class="text-base md:text-xl font-black text-zinc-400 uppercase tracking-widest">Belum ada berita terbaru</h3>
            </div>
            @endforelse
        </div>

        <div class="mt-16 md:mt-24 flex justify-center">
            {{ $beritas->links() }}
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-zinc-900 text-white px-6 md:px-20 pt-16 md:pt-28 pb-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 md:gap-20 mb-16 md:mb-24">

            <!-- Brand -->
            <div class="col-span-2 md:col-span-1">
                <h3 class="text-xl md:text-2xl font-black uppercase mb-6 tracking-widest">Tasty Food</h3>
                <p class="text-zinc-200 text-sm leading-loose italic font-bold">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="flex gap-4 mt-8">
                    <div class="bg-zinc-800 w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-4 h-4 invert" alt="FB">
                    </div>
                    <div class="bg-zinc-800 w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="w-4 h-4 invert" alt="TW">
                    </div>
                </div>
            </div>

            <!-- Useful Links -->
            <div>
                <h4 class="font-black text-base md:text-lg mb-6 italic tracking-wider">Useful Links</h4>
                <ul class="text-zinc-200 text-sm space-y-3 italic font-bold">
                    <li><a href="{{ route('home') }}" class="hover:text-yellow-500 transition-colors">Blog</a></li>
                    <li><a href="#" class="hover:text-yellow-500 transition-colors">Hewan</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-yellow-500 transition-colors">Galeri</a></li>
                    <li><a href="#" class="hover:text-yellow-500 transition-colors">Testimonial</a></li>
                </ul>
            </div>

            <!-- Privacy -->
            <div>
                <h4 class="font-black text-base md:text-lg mb-6 italic tracking-wider">Privacy</h4>
                <ul class="text-zinc-200 text-sm space-y-3 italic font-bold">
                    <li><a href="#" class="hover:text-yellow-500 transition-colors">Karir</a></li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-yellow-500 transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-yellow-500 transition-colors">Kontak Kami</a></li>
                    <li><a href="#" class="hover:text-yellow-500 transition-colors">Servis</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-span-2 md:col-span-1">
                <h4 class="font-black text-base md:text-lg mb-6 italic tracking-wider">Contact Info</h4>
                <ul class="text-zinc-200 text-sm space-y-4 italic font-bold">
                    <li>✉ tastyfood@gmail.com</li>
                    <li>📞 +62 812 3456 7890</li>
                    <li>📍 Kota Bandung, Jawa Barat</li>
                </ul>
            </div>

        </div>
        <div class="border-t border-zinc-800 pt-8 text-center text-zinc-500 text-[10px] md:text-[11px] uppercase tracking-[0.3em] md:tracking-[0.4em] font-black">
            Copyright ©2026 All rights reserved
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        }
    </script>

</body>
</html>