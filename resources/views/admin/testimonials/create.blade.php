@extends('layouts.admin')
@section('title', 'Tambah Testimoni')
@section('page-title', 'Tambah Testimoni')

@push('styles')
<style>
.form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
@media(max-width:640px){ .form-grid-2{grid-template-columns:1fr;} }
</style>
@endpush

@section('content')
<div style="max-width:600px;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Form Tambah Testimoni</span>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="arrow-left" size="14"></i> Kembali</a>
        </div>
        <form method="POST" action="{{ route('admin.testimonials.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama *</label>
                <input type="text" name="name" class="form-control" placeholder="Nama klien" value="{{ old('name') }}" required>
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Jabatan / Pekerjaan</label>
                <input type="text" name="role" class="form-control" placeholder="Pemilik Toko Online" value="{{ old('role') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Pesan Testimoni *</label>
                <textarea name="message" class="form-control" placeholder="Isi testimoni klien..." required>{{ old('message') }}</textarea>
                @error('message')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Rating (1–5)</label>
                <select name="rating" class="form-control">
                    @for($i=5;$i>=1;$i--)
                    <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label>Tampilkan di website</label>
                </label>
            </div>
            <div style="display:flex;gap:1rem;">
                <button type="submit" class="btn btn-primary"><i data-lucide="save" size="16"></i> Simpan</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
