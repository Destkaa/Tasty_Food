<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Tasty Food</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --sidebar-width: 280px;
            --primary: #696cff;
            --primary-soft: #eeeeff;
            --warning: #ffab00;
            --warning-soft: #fff8e6;
            --info: #03c3ec;
            --info-soft: #e0f9ff;
            --danger: #ff3e1d;
            --dark: #1e293b;
            --body-bg: #f1f5f9;
            --card-radius: 20px;
            --shadow: 0 4px 24px rgba(0,0,0,0.06);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--body-bg); font-family: 'Inter', sans-serif; color: var(--dark); }

        /* ===== LAYOUT ===== */
        .main-content { margin-left: var(--sidebar-width); padding: 2.5rem; min-height: 100vh; }
        @media (max-width: 992px) { .main-content { margin-left: 0; padding: 1.25rem; } }

        /* ===== WELCOME BANNER ===== */
        .welcome-banner {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%);
            border-radius: var(--card-radius);
            padding: 2.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(79, 70, 229, 0.3);
        }
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }
        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -80px; right: 80px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .welcome-banner .greeting { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.6rem; font-weight: 800; }
        .welcome-banner .sub { opacity: 0.75; font-size: 0.9rem; margin-top: 4px; }
        .clock-pill {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: 5px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: #fff;
            border-radius: var(--card-radius);
            padding: 1.6rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.04);
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px; height: 100%;
            border-radius: 0 4px 4px 0;
        }
        .stat-card.s-primary::after { background: var(--primary); }
        .stat-card.s-warning::after { background: var(--warning); }
        .stat-card.s-info::after { background: var(--info); }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); }

        .stat-icon {
            width: 56px; height: 56px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; flex-shrink: 0;
        }
        .stat-icon.primary { background: var(--primary-soft); color: var(--primary); }
        .stat-icon.warning { background: var(--warning-soft); color: var(--warning); }
        .stat-icon.info { background: var(--info-soft); color: var(--info); }

        .stat-label { font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; }
        .stat-value { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 2rem; font-weight: 800; color: var(--dark); line-height: 1.1; }
        .stat-desc { font-size: 0.75rem; color: #94a3b8; margin-top: 2px; }

        /* ===== QUICK ACTIONS ===== */
        .section-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1rem; font-weight: 700;
            color: var(--dark); margin-bottom: 1rem;
            display: flex; align-items: center; gap-8px;
        }
        .section-title span { color: #94a3b8; font-size: 0.8rem; font-weight: 500; margin-left: 8px; font-family: 'Inter', sans-serif; }

        .action-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        @media (max-width: 576px) { .action-grid { grid-template-columns: 1fr; } }

        .action-btn {
            display: flex; align-items: center; gap: 14px;
            padding: 1.2rem 1.4rem;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 700; font-size: 0.88rem;
            transition: all 0.25s ease;
            border: 2px solid transparent;
        }
        .action-btn:hover { transform: translateY(-3px); }
        .action-btn .action-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; flex-shrink: 0;
        }
        .action-btn.a-primary { background: var(--primary-soft); color: var(--primary); }
        .action-btn.a-primary:hover { background: var(--primary); color: #fff; border-color: var(--primary); }
        .action-btn.a-primary .action-icon { background: rgba(105,108,255,0.15); }

        .action-btn.a-warning { background: var(--warning-soft); color: #b37900; }
        .action-btn.a-warning:hover { background: var(--warning); color: #fff; border-color: var(--warning); }
        .action-btn.a-warning .action-icon { background: rgba(255,171,0,0.15); }

        .action-btn.a-info { background: var(--info-soft); color: #0284a0; }
        .action-btn.a-info:hover { background: var(--info); color: #fff; border-color: var(--info); }
        .action-btn.a-info .action-icon { background: rgba(3,195,236,0.15); }

        /* ===== TABLE CARD ===== */
        .table-card {
            background: #fff;
            border-radius: var(--card-radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .table-card-header {
            padding: 1.6rem 1.8rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;
        }
        .table-card-header h5 { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1rem; margin: 0; }
        .table-card-header p { margin: 0; font-size: 0.78rem; color: #94a3b8; }

        .table { margin: 0; }
        .table thead th {
            background: #f8fafc; color: #94a3b8;
            font-size: 0.72rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1px solid #f1f5f9; padding: 1rem 1.5rem;
        }
        .table tbody td { padding: 1rem 1.5rem; border-color: #f8fafc; vertical-align: middle; font-size: 0.875rem; }
        .table tbody tr:hover td { background: #fafbff; }

        .badge-tipe {
            padding: 5px 12px; border-radius: 8px;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.03em;
        }
        .badge-berita { background: #eff6ff; color: #2563eb; }
        .badge-galeri { background: #fffbeb; color: #d97706; }
        .badge-pesan { background: #faf5ff; color: #7c3aed; }

        .empty-state { text-align: center; padding: 4rem 2rem; color: #94a3b8; }
        .empty-state i { font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.4; }

        /* ===== BTN CLEAR ===== */
        .btn-clear {
            display: flex; align-items: center; gap: 6px;
            background: #fff1f0; color: var(--danger);
            border: none; border-radius: 50px;
            padding: 8px 18px; font-size: 0.8rem; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-clear:hover { background: var(--danger); color: #fff; }

        /* ===== WRAPPER CARDS ===== */
        .card-wrapper {
            background: #fff;
            border-radius: var(--card-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.04);
        }
    </style>
</head>
<body>

    @include('admin.partials.sidebar')

    <main class="main-content">

        <!-- Welcome Banner -->
        <div class="welcome-banner mb-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div style="position:relative;z-index:1;">
                    <div class="welcome-badge">
                        <i class='bx bxs-crown' style="font-size:0.9rem;"></i> Admin Panel
                    </div>
                    <div class="greeting">Halo, {{ Auth::user()->name }}! 👋</div>
                    <div class="sub">Selamat datang kembali — kelola konten Tasty Food kamu hari ini.</div>
                </div>
                <div class="clock-pill" style="position:relative;z-index:1;">
                    <i class='bx bx-time-five me-1'></i>
                    <span id="clock-display">...</span>
                </div>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="stat-card s-primary">
                    <div class="stat-icon primary"><i class='bx bx-news'></i></div>
                    <div>
                        <div class="stat-label">Berita Terbit</div>
                        <div class="stat-value">{{ \App\Models\Berita::count() }}</div>
                        <div class="stat-desc">Total artikel dipublikasi</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card s-warning">
                    <div class="stat-icon warning"><i class='bx bx-image-alt'></i></div>
                    <div>
                        <div class="stat-label">Total Galeri</div>
                        <div class="stat-value">{{ \App\Models\Galeri::count() }}</div>
                        <div class="stat-desc">Foto tersimpan di galeri</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card s-info">
                    <div class="stat-icon info"><i class='bx bx-envelope'></i></div>
                    <div>
                        <div class="stat-label">Pesan Masuk</div>
                        <div class="stat-value">{{ \App\Models\Kontak::count() }}</div>
                        <div class="stat-desc">Dari pengunjung website</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card-wrapper mb-4">
            <div class="section-title mb-3">
                <i class='bx bxs-zap me-2' style="color:var(--warning);font-size:1.1rem;"></i>
                Aksi Cepat
                <span>Pintasan ke fitur utama</span>
            </div>
            <div class="action-grid">
                <a href="{{ route('admin.berita.create') }}" class="action-btn a-primary">
                    <div class="action-icon"><i class='bx bx-plus'></i></div>
                    <div>
                        <div>Berita Baru</div>
                        <div style="font-size:0.72rem;opacity:0.7;font-weight:500;">Tulis & publikasikan</div>
                    </div>
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="action-btn a-warning">
                    <div class="action-icon"><i class='bx bx-upload'></i></div>
                    <div>
                        <div>Upload Foto</div>
                        <div style="font-size:0.72rem;opacity:0.7;font-weight:500;">Tambah ke galeri</div>
                    </div>
                </a>
                <a href="{{ route('admin.pesan.index') }}" class="action-btn a-info">
                    <div class="action-icon"><i class='bx bx-envelope'></i></div>
                    <div>
                        <div>Lihat Pesan</div>
                        <div style="font-size:0.72rem;opacity:0.7;font-weight:500;">Baca pesan masuk</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Activity Table -->
        <div class="table-card">
            <div class="table-card-header">
                <div>
                    <h5>Aktivitas Konten Terbaru</h5>
                    <p>Update otomatis dari database</p>
                </div>
                @if($histories->count() > 0)
                <form id="form-nuke" action="{{ route('admin.hapus_riwayat') }}" method="POST">
                    @csrf
                    <button type="button" onclick="confirmNuke()" class="btn-clear">
                        <i class='bx bx-trash'></i> Hapus Riwayat
                    </button>
                </form>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width:50%">Judul / Konten</th>
                            <th>Kategori</th>
                            <th class="text-end">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $log)
                        <tr>
                            <td>
                                <div class="fw-semibold text-dark" style="font-size:0.875rem;">{{ $log['judul'] }}</div>
                            </td>
                            <td>
                                <span class="badge-tipe {{ $log['tipe'] == 'Berita' ? 'badge-berita' : ($log['tipe'] == 'Galeri' ? 'badge-galeri' : 'badge-pesan') }}">
                                    {{ $log['tipe'] }}
                                </span>
                            </td>
                            <td class="text-end" style="color:#94a3b8;font-size:0.78rem;">
                                <i class='bx bx-time-five me-1'></i>{{ $log['waktu']->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <i class='bx bx-inbox'></i>
                                    <div style="font-weight:600;color:#64748b;">Belum ada aktivitas</div>
                                    <div style="font-size:0.8rem;margin-top:4px;">Aktivitas konten akan muncul di sini</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Realtime Clock
        function updateClock() {
            const now = new Date();
            const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('clock-display').innerText = now.toLocaleDateString('id-ID', options);
        }
        setInterval(updateClock, 1000);
        updateClock();

        // SweetAlert Konfirmasi Hapus
        function confirmNuke() {
            Swal.fire({
                title: 'Kosongkan Riwayat?',
                text: "Data log akan dihapus, tapi data asli (Berita/Foto) tetap aman!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff3e1d',
                cancelButtonColor: '#696cff',
                confirmButtonText: 'Ya, Bersihkan!',
                cancelButtonText: 'Batal',
                borderRadius: '16px'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Membersihkan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } });
                    document.getElementById('form-nuke').submit();
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    </script>
</body>
</html>