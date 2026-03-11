@extends('layouts.app')
@section('title', 'Layanan')

@push('styles')
<style>
    .page-hero { padding: 9rem 2rem 5rem; }
    .services-full-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-top: 3rem; }
    .service-full-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 20px; padding: 2.5rem; transition: all .3s; position: relative; overflow: hidden; }
    .service-full-card::before { content: ''; position: absolute; top: 0; left: 0; bottom: 0; width: 4px; background: var(--accent); transform: scaleY(0); transition: transform .3s; transform-origin: top; }
    .service-full-card:hover { border-color: rgba(244,165,53,0.4); transform: translateY(-3px); }
    .service-full-card:hover::before { transform: scaleY(1); }
    .service-full-icon { width: 58px; height: 58px; border-radius: 16px; background: rgba(244,165,53,0.1); display: flex; align-items: center; justify-content: center; color: var(--accent); margin-bottom: 1.5rem; }
    .service-full-name { font-family: var(--font-h); font-size: 1.5rem; color: var(--white); margin-bottom: 1rem; }
    .service-full-desc { color: var(--muted); font-size: 0.9rem; line-height: 1.85; margin-bottom: 1.5rem; }
    .service-full-price { display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(244,165,53,0.1); border: 1px solid rgba(244,165,53,0.3); color: var(--accent); padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.875rem; font-weight: 600; }
    .how-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-top: 3rem; }
    .how-card { text-align: center; padding: 2rem 1.5rem; background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); position: relative; }
    .how-num { font-family: var(--font-h); font-size: 3rem; color: rgba(244,165,53,0.2); margin-bottom: 1rem; line-height: 1; }
    .how-icon { color: var(--accent); margin-bottom: 1rem; }
    .how-title { font-weight: 600; color: var(--white); margin-bottom: 0.5rem; }
    .how-desc { color: var(--muted); font-size: 0.85rem; line-height: 1.7; }
    /* ─── RESPONSIVE ─── */
    @media (max-width: 900px) {
        .page-hero { padding: 7rem 1.5rem 3.5rem; }
        .services-full-grid { grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .how-grid { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width: 640px) {
        .page-hero { padding: 6rem 1rem 3rem; }
        .services-full-grid { grid-template-columns: 1fr; }
        .how-grid { grid-template-columns: repeat(2,1fr); }
    }
    @media (max-width: 480px) {
        .how-grid { grid-template-columns: 1fr; }
        .service-full-card { padding: 1.75rem 1.25rem; }
    }
</style>
@endpush

@section('content')

<section class="page-hero" style="background:radial-gradient(ellipse 60% 60% at 60% 40%,rgba(244,165,53,0.07) 0%,transparent 70%);">
    <div style="max-width:1200px;margin:0 auto;">
        <div class="badge">Layanan Kami</div>
        <h1 class="section-title" style="font-size:clamp(2.2rem,5vw,3.5rem);">Semua Kebutuhan Digital<br><em style="color:var(--accent);font-style:normal;">Anda di Satu Tempat</em></h1>
        <div class="divider"></div>
        <p class="section-subtitle" style="font-size:1.05rem;max-width:580px;">Dari desain hingga teknologi, dari akademis hingga digital marketing — SIB siap membantu dengan layanan profesional yang terjangkau.</p>
    </div>
</section>

<!-- Services Grid -->
<section class="section" style="max-width:1200px;margin:0 auto;">
    <div class="services-full-grid">
        @forelse($services as $service)
        <div class="service-full-card">
            @if($service->image)
            <div style="margin:-2.5rem -2.5rem 2rem;border-radius:20px 20px 0 0;overflow:hidden;height:200px;">
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                    style="width:100%;height:100%;object-fit:cover;">
            </div>
            @endif
            <div class="service-full-icon">
                <i data-lucide="{{ $service->icon ?? 'briefcase' }}" size="26"></i>
            </div>
            <h3 class="service-full-name">{{ $service->name }}</h3>
            <p class="service-full-desc">{{ $service->description }}</p>
            @if($service->price)
            <div class="service-full-price"><i data-lucide="tag" size="14"></i> {{ $service->price }}</div>
            @endif
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;color:var(--muted);">
            <p>Layanan sedang dalam persiapan.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- How We Work -->
<section class="section" style="background:var(--bg2);border-top:1px solid var(--border);">
    <div style="max-width:1200px;margin:0 auto;">
        <div class="text-center">
            <div class="badge">Cara Kerja</div>
            <h2 class="section-title">Proses Sederhana,<br>Hasil Maksimal</h2>
            <div class="divider center"></div>
        </div>
        <div class="how-grid">
            <div class="how-card"><div class="how-num">01</div><div class="how-icon"><i data-lucide="message-circle" size="28"></i></div><div class="how-title">Konsultasi</div><div class="how-desc">Ceritakan kebutuhan Anda kepada tim kami via chat atau telepon secara gratis</div></div>
            <div class="how-card"><div class="how-num">02</div><div class="how-icon"><i data-lucide="file-text" size="28"></i></div><div class="how-title">Penawaran</div><div class="how-desc">Kami akan memberikan penawaran harga dan estimasi waktu pengerjaan yang transparan</div></div>
            <div class="how-card"><div class="how-num">03</div><div class="how-icon"><i data-lucide="zap" size="28"></i></div><div class="how-title">Pengerjaan</div><div class="how-desc">Tim profesional kami mulai mengerjakan proyek dengan standar kualitas terbaik</div></div>
            <div class="how-card"><div class="how-num">04</div><div class="how-icon"><i data-lucide="check-circle" size="28"></i></div><div class="how-title">Selesai</div><div class="how-desc">Hasil diserahkan tepat waktu disertai revisi gratis hingga Anda puas</div></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="text-align:center;padding:5rem 2rem;">
    <div class="badge">Hubungi Kami</div>
    <h2 class="section-title">Tertarik? Hubungi Kami<br>Sekarang Juga!</h2>
    <p style="color:var(--muted);margin:1rem auto 2rem;max-width:480px;">Konsultasi pertama gratis. Kami siap membantu Anda menemukan solusi yang tepat.</p>
    <a href="{{ route('contact') }}" class="btn btn-primary" style="font-size:1rem;padding:.9rem 2rem;"><i data-lucide="send" size="18"></i> Hubungi Sekarang</a>
</section>

@endsection
