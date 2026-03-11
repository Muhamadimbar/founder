@extends('layouts.admin')
@section('title', 'Kelola Testimoni')
@section('page-title', 'Kelola Testimoni')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Daftar Testimoni ({{ $testimonials->count() }})</span>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" size="15"></i> Tambah Testimoni</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Nama</th><th>Jabatan</th><th>Rating</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($testimonials as $i => $t)
                <tr>
                    <td style="color:var(--muted);">{{ $i + 1 }}</td>
                    <td>
                        <strong style="color:var(--white);">{{ $t->name }}</strong>
                        <div style="color:var(--muted);font-size:.78rem;margin-top:2px;">{{ Str::limit($t->message, 50) }}</div>
                    </td>
                    <td style="color:var(--muted);">{{ $t->role ?? '—' }}</td>
                    <td>
                        <div style="display:flex;gap:2px;">
                            @for($s=1;$s<=5;$s++)
                                <i data-lucide="star" size="12" style="{{ $s<=$t->rating ? 'color:var(--accent);fill:var(--accent)' : 'color:var(--border)' }}"></i>
                            @endfor
                        </div>
                    </td>
                    <td>
                        @if($t->is_active)<span class="badge badge-success">Aktif</span>
                        @else <span class="badge badge-danger">Non-aktif</span> @endif
                    </td>
                    <td style="color:var(--muted);font-size:.8rem;">{{ $t->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div style="display:flex;gap:.4rem;">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-secondary btn-sm btn-icon"><i data-lucide="pencil" size="14"></i></a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Hapus testimoni?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i data-lucide="trash-2" size="14"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--muted);">Belum ada testimoni.</td></tr>
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
