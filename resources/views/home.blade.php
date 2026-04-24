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
        body { font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        .hero-bg {
            background: linear-gradient(to right, white 60%, #f3f4f6 40%);
        }
        .admin-link:hover { transform: scale(1.05); }
    </style>
</head>
<body class="bg-white">

    <nav class="flex justify-between items-center px-20 py-8 absolute w-full z-50">
        <div class="text-2xl font-black uppercase tracking-widest text-zinc-800">Tasty Food</div>
        
        <ul class="flex gap-10 text-sm font-black uppercase text-zinc-500">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->is('tentang') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Tentang</a></li>
            <li><a href="{{ route('berita') }}" class="{{ request()->is('berita*') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Berita</a></li>
            <li><a href="{{ route('galeri') }}" class="{{ request()->is('galeri') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" class="{{ request()->is('kontak') ? 'text-zinc-900' : 'hover:text-zinc-900' }} transition-all">Kontak</a></li>
        </ul>

        <div class="text-sm font-black uppercase">
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

                    <a href="{{ route('logout') }}" 
                       class="text-red-600 hover:text-red-800 transition-all"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                         Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </nav>

    <section class="flex px-20 py-10 items-center min-h-[100vh] hero-bg">
        <div class="w-1/2">
            <div class="w-20 h-1.5 bg-zinc-800 mb-8"></div>
            <h1 class="text-8xl font-light leading-[1] mb-6 tracking-tight text-zinc-800">
                HEALTHY <br> <span class="font-black">TASTY FOOD</span>
            </h1>
            <p class="text-zinc-500 mb-10 max-w-lg leading-loose text-base font-bold">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero id eros elementum convallis ac at magna.
            </p>
            <a href="{{ route('tentang') }}" class="bg-zinc-900 text-white px-14 py-4 uppercase text-sm font-black tracking-[0.2em] shadow-2xl hover:bg-black transition-all inline-block">
                Tentang Kami
            </a>
        </div>
        <div class="w-1/2 flex justify-end">
            <img src="https://imgur.com/ZGeUrev.png" alt="Food Plate" 
                  class="rounded-full w-[650px] h-[650px] object-cover shadow-[0_50px_100px_-20px_rgba(0,0,0,0.3)] translate-x-20">
        </div>
    </section>

    <section class="py-32 bg-white">
        <div class="text-center max-w-4xl mx-auto mb-32 px-20">
            <h2 class="text-3xl font-black uppercase mb-10 tracking-widest text-zinc-800">Tentang Kami</h2>
            <p class="text-zinc-500 leading-loose text-base font-bold italic mb-8">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.
            </p>
            <div class="w-20 h-1 bg-zinc-800 mx-auto"></div>
        </div>

        <div class="relative px-20 py-40 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1500');">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="relative z-10 flex gap-8">
                @foreach(range(1,4) as $card)
                <div class="bg-white p-10 rounded-[2.5rem] shadow-2xl w-1/4 text-center transform hover:-translate-y-6 transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=400" 
                          class="w-36 h-36 rounded-full mx-auto -mt-24 border-[10px] border-white shadow-xl object-cover mb-8">
                    <h3 class="font-black uppercase text-xl mb-6 text-zinc-800 tracking-wider">LOREM IPSUM</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed font-bold italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="px-20 py-32 bg-white">
        <h2 class="text-center text-3xl font-black uppercase mb-24 tracking-widest text-zinc-800">Berita Kami</h2>
        <div class="flex gap-12">
            @if(isset($beritas) && $beritas->count() > 0)
                @php $utama = $beritas->first(); @endphp
                <div class="w-1/2 bg-white rounded-[3rem] overflow-hidden shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] group">
                    <div class="overflow-hidden h-[450px]">
                        <img src="{{ asset('storage/' . $utama->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700">
                    </div>
                    <div class="p-14">
                        <h3 class="text-2xl font-black mb-8 uppercase leading-tight tracking-tight text-zinc-800">{{ $utama->judul }}</h3>
                        <p class="text-zinc-500 font-bold mb-10 leading-relaxed">{{ Str::limit($utama->konten, 180) }}</p>
                        <a href="{{ route('berita.show', $utama->id) }}" class="text-yellow-600 font-black text-sm uppercase tracking-widest hover:text-yellow-700 italic">Baca Selengkapnya</a>
                    </div>
                </div>
            @endif

            <div class="w-1/2 grid grid-cols-2 gap-10">
                @foreach($beritas->skip(1)->take(4) as $item)
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all group">
                    <div class="overflow-hidden h-48">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                    </div>
                    <div class="p-8">
                        <h4 class="font-black text-base mb-4 uppercase text-zinc-800 tracking-wider">{{ Str::limit($item->judul, 30) }}</h4>
                        <a href="{{ route('berita.show', $item->id) }}" class="text-yellow-600 text-xs font-black italic tracking-widest hover:underline">Baca Selengkapnya</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="px-20 py-32 bg-white">
        <h2 class="text-center text-3xl font-black uppercase mb-24 tracking-widest text-zinc-800">Galeri Kami</h2>
        <div class="grid grid-cols-3 gap-10 mb-24">
            @foreach($galeris->take(6) as $g)
            <div class="overflow-hidden rounded-[2.5rem] h-[350px] shadow-xl group">
                <img src="{{ asset('storage/' . $g->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
            </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('galeri') }}" class="bg-zinc-900 text-white px-24 py-5 uppercase text-sm font-black tracking-[0.3em] shadow-[0_20px_50px_rgba(0,0,0,0.2)] hover:bg-black transition-all inline-block">
                Lihat Lebih Banyak
            </a>
        </div>
    </section>

    <footer class="bg-zinc-900 text-white px-20 pt-28 pb-10">
        <div class="grid grid-cols-4 gap-20 mb-24">
            <div>
                <h3 class="text-2xl font-black uppercase mb-8 tracking-widest">Tasty Food</h3>
                <p class="text-zinc-200 text-sm leading-loose italic font-bold">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider">Useful Links</h4>
                <ul class="text-zinc-200 text-sm space-y-4 italic font-bold">
                    <li><a href="{{ route('berita') }}">Blog</a></li>
                    <li><a href="{{ route('galeri') }}">Galeri</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider">Privacy</h4>
                <ul class="text-zinc-200 text-sm space-y-4 italic font-bold">
                    <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider">Contact Info</h4>
                <ul class="text-zinc-200 text-sm space-y-5 italic font-bold">
                    <li>✉ tastyfood@gmail.com</li>
                    <li>📍 Kota Bandung, Jawa Barat</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-zinc-800 pt-10 text-center text-zinc-500 text-[11px] uppercase tracking-[0.4em] font-black">
            Copyright ©2026 All rights reserved
        </div>
    </footer>

    @auth
        @if(Auth::user()->role === 'admin')
        <div class="fixed bottom-10 right-10 z-[9999]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 bg-zinc-900 text-white px-6 py-4 rounded-2xl shadow-2xl border border-zinc-700 hover:bg-black hover:scale-105 transition-all group">
                <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse group-hover:animate-none"></span>
                <span class="text-[10px] font-black uppercase tracking-widest">Kembali ke Dashboard</span>
            </a>
        </div>
        @endif
    @endauth

</body>
</html>