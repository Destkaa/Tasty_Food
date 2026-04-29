<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - Tasty Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .header-bg {
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)),
                url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=2000');
            background-size: cover;
            background-position: center;
            min-height: 300px;
        }
        @media (min-width: 768px) {
            .header-bg { min-height: 400px; }
        }
        #mobile-menu { display: none; }
        #mobile-menu.open { display: flex; }
    </style>
</head>
<body class="bg-white">

    <!-- ===== NAVBAR ===== -->
    <nav class="flex justify-between items-center px-6 md:px-20 py-6 md:py-8 absolute w-full z-50 text-white">
        <div class="text-xl md:text-2xl font-bold uppercase tracking-widest text-white">Tasty Food</div>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex gap-10 text-sm font-semibold uppercase">
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

    <!-- ===== HERO ===== -->
    <header class="header-bg flex items-end px-6 md:px-20 pb-12 md:pb-20">
        <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight">Kontak Kami</h1>
    </header>

    <!-- ===== FORM KONTAK ===== -->
    <section class="px-6 md:px-20 py-16 md:py-24 bg-white">
        <h2 class="text-xl md:text-2xl font-black uppercase mb-8 md:mb-12 tracking-tight text-zinc-800">Kontak Kami</h2>

        @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-500 text-white rounded-xl font-bold italic shadow-lg animate-bounce">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('kontak.kirim') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            @csrf
            <!-- Kiri: Input fields -->
            <div class="space-y-4 md:space-y-6">
                <input type="text" name="subjek" placeholder="Subject" required
                    class="w-full p-4 bg-white border-2 border-zinc-200 rounded-xl focus:border-zinc-800 outline-none transition-all font-medium text-sm">

                <input type="text" name="nama" placeholder="Name" required
                    class="w-full p-4 bg-white border-2 border-zinc-200 rounded-xl focus:border-zinc-800 outline-none transition-all font-medium text-sm">

                <input type="email" name="email" placeholder="Email" required
                    class="w-full p-4 bg-white border-2 border-zinc-200 rounded-xl focus:border-zinc-800 outline-none transition-all font-medium text-sm">
            </div>

            <!-- Kanan: Textarea -->
            <div>
                <textarea name="pesan" placeholder="Message" rows="6" required
                    class="w-full h-full min-h-[160px] p-4 bg-white border-2 border-zinc-200 rounded-xl focus:border-zinc-800 outline-none transition-all font-medium resize-none text-sm"></textarea>
            </div>

            <!-- Submit -->
            <div class="col-span-1 md:col-span-2">
                <button type="submit"
                    class="w-full py-4 bg-zinc-900 text-white uppercase font-black tracking-[0.2em] md:tracking-[0.3em] rounded-xl hover:bg-black transition-all shadow-lg active:scale-[0.98] text-sm">
                    Kirim
                </button>
            </div>
        </form>
    </section>

    <!-- ===== INFO KONTAK ===== -->
    <section class="px-6 md:px-20 py-16 md:py-24 grid grid-cols-1 sm:grid-cols-3 gap-8 md:gap-10 text-center">

        <div class="flex flex-col items-center">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-5 shadow-xl">
                <span class="text-2xl md:text-3xl text-white">✉</span>
            </div>
            <h3 class="font-black uppercase text-base md:text-lg mb-2">Email</h3>
            <p class="text-zinc-500 font-bold italic text-sm">tastyfood@gmail.com</p>
        </div>

        <div class="flex flex-col items-center">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-5 shadow-xl">
                <span class="text-2xl md:text-3xl text-white">📞</span>
            </div>
            <h3 class="font-black uppercase text-base md:text-lg mb-2">Phone</h3>
            <p class="text-zinc-500 font-bold italic text-sm">+62 812 3456 7890</p>
        </div>

        <div class="flex flex-col items-center">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-5 shadow-xl">
                <span class="text-2xl md:text-3xl text-white">📍</span>
            </div>
            <h3 class="font-black uppercase text-base md:text-lg mb-2">Location</h3>
            <p class="text-zinc-500 font-bold italic text-sm">Kota Bandung, Jawa Barat</p>
        </div>

    </section>

    <!-- ===== MAP ===== -->
    <section class="px-4 md:px-20 py-12 md:py-24 bg-zinc-50">
        <div class="w-full h-64 sm:h-80 md:h-[500px] rounded-[1.5rem] md:rounded-[3rem] overflow-hidden shadow-2xl border-4 md:border-8 border-white">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.5731164!3d-6.9034443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146050516e439867!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
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