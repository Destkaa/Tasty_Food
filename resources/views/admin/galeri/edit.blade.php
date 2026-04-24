<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto Galeri | Tasty Food</title>
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
            --dark-color: #233446;
            --bg-body: #f8f9fa;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Inter', sans-serif;
            color: var(--dark-color);
        }

        h4, h5, .sidebar-brand {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- Sidebar Style --- */
        .sidebar { 
            width: var(--sidebar-width); 
            height: 100vh; 
            position: fixed; 
            background: #ffffff; 
            border-right: 1px solid rgba(0,0,0,0.05); 
            padding: 1.5rem 1rem;
            z-index: 100;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -1px;
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
            font-weight: 500;
        }

        .menu-item i { 
            font-size: 1.4rem; 
            margin-right: 12px;
        }

        .menu-item:hover { 
            background: var(--primary-soft); 
            color: var(--primary-color); 
        }

        .menu-item.active { 
            background: var(--primary-color); 
            color: #fff; 
            box-shadow: 0 10px 15px -3px rgba(105, 108, 255, 0.3);
        }

        /* --- Main Content --- */
        .main-content { 
            margin-left: var(--sidebar-width); 
            padding: 2.5rem; 
        }

        .card-form {
            border-radius: 20px;
            border: none;
            background: #fff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            max-width: 600px;
        }

        .current-img-preview {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            border: 1px solid #eee;
        }

        .btn-update {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-update:hover {
            background: #5f61e6;
            color: white;
            box-shadow: 0 8px 15px rgba(105, 108, 255, 0.2);
        }
    </style>
</head>
<body>

    <aside class="sidebar shadow-sm">
        <div class="sidebar-brand">TastyAdmin.</div>
        
        <div class="menu-header" style="font-size: 0.75rem; font-weight: 700; color: #cbd5e0; padding: 1.5rem 1rem 0.5rem; text-transform: uppercase;">Main Menu</div>
        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <i class='bx bxs-dashboard'></i> Dashboard
        </a>
        <a href="{{ route('admin.berita.index') }}" class="menu-item">
            <i class='bx bx-news'></i> Kelola Berita
        </a>
        <a href="{{ route('admin.galeri.index') }}" class="menu-item active">
            <i class='bx bx-image-alt'></i> Kelola Galeri
        </a>
    </aside>

    <main class="main-content">
        <div class="mb-4">
            <a href="{{ route('admin.galeri.index') }}" class="text-decoration-none text-muted small fw-bold">
                <i class='bx bx-left-arrow-alt'></i> KEMBALI KE DAFTAR
            </a>
            <h4 class="fw-bold mt-2">Edit Foto Galeri</h4>
            <p class="text-muted">Ganti foto lama dengan foto makanan yang baru</p>
        </div>

        <div class="card card-form">
            <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label fw-bold d-block mb-3">Foto Saat Ini</label>
                    <img id="preview" src="{{ asset('storage/' . $galeri->foto) }}" class="current-img-preview shadow-sm" alt="Preview">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Pilih Foto Baru</label>
                    <input type="file" name="foto" class="form-control rounded-3 @error('foto') is-invalid @enderror" onchange="previewImage(this)" accept="image/*">
                    <small class="text-muted mt-2 d-block">Format: JPG, PNG, JPEG. Maks: 2MB</small>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-light rounded-3 px-4">Batal</a>
                    <button type="submit" class="btn btn-update">
                        <i class='bx bx-save me-1'></i> Update Foto
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>