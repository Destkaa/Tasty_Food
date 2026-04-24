<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Masuk | Tasty Food</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Samakan dengan style dashboard kamu sebelumnya */
        :root { --sidebar-width: 280px; --primary-color: #696cff; --primary-soft: #e7e7ff; --dark-color: #233446; --bg-body: #f8f9fa; }
        body { background-color: var(--bg-body); font-family: 'Inter', sans-serif; color: var(--dark-color); }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; background: #fff; border-right: 1px solid rgba(0,0,0,0.05); padding: 1.5rem 1rem; z-index: 100; }
        .sidebar-brand { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 800; color: var(--primary-color); padding: 0 1rem 2rem; }
        .menu-item { display: flex; align-items: center; padding: 0.8rem 1rem; color: #718096; text-decoration: none; border-radius: 10px; margin-bottom: 0.4rem; transition: all 0.2s; font-weight: 500; }
        .menu-item i { font-size: 1.4rem; margin-right: 12px; }
        .menu-item:hover { background: var(--primary-soft); color: var(--primary-color); }
        .menu-item.active { background: var(--primary-color); color: #fff; box-shadow: 0 10px 15px -3px rgba(105, 108, 255, 0.3); }
        .main-content { margin-left: var(--sidebar-width); padding: 2.5rem; }
        .card-custom { border-radius: 20px; border: none; background: #fff; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); padding: 1.5rem; }
        .badge-email { background: #e0f2fe; color: #0ea5e9; font-weight: 600; border-radius: 6px; padding: 0.5em 0.8em; font-size: 0.75rem; }
        .btn-delete { color: #ff3e1d; background: #ffe5e0; border: none; padding: 0.5rem; border-radius: 8px; transition: 0.2s; }
        .btn-delete:hover { background: #ff3e1d; color: #fff; }
    </style>
</head>
<body>

    @include('admin.partials.sidebar')

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Pesan Masuk</h4>
                <p class="text-muted small mb-0">Daftar pertanyaan dan masukan dari pengunjung website</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class='bx bx-check-circle me-2'></i> {{ session('success') }}
        </div>
        @endif

        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-3">Pengirim</th>
                            <th class="border-0">Subjek</th>
                            <th class="border-0">Isi Pesan</th>
                            <th class="border-0">Waktu</th>
                            <th class="border-0 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesans as $p)
                        <tr>
                            <td class="px-3">
                                <div class="fw-bold text-dark">{{ $p->nama }}</div>
                                <div class="badge-email mt-1">{{ $p->email }}</div>
                            </td>
                            <td><span class="fw-semibold text-primary">{{ $p->subjek }}</span></td>
                            <td>
                                <p class="mb-0 small text-muted" style="max-width: 300px; white-space: normal;">
                                    {{ $p->pesan }}
                                </p>
                            </td>
                            <td class="small text-muted">{{ $p->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.pesan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class='bx bx-envelope-open fs-1 opacity-25'></i>
                                <p class="mt-2">Belum ada pesan yang masuk.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>