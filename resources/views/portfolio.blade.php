@extends('layouts.app')
@section('title', 'Portofolio')
@section('description', 'Lihat hasil karya dan proyek terbaik SIB Group')

@push('styles')
<style>
.portfolio-hero { padding: 6rem 2rem 4rem; text-align: center; }
.portfolio-filters { display: flex; justify-content: center; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 3rem; }
.filter-btn { padding: 0.5rem 1.25rem; border-radius: 20px; border: 1.5px solid var(--border2); background: transparent; color: var(--muted2); font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: all .2s; font-family: var(--font-b); }
.filter-btn:hover, .filter-btn.active { background: var(--accent); border-color: var(--accent); color: white; }
.portfolio-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px,1fr)); gap: 1.5rem; }
.portfolio-card { border-radius: 16px; overflow: hidden; background: var(--bg2); border: 1px solid var(--border); transition: all .3s; cursor: pointer; }
.portfolio-card:hover { transform: translateY(-6px); box-shadow: 0 24px 60px rgba(0,0,0,0.5); border-color: rgba(230,57,70,0.3); }
.portfolio-img { position: relative; height: 220px; overflow: hidden; }
.portfolio-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
.portfolio-card:hover .portfolio-img img { transform: scale(1.07); }
.portfolio-img-placeholder { width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--bg3); }
.portfolio-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.7); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .3s; }
.portfolio-card:hover .portfolio-overlay { opacity: 1; }
.portfolio-cat-badge { position: absolute; top: 1rem; left: 1rem; padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; background: var(--accent); color: white; }
.portfolio-featured-badge { position: absolute; top: 1rem; right: 1rem; background: var(--gold); color: var(--bg); padding: 0.25rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 800; }
.portfolio-body { padding: 1.25rem; }
.portfolio-title { font-weight: 700; color: var(--white); font-size: 1rem; margin-bottom: 0.3rem; }
.portfolio-client { color: var(--muted); font-size: 0.8rem; display: flex; align-items: center; gap: 0.3rem; }
.portfolio-desc { color: var(--muted2); font-size: 0.82rem; margin-top: 0.5rem; display: -webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.empty-portfolio { text-align: center; padding: 5rem 2rem; color: var(--muted); }

/* ─── RESPONSIVE ─── */
@media (max-width: 900px) {
    .portfolio-grid { grid-template-columns: repeat(2, 1fr); }
    .portfolio-hero { padding: 5rem 1.5rem 3rem; }
}
@media (max-width: 640px) {
    .portfolio-grid { grid-template-columns: 1fr; }
    .portfolio-hero { padding: 4.5rem 1rem 2.5rem; }
    .portfolio-filters { gap: 0.4rem; }
    .filter-btn { padding: 0.4rem 0.9rem; font-size: 0.78rem; }
    .portfolio-img { height: 180px; }
}
@media (max-width: 480px) {
    .portfolio-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<section class="portfolio-hero">
    <div class="badge-pill" style="margin:0 auto 1rem;"><i data-lucide="image" size="11"></i> Portofolio</div>
    <h1 class="section-title">Hasil Karya Terbaik Kami</h1>
    <p class="section-subtitle" style="margin:0 auto 3rem;">Kumpulan proyek yang telah kami selesaikan dengan penuh dedikasi dan profesionalisme.</p>

    <div class="portfolio-filters">
        <button class="filter-btn active" onclick="filterPortfolio('all', this)">Semua</button>
        @foreach($categories as $key => $label)
        <button class="filter-btn" onclick="filterPortfolio('{{ $key }}', this)">{{ $label }}</button>
        @endforeach
    </div>

    <div class="container">
        @if($portfolios->isEmpty())
        <div class="empty-portfolio">
            <i data-lucide="image-off" size="48" style="margin-bottom:1rem;color:var(--border2);"></i>
            <p>Portofolio sedang disiapkan. Cek lagi nanti!</p>
        </div>
        @else
        <div class="portfolio-grid" id="portfolioGrid">
            @foreach($portfolios as $item)
            <div class="portfolio-card" data-category="{{ $item->category }}">
                <div class="portfolio-img">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
                    @else
                        <div class="portfolio-img-placeholder"><i data-lucide="image" size="48" style="color:var(--border2);"></i></div>
                    @endif
                    <div class="portfolio-overlay"><i data-lucide="zoom-in" size="32" style="color:white;"></i></div>
                    <span class="portfolio-cat-badge">{{ $item->category_label }}</span>
                    @if($item->is_featured)<span class="portfolio-featured-badge">⭐ Unggulan</span>@endif
                </div>
                <div class="portfolio-body">
                    <div class="portfolio-title">{{ $item->title }}</div>
                    @if($item->client)<div class="portfolio-client"><i data-lucide="user" size="11"></i> {{ $item->client }}</div>@endif
                    @if($item->description)<div class="portfolio-desc">{{ $item->description }}</div>@endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<section class="section" style="background:var(--bg2);border-top:1px solid var(--border);text-align:center;">
    <div class="cta-inner" style="max-width:600px;margin:0 auto;">
        <h2 class="section-title">Tertarik Bekerja Sama?</h2>
        <p class="section-subtitle" style="margin:0 auto 2rem;">Jadilah bagian dari portofolio terbaik kami. Konsultasikan kebutuhan Anda sekarang.</p>
        <a href="{{ route('order') }}" class="btn btn-primary"><i data-lucide="send" size="16"></i> Buat Pesanan</a>
    </div>
</section>
@endsection

@push('scripts')
<script>
function filterPortfolio(cat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.portfolio-card').forEach(card => {
        card.style.display = (cat === 'all' || card.dataset.category === cat) ? 'block' : 'none';
    });
}
</script>
@endpush
