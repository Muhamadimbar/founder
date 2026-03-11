@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    /* Welcome */
    .welcome-banner {
        background: linear-gradient(135deg, rgba(244,165,53,.12), rgba(244,165,53,.03));
        border: 1px solid rgba(244,165,53,.2);
        border-radius: 18px; padding: 1.5rem 2rem;
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;
    }
    .welcome-left  { display: flex; align-items: center; gap: 1.25rem; min-width: 0; }
    .welcome-avatar { width: 52px; height: 52px; border-radius: 14px; background: rgba(244,165,53,.15); display: flex; align-items: center; justify-content: center; color: var(--accent); flex-shrink: 0; }
    .welcome-name  { font-family: var(--font-h); font-size: 1.3rem; color: var(--white); line-height: 1.2; }
    .welcome-date  { font-size: 0.78rem; color: var(--muted); margin-top: 0.2rem; }
    .welcome-right { display: flex; gap: 0.75rem; flex-wrap: wrap; }
    .quick-btn {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.5rem 1rem; border-radius: 9px; font-size: 0.8rem;
        font-weight: 600; text-decoration: none; transition: all .2s;
        background: var(--bg3); color: var(--text); border: 1px solid var(--border); font-family: var(--font-b);
    }
    .quick-btn:hover { border-color: var(--accent); color: var(--accent); }
    .quick-btn.primary { background: var(--accent); color: var(--bg); border-color: var(--accent); }
    .quick-btn.primary:hover { background: var(--accent2); }

    /* Stat Cards */
    .stats-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 1.25rem; margin-bottom: 1.75rem; }
    .stat-box {
        background: var(--bg2); border: 1px solid var(--border); border-radius: 14px;
        padding: 1.4rem 1.5rem; display: flex; align-items: center; gap: 1rem;
        transition: border-color .2s; position: relative; overflow: hidden;
    }
    .stat-box::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; border-radius:14px 14px 0 0; }
    .stat-box.amber::before { background: var(--accent); }
    .stat-box.red::before   { background: #e05555; }
    .stat-box.blue::before  { background: #56b4e9; }
    .stat-box.green::before { background: #52b788; }
    .stat-box:hover { border-color: rgba(244,165,53,.3); }
    .stat-box-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .stat-box-icon.amber { background: rgba(244,165,53,.12); color: var(--accent); }
    .stat-box-icon.red   { background: rgba(224,85,85,.12);  color: #e05555; }
    .stat-box-icon.blue  { background: rgba(86,180,233,.12); color: #56b4e9; }
    .stat-box-icon.green { background: rgba(82,183,136,.12); color: #52b788; }
    .stat-box-num { font-family: var(--font-h); font-size: 1.9rem; color: var(--white); line-height: 1; }
    .stat-box-lbl { font-size: 0.78rem; color: var(--muted); margin-top: .2rem; }

    /* Dashboard Grid */
    .dash-grid { display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem; }
    .dash-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; }
    .dash-card-head { padding: 1.1rem 1.4rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .5rem; }
    .dash-card-title { font-size: .9rem; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: .5rem; }
    .dash-card-title i { color: var(--accent); }

    /* Messages Table */
    .msg-table { width: 100%; border-collapse: collapse; font-size: .83rem; }
    .msg-table th { padding: .65rem 1.2rem; color: var(--muted); font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; text-align: left; }
    .msg-table td { padding: .75rem 1.2rem; border-top: 1px solid rgba(37,44,58,.6); vertical-align: middle; }
    .msg-table tr:hover td { background: var(--bg3); }
    .msg-name { font-weight: 600; color: var(--text); display: flex; align-items: center; gap: .4rem; }
    .dot-new  { width: 7px; height: 7px; border-radius: 50%; background: var(--accent); flex-shrink: 0; }

    /* Service List */
    .svc-list { display: flex; flex-direction: column; }
    .svc-item { display: flex; align-items: center; gap: .9rem; padding: .9rem 1.2rem; border-top: 1px solid rgba(37,44,58,.6); transition: background .15s; }
    .svc-item:first-child { border-top: none; }
    .svc-item:hover { background: var(--bg3); }
    .svc-thumb { width: 44px; height: 44px; border-radius: 9px; object-fit: cover; flex-shrink: 0; }
    .svc-thumb-placeholder { width: 44px; height: 44px; border-radius: 9px; background: rgba(244,165,53,.1); display: flex; align-items: center; justify-content: center; color: var(--accent); flex-shrink: 0; }
    .svc-info { flex: 1; min-width: 0; }
    .svc-name { font-size: .85rem; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .svc-price { font-size: .72rem; color: var(--accent); margin-top: 2px; }

    /* Info Sistem */
    .info-row { display: flex; justify-content: space-between; align-items: center; padding: .8rem 1.2rem; border-top: 1px solid rgba(37,44,58,.6); flex-wrap: wrap; gap: .5rem; }
    .info-row:first-child { border-top: none; }
    .info-key { font-size: .82rem; color: var(--muted); display: flex; align-items: center; gap: .5rem; }
    .info-val { font-size: .82rem; color: var(--text); font-weight: 600; }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1280px) {
        .stats-row { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 1024px) {
        .stats-row { grid-template-columns: repeat(2, 1fr); }
        .dash-grid  { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .welcome-banner { padding: 1.25rem; }
        .welcome-name { font-size: 1.1rem; }
        .stats-row { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .stat-box { padding: 1.1rem; gap: .75rem; }
        .stat-box-num { font-size: 1.6rem; }
    }
    @media (max-width: 480px) {
        .welcome-right { display: none; }
        .stats-row { grid-template-columns: 1fr 1fr; gap: .75rem; }
        .stat-box { padding: 1rem .85rem; }
        .stat-box-icon { width: 36px; height: 36px; }
        .stat-box-num { font-size: 1.4rem; }
    }
</style>
@endpush

@section('content')

{{-- WELCOME --}}
<div class="welcome-banner">
    <div class="welcome-left">
        <div class="welcome-avatar"><i data-lucide="user" size="24"></i></div>
        <div>
            <div class="welcome-name">Halo, {{ Auth::user()->name }}! 👋</div>
            <div class="welcome-date">{{ now()->isoFormat('dddd, D MMMM Y') }} — Panel Admin SIB</div>
        </div>
    </div>
    <div class="welcome-right">
        <a href="{{ route('admin.services.create') }}"   class="quick-btn primary"><i data-lucide="plus" size="14"></i> Tambah Layanan</a>
        <a href="{{ route('admin.portfolio.create') }}"  class="quick-btn"><i data-lucide="image" size="14"></i> Tambah Portfolio</a>
        <a href="{{ route('admin.orders.index') }}"      class="quick-btn"><i data-lucide="shopping-bag" size="14"></i> Pesanan</a>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="stats-row">
    <div class="stat-box amber">
        <div class="stat-box-icon amber"><i data-lucide="briefcase" size="22"></i></div>
        <div><div class="stat-box-num">{{ $stats['services'] }}</div><div class="stat-box-lbl">Layanan</div></div>
    </div>
    <div class="stat-box red">
        <div class="stat-box-icon red"><i data-lucide="shopping-bag" size="22"></i></div>
        <div>
            <div class="stat-box-num">{{ $stats['orders'] }}</div>
            <div class="stat-box-lbl">Total Pesanan
                @if($stats['orders_pending'] > 0)<span class="badge badge-danger" style="margin-left:.4rem;">{{ $stats['orders_pending'] }} baru</span>@endif
            </div>
        </div>
    </div>
    <div class="stat-box blue">
        <div class="stat-box-icon blue"><i data-lucide="mail" size="22"></i></div>
        <div>
            <div class="stat-box-num">{{ $stats['contacts'] }}</div>
            <div class="stat-box-lbl">Pesan Masuk
                @if($stats['unread_contacts'] > 0)<span class="badge badge-info" style="margin-left:.4rem;">{{ $stats['unread_contacts'] }} baru</span>@endif
            </div>
        </div>
    </div>
    <div class="stat-box green">
        <div class="stat-box-icon green"><i data-lucide="image" size="22"></i></div>
        <div><div class="stat-box-num">{{ $stats['portfolio'] }}</div><div class="stat-box-lbl">Portofolio</div></div>
    </div>
</div>

{{-- MAIN GRID --}}
<div class="dash-grid">
    {{-- Pesan Terbaru --}}
    <div class="dash-card">
        <div class="dash-card-head">
            <div class="dash-card-title"><i data-lucide="mail" size="16"></i> Pesan Terbaru</div>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table class="msg-table">
                <thead><tr><th>Nama</th><th>Layanan</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse($recentContacts as $contact)
                    <tr>
                        <td>
                            <div class="msg-name">
                                @if(!$contact->is_read)<span class="dot-new"></span>@endif
                                {{ $contact->name }}
                            </div>
                            <div style="font-size:.72rem;color:var(--muted);">{{ $contact->email }}</div>
                        </td>
                        <td style="color:var(--muted);font-size:.8rem;">{{ $contact->service ?? '—' }}</td>
                        <td>@if($contact->is_read)<span class="badge badge-success">Dibaca</span>@else<span class="badge badge-warning">Baru</span>@endif</td>
                        <td><a href="{{ route('admin.contacts.show',$contact) }}" class="btn btn-secondary btn-sm btn-icon"><i data-lucide="eye" size="14"></i></a></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;padding:2rem;color:var(--muted);">Belum ada pesan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Kolom Kanan --}}
    <div style="display:flex;flex-direction:column;gap:1.5rem;">
        {{-- Pesanan Terbaru --}}
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title"><i data-lucide="shopping-bag" size="16"></i> Pesanan Terbaru</div>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Semua</a>
            </div>
            <div class="svc-list">
                @forelse($recentOrders as $order)
                <div class="svc-item">
                    <div class="svc-thumb-placeholder"><i data-lucide="package" size="18"></i></div>
                    <div class="svc-info">
                        <div class="svc-name">{{ $order->name }}</div>
                        <div class="svc-price">{{ $order->service }}</div>
                    </div>
                    <span class="badge badge-{{ $order->status_color }}">{{ $order->status_label }}</span>
                </div>
                @empty
                <div style="padding:1.5rem;text-align:center;color:var(--muted);font-size:.85rem;">Belum ada pesanan.</div>
                @endforelse
            </div>
        </div>

        {{-- Info Sistem --}}
        <div class="dash-card">
            <div class="dash-card-head">
                <div class="dash-card-title"><i data-lucide="server" size="16"></i> Info Sistem</div>
            </div>
            <div>
                <div class="info-row"><div class="info-key"><i data-lucide="cpu" size="13"></i>PHP</div><div class="info-val">{{ PHP_VERSION }}</div></div>
                <div class="info-row"><div class="info-key"><i data-lucide="database" size="13"></i>Database</div><div class="info-val">SQLite</div></div>
                <div class="info-row"><div class="info-key"><i data-lucide="layers" size="13"></i>Laravel</div><div class="info-val">{{ app()->version() }}</div></div>
                <div class="info-row"><div class="info-key"><i data-lucide="hard-drive" size="13"></i>Storage</div><div class="info-val">{{ number_format(disk_free_space('/') / 1073741824, 1) }} GB free</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
