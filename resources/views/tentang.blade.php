<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Tasty Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; overflow-x: hidden; color: #333; }
        .about-hero {
            background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
                url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1500');
            background-size: cover;
            background-position: center;
            min-height: 55vh;
        }
        #mobile-menu { display: none; }
        #mobile-menu.open { display: flex; }
    </style>
</head>
<body class="bg-white">

    <!-- ===== NAVBAR ===== -->
    <nav class="flex justify-between items-center px-6 md:px-24 py-6 md:py-10 absolute w-full z-50 text-white">
        <div class="text-xl md:text-2xl font-black uppercase tracking-[0.2em]">Tasty Food</div>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex gap-12 text-[13px] font-bold uppercase tracking-widest">
            <li><a href="{{ route('home') }}" class="hover:text-zinc-300 transition-all">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="text-white border-b-2 border-white pb-1">Tentang</a></li>
            <li><a href="{{ route('berita') }}" class="hover:text-zinc-300 transition-all">Berita</a></li>
            <li><a href="{{ route('galeri') }}" class="hover:text-zinc-300 transition-all">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" class="hover:text-zinc-300 transition-all">Kontak</a></li>
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
    <section class="about-hero flex items-end pb-12 md:pb-24 px-6 md:px-24">
        <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tight">Tentang Kami</h1>
    </section>

    <!-- ===== SECTION 1: Tentang ===== -->
    <section class="px-6 md:px-24 py-16 md:py-32 flex flex-col md:flex-row gap-10 md:gap-16 items-start">
        <!-- Text -->
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl md:text-3xl font-black uppercase mb-6 tracking-[0.2em] text-zinc-800">Tasty Food</h2>
            <p class="text-zinc-800 font-bold text-sm leading-loose mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Fusce sit amet viverra ante.
            </p>
            <p class="text-zinc-500 text-sm leading-loose font-medium">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
            </p>
        </div>
        <!-- Images -->
        <div class="w-full md:w-1/2 flex gap-4 md:gap-6">
            <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe"
                 class="w-1/2 h-56 sm:h-72 md:h-[450px] object-cover rounded-[24px] md:rounded-[40px] shadow-2xl" alt="Food 1">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836"
                 class="w-1/2 h-56 sm:h-72 md:h-[450px] object-cover rounded-[24px] md:rounded-[40px] shadow-2xl mt-8 md:mt-16" alt="Food 2">
        </div>
    </section>

    <!-- ===== SECTION 2: Visi ===== -->
    <section class="px-6 md:px-24 py-12 md:py-24 flex flex-col md:flex-row gap-10 md:gap-20 items-center">
        <!-- Images -->
        <div class="w-full md:w-1/2 flex gap-4 md:gap-6 order-2 md:order-1">
            <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1"
                 class="w-1/2 h-52 sm:h-64 md:h-[380px] object-cover rounded-[24px] md:rounded-[40px] shadow-xl" alt="Visi 1">
            <img src="https://images.unsplash.com/photo-1490818387583-1baba5e638af"
                 class="w-1/2 h-52 sm:h-64 md:h-[380px] object-cover rounded-[24px] md:rounded-[40px] shadow-xl" alt="Visi 2">
        </div>
        <!-- Text -->
        <div class="w-full md:w-1/2 order-1 md:order-2">
            <h2 class="text-2xl md:text-3xl font-black uppercase mb-6 tracking-[0.2em] text-zinc-800">Visi</h2>
            <p class="text-zinc-500 text-sm md:text-[15px] leading-loose font-medium">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis luctus vitae eros malesuada eleifend. Maecenas eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat.
            </p>
        </div>
    </section>

    <!-- ===== SECTION 3: Misi ===== -->
    <section class="px-6 md:px-24 py-12 md:py-32 flex flex-col md:flex-row gap-10 md:gap-20 items-center mb-6 md:mb-10">
        <!-- Text -->
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl md:text-3xl font-black uppercase mb-6 tracking-[0.2em] text-zinc-800">Misi</h2>
            <p class="text-zinc-500 text-sm md:text-[15px] leading-loose font-medium">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis luctus vitae eros malesuada eleifend. Maecenas eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat.
            </p>
        </div>
        <!-- Image -->
        <div class="w-full md:w-1/2">
            <img src="https://images.unsplash.com/photo-1467003909585-2f8a72700288"
                 class="w-full h-64 sm:h-80 md:h-[400px] object-cover rounded-[28px] md:rounded-[45px] shadow-2xl" alt="Misi Image">
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