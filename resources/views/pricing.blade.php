@extends('layouts.app')
@section('title', 'Harga Layanan')

@push('styles')
<style>
.pricing-hero { padding: 6rem 2rem 4rem; text-align: center; }
.pricing-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px,1fr)); gap: 1.5rem; max-width: 1100px; margin: 0 auto; }
.pricing-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 20px; padding: 2rem; position: relative; transition: all .3s; }
.pricing-card.popular { border-color: var(--accent); box-shadow: 0 0 40px rgba(230,57,70,0.15); transform: scale(1.03); }
.popular-badge { position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: var(--accent); color: white; padding: 0.3rem 1.25rem; border-radius: 20px; font-size: 0.72rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; white-space: nowrap; }
.pricing-service-name { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent); margin-bottom: 0.5rem; }
.pricing-package { font-family: var(--font-h); font-size: 1.5rem; color: var(--white); margin-bottom: 0.5rem; }
.pricing-price { font-size: 2rem; font-weight: 800; color: var(--white); line-height: 1; margin: 1rem 0 0.25rem; }
.pricing-price span { font-size: 1rem; color: var(--muted); font-weight: 400; }
.pricing-desc { color: var(--muted); font-size: 0.82rem; margin-bottom: 1.5rem; }
.pricing-features { list-style: none; margin-bottom: 2rem; }
.pricing-features li { display: flex; align-items: center; gap: 0.6rem; font-size: 0.85rem; color: var(--muted2); padding: 0.45rem 0; border-bottom: 1px solid rgba(37,44,58,0.5); }
.pricing-features li:last-child { border-bottom: none; }
.pricing-features li i { flex-shrink: 0; }
.section-divider { max-width: 1100px; margin: 5rem auto 3rem; border-top: 1px solid var(--border); padding-top: 3rem; }

/* ─── RESPONSIVE ─── */
@media (max-width: 900px) {
    .pricing-grid { grid-template-columns: 1fr 1fr; }
    .pricing-card.popular { transform: scale(1); }
    .pricing-hero { padding: 5rem 1.5rem 3rem; }
    .section-divider { margin: 3rem auto 2rem; }
}
@media (max-width: 640px) {
    .pricing-grid { grid-template-columns: 1fr; max-width: 420px; }
    .pricing-card.popular { transform: scale(1); }
    .pricing-hero { padding: 4.5rem 1rem 2.5rem; }
    .pricing-hero h3 { padding: 0 1rem; }
}
@media (max-width: 480px) {
    .pricing-price { font-size: 1.6rem; }
}
</style>
@endpush

@section('content')
<section class="pricing-hero">
    <div class="badge-pill" style="margin:0 auto 1rem;"><i data-lucide="tag" size="11"></i> Harga Layanan</div>
    <h1 class="section-title">Harga Transparan,<br>Kualitas Terjamin</h1>
    <p class="section-subtitle" style="margin:0 auto 4rem;">Pilih paket yang sesuai kebutuhan Anda. Semua paket sudah termasuk revisi dan garansi kepuasan.</p>

    {{-- Desain Grafis --}}
    <h3 style="font-family:var(--font-h);color:var(--white);margin-bottom:2rem;text-align:left;max-width:1100px;margin-left:auto;margin-right:auto;">🎨 Desain Grafis</h3>
    <div class="pricing-grid">
        <div class="pricing-card">
            <div class="pricing-service-name">Desain Grafis</div>
            <div class="pricing-package">Basic</div>
            <div class="pricing-price">Rp 75K <span>/ proyek</span></div>
            <div class="pricing-desc">Untuk kebutuhan sederhana</div>
            <ul class="pricing-features">
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> 1 konsep desain</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> 2x revisi</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Format JPG/PNG</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Selesai 2-3 hari</li>
                <li><i data-lucide="x" size="14" style="color:var(--muted);"></i> File source (AI/PSD)</li>
            </ul>
            <a href="{{ route('order') }}?service=Desain+Grafis&package=Basic" class="btn btn-outline" style="width:100%;justify-content:center;">Pilih Basic</a>
        </div>
        <div class="pricing-card popular">
            <div class="popular-badge">⭐ Paling Populer</div>
            <div class="pricing-service-name">Desain Grafis</div>
            <div class="pricing-package">Standard</div>
            <div class="pricing-price">Rp 150K <span>/ proyek</span></div>
            <div class="pricing-desc">Cocok untuk bisnis berkembang</div>
            <ul class="pricing-features">
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> 2 konsep desain</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Revisi tidak terbatas</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Format JPG/PNG/PDF</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Selesai 1-2 hari</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> File source (AI/PSD)</li>
            </ul>
            <a href="{{ route('order') }}?service=Desain+Grafis&package=Standard" class="btn btn-primary" style="width:100%;justify-content:center;">Pilih Standard</a>
        </div>
        <div class="pricing-card">
            <div class="pricing-service-name">Desain Grafis</div>
            <div class="pricing-package">Premium</div>
            <div class="pricing-price">Rp 300K <span>/ proyek</span></div>
            <div class="pricing-desc">Untuk branding profesional</div>
            <ul class="pricing-features">
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> 3+ konsep desain</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Revisi tidak terbatas</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Semua format file</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Selesai same day</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Panduan brand</li>
            </ul>
            <a href="{{ route('order') }}?service=Desain+Grafis&package=Premium" class="btn btn-outline" style="width:100%;justify-content:center;">Pilih Premium</a>
        </div>
    </div>

    {{-- Website UMKM --}}
    <div class="section-divider">
        <h3 style="font-family:var(--font-h);color:var(--white);margin-bottom:2rem;text-align:left;">🌐 Website UMKM</h3>
    </div>
    <div class="pricing-grid">
        <div class="pricing-card">
            <div class="pricing-service-name">Website UMKM</div>
            <div class="pricing-package">Landing Page</div>
            <div class="pricing-price">Rp 500K</div>
            <div class="pricing-desc">Website 1 halaman modern</div>
            <ul class="pricing-features">
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> 1 halaman responsif</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Form kontak</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Integrasi WhatsApp</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Free domain .my.id</li>
                <li><i data-lucide="x" size="14" style="color:var(--muted);"></i> Panel admin</li>
            </ul>
            <a href="{{ route('order') }}?service=Website+UMKM&package=Landing+Page" class="btn btn-outline" style="width:100%;justify-content:center;">Pilih Paket Ini</a>
        </div>
        <div class="pricing-card popular">
            <div class="popular-badge">⭐ Rekomendasi</div>
            <div class="pricing-service-name">Website UMKM</div>
            <div class="pricing-package">Company Profile</div>
            <div class="pricing-price">Rp 1.5jt</div>
            <div class="pricing-desc">Website multi-halaman lengkap</div>
            <ul class="pricing-features">
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> 5 halaman</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Panel admin konten</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> SEO dasar</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Free domain + hosting 1thn</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Garansi 3 bulan</li>
            </ul>
            <a href="{{ route('order') }}?service=Website+UMKM&package=Company+Profile" class="btn btn-primary" style="width:100%;justify-content:center;">Pilih Paket Ini</a>
        </div>
        <div class="pricing-card">
            <div class="pricing-service-name">Website UMKM</div>
            <div class="pricing-package">Toko Online</div>
            <div class="pricing-price">Rp 3jt</div>
            <div class="pricing-desc">Website toko dengan fitur jualan</div>
            <ul class="pricing-features">
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Produk tidak terbatas</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Keranjang & checkout</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Integrasi payment</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Free domain + hosting 1thn</li>
                <li><i data-lucide="check" size="14" style="color:#52b788;"></i> Garansi 6 bulan</li>
            </ul>
            <a href="{{ route('order') }}?service=Website+UMKM&package=Toko+Online" class="btn btn-outline" style="width:100%;justify-content:center;">Pilih Paket Ini</a>
        </div>
    </div>

    <div style="margin-top:5rem;background:var(--bg2);border:1px solid var(--border);border-radius:20px;padding:3rem;max-width:700px;margin-left:auto;margin-right:auto;text-align:center;">
        <h3 style="font-family:var(--font-h);color:var(--white);margin-bottom:0.75rem;">Butuh Harga Khusus?</h3>
        <p style="color:var(--muted2);margin-bottom:2rem;font-size:.9rem;">Punya kebutuhan yang lebih spesifik? Konsultasikan langsung dengan tim kami dan dapatkan penawaran terbaik.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary"><i data-lucide="message-circle" size="16"></i> Konsultasi Gratis</a>
    </div>
</section>
@endsection
