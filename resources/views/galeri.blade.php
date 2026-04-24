<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - Tasty Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .fade-in { animation: fadeIn 1s ease-out forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom Swiper Button Style */
        .swiper-button-next, .swiper-button-prev {
            background: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: black !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 18px !important;
            font-weight: bold;
        }
        .swiper-pagination-bullet-active {
            background: #eab308 !important; /* Yellow 500 */
        }
    </style>
</head>
<body class="bg-white">

    <nav class="flex justify-between items-center px-20 py-8 absolute w-full z-50 text-white">
        <div class="text-2xl font-bold uppercase tracking-widest text-white">Tasty Food</div>
        <ul class="flex gap-10 text-sm font-semibold uppercase">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->is('tentang') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Tentang</a></li>
            <li><a href="{{ route('berita') }}" class="{{ request()->is('berita*') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Berita</a></li>
            <li><a href="{{ route('galeri') }}" class="{{ request()->is('galeri') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" class="{{ request()->is('kontak') ? 'text-yellow-400' : 'hover:text-yellow-400' }} transition-all">Kontak</a></li>
        </ul>
    </nav>

    <header class="relative h-[60vh] bg-cover bg-center flex items-center px-20" 
            style="background-image: url('https://images.unsplash.com/photo-1490818387583-1baba5e638af?q=80&w=1500');">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative fade-in">
            <h1 class="text-7xl font-bold text-white uppercase tracking-tighter">Galeri Kami</h1>
            <div class="w-24 h-2 bg-yellow-500 mt-4"></div>
        </div>
    </header>

    <section class="px-20 -mt-32 relative z-10 fade-in" style="animation-delay: 0.3s;">
        <div class="swiper mySwiper relative rounded-[3rem] shadow-2xl border-[12px] border-white bg-gray-200 overflow-hidden">
            <div class="swiper-wrapper">
                @forelse($galeris as $g)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $g->foto) }}" 
                         class="w-full h-[550px] object-cover">
                </div>
                @empty
                <div class="swiper-slide h-[550px] flex items-center justify-center text-gray-500 italic">
                    Belum ada foto koleksi.
                </div>
                @endforelse
            </div>
            
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="px-20 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($galeris as $index => $g)
            <div class="group relative overflow-hidden rounded-3xl shadow-lg h-72 fade-in" 
                 style="animation-delay: {{ 0.1 * ($index % 4) }}s;">
                
                <img src="{{ asset('storage/' . $g->foto) }}" 
                     class="w-full h-full object-cover transform group-hover:scale-125 transition-all duration-700">
                
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="text-white font-bold tracking-widest uppercase text-xs border-2 border-white px-4 py-2">
                        Zoom Photo
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <footer class="bg-zinc-900 text-white px-20 pt-28 pb-10">
        <div class="grid grid-cols-4 gap-20 mb-24">
            <div>
                <h3 class="text-2xl font-black uppercase mb-8 tracking-widest">Tasty Food</h3>
                <p class="text-zinc-200 text-sm leading-loose italic font-bold">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="flex gap-4 mt-10">
                    <div class="bg-zinc-800 w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-4 h-4 invert" alt="FB">
                    </div>
                    <div class="bg-zinc-800 w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="w-4 h-4 invert" alt="TW">
                    </div>
                </div>
            </div>

            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider">Useful Links</h4>
                <ul class="text-zinc-200 text-sm space-y-4 italic font-bold">
                    <li><a href="{{ route('home') }}" class="hover:text-yellow-500">Blog</a></li>
                    <li><a href="#">Hewan</a></li>
                    <li><a href="{{ route('galeri') }}">Galeri</a></li>
                    <li><a href="#">Testimonial</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider">Privacy</h4>
                <ul class="text-zinc-200 text-sm space-y-4 italic font-bold">
                    <li><a href="#">Karir</a></li>
                    <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
                    <li><a href="#">Servis</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider">Contact Info</h4>
                <ul class="text-zinc-200 text-sm space-y-5 italic font-bold">
                    <li>✉ tastyfood@gmail.com</li>
                    <li>📞 +62 812 3456 7890</li>
                    <li>📍 Kota Bandung, Jawa Barat</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-zinc-800 pt-10 text-center text-zinc-500 text-[11px] uppercase tracking-[0.4em] font-black">
            Copyright ©2026 All rights reserved
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 0,
            centeredSlides: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>
</html>