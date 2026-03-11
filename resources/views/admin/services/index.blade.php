@extends('layouts.admin')
@section('title', 'Kelola Layanan')
@section('page-title', 'Kelola Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Daftar Layanan ({{ $services->count() }})</span>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" size="15"></i> Tambah Layanan</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $i => $service)
                <tr>
                    <td style="color:var(--muted);">{{ $i + 1 }}</td>
                    <td>
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                                style="width:52px;height:52px;object-fit:cover;border-radius:8px;border:1px solid var(--border);">
                        @else
                            <div style="width:52px;height:52px;border-radius:8px;background:var(--bg3);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);">
                                <i data-lucide="image" size="18"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong style="color:var(--white);">{{ $service->name }}</strong>
                        <div style="color:var(--muted);font-size:0.78rem;margin-top:2px;">{{ Str::limit($service->description, 60) }}</div>
                    </td>
                    <td style="color:var(--accent);font-weight:600;">{{ $service->price ?? '—' }}</td>
                    <td><code style="background:var(--bg3);padding:2px 6px;border-radius:4px;font-size:.8rem;">{{ $service->icon }}</code></td>
                    <td>
                        @if($service->is_active)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Non-aktif</span>
                        @endif
                    </td>
                    <td style="color:var(--muted);font-size:0.8rem;">{{ $service->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div style="display:flex;gap:0.4rem;">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit"><i data-lucide="pencil" size="14"></i></a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Hapus"><i data-lucide="trash-2" size="14"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;padding:3rem;color:var(--muted);">Belum ada layanan. <a href="{{ route('admin.services.create') }}" style="color:var(--accent);">Tambah sekarang</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
