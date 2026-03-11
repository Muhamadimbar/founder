@extends('layouts.admin')
@section('title', 'Detail Order')
@section('page-title', 'Detail Order')
@section('content')
<div style="max-width:800px;width:100%;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Order: <span style="color:var(--accent);">{{ $order->order_number }}</span></span>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="arrow-left" size="14"></i> Kembali</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.25rem;margin-bottom:1.5rem;">
            <div><label class="form-label" style="font-size:.72rem;">Nama</label><p style="color:var(--white);font-weight:600;">{{ $order->name }}</p></div>
            <div><label class="form-label" style="font-size:.72rem;">Email</label><p style="color:var(--text);">{{ $order->email }}</p></div>
            <div><label class="form-label" style="font-size:.72rem;">WhatsApp</label><p><a href="https://wa.me/{{ preg_replace('/\D/','',$order->phone) }}" target="_blank" style="color:var(--accent);">{{ $order->phone }}</a></p></div>
            <div><label class="form-label" style="font-size:.72rem;">Layanan</label><p style="color:var(--text);">{{ $order->service }} @if($order->package) — <span style="color:var(--accent);">{{ $order->package }}</span>@endif</p></div>
            <div><label class="form-label" style="font-size:.72rem;">Deadline</label><p style="color:var(--text);">{{ $order->deadline ?? '—' }}</p></div>
            <div><label class="form-label" style="font-size:.72rem;">Budget</label><p style="color:var(--gold);font-weight:600;">{{ $order->budget ?? '—' }}</p></div>
        </div>
        <div style="margin-bottom:1.5rem;">
            <label class="form-label" style="font-size:.72rem;">Deskripsi Kebutuhan</label>
            <div style="background:var(--bg3);border-radius:10px;padding:1rem;color:var(--text);font-size:.9rem;line-height:1.7;border:1px solid var(--border);">{{ $order->description }}</div>
        </div>
        @if($order->file_attachment)
        <div style="margin-bottom:1.5rem;">
            <label class="form-label" style="font-size:.72rem;">File Lampiran</label>
            <a href="{{ asset('storage/'.$order->file_attachment) }}" target="_blank" class="btn btn-secondary btn-sm"><i data-lucide="download" size="14"></i> Download File</a>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.orders.status', $order) }}">
            @csrf @method('PATCH')
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;margin-bottom:1rem;">
                <div>
                    <label class="form-label">Update Status</label>
                    <select name="status" class="form-control">
                        @foreach(\App\Models\Order::$statuses as $val => $info)
                        <option value="{{ $val }}" {{ $order->status==$val?'selected':'' }}>{{ $info['label'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Catatan Admin</label>
                <textarea name="admin_notes" class="form-control" placeholder="Catatan internal...">{{ $order->admin_notes }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i data-lucide="save" size="16"></i> Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
