<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tasty Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .bg-pattern {
            background-color: #ffffff;
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
        }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center p-6">

    <div class="max-w-4xl w-full bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        <div class="hidden md:block md:w-1/2 bg-zinc-900 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1000" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="relative z-10 p-12 flex flex-col h-full justify-between text-white">
                <div>
                    <h2 class="text-3xl font-bold uppercase tracking-widest">Tasty Food</h2>
                    <p class="mt-4 text-zinc-300 italic">"Sajian lezat, hidup lebih sehat."</p>
                </div>
                <div class="text-sm text-zinc-400">
                    &copy; 2026 All Rights Reserved.
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-10 md:p-16">
            <div class="mb-10">
                <h3 class="text-3xl font-black text-zinc-800 uppercase tracking-tight">Selamat Datang</h3>
                <p class="text-zinc-500 text-sm mt-2 font-medium">Silakan masuk ke akun Anda</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-xl">
                    <p class="text-xs font-black uppercase tracking-widest mb-1">Terjadi Kesalahan:</p>
                    <ul class="text-xs font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-zinc-400 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-5 py-4 bg-zinc-50 border border-zinc-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-zinc-800 transition-all text-sm @error('email') border-red-500 @enderror"
                           placeholder="nama@email.com">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-zinc-400 mb-2">Password</label>
                    <div class="relative group">
                        <input type="password" id="password" name="password" required 
                               class="w-full px-5 py-4 bg-zinc-50 border border-zinc-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-zinc-800 transition-all text-sm @error('password') border-red-500 @enderror"
                               placeholder="••••••••">
                        
                        <button type="button" id="togglePassword" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-zinc-800 transition-colors focus:outline-none">
                            <i class='bx bx-hide text-xl' id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center text-xs font-bold text-zinc-500 cursor-pointer">
                        <input type="checkbox" name="remember" class="mr-2 accent-zinc-800"> Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-bold text-zinc-800 hover:underline">Lupa Password?</a>
                    @endif
                </div>

                <button type="submit" 
                        class="w-full bg-zinc-900 text-white py-4 rounded-xl font-black uppercase text-xs tracking-[0.2em] shadow-xl hover:bg-black transition-all active:scale-[0.98]">
                    Masuk Sekarang
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center"><span class="w-full border-t border-zinc-200"></span></div>
                <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-4 text-zinc-400 font-bold tracking-widest">Atau</span></div>
            </div>

            <a href="{{ route('google.login') }}" 
               class="w-full flex items-center justify-center gap-3 bg-white border-2 border-zinc-100 py-4 rounded-xl font-bold text-xs text-zinc-700 hover:bg-zinc-50 transition-all shadow-sm">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
                Masuk dengan Google
            </a>

            <p class="text-center mt-10 text-xs text-zinc-500 font-medium">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-zinc-900 font-black uppercase tracking-wider hover:underline ml-1">Daftar Gratis</a>
            </p>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Toggle tipe input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon (bx-hide ke bx-show)
            if (type === 'password') {
                eyeIcon.classList.replace('bx-show', 'bx-hide');
            } else {
                eyeIcon.classList.replace('bx-hide', 'bx-show');
            }
        });
    </script>

</body>
</html>