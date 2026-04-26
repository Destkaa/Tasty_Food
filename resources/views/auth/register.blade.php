<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Tasty Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .register-bg {
            background: linear-gradient(135deg, #f3f4f6 0%, #ffffff 100%);
        }
    </style>
</head>
<body class="register-bg min-h-screen flex items-center justify-center p-6">

    <div class="max-w-5xl w-full bg-white rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)] overflow-hidden flex flex-col md:flex-row">
        
        <div class="md:w-1/2 relative hidden md:block">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1000" 
                 alt="Healthy Food" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute bottom-12 left-12 right-12 text-white">
                <h2 class="text-4xl font-black uppercase mb-4 leading-tight">Mulai Hidup Sehat <br> Bersama Kami.</h2>
                <p class="text-white/80 font-medium italic">"Makanan yang baik adalah fondasi dari kebahagiaan yang tulus."</p>
            </div>
        </div>

        <div class="md:w-1/2 p-12 md:p-20">
            <div class="mb-10 flex justify-between items-start">
                <div>
                    <h3 class="text-3xl font-black text-zinc-800 uppercase tracking-tighter mb-2">Daftar Akun</h3>
                    <p class="text-zinc-400 text-sm font-bold italic">Bergabunglah hari ini.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-2xl">
                    <ul class="text-xs font-black uppercase tracking-widest leading-relaxed">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-zinc-400 mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                           class="w-full px-6 py-4 bg-zinc-100 border-none rounded-2xl focus:ring-2 focus:ring-zinc-800 transition-all font-bold text-zinc-800 outline-none placeholder:font-medium"
                           placeholder="John Doe">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-zinc-400 mb-2 ml-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           class="w-full px-6 py-4 bg-zinc-100 border-none rounded-2xl focus:ring-2 focus:ring-zinc-800 transition-all font-bold text-zinc-800 outline-none placeholder:font-medium"
                           placeholder="email@contoh.com">
                </div>

                <div class="space-y-6">
                    <div class="relative">
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label class="text-xs font-black uppercase tracking-widest text-zinc-400">Password</label>
                            <button type="button" onclick="generatePassword()" class="text-[10px] font-black uppercase text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1">
                                <i class='bx bx-refresh text-sm'></i> Acak Password
                            </button>
                        </div>
                        <div class="relative group">
                            <input type="password" id="password" name="password" required 
                                   class="w-full px-6 py-4 bg-zinc-100 border-none rounded-2xl focus:ring-2 focus:ring-zinc-800 transition-all font-bold text-zinc-800 outline-none placeholder:font-medium"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePass('password', 'eye1')" class="absolute right-5 top-1/2 -translate-y-1/2 text-zinc-400">
                                <i class='bx bx-hide text-xl' id="eye1"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-zinc-400 mb-2 ml-1">Konfirmasi Password</label>
                        <div class="relative group">
                            <input type="password" id="password_confirmation" name="password_confirmation" required 
                                   class="w-full px-6 py-4 bg-zinc-100 border-none rounded-2xl focus:ring-2 focus:ring-zinc-800 transition-all font-bold text-zinc-800 outline-none placeholder:font-medium"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePass('password_confirmation', 'eye2')" class="absolute right-5 top-1/2 -translate-y-1/2 text-zinc-400">
                                <i class='bx bx-hide text-xl' id="eye2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-zinc-900 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-sm shadow-xl hover:bg-black hover:-translate-y-1 transition-all active:scale-95">
                    Buat Akun
                </button>

                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-zinc-200"></div>
                    <span class="flex-shrink mx-4 text-zinc-400 text-[10px] font-black uppercase italic">Atau</span>
                    <div class="flex-grow border-t border-zinc-200"></div>
                </div>

                <a href="{{ route('google.login') }}" 
                   class="w-full flex items-center justify-center gap-4 bg-white border-2 border-zinc-100 py-4 rounded-2xl font-black uppercase text-xs tracking-widest text-zinc-600 hover:bg-zinc-50 transition-all">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5">
                    Google
                </a>
            </form>

            <p class="text-center mt-10 text-zinc-400 text-sm font-bold">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-zinc-800 border-b-2 border-zinc-800 pb-0.5 hover:text-zinc-500 hover:border-zinc-500 transition-all">Masuk</a>
            </p>
        </div>
    </div>

    <script>
        // Fungsi Sembunyi/Tampil Password
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('bx-hide', 'bx-show');
            } else {
                input.type = "password";
                icon.classList.replace('bx-show', 'bx-hide');
            }
        }

        // Fungsi Acak Password
        function generatePassword() {
            const chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()";
            const passwordLength = 12;
            let password = "";
            
            for (let i = 0; i <= passwordLength; i++) {
                let randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber + 1);
            }

            // Isi ke kedua input
            const pInput = document.getElementById('password');
            const cInput = document.getElementById('password_confirmation');
            
            pInput.value = password;
            cInput.value = password;

            // Ubah tipe ke text supaya user bisa lihat password yang baru dibuat
            pInput.type = "text";
            cInput.type = "text";
            
            // Update icon mata jadi 'show'
            document.getElementById('eye1').classList.replace('bx-hide', 'bx-show');
            document.getElementById('eye2').classList.replace('bx-hide', 'bx-show');

            alert("Password acak berhasil dibuat! Silakan catat atau ingat password Anda.");
        }
    </script>
</body>
</html>