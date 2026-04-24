<aside class="sidebar shadow-sm">
    <div class="sidebar-brand">TastyAdmin.</div>
    
    <div class="menu-header">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class='bx bxs-dashboard'></i> Dashboard
    </a>
    
    <a href="{{ route('admin.berita.index') }}" class="menu-item {{ request()->is('admin/berita*') ? 'active' : '' }}">
        <i class='bx bx-news'></i> Kelola Berita
    </a>
    
    <a href="{{ route('admin.galeri.index') }}" class="menu-item {{ request()->is('admin/galeri*') ? 'active' : '' }}">
        <i class='bx bx-image-alt'></i> Kelola Galeri
    </a>
    
    <a href="{{ route('admin.pesan.index') }}" class="menu-item {{ request()->is('admin/pesan*') ? 'active' : '' }}">
        <i class='bx bx-envelope'></i> Pesan Masuk
    </a>
    
    <div class="menu-header">Lainnya</div>
    <a href="{{ route('home') }}" target="_blank" class="menu-item">
        <i class='bx bx-link-external'></i> Lihat Website
    </a>
    
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="menu-item logout-btn w-100 border-0 text-start">
            <i class='bx bx-log-out'></i> Logout
        </button>
    </form>
</aside>