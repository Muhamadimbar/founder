@extends('layouts.admin')
@section('title', 'Kelola Orders')
@section('page-title', 'Kelola Orders')
@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Daftar Pesanan ({{ $orders->total() }})</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>No. Order</th><th>Nama</th><th>Layanan</th><th>Paket</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><code style="background:var(--bg3);padding:2px 6px;border-radius:4px;font-size:.78rem;color:var(--accent);">{{ $order->order_number }}</code></td>
                    <td>
                        <strong style="color:var(--white);">{{ $order->name }}</strong>
                        <div style="font-size:.75rem;color:var(--muted);">{{ $order->email }}</div>
                    </td>
                    <td style="color:var(--text);font-size:.85rem;">{{ $order->service }}</td>
                    <td style="color:var(--muted);font-size:.82rem;">{{ $order->package ?? '—' }}</td>
                    <td><span class="badge badge-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
                    <td style="color:var(--muted);font-size:.8rem;">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div style="display:flex;gap:.4rem;">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm btn-icon"><i data-lucide="eye" size="14"></i></a>
                            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" onsubmit="return confirm('Hapus order ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm btn-icon"><i data-lucide="trash-2" size="14"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--muted);">Belum ada pesanan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 1.5rem;">{{ $orders->links() }}</div>
</div>
@endsection

@push('styles')
<style>
@media(max-width:480px){
    .card-header { flex-direction: column; align-items: flex-start; }
}
</style>
@endpush
