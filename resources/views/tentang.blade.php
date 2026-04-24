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
            background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1500');
            background-size: cover;
            background-position: center;
            height: 55vh;
        }
    </style>
</head>
<body class="bg-white">

    <nav class="flex justify-between items-center px-24 py-10 absolute w-full z-50 text-white">
        <div class="text-2xl font-black uppercase tracking-[0.2em]">Tasty Food</div>
        <ul class="flex gap-12 text-[13px] font-bold uppercase tracking-widest">
            <li><a href="{{ route('home') }}" class="hover:text-zinc-300 transition-all">Home</a></li>
            <li><a href="{{ route('tentang') }}" class="text-white border-b-2 border-white pb-1">Tentang</a></li>
            <li><a href="{{ route('berita') }}" class="hover:text-zinc-300 transition-all">Berita</a></li>
            <li><a href="{{ route('galeri') }}" class="hover:text-zinc-300 transition-all">Galeri</a></li>
            <li><a href="{{ route('kontak') }}" class="hover:text-zinc-300 transition-all">Kontak</a></li>
        </ul>
    </nav>

    <section class="about-hero flex items-end pb-24 px-24">
        <h1 class="text-6xl font-black text-white uppercase tracking-tight">Tentang Kami</h1>
    </section>

    <section class="px-24 py-32 flex gap-16 items-start">
        <div class="w-1/2">
            <h2 class="text-3xl font-black uppercase mb-8 tracking-[0.2em] text-zinc-800">Tasty Food</h2>
            <p class="text-zinc-800 font-bold text-sm leading-loose mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Fusce sit amet viverra ante.
            </p>
            <p class="text-zinc-500 text-sm leading-loose font-medium">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
            </p>
        </div>
        <div class="w-1/2 flex gap-6">
            <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe" class="w-1/2 h-[450px] object-cover rounded-[40px] shadow-2xl" alt="Food 1">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" class="w-1/2 h-[450px] object-cover rounded-[40px] shadow-2xl mt-16" alt="Food 2">
        </div>
    </section>

    <section class="px-24 py-24 flex gap-20 items-center">
        <div class="w-1/2 flex gap-6">
            <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1" class="w-1/2 h-[380px] object-cover rounded-[40px] shadow-xl" alt="Visi 1">
            <img src="https://images.unsplash.com/photo-1490818387583-1baba5e638af" class="w-1/2 h-[380px] object-cover rounded-[40px] shadow-xl" alt="Visi 2">
        </div>
        <div class="w-1/2">
            <h2 class="text-3xl font-black uppercase mb-8 tracking-[0.2em] text-zinc-800">Visi</h2>
            <p class="text-zinc-500 text-[15px] leading-loose font-medium">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis luctus vitae eros malesuada eleifend. Maecenas eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat.
            </p>
        </div>
    </section>

    <section class="px-24 py-32 flex gap-20 items-center mb-10">
        <div class="w-1/2">
            <h2 class="text-3xl font-black uppercase mb-8 tracking-[0.2em] text-zinc-800">Misi</h2>
            <p class="text-zinc-500 text-[15px] leading-loose font-medium">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis luctus vitae eros malesuada eleifend. Maecenas eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat.
            </p>
        </div>
        <div class="w-1/2">
            <img src="https://images.unsplash.com/photo-1467003909585-2f8a72700288" class="w-full h-[400px] object-cover rounded-[45px] shadow-2xl" alt="Misi Image">
        </div>
    </section>

    <footer class="bg-[#111111] text-white px-24 pt-32 pb-12">
        <div class="grid grid-cols-4 gap-20 mb-28">
            <div class="col-span-1">
                <h3 class="text-2xl font-black uppercase mb-10 tracking-widest">Tasty Food</h3>
                <p class="text-zinc-400 text-sm leading-loose italic font-bold">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="flex gap-4 mt-10">
                    <div class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center font-bold text-xs">f</div>
                    <div class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center font-bold text-xs">t</div>
                </div>
            </div>
            
            <div>
                <h4 class="font-black text-lg mb-10 italic">Useful Links</h4>
                <ul class="text-zinc-400 text-sm space-y-4 font-bold italic">
                    <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Hewan</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-white transition-colors">Galeri</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Testimonial</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-black text-lg mb-10 italic">Privacy</h4>
                <ul class="text-zinc-400 text-sm space-y-4 font-bold italic">
                    <li><a href="#" class="hover:text-white transition-colors">Karir</a></li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-white transition-colors">Kontak Kami</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Servis</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-black text-lg mb-10 italic">Contact Info</h4>
                <ul class="text-zinc-400 text-[13px] space-y-6 font-bold italic">
                    <li class="flex items-center gap-3">✉ tastyfood@gmail.com</li>
                    <li class="flex items-center gap-3">📞 +62 812 3456 7890</li>
                    <li class="flex items-center gap-3">📍 Kota Bandung, Jawa Barat</li>
                </ul>
            </div>
        </div>
        
        <p class="text-center text-zinc-600 text-[10px] uppercase tracking-[0.5em] font-black border-t border-zinc-800 pt-12">
            Copyright ©2026 All rights reserved
        </p>
    </footer>

</body>
</html>