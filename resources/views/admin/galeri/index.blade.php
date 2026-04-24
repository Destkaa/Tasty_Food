<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri | Tasty Food</title>
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

        h4, h5, .sidebar-brand { font-family: 'Plus Jakarta Sans', sans-serif; }

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

        .menu-item:hover { background: var(--primary-soft); color: var(--primary-color); }
        .menu-item.active { background: var(--primary-color); color: #fff; box-shadow: 0 10px 15px -3px rgba(105, 108, 255, 0.3); }

        /* --- Main Content --- */
        .main-content { margin-left: var(--sidebar-width); padding: 2.5rem; }

        .card-custom {
            border-radius: 20px;
            border: none;
            background: #fff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .img-preview {
            width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .btn-add {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.2s;
        }
    </style>
</head>
<body>

   @include('admin.partials.sidebar')

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold m-0">Kelola Galeri</h4>
                <p class="text-muted small m-0">Ganti atau hapus koleksi foto makanan Anda</p>
            </div>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahGaleri">
                <i class='bx bx-plus me-1'></i> Tambah Foto
            </button>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-2'></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card card-custom">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th>Preview Foto</th>
                            <th>Tanggal Upload</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galeris as $index => $g)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $g->foto) }}" class="img-preview shadow-sm" alt="Galeri">
                            </td>
                            <td><span class="text-muted small">{{ $g->created_at->format('d M Y') }}</span></td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn-action btn btn-outline-warning border" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEditGaleri"
                                            data-id="{{ $g->id }}"
                                            data-url="{{ route('admin.galeri.update', $g->id) }}"
                                            data-foto="{{ asset('storage/' . $g->foto) }}">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>

                                    <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn-action btn btn-outline-danger border">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada foto.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalTambahGaleri" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 20px;">
                <div class="modal-header border-0">
                    <h5 class="fw-bold">Unggah Foto Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="foto" class="form-control" required accept="image/*">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary rounded-3 px-4">Unggah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditGaleri" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 20px;">
                <div class="modal-header border-0">
                    <h5 class="fw-bold">Edit Foto Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEditGaleri" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-body text-center">
                        <div class="mb-3">
                            <p class="text-muted small">Foto Saat Ini:</p>
                            <img id="prevFoto" src="" class="img-thumbnail mb-3" style="max-height: 150px;">
                        </div>
                        <div class="text-start">
                            <label class="form-label fw-bold">Ganti Foto Baru</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted italic">*Kosongkan jika tidak ingin mengganti foto</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-warning rounded-3 px-4">Update Foto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Logika untuk mengisi data ke dalam Modal Edit secara otomatis
        const modalEdit = document.getElementById('modalEditGaleri');
        modalEdit.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const url = button.getAttribute('data-url');
            const fotoSrc = button.getAttribute('data-foto');

            const form = document.getElementById('formEditGaleri');
            const preview = document.getElementById('prevFoto');

            form.setAttribute('action', url);
            preview.setAttribute('src', fotoSrc);
        });
    </script>
</body>
</html>