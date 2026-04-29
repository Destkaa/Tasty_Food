<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita | Tasty Food</title>
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
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #d9dee3;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25 hide rgba(105, 108, 255, 0.1);
        }

        .current-img-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid #eee;
            margin-bottom: 1rem;
        }

        .btn-update {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 2.5rem;
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

     @include('admin.partials.sidebar')


    <main class="main-content">
        <div class="mb-4">
            <a href="{{ route('admin.berita.index') }}" class="text-decoration-none text-muted small fw-bold">
                <i class='bx bx-left-arrow-alt'></i> KEMBALI KE DAFTAR
            </a>
            <h4 class="fw-bold mt-2">Edit Berita</h4>
            <p class="text-muted">Perbarui informasi berita "{{ $berita->judul }}"</p>
        </div>

        <div class="card card-form shadow-sm">
            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label class="form-label">Judul Berita</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}" placeholder="Masukkan judul menarik..." required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Konten Berita</label>
                            <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" rows="10" placeholder="Tulis isi berita secara detail..." required>{{ old('konten', $berita->konten) }}</textarea>
                            @error('konten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-4">
                            <label class="form-label">Foto Saat Ini</label>
                            <div class="current-img-box text-center">
                                <img src="{{ asset('storage/' . $berita->foto) }}" class="img-fluid rounded-3 shadow-sm mb-2" id="img-preview" alt="Foto Berita">
                                <p class="text-muted x-small m-0" style="font-size: 0.7rem;">Foto aktif digunakan</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Ganti Foto (Opsional)</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewImage(this)" accept="image/*">
                            <small class="text-muted mt-2 d-block">Biarkan kosong jika tidak ingin mengganti foto.</small>
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="alert alert-info border-0 rounded-4 p-3 mt-4">
                            <div class="d-flex">
                                <i class='bx bx-info-circle fs-4 me-2'></i>
                                <span class="small">Perubahan akan langsung terlihat di halaman publik setelah Anda menekan tombol simpan.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 opacity-25">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-light px-4 rounded-3">Batal</a>
                    <button type="submit" class="btn btn-update">
                        <i class='bx bx-save me-1'></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Fitur untuk preview gambar saat dipilih
        function previewImage(input) {
            const preview = document.getElementById('img-preview');
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