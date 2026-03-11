@extends('layouts.admin')
@section('title', 'Edit Testimoni')
@section('page-title', 'Edit Testimoni')

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
            <span class="card-title">Edit: {{ $testimonial->name }}</span>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="arrow-left" size="14"></i> Kembali</a>
        </div>
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Jabatan</label>
                <input type="text" name="role" class="form-control" value="{{ old('role', $testimonial->role) }}">
            </div>
            <div class="form-group">
                <label class="form-label">Pesan *</label>
                <textarea name="message" class="form-control" required>{{ old('message', $testimonial->message) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Rating</label>
                <select name="rating" class="form-control">
                    @for($i=5;$i>=1;$i--)
                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                    <label>Tampilkan di website</label>
                </label>
            </div>
            <div style="display:flex;gap:1rem;">
                <button type="submit" class="btn btn-primary"><i data-lucide="save" size="16"></i> Perbarui</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
