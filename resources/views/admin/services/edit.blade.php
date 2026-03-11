@extends('layouts.admin')
@section('title', 'Edit Layanan')
@section('page-title', 'Edit Layanan')

@section('content')
<div style="max-width:700px;width:100%;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Edit: {{ $service->name }}</span>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="arrow-left" size="14"></i> Kembali</a>
        </div>
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama Layanan *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi *</label>
                <textarea name="description" class="form-control" required>{{ old('description', $service->description) }}</textarea>
                @error('description')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;">
                <div class="form-group">
                    <label class="form-label">Harga</label>
                    <input type="text" name="price" class="form-control" value="{{ old('price', $service->price) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Lucide)</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}">
                    <small style="color:var(--muted);font-size:0.75rem;"><a href="https://lucide.dev/icons" target="_blank" style="color:var(--accent);">Cari icon di sini</a></small>
                </div>
            </div>

            {{-- Upload Foto --}}
            <div class="form-group">
                <label class="form-label">Foto Layanan</label>

                @if($service->image)
                {{-- Foto saat ini --}}
                <div style="margin-bottom:1rem;background:var(--bg3);border-radius:10px;padding:1rem;border:1px solid var(--border);">
                    <p style="font-size:.75rem;color:var(--muted);margin-bottom:.5rem;">Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                        style="max-height:160px;border-radius:8px;display:block;margin-bottom:.75rem;">
                    <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.85rem;color:#e07070;">
                        <input type="checkbox" name="remove_image" value="1" style="accent-color:#e05555;">
                        Hapus foto ini
                    </label>
                </div>
                @endif

                <div id="uploadArea" onclick="document.getElementById('imageInput').click()"
                    style="border:2px dashed var(--border);border-radius:12px;padding:2rem;text-align:center;cursor:pointer;transition:all .2s;background:var(--bg3);"
                    onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                    <div id="uploadPlaceholder">
                        <i data-lucide="image-plus" size="36" style="color:var(--muted);margin-bottom:.75rem;display:block;margin-left:auto;margin-right:auto;"></i>
                        <p style="color:var(--muted);font-size:.875rem;">{{ $service->image ? 'Ganti dengan foto baru' : 'Klik untuk upload foto' }}</p>
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
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                    <label>Tampilkan di website (Aktif)</label>
                </label>
            </div>
            <div style="display:flex;gap:1rem;">
                <button type="submit" class="btn btn-primary"><i data-lucide="save" size="16"></i> Perbarui Layanan</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>

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
    </div>
</div>
@endsection
