@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')

@section('content')
<div style="max-width:700px;width:100%;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Pesan dari {{ $contact->name }}</span>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="arrow-left" size="14"></i> Kembali</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-bottom:1.5rem;">
            <div style="background:var(--bg3);border-radius:10px;padding:1rem;">
                <div style="font-size:.72rem;color:var(--accent);text-transform:uppercase;letter-spacing:1px;font-weight:600;margin-bottom:.3rem;">Nama</div>
                <div style="color:var(--text);">{{ $contact->name }}</div>
            </div>
            <div style="background:var(--bg3);border-radius:10px;padding:1rem;">
                <div style="font-size:.72rem;color:var(--accent);text-transform:uppercase;letter-spacing:1px;font-weight:600;margin-bottom:.3rem;">Email</div>
                <div style="color:var(--text);">{{ $contact->email }}</div>
            </div>
            <div style="background:var(--bg3);border-radius:10px;padding:1rem;">
                <div style="font-size:.72rem;color:var(--accent);text-transform:uppercase;letter-spacing:1px;font-weight:600;margin-bottom:.3rem;">Telepon</div>
                <div style="color:var(--text);">{{ $contact->phone ?? '—' }}</div>
            </div>
            <div style="background:var(--bg3);border-radius:10px;padding:1rem;">
                <div style="font-size:.72rem;color:var(--accent);text-transform:uppercase;letter-spacing:1px;font-weight:600;margin-bottom:.3rem;">Layanan</div>
                <div style="color:var(--text);">{{ $contact->service ?? '—' }}</div>
            </div>
        </div>
        <div style="background:var(--bg3);border-radius:10px;padding:1.25rem;margin-bottom:1.5rem;">
            <div style="font-size:.72rem;color:var(--accent);text-transform:uppercase;letter-spacing:1px;font-weight:600;margin-bottom:.5rem;">Pesan</div>
            <p style="color:var(--text);line-height:1.8;white-space:pre-wrap;">{{ $contact->message }}</p>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.75rem;">
            <span style="color:var(--muted);font-size:.85rem;"><i data-lucide="clock" size="14" style="display:inline;"></i> Dikirim: {{ $contact->created_at->format('d F Y, H:i') }}</span>
            <div style="display:flex;gap:.75rem;">
                <a href="mailto:{{ $contact->email }}" class="btn btn-secondary btn-sm"><i data-lucide="mail" size="14"></i> Balas Email</a>
                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i data-lucide="trash-2" size="14"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
