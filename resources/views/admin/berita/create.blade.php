<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Berita Baru | Tasty Food</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-color: #696cff;
            --primary-soft: #e7e7ff;
            --bg-body: #f8f9fa;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Inter', sans-serif;
            color: #233446;
        }

        h4, .sidebar-brand { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* --- Sidebar Style --- */
        .sidebar { 
            width: var(--sidebar-width); 
            height: 100vh; 
            position: fixed; 
            background: #fff; 
            border-right: 1px solid rgba(0,0,0,0.05); 
            padding: 1.5rem 1rem;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            padding: 0 1rem 2rem;
            color: var(--primary-color);
        }

        .menu-item { 
            display: flex; 
            align-items: center; 
            padding: 0.8rem 1rem; 
            color: #718096; 
            text-decoration: none; 
            border-radius: 10px; 
            margin-bottom: 0.4rem; 
            transition: all 0.2s ease;
        }

        .menu-item i { font-size: 1.4rem; margin-right: 12px; }
        .menu-item:hover { background: var(--primary-soft); color: var(--primary-color); }

        .menu-item.active { 
            background: var(--primary-color); 
            color: #fff; 
            box-shadow: 0 10px 15px -3px rgba(105, 108, 255, 0.3);
            font-weight: 600;
        }

        /* --- Content Style --- */
        .main-content { margin-left: var(--sidebar-width); padding: 2.5rem; }

        .card-form {
            border-radius: 20px;
            border: none;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
        }

        .form-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            margin-bottom: 0.8rem;
        }

        .form-control {
            border: 1px solid #d9dee3;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(105, 108, 255, 0.1);
        }

        .form-control-lg {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .btn-publish {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(105, 108, 255, 0.3);
            transition: all 0.2s;
        }

        .btn-publish:hover {
            background: #5f61e6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(105, 108, 255, 0.4);
        }

        .btn-cancel {
            border-radius: 10px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            color: #8592a3;
            border: 1px solid #d9dee3;
            text-decoration: none;
            display: inline-block;
        }

        .image-preview-placeholder {
            width: 100%;
            height: 250px;
            background: #f8f9fa;
            border: 2px dashed #d9dee3;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8592a3;
            margin-top: 10px;
            overflow: hidden;
        }

        .image-preview-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <aside class="sidebar shadow-sm">
        <div class="sidebar-brand">TastyAdmin.</div>
        
        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <i class='bx bx-home-circle'></i> Dashboard
        </a>
        <a href="{{ route('admin.berita.index') }}" class="menu-item active">
            <i class='bx bx-news'></i> Kelola Berita
        </a>
        <a href="{{ route('admin.galeri.index') }}" class="menu-item">
            <i class='bx bx-image-alt'></i> Kelola Galeri
        </a>
        
        <hr class="my-4 opacity-50">
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="menu-item w-100 border-0 bg-transparent text-danger">
                <i class='bx bx-log-out'></i> Logout
            </button>
        </form>
    </aside>

    <main class="main-content">
        <div class="mb-4">
            <a href="{{ route('admin.berita.index') }}" class="text-muted text-decoration-none small fw-medium">
                <i class='bx bx-chevron-left'></i> Kembali ke Daftar
            </a>
            <h4 class="fw-bold mt-2">Buat Berita Baru</h4>
            <p class="text-muted small">Isi formulir di bawah untuk mempublikasikan artikel makanan terbaru.</p>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card-form">
                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold">Judul Berita</label>
                            <input type="text" name="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror" placeholder="Contoh: 5 Resep Pasta Rumahan yang Simple" value="{{ old('judul') }}" required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Isi Konten Berita</label>
                            <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" rows="10" placeholder="Ceritakan detail berita di sini..." required>{{ old('konten') }}</textarea>
                            @error('konten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold">Unggah Foto Utama</label>
                            <input type="file" name="foto" id="fotoInput" class="form-control @error('foto') is-invalid @enderror" accept="image/*" required>
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            
                            <div class="image-preview-placeholder" id="imagePreview">
                                <div class="text-center" id="previewText">
                                    <i class='bx bx-image-add fs-1'></i>
                                    <p class="mb-0 small">Pratinjau gambar akan muncul setelah dipilih</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-publish px-5">Terbitkan Berita</button>
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-cancel">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-form border-start border-primary border-4">
                    <h6 class="fw-bold mb-3"><i class='bx bx-bulb text-warning me-2'></i>Tips Menulis</h6>
                    <ul class="text-muted small ps-3">
                        <li class="mb-2">Gunakan judul yang menarik agar pembaca penasaran.</li>
                        <li class="mb-2">Pastikan gambar fokus pada objek makanan (Food Porn).</li>
                        <li>Gunakan paragraf yang tidak terlalu panjang agar mudah dibaca di HP.</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Logika untuk menampilkan preview gambar secara instan
        document.getElementById('fotoInput').addEventListener('change', function(event) {
            const output = document.getElementById('imagePreview');
            const previewText = document.getElementById('previewText');
            
            const reader = new FileReader();
            reader.onload = function() {
                output.innerHTML = `<img src="${reader.result}" />`;
            };
            
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                output.innerHTML = `<div class="text-center" id="previewText">
                                    <i class='bx bx-image-add fs-1'></i>
                                    <p class="mb-0 small">Pratinjau gambar akan muncul setelah dipilih</p>
                                </div>`;
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>