<style>
    :root {
        --sidebar-width: 280px;
        --primary-color: #534AB7;
        --primary-soft: #EEEDFE;
        --primary-hover: #3C3489;
        --text-muted: #718096;
        --nav-hover: #f5f5f9;
        --transition-speed: 0.3s;
    }

    body.dark-mode .sidebar {
        background: #2b2c40 !important;
        border-right-color: #3e3f57;
    }
    body.dark-mode .menu-header { color: #5a5b75; }
    body.dark-mode .menu-item { color: #a3a4cc; }
    body.dark-mode .menu-item:hover { background: rgba(83,74,183,0.15); color: #8b87e6; }
    body.dark-mode .sidebar-brand { color: #fff; }
    body.dark-mode .sidebar-footer { border-color: rgba(255,255,255,0.06); }
    body.dark-mode .profile-card {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.06);
    }
    body.dark-mode .profile-name { color: #e2e8f0; }
    body.dark-mode .profile-role { color: #5a5b75; }

    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        background: #ffffff;
        border-right: 1px solid rgba(0,0,0,0.06);
        padding: 1.5rem 1.2rem;
        z-index: 1000;
        transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .sidebar-brand {
        font-family: 'Sora', 'Plus Jakarta Sans', sans-serif;
        font-size: 1.4rem;
        font-weight: 800;
        padding: 0.5rem 1rem 2.5rem;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: -0.5px;
        text-decoration: none !important;
    }
    .sidebar-brand .brand-icon {
        background: var(--primary-color);
        color: white;
        width: 38px; height: 38px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        box-shadow: 0 4px 12px rgba(83,74,183,0.3);
        flex-shrink: 0;
    }

    .menu-container {
        flex-grow: 1;
        overflow-y: auto;
        padding-right: 4px;
    }
    .menu-container::-webkit-scrollbar { width: 3px; }
    .menu-container::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

    .menu-header {
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #cbd5e0;
        padding: 1.2rem 1rem 0.5rem;
        letter-spacing: 1.2px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: var(--text-muted);
        text-decoration: none !important;
        border-radius: 10px;
        margin-bottom: 2px;
        transition: all 0.2s ease;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        gap: 10px;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
    }
    .menu-item i { font-size: 1.15rem; flex-shrink: 0; }
    .menu-item:hover {
        background: var(--primary-soft);
        color: var(--primary-color);
        transform: translateX(3px);
    }
    .menu-item.active {
        background: var(--primary-color) !important;
        color: #fff !important;
        box-shadow: 0 4px 14px rgba(83,74,183,0.28);
    }
    .menu-item.active i { color: #fff; }

    /* Profile nav item khusus — di luar menu-container */
    .menu-item-profile {
        margin: 0.5rem 0;
    }

    /* ===== SIDEBAR FOOTER ===== */
    .sidebar-footer {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    .profile-card {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.75rem 0.9rem;
        border-radius: 12px;
        background: #fafafa;
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 0.5rem;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .profile-card:hover {
        background: var(--primary-soft);
        border-color: rgba(83,74,183,0.2);
    }

    /* Avatar — tampilkan foto jika ada, inisial jika tidak */
    .profile-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #7F77DD, #a855f7);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
        overflow: hidden;
        box-shadow: 0 3px 8px rgba(83,74,183,0.22);
    }
    .profile-avatar img {
        width: 100%; height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .profile-info { flex: 1; min-width: 0; }
    .profile-name {
        font-size: 0.8rem;
        font-weight: 700;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-family: 'Sora', sans-serif;
    }
    .profile-role {
        font-size: 0.68rem;
        color: #94a3b8;
        margin-top: 1px;
        font-weight: 500;
    }

    .profile-badge {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #22c55e;
        flex-shrink: 0;
        box-shadow: 0 0 0 2px rgba(34,197,94,0.2);
        animation: pulse-green 2s infinite;
    }

    @keyframes pulse-green {
        0%, 100% { box-shadow: 0 0 0 2px rgba(34,197,94,0.2); }
        50% { box-shadow: 0 0 0 5px rgba(34,197,94,0.08); }
    }

    .logout-item {
        color: #c0143c !important;
        background: rgba(192,20,60,0.04) !important;
        border: 1px solid rgba(192,20,60,0.08) !important;
    }
    .logout-item:hover {
        background: #c0143c !important;
        color: #fff !important;
        border-color: #c0143c !important;
        box-shadow: 0 4px 14px rgba(192,20,60,0.2);
        transform: translateX(3px);
    }
    .logout-item i { color: inherit; }

    @media (max-width: 992px) {
        .sidebar { left: -100%; box-shadow: 15px 0 30px rgba(0,0,0,0.08); }
        .sidebar.active { left: 0; }
    }
</style>

<aside class="sidebar">
    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="brand-icon">
            <i class='bx bxs-food-menu'></i>
        </div>
        <span>Tasty Food</span>
    </a>

    {{-- Menu utama --}}
    <div class="menu-container">
        <div class="menu-header">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}"
           class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
        </a>

        <div class="menu-header">Manajemen Konten</div>

        <a href="{{ route('admin.berita.index') }}"
           class="menu-item {{ request()->segment(2) == 'berita' ? 'active' : '' }}">
            <i class='bx bx-news'></i>
            <span>Berita</span>
        </a>

        <a href="{{ route('admin.galeri.index') }}"
           class="menu-item {{ request()->segment(2) == 'galeri' ? 'active' : '' }}">
            <i class='bx bx-image-alt'></i>
            <span>Galeri</span>
        </a>

        <a href="{{ route('admin.pesan.index') }}"
           class="menu-item {{ request()->segment(2) == 'pesan' ? 'active' : '' }}">
            <i class='bx bx-envelope'></i>
            <span>Pesan Masuk</span>
        </a>

        <div class="menu-header">Situs</div>

        <a href="{{ route('home') }}" target="_blank" class="menu-item">
            <i class='bx bx-globe'></i>
            <span>Lihat Website</span>
        </a>
    </div>
    
        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="menu-item logout-item">
                <i class='bx bx-log-out-circle'></i>
                <span>Keluar Aplikasi</span>
            </button>
        </form>

    </div>
</aside>