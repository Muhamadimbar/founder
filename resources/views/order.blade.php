@extends('layouts.app')
@section('title', 'Buat Pesanan')

@push('styles')
<style>
.order-hero { padding: 6rem 2rem 4rem; }
.order-grid { display: grid; grid-template-columns: 1.4fr 1fr; gap: 3rem; max-width: 1100px; margin: 0 auto; align-items: start; }
.order-form-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 20px; padding: 2.5rem; }
.order-form-card::before { content:''; display:block; height:3px; background:linear-gradient(90deg,var(--accent),var(--gold)); border-radius:20px 20px 0 0; margin:-2.5rem -2.5rem 2.5rem; }
.form-group { margin-bottom: 1.35rem; }
.form-label { display: block; font-size: 0.82rem; font-weight: 700; color: var(--text); margin-bottom: 0.4rem; text-transform: uppercase; letter-spacing: 0.5px; }
.form-control { width: 100%; background: var(--bg3); border: 1.5px solid var(--border); border-radius: 10px; padding: 0.75rem 1rem; color: var(--text); font-family: var(--font-b); font-size: 0.9rem; transition: border-color .2s; }
.form-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(230,57,70,0.1); }
textarea.form-control { resize: vertical; min-height: 120px; }
select.form-control { cursor: pointer; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-error { color: #f87171; font-size: 0.78rem; margin-top: 0.35rem; }
.order-info-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 20px; padding: 2rem; position: sticky; top: 90px; }
.order-info-title { font-family: var(--font-h); font-size: 1.3rem; color: var(--white); margin-bottom: 1.5rem; }
.order-step { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
.order-step-num { width: 32px; height: 32px; border-radius: 50%; background: rgba(230,57,70,0.1); border: 1.5px solid rgba(230,57,70,0.3); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; color: var(--accent); flex-shrink: 0; }
.order-step-text strong { display: block; color: var(--text); font-size: 0.875rem; margin-bottom: 0.2rem; }
.order-step-text span { color: var(--muted); font-size: 0.8rem; }
.order-guarantee { background: var(--bg3); border-radius: 12px; padding: 1.25rem; margin-top: 1.5rem; border: 1px solid var(--border); }
.guarantee-item { display: flex; align-items: center; gap: 0.6rem; font-size: 0.82rem; color: var(--muted2); margin-bottom: 0.6rem; }
.guarantee-item:last-child { margin-bottom: 0; }
.guarantee-item i { color: #52b788; flex-shrink: 0; }
/* ─── RESPONSIVE ─── */
@media (max-width: 1024px) {
    .order-grid { gap: 2rem; }
    .order-info-card { position: static; }
}
@media (max-width: 900px) {
    .order-grid { grid-template-columns: 1fr; }
    .order-info-card { order: -1; }
    .order-hero { padding: 5rem 1.5rem 3rem; }
}
@media (max-width: 640px) {
    .form-row { grid-template-columns: 1fr; }
    .order-form-card { padding: 1.75rem 1.25rem; }
    .order-form-card::before { margin: -1.75rem -1.25rem 1.75rem; }
    .order-info-card { padding: 1.5rem 1.25rem; }
    .order-hero { padding: 4.5rem 1rem 2.5rem; }
}
</style>
@endpush

@section('content')
<section class="order-hero">
    <div style="text-align:center;margin-bottom:3rem;">
        <div class="badge-pill" style="margin:0 auto 1rem;"><i data-lucide="shopping-bag" size="11"></i> Pesan Sekarang</div>
        <h1 class="section-title">Buat Pesanan</h1>
        <p class="section-subtitle" style="margin:0 auto;">Isi form di bawah ini dan tim kami akan menghubungi Anda dalam 1x24 jam.</p>
    </div>

    <div class="order-grid">
        <div class="order-form-card">
            <form method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required>
                        @error('name')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp *</label>
                        <input type="text" name="phone" class="form-control" placeholder="08xx-xxxx-xxxx" value="{{ old('phone') }}" required>
                        @error('phone')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Layanan yang Dibutuhkan *</label>
                        <select name="service" class="form-control" required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($services as $svc)
                            <option value="{{ $svc->name }}" {{ old('service')==$svc->name?'selected':'' }}>{{ $svc->name }}</option>
                            @endforeach
                        </select>
                        @error('service')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Paket</label>
                        <select name="package" class="form-control">
                            <option value="">-- Pilih Paket --</option>
                            <option value="Basic" {{ old('package')=='Basic'?'selected':'' }}>Basic</option>
                            <option value="Standard" {{ old('package')=='Standard'?'selected':'' }}>Standard</option>
                            <option value="Premium" {{ old('package')=='Premium'?'selected':'' }}>Premium</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Kebutuhan *</label>
                    <textarea name="description" class="form-control" placeholder="Jelaskan secara detail kebutuhan Anda, referensi, warna yang diinginkan, dll..." required>{{ old('description') }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Target Selesai</label>
                        <input type="text" name="deadline" class="form-control" placeholder="Contoh: 3 hari, 1 minggu" value="{{ old('deadline') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Budget (Opsional)</label>
                        <input type="text" name="budget" class="form-control" placeholder="Contoh: Rp 200.000" value="{{ old('budget') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Upload File Referensi (Opsional)</label>
                    <input type="file" name="file_attachment" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.zip,.doc,.docx">
                    <small style="color:var(--muted);font-size:.75rem;margin-top:.3rem;display:block;">Format: JPG, PNG, PDF, ZIP, DOC — Maks 10MB</small>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:1rem;font-size:1rem;">
                    <i data-lucide="send" size="18"></i> Kirim Pesanan
                </button>
            </form>
        </div>

        <div class="order-info-card">
            <div class="order-info-title">Cara Kerja Kami</div>
            <div class="order-step">
                <div class="order-step-num">1</div>
                <div class="order-step-text"><strong>Isi Form Pesanan</strong><span>Lengkapi detail kebutuhan Anda di form ini</span></div>
            </div>
            <div class="order-step">
                <div class="order-step-num">2</div>
                <div class="order-step-text"><strong>Konfirmasi Tim</strong><span>Tim kami menghubungi via WhatsApp dalam 1x24 jam</span></div>
            </div>
            <div class="order-step">
                <div class="order-step-num">3</div>
                <div class="order-step-text"><strong>Pengerjaan</strong><span>Proyek dikerjakan sesuai brief dan timeline</span></div>
            </div>
            <div class="order-step">
                <div class="order-step-num">4</div>
                <div class="order-step-text"><strong>Revisi & Selesai</strong><span>Revisi hingga puas, lalu file diserahkan</span></div>
            </div>
            <div class="order-guarantee">
                <div class="guarantee-item"><i data-lucide="check-circle" size="15"></i> Revisi sampai puas</div>
                <div class="guarantee-item"><i data-lucide="check-circle" size="15"></i> Harga transparan, tanpa biaya tersembunyi</div>
                <div class="guarantee-item"><i data-lucide="check-circle" size="15"></i> Pengerjaan tepat waktu</div>
                <div class="guarantee-item"><i data-lucide="check-circle" size="15"></i> Garansi kepuasan 100%</div>
            </div>
        </div>
    </div>
</section>
@endsection
