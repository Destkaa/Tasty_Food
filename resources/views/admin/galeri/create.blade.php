<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto Galeri | Tasty Food</title>
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
            max-width: 700px;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .drop-zone {
            border: 2px dashed #d9dee3;
            border-radius: 15px;
            padding: 3rem;
            text-align: center;
            transition: 0.3s;
            cursor: pointer;
            background: #fcfcfd;
        }

        .drop-zone:hover {
            border-color: var(--primary-color);
            background: var(--primary-soft);
        }

        .btn-save {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-save:hover {
            background: #5f61e6;
            color: white;
            box-shadow: 0 8px 15px rgba(105, 108, 255, 0.2);
        }
    </style>
</head>
<body>

     @include('admin.partials.sidebar')


    <main class="main-content">
        <div class="mb-4">
            <a href="{{ route('admin.galeri.index') }}" class="text-decoration-none text-muted small fw-bold">
                <i class='bx bx-left-arrow-alt'></i> KEMBALI KE DAFTAR
            </a>
            <h4 class="fw-bold mt-2">Tambah Koleksi Galeri</h4>
            <p class="text-muted">Unggah foto makanan terbaru untuk ditampilkan di website</p>
        </div>

        <div class="card card-form">
            <form action="{{ route('admin.galeri.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4 text-center">
                    <label for="foto" class="form-label d-block text-start">Unggah Foto</label>
                    <div class="drop-zone" onclick="document.getElementById('foto').click()">
                        <i class='bx bx-cloud-upload fs-1 text-primary mb-2'></i>
                        <h6 class="fw-bold">Klik atau seret gambar ke sini</h6>
                        <p class="text-muted small mb-0">Hanya file JPG, PNG, atau JPEG (Maks. 2MB)</p>
                        <input type="file" name="foto" id="foto" class="d-none" required accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div id="image-preview-container" class="mt-3 d-none">
                        <img id="preview" src="#" alt="Preview" class="img-fluid rounded-3 shadow-sm" style="max-height: 250px;">
                    </div>
                    @error('foto')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-5">
                    <span class="text-muted small"><i class='bx bx-info-circle'></i> Foto akan langsung dipublikasikan.</span>
                    <button type="submit" class="btn btn-save">
                        <i class='bx bx-upload me-1'></i> Unggah Foto
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const container = document.getElementById('image-preview-container');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>