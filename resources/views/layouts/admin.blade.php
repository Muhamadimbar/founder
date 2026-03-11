<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — SIB Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:      #0c0f14;
            --bg2:     #141820;
            --bg3:     #1a1f2b;
            --bg4:     #1f2537;
            --border:  #252c3a;
            --text:    #e8eaf2;
            --muted:   #7a8199;
            --white:   #ffffff;
            --accent:  #f4a535;
            --accent2: #e8891a;
            --danger:  #e05555;
            --success: #52b788;
            --info:    #56b4e9;
            --radius:  12px;
            --font-h:  'DM Serif Display', Georgia, serif;
            --font-b:  'DM Sans', sans-serif;
            --sidebar: 240px;
        }
        html { scroll-behavior: smooth; }
        body { background: var(--bg); color: var(--text); font-family: var(--font-b); display: flex; min-height: 100vh; overflow-x: hidden; }

        /* ══════════════════════ SIDEBAR ══════════════════════ */
        .sidebar {
            width: var(--sidebar);
            background: var(--bg2);
            border-right: 1px solid var(--border);
            position: fixed; top: 0; left: 0; bottom: 0; z-index: 200;
            display: flex; flex-direction: column;
            transition: transform .3s cubic-bezier(.4,0,.2,1);
            will-change: transform;
        }
        .sidebar-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            font-family: var(--font-h); font-size: 1.5rem; color: var(--white);
            flex-shrink: 0;
        }
        .sidebar-header span { color: var(--accent); }
        .sidebar-header small { display: block; font-family: var(--font-b); font-size: 0.7rem; color: var(--muted); font-weight: 400; margin-top: 2px; }
        .sidebar-nav { flex: 1; padding: 1rem 0.75rem; overflow-y: auto; -webkit-overflow-scrolling: touch; }
        .nav-section-label { font-size: 0.65rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 1.5px; padding: 0.5rem 0.75rem; margin-top: 0.5rem; }
        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.7rem 0.9rem; border-radius: 8px; text-decoration: none;
            color: var(--muted); font-size: 0.9rem; font-weight: 500;
            transition: all .2s; margin-bottom: 2px;
        }
        .sidebar-link:hover { background: var(--bg3); color: var(--text); }
        .sidebar-link.active { background: rgba(244,165,53,0.12); color: var(--accent); }
        .sidebar-link .badge-count { margin-left: auto; background: var(--danger); color: #fff; font-size: 0.7rem; padding: 1px 7px; border-radius: 20px; }
        .sidebar-footer { padding: 1rem 0.75rem; border-top: 1px solid var(--border); flex-shrink: 0; }
        .sidebar-user { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; border-radius: 8px; background: var(--bg3); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--accent); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; color: var(--bg); flex-shrink: 0; }
        .user-info { flex: 1; min-width: 0; }
        .user-name { font-size: 0.85rem; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: 0.72rem; color: var(--muted); }
        .logout-btn { background: none; border: none; cursor: pointer; color: var(--muted); padding: 0.3rem; border-radius: 6px; transition: color .2s; }
        .logout-btn:hover { color: var(--danger); }

        /* ══════════════════════ OVERLAY ══════════════════════ */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.6); z-index: 190;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.show { display: block; }

        /* ══════════════════════ MAIN ══════════════════════ */
        .admin-main { margin-left: var(--sidebar); flex: 1; min-height: 100vh; display: flex; flex-direction: column; min-width: 0; }
        .topbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(12,15,20,.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 1.5rem; height: 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .topbar-left { display: flex; align-items: center; gap: 1rem; min-width: 0; }
        .topbar-title { font-size: 0.95rem; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .topbar-actions { display: flex; align-items: center; gap: 1rem; flex-shrink: 0; }
        .topbar-link { color: var(--muted); font-size: 0.85rem; text-decoration: none; display: flex; align-items: center; gap: 0.4rem; transition: color .2s; white-space: nowrap; }
        .topbar-link:hover { color: var(--accent); }
        .content-area { flex: 1; padding: 1.75rem 2rem; max-width: 1300px; width: 100%; }

        /* ── SIDEBAR TOGGLE (hamburger topbar) ── */
        .sidebar-toggle {
            display: none;
            background: none; border: none; color: var(--text);
            cursor: pointer; padding: 0.5rem;
            border-radius: 8px; flex-shrink: 0;
            align-items: center; justify-content: center;
            transition: background .2s;
        }
        .sidebar-toggle:hover { background: var(--bg3); }

        /* ══════════════════════ CARDS ══════════════════════ */
        .card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem; }
        .card-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem; }
        .card-title { font-size: 1rem; font-weight: 600; color: var(--text); }

        /* ══════════════════════ STATS ══════════════════════ */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.2rem; margin-bottom: 2rem; }
        .stat-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem; position: relative; overflow: hidden; transition: border-color .2s; }
        .stat-card:hover { border-color: var(--accent); }
        .stat-card::after { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: var(--accent); border-radius: var(--radius) var(--radius) 0 0; }
        .stat-icon { width: 42px; height: 42px; border-radius: 10px; background: rgba(244,165,53,0.12); display: flex; align-items: center; justify-content: center; color: var(--accent); margin-bottom: 1rem; }
        .stat-value { font-family: var(--font-h); font-size: 2rem; color: var(--white); }
        .stat-label { color: var(--muted); font-size: 0.85rem; margin-top: 0.2rem; }

        /* ══════════════════════ TABLE ══════════════════════ */
        .table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; min-width: 480px; }
        th { text-align: left; padding: 0.75rem 1rem; color: var(--muted); font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--border); white-space: nowrap; }
        td { padding: 0.875rem 1rem; color: var(--text); border-bottom: 1px solid rgba(37,44,58,0.5); vertical-align: middle; }
        tr:hover td { background: var(--bg3); }
        tr:last-child td { border-bottom: none; }

        /* ══════════════════════ FORMS ══════════════════════ */
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--text); margin-bottom: 0.4rem; }
        .form-control { width: 100%; padding: 0.7rem 1rem; border-radius: 8px; background: var(--bg3); border: 1.5px solid var(--border); color: var(--text); font-family: var(--font-b); font-size: 0.9rem; transition: border-color .2s; }
        .form-control:focus { outline: none; border-color: var(--accent); }
        .form-control::placeholder { color: var(--muted); }
        textarea.form-control { min-height: 120px; resize: vertical; }
        select.form-control { cursor: pointer; }
        .form-check { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; }
        .form-check input { accent-color: var(--accent); cursor: pointer; width: 16px; height: 16px; }
        .form-error { color: #e07070; font-size: 0.8rem; margin-top: 0.3rem; }

        /* Reusable 2-col form grid */
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        /* ══════════════════════ BUTTONS ══════════════════════ */
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; text-decoration: none; cursor: pointer; border: none; transition: all .2s; font-family: var(--font-b); white-space: nowrap; }
        .btn-primary  { background: var(--accent); color: var(--bg); }
        .btn-primary:hover  { background: var(--accent2); }
        .btn-danger   { background: rgba(224,85,85,0.15); color: var(--danger); border: 1px solid rgba(224,85,85,0.3); }
        .btn-danger:hover   { background: var(--danger); color: white; }
        .btn-secondary{ background: var(--bg3); color: var(--text); border: 1px solid var(--border); }
        .btn-secondary:hover{ border-color: var(--accent); color: var(--accent); }
        .btn-sm  { padding: 0.4rem 0.85rem; font-size: 0.8rem; }
        .btn-icon{ padding: 0.45rem; border-radius: 7px; }

        /* ══════════════════════ BADGES ══════════════════════ */
        .badge         { display: inline-block; padding: 0.2rem 0.7rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
        .badge-success { background: rgba(82,183,136,0.15);  color: var(--success); }
        .badge-danger  { background: rgba(224,85,85,0.15);   color: var(--danger); }
        .badge-warning { background: rgba(244,165,53,0.15);  color: var(--accent); }
        .badge-info    { background: rgba(86,180,233,0.15);  color: var(--info); }

        /* ══════════════════════ FLASH ══════════════════════ */
        .flash         { padding: 0.875rem 1.25rem; border-radius: 10px; font-size: 0.875rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.6rem; }
        .flash-success { background: rgba(82,183,136,0.12); border: 1px solid rgba(82,183,136,0.3); color: var(--success); }
        .flash-error   { background: rgba(224,85,85,0.12);  border: 1px solid rgba(224,85,85,0.3);  color: var(--danger); }

        /* ══════════════════════ PAGINATION ══════════════════════ */
        .pagination { display: flex; gap: 0.4rem; justify-content: center; margin-top: 1.5rem; flex-wrap: wrap; }
        .pagination a, .pagination span { padding: 0.5rem 0.8rem; border-radius: 7px; font-size: 0.85rem; text-decoration: none; }
        .pagination a { background: var(--bg3); color: var(--text); border: 1px solid var(--border); transition: all .2s; }
        .pagination a:hover { border-color: var(--accent); color: var(--accent); }
        .pagination span { background: var(--accent); color: var(--bg); font-weight: 600; }

        /* ══════════════════════ RESPONSIVE ══════════════════════ */

        /* Laptop (≤1280px) */
        @media (max-width: 1280px) {
            .content-area { padding: 1.5rem; }
        }

        /* Tablet (≤1024px) — sidebar collapses */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); box-shadow: none; }
            .sidebar.open { transform: translateX(0); box-shadow: 4px 0 30px rgba(0,0,0,.5); }
            .admin-main { margin-left: 0; }
            .sidebar-toggle { display: flex; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .form-grid-2 { grid-template-columns: 1fr 1fr; }
        }

        /* Mobile (≤768px) */
        @media (max-width: 768px) {
            .content-area { padding: 1.25rem; }
            .topbar { padding: 0 1rem; }
            .topbar-link span { display: none; }
            .card { padding: 1.25rem; }
            .card-header { flex-direction: column; align-items: flex-start; }
            .card-header .btn { align-self: flex-end; margin-top: -2.5rem; }
        }

        /* Small mobile (≤640px) */
        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .content-area { padding: 1rem; }
            .form-grid-2 { grid-template-columns: 1fr; }
            .topbar { height: 56px; }
        }

        /* Very small (≤480px) */
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            table { min-width: 400px; }
            .card { padding: 1rem; }
            .btn { font-size: 0.8rem; padding: 0.5rem 0.9rem; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar Overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        SI<span>B</span><small>Admin Panel</small>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i data-lucide="layout-dashboard" size="18"></i> Dashboard
        </a>

        <div class="nav-section-label">Konten</div>
        <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
            <i data-lucide="briefcase" size="18"></i> Layanan
        </a>
        <a href="{{ route('admin.portfolio.index') }}" class="sidebar-link {{ request()->routeIs('admin.portfolio*') ? 'active' : '' }}">
            <i data-lucide="image" size="18"></i> Portofolio
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
            <i data-lucide="star" size="18"></i> Testimoni
        </a>

        <div class="nav-section-label">Transaksi</div>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i data-lucide="shopping-bag" size="18"></i> Pesanan
            @php $pendingOrders = \App\Models\Order::where('status','pending')->count(); @endphp
            @if($pendingOrders > 0)<span class="badge-count">{{ $pendingOrders }}</span>@endif
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="sidebar-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
            <i data-lucide="mail" size="18"></i> Pesan Masuk
            @php $unread = \App\Models\Contact::where('is_read', false)->count(); @endphp
            @if($unread > 0)<span class="badge-count">{{ $unread }}</span>@endif
        </a>

        <div class="nav-section-label">Akun</div>
        <a href="{{ route('admin.profile') }}" class="sidebar-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <i data-lucide="user-cog" size="18"></i> Profil & Password
        </a>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <i data-lucide="external-link" size="18"></i> Lihat Website
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn" title="Logout">
                    <i data-lucide="log-out" size="16"></i>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Main Content -->
<div class="admin-main">
    <div class="topbar">
        <div class="topbar-left">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Menu">
                <svg id="toggleIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 5h16"/><path d="M4 12h16"/><path d="M4 19h16"/>
                </svg>
            </button>
            <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('home') }}" target="_blank" class="topbar-link">
                <i data-lucide="globe" size="15"></i> <span>Website</span>
            </a>
        </div>
    </div>

    <div class="content-area">
        @if(session('success'))
            <div class="flash flash-success"><i data-lucide="check-circle" size="16"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-error"><i data-lucide="alert-circle" size="16"></i> {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script>
    lucide.createIcons();

    // ── SIDEBAR TOGGLE ──
    const sidebarToggle  = document.getElementById('sidebarToggle');
    const sidebar        = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const toggleIcon     = document.getElementById('toggleIcon');

    const ICON_MENU = '<path d="M4 5h16"/><path d="M4 12h16"/><path d="M4 19h16"/>';
    const ICON_X    = '<path d="M18 6 6 18"/><path d="M6 6l12 12"/>';

    function openSidebar() {
        sidebar.classList.add('open');
        sidebarOverlay.classList.add('show');
        toggleIcon.innerHTML = ICON_X;
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('show');
        toggleIcon.innerHTML = ICON_MENU;
        document.body.style.overflow = '';
    }

    sidebarToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    sidebarOverlay.addEventListener('click', closeSidebar);

    // Close on nav link click (mobile)
    sidebar.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 1024) closeSidebar();
        });
    });

    // Close on resize to desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) closeSidebar();
    });
</script>
@stack('scripts')
</body>
</html>
