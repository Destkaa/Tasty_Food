<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Tasty Food</title>
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

        /* --- Sidebar CSS (Tetap di sini untuk layouting) --- */
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
            border-radius: 12px; 
            margin-bottom: 0.4rem; 
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .menu-item i { font-size: 1.4rem; margin-right: 12px; }
        .menu-item:hover { background: var(--primary-soft); color: var(--primary-color); }
        .menu-item.active { 
            background: var(--primary-color); 
            color: #fff; 
            box-shadow: 0 8px 15px rgba(105, 108, 255, 0.3);
        }

        .menu-header {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #cbd5e0;
            padding: 1.5rem 1rem 0.5rem;
        }

        /* --- Main Content --- */
        .main-content { margin-left: var(--sidebar-width); padding: 2.5rem; }

        .welcome-card {
            background: linear-gradient(135deg, #696cff 0%, #8e91ff 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 10px 20px rgba(105, 108, 255, 0.2);
        }

        #realtime-clock {
            background: rgba(255,255,255,0.2);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .stat-card {
            background: #fff;
            border-radius: 18px;
            padding: 1.5rem;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .bg-light-primary { background: #e7e7ff; color: #696cff; }
        .bg-light-warning { background: #fff2d6; color: #ffab00; }
        .bg-light-info { background: #d7f5fc; color: #03c3ec; }

        .card-history {
            border-radius: 20px;
            border: none;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 1.5rem;
        }

        .btn-clear-history {
            color: #ff3e1d;
            background: #ffe5e0;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 50px; 
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-clear-history:hover { 
            background: #ff3e1d; 
            color: #fff; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 62, 29, 0.3);
        }

        .badge-berita { background: #e0f2fe; color: #0ea5e9; font-weight: 600; border-radius: 6px; padding: 0.5em 0.8em; }
        .badge-galeri { background: #fef3c7; color: #d97706; font-weight: 600; border-radius: 6px; padding: 0.5em 0.8em; }
        .badge-pesan  { background: #f3e8ff; color: #7e22ce; font-weight: 600; border-radius: 6px; padding: 0.5em 0.8em; }

        .logout-btn { background: #fff5f5; color: #f56565; margin-top: 1rem; transition: 0.2s; }
        .logout-btn:hover { background: #f56565; color: #fff; }
    </style>
</head>
<body>

    @include('admin.partials.sidebar')

    <main class="main-content">
        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class='bx bx-check-circle me-2'></i> {{ session('success') }}
        </div>
        @endif

        <div class="welcome-card mb-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4 class="fw-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h4>
                    <p class="mb-0 opacity-75">Pantau semua aktivitas konten dan pesan masuk hari ini secara real-time.</p>
                </div>
                <div id="realtime-clock">
                    <i class='bx bx-time-five me-1'></i> <span id="clock-display">...</span>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-light-primary"><i class='bx bx-news'></i></div>
                    <div>
                        <small class="text-muted d-block">Total Berita</small>
                        <h4 class="fw-bold m-0">{{ \App\Models\Berita::count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-light-warning"><i class='bx bx-image-alt'></i></div>
                    <div>
                        <small class="text-muted d-block">Foto Galeri</small>
                        <h4 class="fw-bold m-0">{{ \App\Models\Galeri::count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-light-info"><i class='bx bx-envelope'></i></div>
                    <div>
                        <small class="text-muted d-block">Pesan Inbox</small>
                        <h4 class="fw-bold m-0">{{ \App\Models\Kontak::count() }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; background: #fff;">
                    <h6 class="fw-bold mb-3"><i class='bx bxs-zap text-warning me-1'></i> Aksi Cepat</h6>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class='bx bx-plus me-1'></i> Berita Baru
                        </a>
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-warning text-white rounded-pill px-4">
                            <i class='bx bx-upload me-1'></i> Upload Foto
                        </a>
                        <a href="{{ route('admin.pesan.index') }}" class="btn btn-info text-white rounded-pill px-4">
                            <i class='bx bx-envelope me-1'></i> Cek Pesan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-history">
            <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                <div>
                    <h5 class="fw-bold m-0 text-dark">Log Aktivitas Terbaru</h5>
                    <p class="text-muted small m-0">Menampilkan 10 data terbaru</p>
                </div>

                @if($histories->count() > 0)
                <form action="{{ route('admin.hapus_riwayat') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data konten?')">
                    @csrf
                    <button type="submit" class="btn-clear-history">
                        <i class='bx bx-trash'></i> Kosongkan Semua
                    </button>
                </form>
                @endif
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Aktivitas</th>
                            <th>Kategori</th>
                            <th class="text-end">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $log)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        @if($log['tipe'] == 'Berita')
                                            <i class='bx bx-file-blank fs-4 text-primary'></i>
                                        @elseif($log['tipe'] == 'Galeri')
                                            <i class='bx bx-image fs-4 text-warning'></i>
                                        @else
                                            <i class='bx bx-envelope fs-4' style="color: #7e22ce;"></i>
                                        @endif
                                    </div>
                                    <span class="fw-semibold text-dark">{{ $log['judul'] }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $badge = 'badge-pesan';
                                    if($log['tipe'] == 'Berita') $badge = 'badge-berita';
                                    if($log['tipe'] == 'Galeri') $badge = 'badge-galeri';
                                @endphp
                                <span class="badge {{ $badge }}">{{ $log['tipe'] }}</span>
                            </td>
                            <td class="text-end text-muted small">
                                <i class='bx bx-time-five me-1'></i>{{ $log['waktu']->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted small italic">Tidak ada aktivitas terdeteksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateClock() {
            const now = new Date();
            const opt = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('clock-display').innerText = now.toLocaleDateString('id-ID', opt);
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>