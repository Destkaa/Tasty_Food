<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food - Healthy & Tasty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            overflow-x: hidden;
        }

        .hero-bg {
            background: linear-gradient(to right, white 60%, #f3f4f6 40%);
        }

        @media (max-width: 768px) {
            .hero-bg {
                background: #ffffff !important;
            }
        }

        .admin-link:hover { transform: scale(1.05); }

        #mobile-menu { display: none; }
        #mobile-menu.open { display: flex; }

        #card-slider::-webkit-scrollbar { display: none; }
        #card-slider { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-white">

    <nav class="flex justify-between items-center px-6 md:px-20 py-6 md:py-8 absolute w-full z-50">
        <div class="text-xl md:text-2xl font-black uppercase tracking-widest text-zinc-800">Tasty Food</div>

        <ul class="hidden md:flex gap-10 text-sm font-black uppercase text-zinc-500">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->is('tentang') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Tentang</a></li>
            <li><a href="{{ route('berita') }}" class="{{ request()->is('berita*') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Berita</a></li>
            <li><a href="{{ route('galeri') }}" class="{{ request()->is('galeri') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" class="{{ request()->is('kontak') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Kontak</a></li>
        </ul>

        <div class="hidden md:block text-sm font-black uppercase">
            @guest
                <a href="{{ route('login') }}" class="text-zinc-500 hover:text-zinc-900 transition-all">Login</a>
            @else
                <div class="flex items-center gap-6">
                    <span class="text-zinc-400 lowercase font-normal italic">hi, {{ Auth::user()->name }}</span>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="admin-link bg-indigo-600 text-white px-5 py-2 rounded-full text-[10px] tracking-wider shadow-lg shadow-indigo-200 transition-all">
                            <i class="bi bi-speedometer2 mr-1"></i> Admin Panel
                        </a>
                    @endif
                    <a href="{{ route('logout') }}" class="text-red-600 hover:text-red-800 transition-all"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
            @endguest
        </div>

        <button id="hamburger" class="md:hidden flex flex-col gap-1.5 z-50" onclick="toggleMenu()">
            <span class="w-6 h-0.5 bg-zinc-800 block transition-all" id="bar1"></span>
            <span class="w-6 h-0.5 bg-zinc-800 block transition-all" id="bar2"></span>
            <span class="w-6 h-0.5 bg-zinc-800 block transition-all" id="bar3"></span>
        </button>
    </nav>

    <div id="mobile-menu" class="fixed top-0 left-0 w-full h-full bg-white z-40 flex-col items-center justify-center gap-8 text-center">
        <ul class="flex flex-col gap-6 text-lg font-black uppercase text-zinc-700">
            <li><a href="{{ route('home') }}" onclick="toggleMenu()">Home</a></li>
            <li><a href="{{ route('tentang') }}" onclick="toggleMenu()">Tentang</a></li>
            <li><a href="{{ route('berita') }}" onclick="toggleMenu()">Berita</a></li>
            <li><a href="{{ route('galeri') }}" onclick="toggleMenu()">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" onclick="toggleMenu()">Kontak</a></li>
        </ul>
        <div class="mt-8 text-sm font-black uppercase">
            @guest
                <a href="{{ route('login') }}" class="text-zinc-500 hover:text-zinc-900">Login</a>
            @else
                <div class="flex flex-col items-center gap-4">
                    <span class="text-zinc-400 lowercase font-normal italic">hi, {{ Auth::user()->name }}</span>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full text-[10px] tracking-wider">
                            <i class="bi bi-speedometer2 mr-1"></i> Admin Panel
                        </a>
                    @endif
                    <a href="{{ route('logout') }}" class="text-red-600"
                       onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Keluar</a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
            @endguest
        </div>
    </div>

    <section class="flex flex-col-reverse md:flex-row px-6 md:px-20 pt-32 pb-16 md:py-10 items-center min-h-[100vh] hero-bg">
        <div class="w-full md:w-1/2 text-center md:text-left mt-8 md:mt-0">
            <div class="w-16 h-1.5 bg-zinc-800 mb-6 mx-auto md:mx-0"></div>
            <h1 class="text-5xl sm:text-6xl md:text-8xl font-light leading-[1.1] mb-6 tracking-tight text-zinc-800">
                HEALTHY <br> <span class="font-black">TASTY FOOD</span>
            </h1>
            <p class="text-zinc-500 mb-8 max-w-lg leading-loose text-sm md:text-base font-bold mx-auto md:mx-0">
                Nikmati perpaduan sempurna antara kesehatan dan kelezatan. Kami menghadirkan hidangan bernutrisi tinggi dengan cita rasa autentik untuk gaya hidup yang lebih baik.
            </p>
            <a href="{{ route('tentang') }}" class="bg-zinc-900 text-white px-10 md:px-14 py-4 uppercase text-xs md:text-sm font-black tracking-[0.2em] shadow-2xl hover:bg-black transition-all inline-block">
                Tentang Kami
            </a>
        </div>
        <div class="w-full md:w-1/2 flex justify-center md:justify-end">
            <img src="https://imgur.com/ZGeUrev.png" alt="Food Plate" 
                 class="rounded-full w-64 h-64 sm:w-80 sm:h-80 md:w-[650px] md:h-[650px] object-cover shadow-[0_30px_80px_-20px_rgba(0,0,0,0.3)] md:translate-x-20">
        </div>
    </section>

    <section class="py-20 md:py-32 bg-white">
        <div class="text-center max-w-4xl mx-auto mb-16 md:mb-32 px-6 md:px-20">
            <h2 class="text-2xl md:text-3xl font-black uppercase mb-8 tracking-widest text-zinc-800">Tentang Kami</h2>
            <p class="text-zinc-500 leading-loose text-sm md:text-base font-bold italic mb-8">
                Tasty Food bukan sekadar restoran. Kami adalah visi tentang bagaimana makanan sehat seharusnya disajikan: segar, alami, dan penuh rasa.
            </p>
            <div class="w-16 h-1 bg-zinc-800 mx-auto"></div>
        </div>

        <div class="relative px-6 md:px-20 py-24 md:py-40 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1500');">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="relative z-10">
                <div id="card-slider" class="flex gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-6">
                    <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-2xl text-center flex-shrink-0 snap-start w-[75vw] sm:w-[45vw] md:w-[calc(25%-1.5rem)] transform hover:-translate-y-4 transition-all duration-500 mt-16">
                        <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=400" class="w-28 h-28 md:w-36 md:h-36 rounded-full mx-auto -mt-20 md:-mt-24 border-[8px] border-white shadow-xl object-cover mb-6">
                        <h3 class="font-black uppercase text-base md:text-xl mb-4 text-zinc-800 tracking-wider">BAHAN ORGANIK</h3>
                        <p class="text-zinc-400 text-xs md:text-sm leading-relaxed font-bold italic">Kami hanya menggunakan bahan sayur dan daging pilihan langsung dari petani lokal terbaik.</p>
                    </div>
                    <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-2xl text-center flex-shrink-0 snap-start w-[75vw] sm:w-[45vw] md:w-[calc(25%-1.5rem)] transform hover:-translate-y-4 transition-all duration-500 mt-16">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=400" class="w-28 h-28 md:w-36 md:h-36 rounded-full mx-auto -mt-20 md:-mt-24 border-[8px] border-white shadow-xl object-cover mb-6">
                        <h3 class="font-black uppercase text-base md:text-xl mb-4 text-zinc-800 tracking-wider">RESEP RAHASIA</h3>
                        <p class="text-zinc-400 text-xs md:text-sm leading-relaxed font-bold italic">Diracik oleh chef profesional dengan bumbu alami tanpa tambahan pengawet buatan.</p>
                    </div>
                    <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-2xl text-center flex-shrink-0 snap-start w-[75vw] sm:w-[45vw] md:w-[calc(25%-1.5rem)] transform hover:-translate-y-4 transition-all duration-500 mt-16">
                        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=400" class="w-28 h-28 md:w-36 md:h-36 rounded-full mx-auto -mt-20 md:-mt-24 border-[8px] border-white shadow-xl object-cover mb-6">
                        <h3 class="font-black uppercase text-base md:text-xl mb-4 text-zinc-800 tracking-wider">RASA AUTENTIK</h3>
                        <p class="text-zinc-400 text-xs md:text-sm leading-relaxed font-bold italic">Menghadirkan harmoni rasa yang luar biasa di setiap suapan yang Anda nikmati.</p>
                    </div>
                    <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-2xl text-center flex-shrink-0 snap-start w-[75vw] sm:w-[45vw] md:w-[calc(25%-1.5rem)] transform hover:-translate-y-4 transition-all duration-500 mt-16">
                        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=400" class="w-28 h-28 md:w-36 md:h-36 rounded-full mx-auto -mt-20 md:-mt-24 border-[8px] border-white shadow-xl object-cover mb-6">
                        <h3 class="font-black uppercase text-base md:text-xl mb-4 text-zinc-800 tracking-wider">KEPUASAN ANDA</h3>
                        <p class="text-zinc-400 text-xs md:text-sm leading-relaxed font-bold italic">Memberikan pelayanan terbaik karena bagi kami, kenyamanan Anda adalah prioritas utama.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-20 py-20 md:py-32 bg-white">
        <h2 class="text-center text-2xl md:text-3xl font-black uppercase mb-10 md:mb-24 tracking-widest text-zinc-800">Berita Kami</h2>

        @if(isset($beritas) && $beritas->count() > 0)
            @php $utama = $beritas->first(); @endphp

            <div class="bg-white rounded-[1.5rem] md:rounded-[2.5rem] overflow-hidden shadow-xl group mb-6 md:mb-10">
                <div class="flex flex-col md:flex-row">
                    <div class="w-full md:w-1/2 h-52 md:h-[420px] overflow-hidden">
                        <img src="{{ asset('storage/' . $utama->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="w-full md:w-1/2 p-6 md:p-12 flex flex-col justify-center">
                        <span class="text-[10px] font-black uppercase tracking-widest text-yellow-500 mb-3">Berita Utama</span>
                        <h3 class="text-base md:text-2xl font-black uppercase text-zinc-800 mb-3 md:mb-5 leading-tight line-clamp-3">{{ $utama->judul }}</h3>
                        <p class="text-zinc-500 text-xs md:text-sm font-bold italic leading-relaxed line-clamp-3 mb-4 md:mb-8">{{ strip_tags($utama->konten) }}</p>
                        <a href="{{ route('berita.show', $utama->id) }}" class="text-yellow-600 font-black text-[10px] md:text-xs uppercase tracking-widest italic hover:text-yellow-700">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach($beritas->skip(1)->take(4) as $item)
                <div class="bg-white rounded-[1rem] md:rounded-[1.5rem] overflow-hidden shadow-md hover:shadow-xl transition-all group">
                    <div class="h-28 md:h-44 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-3 md:p-5">
                        <h4 class="font-black text-[11px] md:text-sm uppercase text-zinc-800 line-clamp-2 mb-2 leading-snug">{{ $item->judul }}</h4>
                        <a href="{{ route('berita.show', $item->id) }}" class="text-yellow-600 text-[9px] md:text-[11px] font-black italic tracking-widest hover:underline">
                            Baca →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </section>

    <section class="px-6 md:px-20 py-20 md:py-32 bg-white">
        <h2 class="text-center text-2xl md:text-3xl font-black uppercase mb-10 md:mb-24 tracking-widest text-zinc-800">Galeri Kami</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-10 mb-8 md:mb-24">
            @forelse($galeris->take(6) as $g)
                <div class="overflow-hidden rounded-[1rem] md:rounded-[2.5rem] h-32 sm:h-44 md:h-[350px] shadow-md md:shadow-xl group">
                    <img src="{{ asset('storage/' . $g->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-zinc-50 rounded-[2rem] border-2 border-dashed border-zinc-200">
                    <i class="bi bi-images text-4xl text-zinc-300 mb-3 block"></i>
                    <p class="text-zinc-500 font-bold italic text-sm">Maaf, foto belum ditambahkan.</p>
                </div>
            @endforelse
        </div>

        @if($galeris->count() > 0)
        <div class="text-center">
            <a href="{{ route('galeri') }}" class="bg-zinc-900 text-white px-10 md:px-24 py-3 md:py-5 uppercase text-[10px] md:text-sm font-black tracking-[0.2em] md:tracking-[0.3em] shadow-lg md:shadow-[0_20px_50px_rgba(0,0,0,0.2)] hover:bg-black transition-all inline-block rounded-sm">
                Lihat Lebih Banyak
            </a>
        </div>
        @endif
    </section>

    <footer class="bg-zinc-900 text-white px-6 md:px-20 pt-16 md:pt-28 pb-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 md:gap-20 mb-16 md:mb-24">
            <div class="col-span-2 md:col-span-1">
                <h3 class="text-xl md:text-2xl font-black uppercase mb-6 tracking-widest">Tasty Food</h3>
                <p class="text-zinc-200 text-sm leading-loose italic font-bold">
                    Membangun gaya hidup sehat melalui hidangan lezat dan berkualitas. Kami percaya bahwa makanan bergizi adalah investasi terbaik untuk kesehatan masa depan Anda.
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
            <div>
                <h4 class="font-black text-base md:text-lg mb-6 italic tracking-wider">Useful Links</h4>
                <ul class="text-zinc-200 text-sm space-y-3 italic font-bold">
                    <li><a href="{{ route('home') }}" class="hover:text-yellow-500 transition-colors">Blog</a></li>
                    <li><a href="#" class="hover:text-yellow-500 transition-colors">Hewan</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-yellow-500 transition-colors">Galeri</a></li>
                    <li><a href="#" class="hover:text-yellow-500 transition-colors">Testimonial</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-base md:text-lg mb-6 italic tracking-wider">Privacy</h4>
                <ul class="text-zinc-200 text-sm space-y-3 italic font-bold">
                    <li><a href="#" class="hover:text-yellow-500 transition-colors">Karir</a></li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-yellow-500 transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-yellow-500 transition-colors">Kontak Kami</a></li>
                    <li><a href="#" class="hover:text-yellow-500 transition-colors">Servis</a></li>
                </ul>
            </div>
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

    @auth
        @if(Auth::user()->role === 'admin')
        <div class="fixed bottom-6 right-6 z-[9999]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 bg-zinc-900 text-white px-4 md:px-6 py-3 md:py-4 rounded-2xl shadow-2xl border border-zinc-700 hover:bg-black hover:scale-105 transition-all group">
                <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse group-hover:animate-none"></span>
                <span class="text-[9px] md:text-[10px] font-black uppercase tracking-widest">Kembali ke Dashboard</span>
            </a>
        </div>
        @endif
    @endauth

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        }

        function slideCards(dir) {
            const slider = document.getElementById('card-slider');
            const card = slider.querySelector('div');
            const cardWidth = card.offsetWidth + 32;
            slider.scrollBy({ left: dir * cardWidth, behavior: 'smooth' });
        }
    </script>
</body>
</html>