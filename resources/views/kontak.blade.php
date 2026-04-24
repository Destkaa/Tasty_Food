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
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=2000');
            background-size: cover;
            background-position: center;
            height: 400px;
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

    <header class="header-bg flex items-end px-20 pb-20">
        <h1 class="text-white text-5xl font-black uppercase tracking-tight">Kontak Kami</h1>
    </header>

    <section class="px-20 py-24 bg-white">
        <h2 class="text-2xl font-black uppercase mb-12 tracking-tight text-zinc-800">Kontak Kami</h2>
        
        @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-500 text-white rounded-xl font-bold italic shadow-lg animate-bounce">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('kontak.kirim') }}" method="POST" class="grid grid-cols-2 gap-8">
            @csrf
            <div class="space-y-6">
                <input type="text" name="subjek" placeholder="Subject" required
                    class="w-full p-4 bg-white border-2 border-zinc-200 rounded-xl focus:border-zinc-800 outline-none transition-all font-medium">
                
                <input type="text" name="nama" placeholder="Name" required
                    class="w-full p-4 bg-white border-2 border-zinc-200 rounded-xl focus:border-zinc-800 outline-none transition-all font-medium">
                
                <input type="email" name="email" placeholder="Email" required
                    class="w-full p-4 bg-white border-2 border-zinc-200 rounded-xl focus:border-zinc-800 outline-none transition-all font-medium">
            </div>

            <div>
                <textarea name="pesan" placeholder="Message" rows="8" required
                    class="w-full p-4 bg-white border-2 border-zinc-200 rounded-xl focus:border-zinc-800 outline-none transition-all font-medium resize-none"></textarea>
            </div>

            <div class="col-span-2">
                <button type="submit" class="w-full py-4 bg-zinc-900 text-white uppercase font-black tracking-[0.3em] rounded-xl hover:bg-black transition-all shadow-lg active:scale-[0.98]">
                    Kirim
                </button>
            </div>
        </form>
    </section>

    <section class="px-20 py-24 grid grid-cols-3 gap-10 text-center">
        <div class="flex flex-col items-center">
            <div class="w-20 h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-6 shadow-xl">
                <span class="text-3xl text-white">✉</span>
            </div>
            <h3 class="font-black uppercase text-lg mb-2">Email</h3>
            <p class="text-zinc-500 font-bold italic">tastyfood@gmail.com</p>
        </div>

        <div class="flex flex-col items-center">
            <div class="w-20 h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-6 shadow-xl">
                <span class="text-3xl text-white">📞</span>
            </div>
            <h3 class="font-black uppercase text-lg mb-2">Phone</h3>
            <p class="text-zinc-500 font-bold italic">+62 812 3456 7890</p>
        </div>

        <div class="flex flex-col items-center">
            <div class="w-20 h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-6 shadow-xl">
                <span class="text-3xl text-white">📍</span>
            </div>
            <h3 class="font-black uppercase text-lg mb-2">Location</h3>
            <p class="text-zinc-500 font-bold italic">Kota Bandung, Jawa Barat</p>
        </div>
    </section>

    <section class="px-20 py-24 bg-zinc-50">
        <div class="w-full h-[500px] rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white">
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

    <footer class="bg-zinc-900 text-white px-20 pt-28 pb-10">
        <div class="grid grid-cols-4 gap-20 mb-24">
            <div>
                <h3 class="text-2xl font-black uppercase mb-8 tracking-widest">Tasty Food</h3>
                <p class="text-zinc-200 text-sm leading-loose italic font-bold">
                    Nikmati kelezatan hidangan kami yang dibuat dengan bahan pilihan dan cinta.
                </p>
                <div class="flex gap-4 mt-10">
                    <div class="bg-zinc-800 w-10 h-10 rounded-full flex items-center justify-center cursor-pointer shadow-lg">
                        <span class="text-white text-xs">FB</span>
                    </div>
                    <div class="bg-zinc-800 w-10 h-10 rounded-full flex items-center justify-center cursor-pointer shadow-lg">
                        <span class="text-white text-xs">TW</span>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider">Useful Links</h4>
                <ul class="text-zinc-200 text-sm space-y-4 italic font-bold">
                    <li><a href="{{ route('berita') }}" class="hover:text-yellow-500">Blog</a></li>
                    <li><a href="#" class="hover:text-yellow-500">Hewan</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-yellow-500">Galeri</a></li>
                    <li><a href="#" class="hover:text-yellow-500">Testimonial</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-black text-lg mb-8 italic tracking-wider">Privacy</h4>
                <ul class="text-zinc-200 text-sm space-y-4 italic font-bold">
                    <li><a href="#">Karir</a></li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-yellow-500">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-yellow-500">Kontak Kami</a></li>
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

</body>
</html>