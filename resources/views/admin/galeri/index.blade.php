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
            box-shadow: 0 4px 10px rgba(105, 108, 255, 0.3);
            transition: 0.3s;
        }
        .btn-add:hover { background: #5f61e6; color: white; transform: translateY(-2px); }

        /* --- Style Baru untuk Dropzone Unggah --- */
        .upload-container {
            border: 2px dashed #d9dee3;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fcfcfd;
            position: relative;
        }

        .upload-container:hover {
            border-color: var(--primary-color);
            background: var(--primary-soft);
        }

        .upload-container i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .upload-container input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .preview-wrapper {
            display: none;
            margin-top: 1rem;
            position: relative;
        }

        .preview-wrapper img {
            max-width: 100%;
            border-radius: 12px;
            max-height: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: 0.2s;
        }
    </style>
</head>
<body>

    @include('admin.partials.sidebar')

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold m-0 text-dark">Kelola Galeri</h4>
                <p class="text-muted small m-0">Ganti atau hapus koleksi foto makanan Anda</p>
            </div>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahGaleri">
                <i class='bx bx-plus-circle me-1'></i> Tambah Foto
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
                            <td colspan="4" class="text-center py-5 text-muted italic">Belum ada foto.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalTambahGaleri" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 25px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold px-2 pt-2">Unggah Foto Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="upload-container" id="dropzone">
                            <i class='bx bxs-cloud-upload'></i>
                            <h6 class="fw-bold mb-1">Klik atau seret foto ke sini</h6>
                            <p class="text-muted small mb-0">Format JPG, PNG atau WebP (Maks. 2MB)</p>
                            <input type="file" name="foto" id="fileInput" required accept="image/*">
                        </div>
                        
                        <div class="preview-wrapper text-center" id="previewWrapper">
                            <img src="" id="imagePreview" alt="Preview">
                            <p class="text-primary small fw-bold mt-2 cursor-pointer" id="changeImage">Ganti Foto</p>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm fw-bold">Mulai Unggah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditGaleri" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 25px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold px-2 pt-2">Edit Foto Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEditGaleri" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-4 text-center">
                            <label class="d-block text-muted small mb-2">Foto Saat Ini:</label>
                            <img id="prevFoto" src="" class="img-thumbnail border-0 shadow-sm" style="max-height: 150px; border-radius: 12px;">
                        </div>
                        <div class="upload-container">
                            <i class='bx bx-refresh'></i>
                            <h6 class="fw-bold mb-1">Pilih foto pengganti</h6>
                            <p class="text-muted small mb-0">Biarkan kosong jika tidak ingin ganti</p>
                            <input type="file" name="foto" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-warning text-dark rounded-3 px-4 fw-bold w-100">Update Galeri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Logika Preview Foto untuk Modal Tambah
        const fileInput = document.getElementById('fileInput');
        const dropzone = document.getElementById('dropzone');
        const previewWrapper = document.getElementById('previewWrapper');
        const imagePreview = document.getElementById('imagePreview');
        const changeImage = document.getElementById('changeImage');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    dropzone.style.display = 'none';
                    previewWrapper.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        changeImage.addEventListener('click', () => {
            fileInput.value = '';
            dropzone.style.display = 'block';
            previewWrapper.style.display = 'none';
        });

        // Logika Modal Edit
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