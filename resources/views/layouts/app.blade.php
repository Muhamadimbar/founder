<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIB Group') | Your Creativity Technology Partner</title>
    <meta name="description" content="@yield('description', 'SIB Group menyediakan jasa desain grafis, perbaikan laptop, bantuan tugas, dan pembuatan website UMKM profesional.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:      #080b10;
            --bg2:     #0d1117;
            --bg3:     #131920;
            --bg4:     #1a2230;
            --border:  #1e2a38;
            --border2: #253347;
            --text:    #e2e8f0;
            --muted:   #64748b;
            --muted2:  #94a3b8;
            --accent:  #e63946;
            --accent2: #c1121f;
            --gold:    #f4a535;
            --white:   #ffffff;
            --radius:  14px;
            --font-h:  'Playfair Display', Georgia, serif;
            --font-b:  'Plus Jakarta Sans', sans-serif;
            --shadow:  0 20px 60px rgba(0,0,0,0.5);
        }
        html { scroll-behavior: smooth; }
        body { background: var(--bg); color: var(--text); font-family: var(--font-b); font-size: 16px; line-height: 1.7; overflow-x: hidden; }

        /* ── NAVBAR ── */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 0 2rem; height: 70px;
            display: flex; align-items: center;
            transition: all .4s ease;
        }
        .navbar.scrolled {
            background: rgba(8,11,16,0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 4px 30px rgba(0,0,0,0.3);
        }
        .navbar-inner { max-width: 1200px; margin: 0 auto; width: 100%; display: flex; align-items: center; justify-content: space-between; }
        .navbar-brand { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .navbar-logo { height: 42px; width: auto; }
        .navbar-brand-text { font-family: var(--font-h); font-size: 1.4rem; color: var(--white); letter-spacing: -0.5px; }
        .navbar-brand-text span { color: var(--accent); }
        .nav-links { display: flex; align-items: center; gap: 0.25rem; list-style: none; }
        .nav-links a {
            color: var(--muted2); font-size: 0.875rem; font-weight: 600;
            text-decoration: none; padding: 0.5rem 1rem; border-radius: 8px;
            transition: all .2s ease; letter-spacing: 0.2px;
        }
        .nav-links a:hover { color: var(--white); background: rgba(255,255,255,0.06); }
        .nav-links a.active { color: var(--white); }
        .nav-cta {
            background: var(--accent) !important; color: var(--white) !important;
            padding: 0.5rem 1.25rem !important; border-radius: 8px !important;
            font-weight: 700 !important;
        }
        .nav-cta:hover { background: var(--accent2) !important; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(230,57,70,0.4) !important; }
        .hamburger { display: none; background: none; border: none; cursor: pointer; color: var(--text); padding: 0.5rem; }

        /* ── MAIN ── */
        main { min-height: 100vh; padding-top: 70px; }

        /* ── FOOTER ── */
        footer { background: var(--bg2); border-top: 1px solid var(--border); padding: 5rem 2rem 2rem; }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 3rem; }
        .footer-logo { height: 50px; margin-bottom: 1.25rem; }
        .footer-desc { color: var(--muted); font-size: 0.875rem; line-height: 1.8; max-width: 280px; }
        .footer-heading { color: var(--white); font-weight: 700; font-size: 0.875rem; margin-bottom: 1.25rem; text-transform: uppercase; letter-spacing: 1px; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 0.65rem; }
        .footer-links a { color: var(--muted); text-decoration: none; font-size: 0.875rem; transition: color .2s; display: flex; align-items: center; gap: 0.4rem; }
        .footer-links a:hover { color: var(--accent); }
        .footer-contact-item { display: flex; align-items: flex-start; gap: 0.75rem; color: var(--muted); font-size: 0.875rem; margin-bottom: 0.85rem; }
        .footer-contact-icon { width: 32px; height: 32px; border-radius: 8px; background: var(--bg3); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--accent); flex-shrink: 0; margin-top: -2px; }
        .footer-bottom { border-top: 1px solid var(--border); padding-top: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .footer-copy { color: var(--muted); font-size: 0.8rem; }
        .footer-social { display: flex; gap: 0.6rem; }
        .social-btn { width: 38px; height: 38px; border-radius: 10px; background: var(--bg3); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--muted); text-decoration: none; transition: all .2s; }
        .social-btn:hover { background: var(--accent); border-color: var(--accent); color: white; transform: translateY(-2px); }

        /* ── FLASH ── */
        .flash-success, .flash-error { position: fixed; top: 80px; right: 1.5rem; z-index: 9999; padding: 1rem 1.5rem; border-radius: 12px; font-size: 0.875rem; font-weight: 600; animation: slideIn .3s ease; max-width: 360px; display: flex; align-items: center; gap: 0.6rem; }
        .flash-success { background: #0d2818; border: 1px solid #166534; color: #4ade80; }
        .flash-error   { background: #2d0a0a; border: 1px solid #991b1b; color: #f87171; }
        @keyframes slideIn { from { transform: translateX(110%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }

        /* ── FLOATING WA ── */
        .wa-float {
            position: fixed; bottom: 2rem; right: 2rem; z-index: 999;
            width: 56px; height: 56px; border-radius: 50%;
            background: #25d366; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 30px rgba(37,211,102,0.4);
            text-decoration: none; transition: all .3s ease;
            animation: pulse-wa 2s infinite;
        }
        .wa-float:hover { transform: scale(1.1); box-shadow: 0 12px 40px rgba(37,211,102,0.6); }
        .wa-tooltip { position: absolute; right: 70px; background: var(--bg2); color: var(--text); padding: 0.4rem 0.85rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; white-space: nowrap; border: 1px solid var(--border); opacity: 0; pointer-events: none; transition: opacity .2s; }
        .wa-float:hover .wa-tooltip { opacity: 1; }
        @keyframes pulse-wa { 0%,100% { box-shadow: 0 8px 30px rgba(37,211,102,0.4); } 50% { box-shadow: 0 8px 40px rgba(37,211,102,0.7); } }

        /* ── UTILS ── */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .section { padding: 7rem 2rem; }
        .badge-pill { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.35rem 1rem; border-radius: 20px; font-size: 0.72rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; background: rgba(230,57,70,0.1); color: var(--accent); border: 1px solid rgba(230,57,70,0.25); margin-bottom: 1.25rem; }
        .section-title { font-family: var(--font-h); font-size: clamp(2rem, 4vw, 2.8rem); color: var(--white); line-height: 1.2; margin-bottom: 1rem; }
        .section-subtitle { color: var(--muted2); font-size: 1rem; max-width: 520px; line-height: 1.8; }
        .divider { width: 48px; height: 3px; background: var(--accent); border-radius: 2px; margin: 1.25rem 0 2.5rem; }
        .divider.center { margin: 1.25rem auto 2.5rem; }
        .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.8rem 1.75rem; border-radius: 10px; font-weight: 700; font-size: 0.875rem; text-decoration: none; cursor: pointer; border: none; transition: all .25s ease; font-family: var(--font-b); letter-spacing: 0.2px; }
        .btn-primary { background: var(--accent); color: white; box-shadow: 0 4px 20px rgba(230,57,70,0.3); }
        .btn-primary:hover { background: var(--accent2); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(230,57,70,0.5); }
        .btn-outline { background: transparent; color: var(--text); border: 1.5px solid var(--border2); }
        .btn-outline:hover { border-color: var(--accent); color: var(--accent); }
        .btn-gold { background: var(--gold); color: var(--bg); box-shadow: 0 4px 20px rgba(244,165,53,0.3); }
        .btn-gold:hover { background: #e8891a; transform: translateY(-2px); }

        /* ─── RESPONSIVE ─── */

        /* Tablet & below (≤1024px) */
        @media (max-width: 1024px) {
            .navbar { padding: 0 1.5rem; }
            .container { padding: 0 1.5rem; }
            .section { padding: 5rem 1.5rem; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 2rem; }
        }

        /* Mobile (≤768px) */
        @media (max-width: 768px) {
            .navbar { padding: 0 1.25rem; }
            .navbar-inner { position: relative; }
            .hamburger { display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: background .2s; }
            .hamburger:hover { background: rgba(255,255,255,.07); }

            /* Dropdown mobile nav */
            .nav-links {
                display: none; flex-direction: column;
                position: fixed; top: 70px; left: 0; right: 0;
                background: rgba(8,11,16,0.98);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border-bottom: 1px solid var(--border);
                padding: 1rem 1.25rem 1.5rem;
                gap: 0.25rem;
                z-index: 999;
                box-shadow: 0 20px 40px rgba(0,0,0,0.5);
            }
            .nav-links.open { display: flex; }
            .nav-links li { width: 100%; }
            .nav-links a {
                display: block; width: 100%;
                padding: 0.75rem 1rem;
                font-size: 0.95rem;
                border-radius: 10px;
            }
            .nav-cta {
                margin-top: 0.5rem;
                text-align: center;
                justify-content: center;
                padding: 0.85rem 1rem !important;
            }
            .section { padding: 4rem 1.25rem; }
            .container { padding: 0 1.25rem; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 2rem; }
            .footer-desc { max-width: 100%; }
        }

        /* Small mobile (≤480px) */
        @media (max-width: 480px) {
            .navbar { padding: 0 1rem; }
            .section { padding: 3.5rem 1rem; }
            .container { padding: 0 1rem; }
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; gap: 0.75rem; text-align: center; }
            .section-title { font-size: clamp(1.6rem, 6vw, 2.2rem) !important; }
            .section-subtitle { font-size: 0.9rem; }
            .btn { padding: 0.75rem 1.25rem; font-size: 0.85rem; }
            .badge-pill { font-size: 0.65rem; }
            .wa-float { bottom: 1.25rem; right: 1.25rem; width: 50px; height: 50px; }
            .flash-success, .flash-error { right: 1rem; left: 1rem; max-width: 100%; top: 75px; }
        }
    </style>
    @stack('styles')
</head>
<body>

@if(session('success'))
<div class="flash-success" id="flashMsg"><i data-lucide="check-circle" size="16"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="flash-error" id="flashMsg"><i data-lucide="alert-circle" size="16"></i> {{ session('error') }}</div>
@endif

<!-- NAVBAR -->
<nav class="navbar" id="mainNav">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="navbar-brand">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ asset('images/logo.png') }}" alt="SIB Group" class="navbar-logo">
            @else
                <span class="navbar-brand-text">Si<span>B</span></span>
            @endif
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services*') ? 'active' : '' }}">Layanan</a></li>
            <li><a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">Portofolio</a></li>
            <li><a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">Harga</a></li>
            <li><a href="{{ route('order') }}" class="nav-cta">Pesan Sekarang</a></li>
        </ul>
        <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
            <svg id="hamburgerIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16"/><path d="M4 12h16"/><path d="M4 19h16"/></svg>
        </button>
    </div>
</nav>

<main>@yield('content')</main>

<!-- FOOTER -->
<footer>
    <div class="footer-inner">
        <div class="footer-grid">
            <div>
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="SIB Group" class="footer-logo">
                @else
                    <div style="font-family:var(--font-h);font-size:1.8rem;color:var(--white);margin-bottom:1rem;">Si<span style="color:var(--accent);">B</span></div>
                @endif
                <p class="footer-desc">Your Creativity Technology Partner. Solusi kreatif dan teknologi profesional untuk bisnis Anda berkembang di era digital.</p>
                <div class="footer-social" style="margin-top:1.5rem;">
                    <a href="#" class="social-btn"><i data-lucide="instagram" size="16"></i></a>
                    <a href="#" class="social-btn"><i data-lucide="facebook" size="16"></i></a>
                    <a href="#" class="social-btn"><i data-lucide="twitter" size="16"></i></a>
                    <a href="#" class="social-btn"><i data-lucide="youtube" size="16"></i></a>
                </div>
            </div>
            <div>
                <h4 class="footer-heading">Layanan</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('services') }}"><i data-lucide="chevron-right" size="12"></i> Desain Grafis</a></li>
                    <li><a href="{{ route('services') }}"><i data-lucide="chevron-right" size="12"></i> Perbaikan Laptop</a></li>
                    <li><a href="{{ route('services') }}"><i data-lucide="chevron-right" size="12"></i> Bantuan Tugas</a></li>
                    <li><a href="{{ route('services') }}"><i data-lucide="chevron-right" size="12"></i> Website UMKM</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-heading">Navigasi</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i data-lucide="chevron-right" size="12"></i> Beranda</a></li>
                    <li><a href="{{ route('about') }}"><i data-lucide="chevron-right" size="12"></i> Tentang Kami</a></li>
                    <li><a href="{{ route('services') }}"><i data-lucide="chevron-right" size="12"></i> Layanan</a></li>
                    <li><a href="{{ route('contact') }}"><i data-lucide="chevron-right" size="12"></i> Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-heading">Kontak</h4>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i data-lucide="map-pin" size="14"></i></div>
                    <span>Jl. Depok raya No. 10, Indonesia</span>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i data-lucide="phone" size="14"></i></div>
                    <span>+62 812-3456-7890</span>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i data-lucide="mail" size="14"></i></div>
                    <span>sibfounder08@gmail.com</span>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i data-lucide="clock" size="14"></i></div>
                    <span>Senin–Sabtu, 08.00–20.00</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">&copy; {{ date('Y') }} <strong style="color:var(--text);">SIB Group</strong>. All rights reserved. Your Creativity Technology Partner.</p>
            <p class="footer-copy">sabar insyaallah berkah</p>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6289669727431" target="_blank" class="wa-float">
    <span class="wa-tooltip">Chat WhatsApp</span>
    <svg width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

<script>
    lucide.createIcons();

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 20);
    });

    // ── HAMBURGER ──
    const hamburgerBtn  = document.getElementById('hamburgerBtn');
    const hamburgerIcon = document.getElementById('hamburgerIcon');
    const navLinks      = document.getElementById('navLinks');

    const ICON_MENU = '<path d="M4 5h16"/><path d="M4 12h16"/><path d="M4 19h16"/>';
    const ICON_X    = '<path d="M18 6 6 18"/><path d="M6 6l12 12"/>';

    function openNav() {
        navLinks.classList.add('open');
        hamburgerIcon.innerHTML = ICON_X;
    }
    function closeNav() {
        navLinks.classList.remove('open');
        hamburgerIcon.innerHTML = ICON_MENU;
    }

    if (hamburgerBtn && navLinks) {
        hamburgerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            navLinks.classList.contains('open') ? closeNav() : openNav();
        });

        // Close on link click
        navLinks.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', closeNav);
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!hamburgerBtn.contains(e.target) && !navLinks.contains(e.target)) {
                closeNav();
            }
        });
    }

    // Auto hide flash
    const flash = document.getElementById('flashMsg');
    if (flash) setTimeout(() => {
        flash.style.opacity = '0';
        flash.style.transform = 'translateX(110%)';
        flash.style.transition = '.4s ease';
        setTimeout(() => flash.remove(), 400);
    }, 4000);
</script>
@stack('scripts')
</body>
</html>
