@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Semua Pesan ({{ $contacts->total() }})</span>
        @php $unread = \App\Models\Contact::where('is_read', false)->count(); @endphp
        @if($unread > 0)
        <span class="badge badge-warning">{{ $unread }} Belum Dibaca</span>
        @endif
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Nama</th><th>Email</th><th>Layanan</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr>
                    <td style="color:var(--muted);">{{ $contact->id }}</td>
                    <td>
                        @if(!$contact->is_read)<span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:var(--accent);margin-right:6px;"></span>@endif
                        <strong style="color:var(--white);">{{ $contact->name }}</strong>
                    </td>
                    <td style="color:var(--muted);">{{ $contact->email }}</td>
                    <td>{{ $contact->service ?? '—' }}</td>
                    <td>
                        @if($contact->is_read)
                            <span class="badge badge-success">Dibaca</span>
                        @else
                            <span class="badge badge-warning">Baru</span>
                        @endif
                    </td>
                    <td style="color:var(--muted);font-size:.8rem;">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div style="display:flex;gap:.4rem;">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-secondary btn-sm btn-icon" title="Detail"><i data-lucide="eye" size="14"></i></a>
                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i data-lucide="trash-2" size="14"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--muted);">Belum ada pesan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($contacts->hasPages())
    <div style="padding-top:1rem;">{{ $contacts->links() }}</div>
    @endif
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
