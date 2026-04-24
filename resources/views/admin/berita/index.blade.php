<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita | Tasty Food</title>
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

        .card-table {
            border-radius: 20px;
            border: none;
            background: #fff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8fafc;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #94a3b8;
            padding: 1.2rem 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .img-news {
            width: 80px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-add {
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            background: var(--primary-color);
            border: none;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 10px rgba(105, 108, 255, 0.3);
        }

        .btn-add:hover {
            background: #5f61e6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(105, 108, 255, 0.4);
        }
    </style>
</head>
<body>

   @include('admin.partials.sidebar')

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Berita</h4>
                <p class="text-muted small mb-0">Tulis, ubah, dan hapus berita makanan terbaru Anda.</p>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-add">
                <i class='bx bx-plus-circle me-2'></i> Buat Berita Baru
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-2'></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card card-table">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Gambar</th>
                            <th>Judul Berita</th>
                            <th>Tanggal Terbit</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beritas as $item)
                        <tr>
                            <td class="ps-4">
                                <img src="{{ asset('storage/'.$item->foto) }}" class="img-news" alt="foto">
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ Str::limit($item->judul, 60) }}</div>
                                <div class="text-muted small">ID: #{{ $item->id }}</div>
                            </td>
                            <td>
                                <div class="text-dark small fw-medium">
                                    <i class='bx bx-calendar me-1 text-muted'></i> {{ $item->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn-action btn btn-outline-warning" title="Ubah Berita">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn btn-outline-danger" title="Hapus Berita">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class='bx bx-info-circle fs-2 d-block mb-2'></i>
                                Belum ada data berita yang ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>