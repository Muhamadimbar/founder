@extends('layouts.admin')
@section('title', 'Tambah Portofolio')
@section('page-title', 'Tambah Portofolio')
@section('content')
<div style="max-width:700px;width:100%;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Tambah Portofolio Baru</span>
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="arrow-left" size="14"></i> Kembali</a>
        </div>
        <form method="POST" action="{{ route('admin.portfolio.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Judul Proyek *</label>
                <input type="text" name="title" class="form-control" placeholder="Contoh: Logo Brand XYZ" value="{{ old('title') }}" required>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;">
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <select name="category" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach($categories as $key => $label)
                        <option value="{{ $key }}" {{ old('category')==$key?'selected':'' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Klien</label>
                    <input type="text" name="client" class="form-control" placeholder="Contoh: PT Maju Bersama" value="{{ old('client') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" placeholder="Ceritakan tentang proyek ini...">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Foto Portofolio</label>
                <div onclick="document.getElementById('imgInput').click()" style="border:2px dashed var(--border);border-radius:12px;padding:2rem;text-align:center;cursor:pointer;background:var(--bg3);" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                    <div id="imgPlaceholder"><i data-lucide="image-plus" size="36" style="color:var(--muted);display:block;margin:0 auto .75rem;"></i><p style="color:var(--muted);font-size:.875rem;">Klik untuk upload foto</p></div>
                    <img id="imgPreview" src="" style="display:none;max-height:200px;border-radius:8px;margin:0 auto;">
                </div>
                <input type="file" id="imgInput" name="image" accept="image/*" style="display:none;" onchange="prev(this)">
            </div>
            <div style="display:flex;gap:1.5rem;">
                <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.875rem;color:var(--text);">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured')?'checked':'' }}> Tandai sebagai unggulan ⭐
                </label>
                <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.875rem;color:var(--text);">
                    <input type="checkbox" name="is_active" value="1" checked> Tampilkan di website
                </label>
            </div>
            <div style="display:flex;gap:1rem;margin-top:1.5rem;">
                <button type="submit" class="btn btn-primary"><i data-lucide="save" size="16"></i> Simpan</button>
                <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
function prev(input){if(input.files&&input.files[0]){const r=new FileReader();r.onload=e=>{document.getElementById('imgPreview').src=e.target.result;document.getElementById('imgPreview').style.display='block';document.getElementById('imgPlaceholder').style.display='none';};r.readAsDataURL(input.files[0]);}}
</script>
@endpush
