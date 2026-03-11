@extends('layouts.app')
@section('title', 'Pesanan Diterima')
@section('content')
<section style="min-height:80vh;display:flex;align-items:center;justify-content:center;padding:4rem 2rem;text-align:center;">
    <div style="max-width:520px;">
        <div style="width:80px;height:80px;border-radius:50%;background:rgba(82,183,136,0.1);border:2px solid #52b788;display:flex;align-items:center;justify-content:center;margin:0 auto 2rem;color:#52b788;">
            <i data-lucide="check" size="36"></i>
        </div>
        <h1 style="font-family:var(--font-h);font-size:2rem;color:var(--white);margin-bottom:0.75rem;">Pesanan Diterima!</h1>
        <p style="color:var(--muted2);margin-bottom:2rem;line-height:1.8;">Terima kasih <strong style="color:var(--text);">{{ $order->name }}</strong>! Pesanan Anda telah kami terima. Tim kami akan menghubungi Anda via WhatsApp dalam 1x24 jam.</p>
        <div style="background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:1.5rem;margin-bottom:2rem;text-align:left;">
            <div style="display:flex;justify-content:space-between;margin-bottom:0.75rem;font-size:.875rem;">
                <span style="color:var(--muted);">Nomor Order</span>
                <span style="color:var(--accent);font-weight:700;font-family:monospace;">{{ $order->order_number }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:0.75rem;font-size:.875rem;">
                <span style="color:var(--muted);">Layanan</span>
                <span style="color:var(--text);font-weight:600;">{{ $order->service }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:.875rem;">
                <span style="color:var(--muted);">Status</span>
                <span class="badge badge-warning">Menunggu Konfirmasi</span>
            </div>
        </div>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('home') }}" class="btn btn-outline">Kembali ke Beranda</a>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-gold">
                Chat WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection
