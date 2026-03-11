@extends('layouts.app')
@section('title', 'Kontak')

@push('styles')
<style>
    .page-hero { padding: 9rem 2rem 4rem; }
    .contact-grid { display: grid; grid-template-columns: 1fr 1.5fr; gap: 4rem; align-items: start; }
    .contact-info-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 20px; padding: 2.5rem; }
    .contact-info-title { font-family: var(--font-h); font-size: 1.6rem; color: var(--white); margin-bottom: 0.5rem; }
    .contact-info-desc { color: var(--muted); font-size: 0.9rem; line-height: 1.7; margin-bottom: 2rem; }
    .contact-item { display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1.5rem; }
    .contact-item-icon { width: 44px; height: 44px; border-radius: 12px; background: rgba(244,165,53,0.1); display: flex; align-items: center; justify-content: center; color: var(--accent); flex-shrink: 0; }
    .contact-item-label { font-size: 0.75rem; font-weight: 600; color: var(--accent); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.2rem; }
    .contact-item-value { color: var(--text); font-size: 0.9rem; }
    .social-links { display: flex; gap: 0.75rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border); }
    .social-link-btn { width: 42px; height: 42px; border-radius: 10px; background: var(--bg3); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--muted); text-decoration: none; transition: all .2s; }
    .social-link-btn:hover { background: var(--accent); border-color: var(--accent); color: var(--bg); }
    .contact-form-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 20px; padding: 2.5rem; }
    .contact-form-title { font-family: var(--font-h); font-size: 1.5rem; color: var(--white); margin-bottom: 1.5rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .form-group { margin-bottom: 1.25rem; }
    .form-label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--text); margin-bottom: 0.4rem; }
    .form-label span { color: var(--accent); }
    .form-control { width: 100%; padding: 0.75rem 1rem; border-radius: 10px; background: var(--bg3); border: 1.5px solid var(--border); color: var(--text); font-family: var(--font-b); font-size: 0.9rem; transition: border-color .2s; }
    .form-control:focus { outline: none; border-color: var(--accent); background: var(--bg4); }
    .form-control::placeholder { color: var(--muted); }
    textarea.form-control { min-height: 140px; resize: vertical; }
    select.form-control option { background: var(--bg3); }
    .form-error { color: #e07070; font-size: 0.8rem; margin-top: 0.3rem; display: flex; align-items: center; gap: 0.3rem; }
    .submit-btn { width: 100%; padding: 0.9rem; background: var(--accent); color: var(--bg); border: none; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; font-family: var(--font-b); display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all .2s; }
    .submit-btn:hover { background: var(--accent2); transform: translateY(-1px); }
    .whatsapp-btn { display: flex; align-items: center; gap: 0.75rem; background: #25d366; color: white; text-decoration: none; padding: 0.75rem 1.25rem; border-radius: 10px; font-weight: 600; font-size: 0.9rem; margin-top: 1rem; justify-content: center; transition: all .2s; }
    .whatsapp-btn:hover { background: #1db954; }
    /* ─── RESPONSIVE ─── */
    @media (max-width: 900px) {
        .contact-grid { grid-template-columns: 1fr; gap: 2rem; }
        .page-hero { padding: 7rem 1.5rem 3rem; }
    }
    @media (max-width: 640px) {
        .form-row { grid-template-columns: 1fr; }
        .contact-form-card { padding: 1.75rem 1.25rem; }
        .contact-info-card { padding: 1.75rem 1.25rem; }
        .page-hero { padding: 6rem 1rem 2.5rem; }
    }
</style>
@endpush

@section('content')

<section class="page-hero" style="background:radial-gradient(ellipse 60% 60% at 60% 40%,rgba(244,165,53,0.07) 0%,transparent 70%);">
    <div style="max-width:1200px;margin:0 auto;">
        <div class="badge">Kontak</div>
        <h1 class="section-title" style="font-size:clamp(2.2rem,5vw,3.5rem);">Kami Siap Membantu<br><em style="color:var(--accent);font-style:normal;">Kebutuhan Anda</em></h1>
        <div class="divider"></div>
        <p class="section-subtitle" style="font-size:1.05rem;">Jangan ragu untuk menghubungi kami. Konsultasi pertama gratis!</p>
    </div>
</section>

<section class="section" style="max-width:1200px;margin:0 auto;">
    <div class="contact-grid">
        <!-- Contact Info -->
        <div>
            <div class="contact-info-card">
                <h3 class="contact-info-title">Informasi Kontak</h3>
                <p class="contact-info-desc">Hubungi kami melalui berbagai saluran berikut atau isi formulir dan kami akan segera merespons.</p>

                <div class="contact-item">
                    <div class="contact-item-icon"><i data-lucide="map-pin" size="20"></i></div>
                    <div>
                        <div class="contact-item-label">Alamat</div>
                        <div class="contact-item-value">Jl. Teknologi No. 10,<br>Kota Digital, Indonesia</div>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i data-lucide="phone" size="20"></i></div>
                    <div>
                        <div class="contact-item-label">Telepon / WhatsApp</div>
                        <div class="contact-item-value">+62 812-3456-7890</div>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i data-lucide="mail" size="20"></i></div>
                    <div>
                        <div class="contact-item-label">Email</div>
                        <div class="contact-item-value">hello@sib.co.id</div>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i data-lucide="clock" size="20"></i></div>
                    <div>
                        <div class="contact-item-label">Jam Operasional</div>
                        <div class="contact-item-value">Senin – Sabtu: 08.00 – 20.00 WIB<br>Minggu: 09.00 – 16.00 WIB</div>
                    </div>
                </div>

                <div class="social-links">
                    <a href="#" class="social-link-btn" title="Instagram"><i data-lucide="instagram" size="18"></i></a>
                    <a href="#" class="social-link-btn" title="Facebook"><i data-lucide="facebook" size="18"></i></a>
                    <a href="#" class="social-link-btn" title="Twitter"><i data-lucide="twitter" size="18"></i></a>
                    <a href="#" class="social-link-btn" title="YouTube"><i data-lucide="youtube" size="18"></i></a>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-card">
            <h3 class="contact-form-title">Kirim Pesan</h3>

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span>*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama Anda" value="{{ old('name') }}" required>
                        @error('name')<div class="form-error"><i data-lucide="alert-circle" size="12"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email <span>*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="email@domain.com" value="{{ old('email') }}" required>
                        @error('email')<div class="form-error"><i data-lucide="alert-circle" size="12"></i> {{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" class="form-control" placeholder="+62 812-xxxx-xxxx" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Layanan yang Diinginkan</label>
                        <select name="service" class="form-control">
                            <option value="">-- Pilih Layanan --</option>
                            <option value="Desain Grafis" {{ old('service') == 'Desain Grafis' ? 'selected' : '' }}>🎨 Desain Grafis</option>
                            <option value="Perbaikan Laptop" {{ old('service') == 'Perbaikan Laptop' ? 'selected' : '' }}>💻 Perbaikan Laptop</option>
                            <option value="Bantuan Pengerjaan Tugas" {{ old('service') == 'Bantuan Pengerjaan Tugas' ? 'selected' : '' }}>📚 Bantuan Pengerjaan Tugas</option>
                            <option value="Pembuatan Website UMKM" {{ old('service') == 'Pembuatan Website UMKM' ? 'selected' : '' }}>🌐 Pembuatan Website UMKM</option>
                            <option value="Lainnya" {{ old('service') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Pesan <span>*</span></label>
                    <textarea name="message" class="form-control" placeholder="Ceritakan kebutuhan Anda secara detail..." required>{{ old('message') }}</textarea>
                    @error('message')<div class="form-error"><i data-lucide="alert-circle" size="12"></i> {{ $message }}</div>@enderror
                </div>
                <button type="submit" class="submit-btn"><i data-lucide="send" size="18"></i> Kirim Pesan Sekarang</button>
            </form>

            <a href="https://wa.me/6281234567890" target="_blank" class="whatsapp-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Chat via WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection
