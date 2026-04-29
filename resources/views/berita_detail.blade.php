<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Tasty Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <!-- ===== NAVBAR ===== -->
    <nav class="px-6 md:px-20 py-8 md:py-10">
        <a href="{{ route('home') }}" class="text-zinc-400 font-black uppercase text-xs tracking-widest hover:text-zinc-800 transition-all flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Home
        </a>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex flex-col lg:flex-row min-h-[70vh] gap-10 md:gap-16 px-6 md:px-20 mb-16 md:mb-32 items-start">

        <!-- Foto -->
        <div class="w-full lg:w-1/2">
            <div class="rounded-[2rem] md:rounded-[3.5rem] overflow-hidden shadow-[0_30px_80px_-20px_rgba(0,0,0,0.2)] lg:sticky lg:top-10">
                <img src="{{ asset('storage/' . $berita->foto) }}"
                     alt="{{ $berita->judul }}"
                     class="w-full h-64 sm:h-80 md:h-[500px] lg:h-[600px] object-cover hover:scale-105 transition-all duration-700">
            </div>
        </div>

        <!-- Konten -->
        <div class="w-full lg:w-1/2 pt-2 md:pt-10">
            <div class="w-14 md:w-20 h-1.5 bg-zinc-800 mb-6 md:mb-10"></div>

            <p class="text-yellow-600 font-black uppercase tracking-[0.2em] md:tracking-[0.3em] text-xs mb-3 md:mb-4">
                {{ $berita->created_at->format('d M Y') }}
            </p>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-zinc-800 leading-[1.1] mb-8 md:mb-10 uppercase tracking-tighter">
                {{ $berita->judul }}
            </h1>

            <div class="text-zinc-500 text-sm md:text-lg leading-loose font-bold italic border-l-4 border-zinc-100 pl-5 md:pl-8 space-y-4 md:space-y-6">
                {!! nl2br(e($berita->konten)) !!}
            </div>

            <div class="mt-10 md:mt-16">
                <a href="{{ route('berita') }}" class="inline-block bg-zinc-900 text-white px-8 md:px-10 py-3 md:py-4 rounded-full text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-xl">
                    Berita Lainnya
                </a>
            </div>
        </div>

    </main>

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

</body>
</html>