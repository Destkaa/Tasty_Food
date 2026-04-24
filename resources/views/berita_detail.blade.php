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

    <nav class="px-20 py-10">
        <a href="{{ route('home') }}" class="text-zinc-400 font-black uppercase text-xs tracking-widest hover:text-zinc-800 transition-all flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Home
        </a>
    </nav>

    <main class="flex flex-col lg:flex-row min-h-[70vh] gap-16 px-20 mb-32 items-start">
        
        <div class="w-full lg:w-1/2">
            <div class="rounded-[3.5rem] overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.2)] sticky top-10">
                <img src="{{ asset('storage/' . $berita->foto) }}" 
                     alt="{{ $berita->judul }}" 
                     class="w-full h-[600px] object-cover hover:scale-105 transition-all duration-700">
            </div>
        </div>

        <div class="w-full lg:w-1/2 pt-10">
            <div class="w-20 h-1.5 bg-zinc-800 mb-10"></div>
            
            <p class="text-yellow-600 font-black uppercase tracking-[0.3em] text-xs mb-4">
                {{ $berita->created_at->format('d M Y') }}
            </p>
            
            <h1 class="text-6xl font-black text-zinc-800 leading-[1.1] mb-10 uppercase tracking-tighter">
                {{ $berita->judul }}
            </h1>

            <div class="text-zinc-500 text-lg leading-loose font-bold italic border-l-4 border-zinc-100 pl-8 space-y-6">
                {!! nl2br(e($berita->konten)) !!}
            </div>

            <div class="mt-16">
                <a href="{{ route('berita') }}" class="inline-block bg-zinc-900 text-white px-10 py-4 rounded-full text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-xl">
                    Berita Lainnya
                </a>
            </div>
        </div>

    </main>

    <footer class="bg-zinc-900 text-white py-12 text-center text-[10px] uppercase tracking-[0.5em] font-black">
        Copyright ©2026 Tasty Food • All Rights Reserved
    </footer>

</body>
</html>