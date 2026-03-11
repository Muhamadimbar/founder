@extends('layouts.admin')
@section('title', 'Profil Admin')
@section('page-title', 'Profil & Keamanan')
@section('content')
<div style="max-width:700px;width:100%;display:flex;flex-direction:column;gap:1.5rem;">

    {{-- Update Profil --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i data-lucide="user" size="16" style="color:var(--accent);display:inline;margin-right:.4rem;"></i> Informasi Profil</span>
        </div>
        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf @method('PATCH')
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary"><i data-lucide="save" size="16"></i> Simpan Profil</button>
        </form>
    </div>

    {{-- Ganti Password --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i data-lucide="lock" size="16" style="color:var(--accent);display:inline;margin-right:.4rem;"></i> Ganti Password</span>
        </div>
        <form method="POST" action="{{ route('admin.profile.password') }}">
            @csrf @method('PATCH')
            <div class="form-group">
                <label class="form-label">Password Lama</label>
                <input type="password" name="current_password" class="form-control" placeholder="Masukkan password lama" required>
                @error('current_password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" required>
            </div>
            <button type="submit" class="btn btn-primary"><i data-lucide="lock" size="16"></i> Ubah Password</button>
        </form>
    </div>

</div>
@endsection

@push('styles')
<style>
@media(max-width:640px){
  .card { padding: 1.25rem 1rem; }
  .card-header { gap:.5rem; }
}
</style>
@endpush
