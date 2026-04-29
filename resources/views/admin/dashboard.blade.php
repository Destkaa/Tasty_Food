<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Tasty Food</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-color: #696cff;
            --primary-soft: #e7e7ff;
            --dark-color: #233446;
            --bg-body: #f8f9fa;
        }
        body { background-color: var(--bg-body); font-family: 'Inter', sans-serif; color: var(--dark-color); margin: 0; }
        
        /* Layouting */
        .main-content { margin-left: var(--sidebar-width); padding: 2.5rem; min-height: 100vh; }
        
        @media (max-width: 992px) {
            .main-content { margin-left: 0; padding: 1.5rem; }
        }

        /* Cards & Components */
        .welcome-card {
            background: linear-gradient(135deg, #696cff 0%, #8e91ff 100%);
            color: white; padding: 2.5rem; border-radius: 24px;
            box-shadow: 0 10px 20px rgba(105, 108, 255, 0.2);
        }
        #realtime-clock { background: rgba(255,255,255,0.2); padding: 8px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; }
        
        .stat-card { background: #fff; border-radius: 18px; padding: 1.5rem; display: flex; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.03); transition: transform 0.3s ease; }
        .stat-card:hover { transform: translateY(-5px); }
        
        .stat-icon { width: 54px; height: 54px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-right: 15px; }
        .bg-light-primary { background: #e7e7ff; color: #696cff; }
        .bg-light-warning { background: #fff2d6; color: #ffab00; }
        .bg-light-info { background: #d7f5fc; color: #03c3ec; }
        
        .action-card { border-radius: 24px; background: #fff; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.03); padding: 1.5rem; }
        
        .card-history { border-radius: 24px; border: none; background: #fff; box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04); padding: 2rem; }
        .btn-clear-history { color: #ff3e1d; background: #ffe5e0; border: none; padding: 0.7rem 1.6rem; border-radius: 50px; font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .btn-clear-history:hover { background: #ff3e1d; color: #fff; }
        
        .badge-berita { background: #e0f2fe; color: #0ea5e9; font-weight: 600; border-radius: 8px; padding: 0.6em 1em; }
        .badge-galeri { background: #fef3c7; color: #d97706; font-weight: 600; border-radius: 8px; padding: 0.6em 1em; }
        .badge-pesan { background: #f3e8ff; color: #7e22ce; font-weight: 600; border-radius: 8px; padding: 0.6em 1em; }
    </style>
</head>
<body>

    @include('admin.partials.sidebar')

    <main class="main-content">
        <div class="welcome-card mb-4 animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h4>
                    <p class="mb-0 opacity-75">Kelola konten kuliner Tasty Food kamu hari ini.</p>
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
                    <div><small class="text-muted d-block fw-medium">Berita Terbit</small><h4 class="fw-bold m-0">{{ \App\Models\Berita::count() }}</h4></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-light-warning"><i class='bx bx-image-alt'></i></div>
                    <div><small class="text-muted d-block fw-medium">Total Galeri</small><h4 class="fw-bold m-0">{{ \App\Models\Galeri::count() }}</h4></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-light-info"><i class='bx bx-envelope'></i></div>
                    <div><small class="text-muted d-block fw-medium">Pesan Masuk</small><h4 class="fw-bold m-0">{{ \App\Models\Kontak::count() }}</h4></div>
                </div>
            </div>
        </div>

        <div class="action-card mb-4 animate__animated animate__fadeInUp">
            <h6 class="fw-bold mb-3 text-uppercase small text-muted" style="letter-spacing: 1px;">
                <i class='bx bxs-zap text-warning me-1'></i> Aksi Cepat
            </h6>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class='bx bx-plus me-1'></i> Berita Baru
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-warning text-white rounded-pill px-4 shadow-sm">
                    <i class='bx bx-upload me-1'></i> Upload Foto
                </a>
                <a href="{{ route('admin.pesan.index') }}" class="btn btn-info text-white rounded-pill px-4 shadow-sm">
                    <i class='bx bx-envelope me-1'></i> Lihat Pesan
                </a>
            </div>
        </div>

        <div class="card card-history animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h5 class="fw-bold m-0">Aktivitas Konten Terbaru</h5>
                    <p class="text-muted small m-0 italic">Update otomatis dari database</p>
                </div>
                @if($histories->count() > 0)
                <form id="form-nuke" action="{{ route('admin.hapus_riwayat') }}" method="POST">
                    @csrf
                    <button type="button" onclick="confirmNuke()" class="btn-clear-history" data-bs-toggle="tooltip" title="Hapus riwayat">
                        <i class='bx bx-trash'></i> Hapus Riwayat
                    </button>
                </form>
                @endif
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="50%">Judul/Konten</th>
                            <th>Kategori</th>
                            <th class="text-end">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $log)
                        <tr>
                            <td><span class="fw-semibold text-dark">{{ $log['judul'] }}</span></td>
                            <td>
                                <span class="badge {{ $log['tipe'] == 'Berita' ? 'badge-berita' : ($log['tipe'] == 'Galeri' ? 'badge-galeri' : 'badge-pesan') }}">
                                    {{ $log['tipe'] }}
                                </span>
                            </td>
                            <td class="text-end text-muted small">
                                <i class='bx bx-time-five me-1'></i>{{ $log['waktu']->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted italic">
                                <i class='bx bx-info-circle fs-2 d-block mb-2'></i>
                                Belum ada aktivitas yang tercatat.
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

        // Inisialisasi Tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

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
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Membersihkan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } });
                    document.getElementById('form-nuke').submit();
                }
            })
        }

        // Notifikasi Sukses dari Laravel Session
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