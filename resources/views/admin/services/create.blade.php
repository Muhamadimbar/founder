@extends('layouts.admin')
@section('title', 'Tambah Layanan')
@section('page-title', 'Tambah Layanan Baru')

@section('content')
<div style="max-width:700px;width:100%;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Form Tambah Layanan</span>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="arrow-left" size="14"></i> Kembali</a>
        </div>
        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Layanan *</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Desain Grafis" value="{{ old('name') }}" required>
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi *</label>
                <textarea name="description" class="form-control" placeholder="Jelaskan detail layanan Anda..." required>{{ old('description') }}</textarea>
                @error('description')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;">
                <div class="form-group">
                    <label class="form-label">Harga</label>
                    <input type="text" name="price" class="form-control" placeholder="Mulai Rp 150.000" value="{{ old('price') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Lucide)</label>
                    <input type="text" name="icon" class="form-control" placeholder="palette" value="{{ old('icon', 'briefcase') }}">
                    <small style="color:var(--muted);font-size:0.75rem;">Lihat icon: <a href="https://lucide.dev/icons" target="_blank" style="color:var(--accent);">lucide.dev/icons</a></small>
                </div>
            </div>

            {{-- Upload Foto --}}
            <div class="form-group">
                <label class="form-label">Foto Layanan</label>
                <div id="uploadArea" onclick="document.getElementById('imageInput').click()"
                    style="border:2px dashed var(--border);border-radius:12px;padding:2rem;text-align:center;cursor:pointer;transition:all .2s;background:var(--bg3);"
                    onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                    <div id="uploadPlaceholder">
                        <i data-lucide="image-plus" size="36" style="color:var(--muted);margin-bottom:.75rem;display:block;margin-left:auto;margin-right:auto;"></i>
                        <p style="color:var(--muted);font-size:.875rem;">Klik untuk upload foto</p>
                        <p style="color:var(--muted);font-size:.75rem;margin-top:.25rem;">JPG, PNG, WEBP — Maks. 2MB</p>
                    </div>
                    <img id="imagePreview" src="" alt="Preview"
                        style="display:none;max-height:200px;border-radius:8px;margin:0 auto;">
                </div>
                <input type="file" name="image" id="imageInput" accept="image/*" style="display:none;" onchange="previewImage(this)">
                @error('image')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label>Tampilkan di website (Aktif)</label>
                </label>
            </div>
            <div style="display:flex;gap:1rem;">
                <button type="submit" class="btn btn-primary"><i data-lucide="save" size="16"></i> Simpan Layanan</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
            document.getElementById('uploadPlaceholder').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
