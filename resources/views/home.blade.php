@extends('layouts.app')
@section('title', 'Beranda')

@push('styles')
<style>
    /* ── HERO ── */
    .hero {
        min-height: 100vh; display: flex; align-items: center;
        padding: 5rem 2rem 4rem; position: relative; overflow: hidden;
    }
    .hero-bg {
        position: absolute; inset: 0; z-index: 0;
        background:
            radial-gradient(ellipse 70% 60% at 80% 30%, rgba(230,57,70,0.07) 0%, transparent 65%),
            radial-gradient(ellipse 50% 60% at 10% 80%, rgba(230,57,70,0.04) 0%, transparent 60%),
            radial-gradient(ellipse 40% 40% at 50% 50%, rgba(244,165,53,0.03) 0%, transparent 70%);
    }
    .hero-noise { position: absolute; inset: 0; z-index: 0; opacity: 0.025; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E"); }
    .hero-lines { position: absolute; inset: 0; z-index: 0; opacity: 0.03; background-image: linear-gradient(var(--text) 1px, transparent 1px), linear-gradient(90deg, var(--text) 1px, transparent 1px); background-size: 80px 80px; }
    .hero-inner { max-width: 1200px; margin: 0 auto; width: 100%; position: relative; z-index: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center; }

    /* Hero Left */
    .hero-eyebrow { display: inline-flex; align-items: center; gap: 0.6rem; padding: 0.4rem 1rem; border-radius: 20px; background: rgba(230,57,70,0.08); border: 1px solid rgba(230,57,70,0.2); color: var(--accent); font-size: 0.72rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; animation: fadeUp .6s ease both; }
    .hero-eyebrow::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--accent); animation: blink 1.5s infinite; }
    @keyframes blink { 0%,100%{opacity:1}50%{opacity:0.3} }

    .hero-logo-title { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.25rem; animation: fadeUp .6s .1s ease both; }
    .hero-logo-img { height: 90px; width: auto; object-fit: contain; filter: drop-shadow(0 0 20px rgba(230,57,70,0.3)); }
    .hero-title { font-family: var(--font-h); font-size: clamp(2.2rem, 4.5vw, 3.4rem); color: var(--white); line-height: 1.15; }
    .hero-title em { color: var(--accent); font-style: italic; }

    .hero-tagline { font-size: 0.8rem; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--gold); margin-bottom: 1rem; animation: fadeUp .6s .15s ease both; }
    .hero-desc { color: var(--muted2); font-size: 1rem; line-height: 1.85; margin-bottom: 2.5rem; animation: fadeUp .6s .2s ease both; max-width: 480px; }
    .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; animation: fadeUp .6s .25s ease both; margin-bottom: 3rem; }
    .hero-trust { display: flex; align-items: center; gap: 1.5rem; animation: fadeUp .6s .3s ease both; padding-top: 2rem; border-top: 1px solid var(--border); }
    .hero-trust-item { text-align: center; }
    .hero-trust-num { font-family: var(--font-h); font-size: 1.6rem; color: var(--white); }
    .hero-trust-lbl { font-size: 0.72rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px; }
    .hero-trust-sep { width: 1px; height: 40px; background: var(--border2); }

    /* Hero Right — Card */
    .hero-right { animation: fadeUp .7s .2s ease both; }
    .hero-card {
        background: var(--bg2); border: 1px solid var(--border);
        border-radius: 24px; overflow: hidden;
        box-shadow: 0 30px 80px rgba(0,0,0,0.5);
        position: relative;
    }
    .hero-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(230,57,70,0.5), rgba(244,165,53,0.5), transparent); }
    .hero-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 0.6rem; }
    .card-dots { display: flex; gap: 6px; }
    .card-dot { width: 10px; height: 10px; border-radius: 50%; }
    .hero-card-label { font-size: 0.75rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; margin-left: auto; }
    .hero-services-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1px; background: var(--border); }
    .hero-service-item { background: var(--bg2); padding: 1.5rem; transition: background .2s; cursor: pointer; }
    .hero-service-item:hover { background: var(--bg3); }
    .hero-svc-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; }
    .hero-svc-name { font-size: 0.85rem; font-weight: 700; color: var(--text); margin-bottom: 0.2rem; }
    .hero-svc-price { font-size: 0.72rem; color: var(--accent); font-weight: 600; }
    .hero-card-footer { padding: 1rem 1.5rem; background: var(--bg3); display: flex; align-items: center; justify-content: space-between; }
    .rating-stars { display: flex; gap: 2px; }
    .hero-card-rating-text { font-size: 0.78rem; color: var(--muted2); }

    /* ── STATS STRIP ── */
    .stats-strip { background: var(--bg2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
    .stats-strip-inner { max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: grid; grid-template-columns: repeat(4,1fr); }
    .stat-strip-item { padding: 2.5rem 2rem; text-align: center; border-right: 1px solid var(--border); position: relative; }
    .stat-strip-item:last-child { border-right: none; }
    .stat-strip-num { font-family: var(--font-h); font-size: 2.5rem; color: var(--white); line-height: 1; }
    .stat-strip-num span { color: var(--accent); }
    .stat-strip-lbl { color: var(--muted); font-size: 0.8rem; margin-top: 0.4rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }

    /* ── SERVICES ── */
    .services-section { max-width: 1200px; margin: 0 auto; }
    .section-head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem; }
    .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(270px,1fr)); gap: 1.5rem; }
    .service-card {
        background: var(--bg2); border: 1px solid var(--border); border-radius: 18px;
        overflow: hidden; transition: all .3s ease; position: relative;
    }
    .service-card:hover { border-color: rgba(230,57,70,0.3); transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,0.4); }
    .service-card-img { height: 180px; overflow: hidden; position: relative; }
    .service-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
    .service-card:hover .service-card-img img { transform: scale(1.05); }
    .service-card-img-placeholder { height: 180px; background: linear-gradient(135deg, var(--bg3) 0%, var(--bg4) 100%); display: flex; align-items: center; justify-content: center; }
    .service-card-body { padding: 1.5rem; }
    .service-card-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; }
    .service-card-name { font-family: var(--font-h); font-size: 1.2rem; color: var(--white); margin-bottom: 0.6rem; }
    .service-card-desc { color: var(--muted2); font-size: 0.85rem; line-height: 1.75; margin-bottom: 1.25rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .service-card-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid var(--border); }
    .service-price-tag { font-size: 0.8rem; font-weight: 700; color: var(--accent); }
    .service-arrow { width: 32px; height: 32px; border-radius: 8px; background: var(--bg3); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--muted); transition: all .2s; }
    .service-card:hover .service-arrow { background: var(--accent); border-color: var(--accent); color: white; }

    /* ── TESTIMONIALS ── */
    .testimonials-section { background: var(--bg2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
    .testimonials-grid { display: grid; grid-template-columns: repeat(auto-fit,minmax(300px,1fr)); gap: 1.5rem; margin-top: 3rem; }
    .testimonial-card { background: var(--bg3); border: 1px solid var(--border); border-radius: 18px; padding: 1.75rem; transition: all .3s; position: relative; }
    .testimonial-card:hover { border-color: rgba(230,57,70,0.2); transform: translateY(-3px); }
    .testimonial-card::before { content: '"'; font-family: var(--font-h); font-size: 6rem; color: rgba(230,57,70,0.08); position: absolute; top: 0.5rem; right: 1.5rem; line-height: 1; }
    .t-stars { display: flex; gap: 3px; margin-bottom: 1rem; }
    .t-text { color: var(--muted2); font-size: 0.9rem; line-height: 1.8; margin-bottom: 1.5rem; font-style: italic; }
    .t-author { display: flex; align-items: center; gap: 0.75rem; }
    .t-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--accent2)); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.9rem; color: white; flex-shrink: 0; }
    .t-name { font-weight: 700; font-size: 0.875rem; color: var(--white); }
    .t-role { color: var(--muted); font-size: 0.78rem; }

    /* ── CTA ── */
    .cta-section { position: relative; overflow: hidden; text-align: center; }
    .cta-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 70% 80% at 50% 50%, rgba(230,57,70,0.08) 0%, transparent 70%); }
    .cta-inner { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
    .cta-title { font-family: var(--font-h); font-size: clamp(2rem,4vw,3rem); color: var(--white); margin-bottom: 1rem; }
    .cta-desc { color: var(--muted2); font-size: 1rem; margin-bottom: 2.5rem; line-height: 1.8; }
    .cta-actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)} }

    /* ─── TABLET (≤1024px) ─── */
    @media (max-width: 1024px) {
        .hero-inner { gap: 3rem; }
        .hero-title { font-size: clamp(2rem, 4vw, 2.8rem); }
        .hero-card { transform: scale(.95); }
        .stats-strip-inner { padding: 0 1.5rem; }
    }

    /* ─── MOBILE LANDSCAPE / TABLET SMALL (≤900px) ─── */
    @media (max-width: 900px) {
        .hero { padding: 6rem 1.5rem 3rem; min-height: auto; }
        .hero-inner { grid-template-columns: 1fr; gap: 2.5rem; text-align: center; }
        .hero-right { display: none; }
        .hero-eyebrow { margin: 0 auto 1.25rem; }
        .hero-logo-title { justify-content: center; }
        .hero-tagline { text-align: center; }
        .hero-desc { margin: 0 auto 2rem; }
        .hero-actions { justify-content: center; }
        .hero-trust { justify-content: center; }
        .stats-strip-inner { grid-template-columns: repeat(2,1fr); }
        .stat-strip-item:nth-child(1),
        .stat-strip-item:nth-child(2) { border-bottom: 1px solid var(--border); }
        .stat-strip-item:nth-child(2) { border-right: none; }
        .section-head { flex-direction: column; align-items: flex-start; }
    }

    /* ─── MOBILE PORTRAIT (≤640px) ─── */
    @media (max-width: 640px) {
        .hero { padding: 5rem 1rem 3rem; }
        .hero-title { font-size: clamp(1.8rem, 7vw, 2.4rem); }
        .hero-desc { font-size: 0.9rem; }
        .hero-actions { flex-direction: column; align-items: center; width: 100%; }
        .hero-actions .btn { width: 100%; justify-content: center; }
        .hero-trust { gap: 1rem; flex-wrap: wrap; padding-top: 1.5rem; }
        .hero-trust-sep { display: none; }
        .hero-trust-item { flex: 1 1 40%; }
        .services-grid { grid-template-columns: 1fr; }
        .testimonials-grid { grid-template-columns: 1fr; }
        .stat-strip-item { padding: 1.75rem 1rem; }
        .stat-strip-num { font-size: 2rem; }
    }

    /* ─── SMALL MOBILE (≤480px) ─── */
    @media (max-width: 480px) {
        .hero { padding: 4.5rem 1rem 2.5rem; }
        .hero-logo-title { flex-direction: column; gap: 0.75rem; align-items: center; }
        .hero-logo-img { height: 64px; }
        .stats-strip-inner { grid-template-columns: 1fr 1fr; }
        .stat-strip-item { padding: 1.25rem 0.75rem; }
        .stat-strip-num { font-size: 1.75rem; }
        .cta-actions { flex-direction: column; align-items: center; }
        .cta-actions .btn { width: 100%; max-width: 320px; justify-content: center; }
        .hero-trust-num { font-size: 1.3rem; }
    }
</style>
@endpush

@section('content')

<!-- ── HERO ── -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-noise"></div>
    <div class="hero-lines"></div>
    <div class="hero-inner">
        <div>
            <div class="hero-eyebrow">🔥 Profesional & Terpercaya</div>

            {{-- Logo + Judul --}}
            <div class="hero-logo-title">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="SIB Group" class="hero-logo-img">
                @endif
                <h1 class="hero-title">Solusi <em>Kreatif</em> &amp;<br>Teknologi untuk<br>Bisnis Anda</h1>
            </div>

            <div class="hero-tagline">Your Creativity Technology Partner</div>
            <p class="hero-desc">SIB Group hadir sebagai mitra digital terpercaya untuk desain grafis, perbaikan laptop, bantuan tugas akademik, dan pembuatan website UMKM. Cepat, berkualitas, dan terjangkau.</p>

            <div class="hero-actions">
                <a href="{{ route('services') }}" class="btn btn-primary"><i data-lucide="briefcase" size="16"></i> Lihat Layanan</a>
                <a href="{{ route('contact') }}" class="btn btn-outline"><i data-lucide="message-circle" size="16"></i> Konsultasi Gratis</a>
            </div>

            <div class="hero-trust">
                <div class="hero-trust-item"><div class="hero-trust-num">500+</div><div class="hero-trust-lbl">Klien Puas</div></div>
                <div class="hero-trust-sep"></div>
                <div class="hero-trust-item"><div class="hero-trust-num">3+</div><div class="hero-trust-lbl">Tahun</div></div>
                <div class="hero-trust-sep"></div>
                <div class="hero-trust-item"><div class="hero-trust-num">1K+</div><div class="hero-trust-lbl">Proyek</div></div>
                <div class="hero-trust-sep"></div>
                <div class="hero-trust-item"><div class="hero-trust-num">4.9★</div><div class="hero-trust-lbl">Rating</div></div>
            </div>
        </div>

        <div class="hero-right">
            <div class="hero-card">
                <div class="hero-card-header">
                    <div class="card-dots">
                        <div class="card-dot" style="background:#e05555;"></div>
                        <div class="card-dot" style="background:#f4a535;"></div>
                        <div class="card-dot" style="background:#52b788;"></div>
                    </div>
                    <span class="hero-card-label">Layanan Unggulan</span>
                </div>
                <div class="hero-services-grid">
                    <div class="hero-service-item">
                        <div class="hero-svc-icon" style="background:rgba(230,57,70,0.1);"><i data-lucide="palette" size="20" style="color:var(--accent);"></i></div>
                        <div class="hero-svc-name">Desain Grafis</div>
                        <div class="hero-svc-price">Mulai Rp 150.000</div>
                    </div>
                    <div class="hero-service-item">
                        <div class="hero-svc-icon" style="background:rgba(244,165,53,0.1);"><i data-lucide="laptop" size="20" style="color:var(--gold);"></i></div>
                        <div class="hero-svc-name">Perbaikan Laptop</div>
                        <div class="hero-svc-price">Mulai Rp 75.000</div>
                    </div>
                    <div class="hero-service-item">
                        <div class="hero-svc-icon" style="background:rgba(86,180,233,0.1);"><i data-lucide="book-open" size="20" style="color:#56b4e9;"></i></div>
                        <div class="hero-svc-name">Bantuan Tugas</div>
                        <div class="hero-svc-price">Mulai Rp 50.000</div>
                    </div>
                    <div class="hero-service-item">
                        <div class="hero-svc-icon" style="background:rgba(82,183,136,0.1);"><i data-lucide="globe" size="20" style="color:#52b788;"></i></div>
                        <div class="hero-svc-name">Website UMKM</div>
                        <div class="hero-svc-price">Mulai Rp 500.000</div>
                    </div>
                </div>
                <div class="hero-card-footer">
                    <div>
                        <div class="rating-stars">
                            @for($i=0;$i<5;$i++)<i data-lucide="star" size="12" style="fill:var(--gold);color:var(--gold);"></i>@endfor
                        </div>
                        <div class="hero-card-rating-text" style="margin-top:2px;">4.9/5 dari 500+ klien</div>
                    </div>
                    <a href="{{ route('contact') }}" class="btn btn-primary" style="padding:.5rem 1rem;font-size:.8rem;">Mulai Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── STATS ── -->
<div class="stats-strip">
    <div class="stats-strip-inner">
        <div class="stat-strip-item"><div class="stat-strip-num">500<span>+</span></div><div class="stat-strip-lbl">Klien Puas</div></div>
        <div class="stat-strip-item"><div class="stat-strip-num">3<span>+</span></div><div class="stat-strip-lbl">Tahun Pengalaman</div></div>
        <div class="stat-strip-item"><div class="stat-strip-num">1K<span>+</span></div><div class="stat-strip-lbl">Proyek Selesai</div></div>
        <div class="stat-strip-item"><div class="stat-strip-num">24<span>/7</span></div><div class="stat-strip-lbl">Siap Membantu</div></div>
    </div>
</div>

<!-- ── SERVICES ── -->
<section class="section">
    <div class="services-section">
        <div class="section-head">
            <div>
                <div class="badge-pill"><i data-lucide="briefcase" size="11"></i> Layanan Kami</div>
                <h2 class="section-title">Apa yang Bisa Kami<br>Lakukan untuk Anda?</h2>
                <div class="divider"></div>
            </div>
            <a href="{{ route('services') }}" class="btn btn-outline" style="align-self:center;">Semua Layanan <i data-lucide="arrow-right" size="15"></i></a>
        </div>
        <div class="services-grid">
            @forelse($services as $service)
            <div class="service-card">
                @if($service->image)
                    <div class="service-card-img"><img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->name }}"></div>
                @else
                    <div class="service-card-img-placeholder">
                        <i data-lucide="{{ $service->icon ?? 'briefcase' }}" size="48" style="color:var(--border2);"></i>
                    </div>
                @endif
                <div class="service-card-body">
                    <div class="service-card-icon" style="background:rgba(230,57,70,0.1);">
                        <i data-lucide="{{ $service->icon ?? 'briefcase' }}" size="20" style="color:var(--accent);"></i>
                    </div>
                    <h3 class="service-card-name">{{ $service->name }}</h3>
                    <p class="service-card-desc">{{ $service->description }}</p>
                    <div class="service-card-footer">
                        <span class="service-price-tag">{{ $service->price ?? 'Hubungi Kami' }}</span>
                        <div class="service-arrow"><i data-lucide="arrow-right" size="14"></i></div>
                    </div>
                </div>
            </div>
            @empty
            <p style="color:var(--muted);">Layanan akan segera hadir.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ── TESTIMONIALS ── -->
<section class="testimonials-section section">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;">
            <div class="badge-pill" style="margin:0 auto 1rem;"><i data-lucide="star" size="11"></i> Testimoni</div>
            <h2 class="section-title">Kata Mereka Tentang SIB</h2>
            <div class="divider center"></div>
        </div>
        <div class="testimonials-grid">
            @forelse($testimonials as $t)
            <div class="testimonial-card">
                <div class="t-stars">
                    @for($i=1;$i<=5;$i++)<i data-lucide="star" size="13" style="{{ $i<=$t->rating ? 'fill:var(--gold);color:var(--gold)' : 'color:var(--border2)' }};"></i>@endfor
                </div>
                <p class="t-text">"{{ $t->message }}"</p>
                <div class="t-author">
                    <div class="t-avatar">{{ substr($t->name,0,1) }}</div>
                    <div><div class="t-name">{{ $t->name }}</div><div class="t-role">{{ $t->role }}</div></div>
                </div>
            </div>
            @empty
            <p style="color:var(--muted);">Belum ada testimoni.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ── CTA ── -->
<section class="section cta-section" style="background:var(--bg);">
    <div class="cta-bg"></div>
    <div class="cta-inner">
        <div class="badge-pill" style="margin:0 auto 1.5rem;"><i data-lucide="zap" size="11"></i> Mulai Sekarang</div>
        <h2 class="cta-title">Siap Membawa Bisnis Anda<br>ke Level Berikutnya?</h2>
        <p class="cta-desc">Konsultasi gratis, tanpa biaya tambahan. Tim SIB Group siap membantu mewujudkan kebutuhan digital Anda dengan cepat dan profesional.</p>
        <div class="cta-actions">
            <a href="{{ route('contact') }}" class="btn btn-primary" style="font-size:1rem;padding:.9rem 2rem;"><i data-lucide="send" size="18"></i> Konsultasi Gratis</a>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-gold" style="font-size:1rem;padding:.9rem 2rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Chat WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection
