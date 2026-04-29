<style>
    :root {
        --sidebar-width: 280px;
        --primary-color: #696cff;
        --primary-soft: #e7e7ff;
        --dark-bg: #ffffff;
        --text-muted: #718096;
        --nav-hover: #f5f5f9;
        --transition-speed: 0.3s;
    }

    /* --- Dark Mode Compatibility --- */
    body.dark-mode .sidebar {
        background: #2b2c40 !important;
        border-right-color: #3e3f57;
    }
    body.dark-mode .menu-header { 
        color: #5a5b75; 
    }
    body.dark-mode .menu-item { 
        color: #a3a4cc; 
    }
    body.dark-mode .menu-item:hover { 
        background: rgba(105, 108, 255, 0.1); 
        color: #696cff; 
    }
    body.dark-mode .sidebar-brand {
        color: #fff;
    }

    /* --- Sidebar Core Style --- */
    .sidebar { 
        width: var(--sidebar-width); 
        height: 100vh; 
        position: fixed; 
        left: 0; 
        top: 0;
        background: var(--dark-bg); 
        border-right: 1px solid rgba(0,0,0,0.05); 
        padding: 1.5rem 1.2rem;
        z-index: 1000;
        transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    /* --- Brand Section --- */
    .sidebar-brand {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        padding: 0.5rem 1rem 2.5rem;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: -0.5px;
        text-decoration: none !important;
    }

    .sidebar-brand i {
        background: var(--primary-color);
        color: white;
        padding: 8px;
        border-radius: 12px;
        font-size: 1.4rem;
        box-shadow: 0 4px 10px rgba(105, 108, 255, 0.3);
    }

    /* --- Menu Section --- */
    .menu-container {
        flex-grow: 1;
        overflow-y: auto;
        padding-right: 5px;
    }

    /* Custom Scrollbar for Menu */
    .menu-container::-webkit-scrollbar { width: 4px; }
    .menu-container::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }

    .menu-header {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #cbd5e0;
        padding: 1.2rem 1rem 0.6rem;
        letter-spacing: 1.2px;
    }

    .menu-item { 
        display: flex; 
        align-items: center; 
        padding: 0.9rem 1.1rem; 
        color: var(--text-muted); 
        text-decoration: none !important; 
        border-radius: 12px; 
        margin-bottom: 0.5rem; 
        transition: all 0.25s ease;
        font-weight: 500;
        cursor: pointer;
    }

    .menu-item i { 
        font-size: 1.3rem; 
        margin-right: 12px; 
    }
    
    .menu-item:hover { 
        background: var(--primary-soft); 
        color: var(--primary-color);
        transform: translateX(5px);
    }

    .menu-item.active { 
        background: var(--primary-color) !important; 
        color: #fff !important; 
        box-shadow: 0 8px 16px rgba(105, 108, 255, 0.25);
    }

    .menu-item.active i { color: #fff; }

    /* --- Footer / Logout Section --- */
    .sidebar-footer {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    .logout-item {
        color: #ff3e1d !important;
        background: rgba(255, 62, 29, 0.05);
        border: none;
        width: 100%;
        text-align: left;
    }

    .logout-item:hover {
        background: #ff3e1d !important;
        color: #fff !important;
        box-shadow: 0 8px 16px rgba(255, 62, 29, 0.2);
        transform: translateX(5px);
    }

    /* --- Responsive --- */
    @media (max-width: 992px) {
        .sidebar { 
            left: -100%; 
            box-shadow: 15px 0 30px rgba(0,0,0,0.1); 
        }
        .sidebar.active { 
            left: 0; 
        }
    }
</style>

<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <i class='bx bxs-food-menu'></i>
        <span>Tasty Food</span>
    </a>

    <div class="menu-container">
        <div class="menu-header">Menu Utama</div>
        
        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
        </a>

        <div class="menu-header">Manajemen Konten</div>

        <a href="{{ route('admin.berita.index') }}" class="menu-item {{ request()->segment(2) == 'berita' ? 'active' : '' }}">
            <i class='bx bx-news'></i>
            <span>Berita</span>
        </a>

        <a href="{{ route('admin.galeri.index') }}" class="menu-item {{ request()->segment(2) == 'galeri' ? 'active' : '' }}">
            <i class='bx bx-image-alt'></i>
            <span>Galeri</span>
        </a>

        <a href="{{ route('admin.pesan.index') }}" class="menu-item {{ request()->segment(2) == 'pesan' ? 'active' : '' }}">
            <i class='bx bx-envelope'></i>
            <span>Pesan Masuk</span>
        </a>

        <div class="menu-header">Situs</div>
        
        <a href="{{ route('home') }}" target="_blank" class="menu-item">
            <i class='bx bx-globe'></i>
            <span>Lihat Website</span>
        </a>
    </div>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="menu-item logout-item">
                <i class='bx bx-log-out-circle'></i>
                <span>Keluar Aplikasi</span>
            </button>
        </form>
    </div>
</aside>