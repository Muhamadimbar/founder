@extends('layouts.admin')
@section('title', 'Edit Portofolio')
@section('page-title', 'Edit Portofolio')
@section('content')
<div style="max-width:700px;width:100%;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Edit: {{ $portfolio->title }}</span>
            <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="arrow-left" size="14"></i> Kembali</a>
        </div>
        <form method="POST" action="{{ route('admin.portfolio.update', $portfolio) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Judul Proyek *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;">
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <select name="category" class="form-control" required>
                        @foreach($categories as $key => $label)
                        <option value="{{ $key }}" {{ old('category',$portfolio->category)==$key?'selected':'' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Klien</label>
                    <input type="text" name="client" class="form-control" value="{{ old('client', $portfolio->client) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description', $portfolio->description) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Foto</label>
                @if($portfolio->image)
                <div style="margin-bottom:1rem;background:var(--bg3);border-radius:10px;padding:1rem;border:1px solid var(--border);">
                    <img src="{{ asset('storage/'.$portfolio->image) }}" style="max-height:140px;border-radius:8px;display:block;margin-bottom:.75rem;">
                    <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.85rem;color:#e07070;">
                        <input type="checkbox" name="remove_image" value="1"> Hapus foto ini
                    </label>
                </div>
                @endif
                <div onclick="document.getElementById('imgInput').click()" style="border:2px dashed var(--border);border-radius:12px;padding:2rem;text-align:center;cursor:pointer;background:var(--bg3);" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                    <div id="imgPlaceholder"><i data-lucide="image-plus" size="36" style="color:var(--muted);display:block;margin:0 auto .75rem;"></i><p style="color:var(--muted);font-size:.875rem;">{{ $portfolio->image ? 'Ganti foto' : 'Upload foto' }}</p></div>
                    <img id="imgPreview" src="" style="display:none;max-height:200px;border-radius:8px;margin:0 auto;">
                </div>
                <input type="file" id="imgInput" name="image" accept="image/*" style="display:none;" onchange="prev(this)">
            </div>
            <div style="display:flex;gap:1.5rem;">
                <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.875rem;color:var(--text);">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$portfolio->is_featured)?'checked':'' }}> Unggulan ⭐
                </label>
                <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.875rem;color:var(--text);">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active',$portfolio->is_active)?'checked':'' }}> Tampilkan
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
