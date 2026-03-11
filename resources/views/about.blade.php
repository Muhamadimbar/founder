@extends('layouts.app')
@section('title', 'Tentang Kami')
@section('description', 'Kenali lebih dekat tim SIB - Solusi Inovatif Bisnis untuk kebutuhan desain, teknologi, dan akademis Anda.')

@push('styles')
<style>
    .page-hero { padding: 9rem 2rem 5rem; background: radial-gradient(ellipse 60% 60% at 60% 40%, rgba(244,165,53,0.07) 0%, transparent 70%); }
    .page-hero-inner { max-width: 1200px; margin: 0 auto; }
    .story-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
    .story-visual { position: relative; }
    .story-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 20px; padding: 2.5rem; }
    .story-card-icon { width: 60px; height: 60px; border-radius: 16px; background: rgba(244,165,53,0.12); display: flex; align-items: center; justify-content: center; color: var(--accent); margin-bottom: 1.5rem; }
    .mission-vision-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 2rem; }
    .mv-card { background: var(--bg3); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.75rem; }
    .mv-card-icon { width: 40px; height: 40px; border-radius: 10px; background: rgba(244,165,53,0.12); display: flex; align-items: center; justify-content: center; color: var(--accent); margin-bottom: 1rem; }
    .mv-card h4 { font-family: var(--font-h); font-size: 1.1rem; color: var(--white); margin-bottom: 0.5rem; }
    .mv-card p { color: var(--muted); font-size: 0.875rem; line-height: 1.7; }
    .stats-section { background: var(--bg2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 4rem 2rem; }
    .stats-inner { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; text-align: center; }
    .stat-big-num { font-family: var(--font-h); font-size: 3rem; color: var(--accent); }
    .stat-big-lbl { color: var(--muted); font-size: 0.9rem; margin-top: 0.3rem; }
    .team-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-top: 3rem; }
    .team-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 2rem; text-align: center; transition: all .3s; }
    .team-card:hover { border-color: rgba(244,165,53,0.4); transform: translateY(-3px); }
    .team-avatar { width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--accent2)); margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-family: var(--font-h); font-size: 1.6rem; color: var(--bg); }
    .team-name { font-weight: 600; color: var(--white); margin-bottom: 0.3rem; }
    .team-role { color: var(--accent); font-size: 0.85rem; }
    .values-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 3rem; }
    .value-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.75rem; }
    .value-icon { width: 44px; height: 44px; border-radius: 12px; background: rgba(244,165,53,0.1); display: flex; align-items: center; justify-content: center; color: var(--accent); margin-bottom: 1rem; }
    .value-title { font-weight: 600; color: var(--white); margin-bottom: 0.5rem; }
    .value-desc { color: var(--muted); font-size: 0.875rem; line-height: 1.7; }
    /* ─── RESPONSIVE ─── */
    @media (max-width: 900px) {
        .story-grid { grid-template-columns: 1fr; gap: 2.5rem; }
        .stats-inner { grid-template-columns: repeat(2,1fr); gap: 1.5rem; }
        .page-hero { padding: 7rem 1.5rem 3.5rem; }
        .mission-vision-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 640px) {
        .stats-inner { grid-template-columns: repeat(2,1fr); gap: 1rem; }
        .stat-big-num { font-size: 2.2rem; }
        .mission-vision-grid { grid-template-columns: 1fr; }
        .page-hero { padding: 6rem 1rem 2.5rem; }
        .team-grid { grid-template-columns: repeat(2, 1fr); }
        .values-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
        .team-grid { grid-template-columns: 1fr 1fr; }
        .stats-inner { grid-template-columns: 1fr 1fr; }
    }
</style>
@endpush

@section('content')

<!-- PAGE HERO -->
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="badge">Tentang Kami</div>
        <h1 class="section-title" style="font-size:clamp(2.2rem,5vw,3.5rem);">Kami adalah Tim<br><em style="color:var(--accent);font-style:normal;">Profesional</em> yang Berdedikasi</h1>
        <div class="divider"></div>
        <p class="section-subtitle" style="max-width:600px;font-size:1.05rem;">SIB berdiri dengan visi memberikan solusi terbaik di bidang desain kreatif, teknologi informasi, dan dukungan akademis yang terjangkau dan berkualitas untuk semua.</p>
    </div>
</section>

<!-- OUR STORY -->
<section class="section" style="max-width:1200px;margin:0 auto;">
    <div class="story-grid">
        <div>
            <div class="badge">Cerita Kami</div>
            <h2 class="section-title">Lahir dari Semangat<br>Membantu Sesama</h2>
            <div class="divider"></div>
            <p style="color:var(--muted);line-height:1.9;margin-bottom:1rem;">SIB (Solusi Inovatif Bisnis) berdiri pada tahun 2021, berawal dari kepedulian sekelompok anak muda yang ingin membantu para pelaku UMKM, mahasiswa, dan masyarakat umum mendapatkan akses layanan digital yang terjangkau namun berkualitas tinggi.</p>
            <p style="color:var(--muted);line-height:1.9;margin-bottom:2rem;">Dengan pengalaman lebih dari 3 tahun, kami telah melayani lebih dari 500 klien di seluruh Indonesia, mulai dari layanan desain grafis, perbaikan perangkat, bantuan akademik, hingga pembuatan website untuk UMKM.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary"><i data-lucide="send" size="16"></i> Mulai Bersama Kami</a>
        </div>
        <div class="story-visual">
            <div class="story-card">
                <div class="story-card-icon"><i data-lucide="target" size="28"></i></div>
                <h3 style="font-family:var(--font-h);font-size:1.4rem;color:var(--white);margin-bottom:1rem;">Komitmen Kami</h3>
                <p style="color:var(--muted);line-height:1.8;font-size:0.95rem;">Setiap proyek yang kami kerjakan adalah representasi dari komitmen kami terhadap kualitas, ketepatan waktu, dan kepuasan klien. Kami tidak sekadar mengerjakan—kami membangun kepercayaan.</p>
                <div class="mission-vision-grid">
                    <div class="mv-card">
                        <div class="mv-card-icon"><i data-lucide="eye" size="18"></i></div>
                        <h4>Visi</h4>
                        <p>Menjadi platform jasa kreatif dan teknologi terpercaya di Indonesia</p>
                    </div>
                    <div class="mv-card">
                        <div class="mv-card-icon"><i data-lucide="heart" size="18"></i></div>
                        <h4>Misi</h4>
                        <p>Memberdayakan bisnis & individu melalui layanan digital berkualitas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="stats-section">
    <div class="stats-inner">
        @foreach($stats as $stat)
        <div>
            <div class="stat-big-num">{{ $stat['value'] }}</div>
            <div class="stat-big-lbl">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>
</section>

<!-- TEAM -->
<section class="section" style="max-width:1200px;margin:0 auto;">
    <div class="badge">Tim Kami</div>
    <h2 class="section-title">Bertemu dengan<br>Tim Profesional SIB</h2>
    <div class="divider"></div>
    <div class="team-grid">
        @foreach($team as $member)
        <div class="team-card">
            <div class="team-avatar">{{ substr($member['name'], 0, 1) }}</div>
            <div class="team-name">{{ $member['name'] }}</div>
            <div class="team-role">{{ $member['role'] }}</div>
        </div>
        @endforeach
    </div>
</section>

<!-- VALUES -->
<section class="section" style="background:var(--bg2);border-top:1px solid var(--border);">
    <div style="max-width:1200px;margin:0 auto;">
        <div class="text-center">
            <div class="badge">Nilai Kami</div>
            <h2 class="section-title">Prinsip yang Kami<br>Pegang Teguh</h2>
            <div class="divider center"></div>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon"><i data-lucide="shield-check" size="22"></i></div>
                <div class="value-title">Kualitas Terjamin</div>
                <div class="value-desc">Setiap output yang kami berikan telah melewati proses quality control yang ketat untuk memastikan standar kualitas terbaik.</div>
            </div>
            <div class="value-card">
                <div class="value-icon"><i data-lucide="clock" size="22"></i></div>
                <div class="value-title">Tepat Waktu</div>
                <div class="value-desc">Kami sangat menghargai waktu klien. Setiap proyek dikerjakan dan diselesaikan sesuai dengan deadline yang telah disepakati.</div>
            </div>
            <div class="value-card">
                <div class="value-icon"><i data-lucide="users" size="22"></i></div>
                <div class="value-title">Berorientasi Klien</div>
                <div class="value-desc">Kepuasan klien adalah prioritas utama kami. Kami selalu mendengarkan kebutuhan dan memberikan solusi yang paling sesuai.</div>
            </div>
            <div class="value-card">
                <div class="value-icon"><i data-lucide="trending-up" size="22"></i></div>
                <div class="value-title">Inovatif</div>
                <div class="value-desc">Kami terus berinovasi mengikuti perkembangan teknologi dan tren desain untuk memberikan solusi yang relevan dan terkini.</div>
            </div>
        </div>
    </div>
</section>

@endsection
