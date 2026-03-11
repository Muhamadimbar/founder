@extends('layouts.admin')
@section('title', 'Kelola Portofolio')
@section('page-title', 'Kelola Portofolio')
@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Daftar Portofolio ({{ $portfolios->count() }})</span>
        <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" size="15"></i> Tambah</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>#</th><th>Foto</th><th>Judul</th><th>Kategori</th><th>Klien</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($portfolios as $i => $item)
                <tr>
                    <td style="color:var(--muted);">{{ $i+1 }}</td>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}" style="width:52px;height:52px;object-fit:cover;border-radius:8px;border:1px solid var(--border);">
                        @else
                            <div style="width:52px;height:52px;border-radius:8px;background:var(--bg3);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);"><i data-lucide="image" size="18"></i></div>
                        @endif
                    </td>
                    <td>
                        <strong style="color:var(--white);">{{ $item->title }}</strong>
                        @if($item->is_featured)<span class="badge badge-warning" style="margin-left:5px;font-size:.65rem;">⭐ Unggulan</span>@endif
                    </td>
                    <td><span class="badge badge-info">{{ $item->category_label }}</span></td>
                    <td style="color:var(--muted);font-size:.82rem;">{{ $item->client ?? '—' }}</td>
                    <td>@if($item->is_active)<span class="badge badge-success">Aktif</span>@else<span class="badge badge-danger">Nonaktif</span>@endif</td>
                    <td>
                        <div style="display:flex;gap:.4rem;">
                            <a href="{{ route('admin.portfolio.edit', $item) }}" class="btn btn-secondary btn-sm btn-icon"><i data-lucide="pencil" size="14"></i></a>
                            <form method="POST" action="{{ route('admin.portfolio.destroy', $item) }}" onsubmit="return confirm('Hapus portofolio ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i data-lucide="trash-2" size="14"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--muted);">Belum ada portofolio. <a href="{{ route('admin.portfolio.create') }}" style="color:var(--accent);">Tambah sekarang</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>

@media(max-width:640px){
  .card { padding: 1rem .85rem; }
  .card-header { gap: .5rem; }
}
@media(max-width:480px){
  th, td { padding: .6rem .6rem; font-size: .78rem; }
}
</style>
@endpush
