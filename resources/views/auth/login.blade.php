<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — SIB</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0c0f14; --bg2: #141820; --bg3: #1a1f2b; --border: #252c3a;
            --text: #e8eaf2; --muted: #7a8199; --accent: #f4a535; --accent2: #e8891a;
            --font-h: 'DM Serif Display', Georgia, serif; --font-b: 'DM Sans', sans-serif;
        }
        body { background: var(--bg); font-family: var(--font-b); min-height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .bg-glow {
            position: fixed; inset: 0; z-index: 0;
            background:
                radial-gradient(ellipse 60% 50% at 20% 80%, rgba(244,165,53,0.06) 0%, transparent 70%),
                radial-gradient(ellipse 50% 60% at 80% 20%, rgba(244,165,53,0.05) 0%, transparent 70%);
        }
        .grid-bg { position: fixed; inset: 0; z-index: 0; opacity: 0.02; background-image: linear-gradient(var(--text) 1px, transparent 1px), linear-gradient(90deg, var(--text) 1px, transparent 1px); background-size: 60px 60px; }
        .login-wrapper { position: relative; z-index: 1; width: 100%; max-width: 420px; padding: 1.5rem; animation: fadeUp .5s ease; }
        .login-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 24px; padding: 3rem 2.5rem; }
        .login-brand { text-align: center; margin-bottom: 2.5rem; }
        .login-logo-img { height: 72px; width: auto; object-fit: contain; filter: drop-shadow(0 0 20px rgba(244,165,53,0.35)); margin-bottom: 0.5rem; display: block; margin-left: auto; margin-right: auto; }
        .login-logo-text { font-family: var(--font-h); font-size: 2.8rem; color: white; line-height: 1; }
        .login-logo-text span { color: var(--accent); }
        .login-tagline { font-size: 0.75rem; color: var(--muted); margin-top: 0.4rem; letter-spacing: 2px; text-transform: uppercase; }
        .login-title { font-size: 1.1rem; font-weight: 600; color: var(--text); margin-bottom: 0.25rem; text-align: center; }
        .login-subtitle { font-size: 0.85rem; color: var(--muted); text-align: center; margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; font-size: 0.82rem; font-weight: 600; color: var(--text); margin-bottom: 0.4rem; }
        .input-wrapper { position: relative; }
        .input-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--muted); pointer-events: none; }
        .form-control { width: 100%; padding: 0.75rem 1rem 0.75rem 2.75rem; border-radius: 10px; background: var(--bg3); border: 1.5px solid var(--border); color: var(--text); font-family: var(--font-b); font-size: 0.9rem; transition: all .2s; }
        .form-control:focus { outline: none; border-color: var(--accent); background: #1d2433; }
        .form-control::placeholder { color: var(--muted); }
        .password-toggle { position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--muted); padding: 0; transition: color .2s; }
        .password-toggle:hover { color: var(--text); }
        .form-options { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .form-check { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; }
        .form-check input { accent-color: var(--accent); cursor: pointer; }
        .form-check label { font-size: 0.85rem; color: var(--muted); cursor: pointer; }
        .error-box { background: rgba(224,85,85,0.1); border: 1px solid rgba(224,85,85,0.3); color: #e07070; border-radius: 10px; padding: 0.75rem 1rem; font-size: 0.85rem; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; }
        .submit-btn { width: 100%; padding: 0.85rem; background: var(--accent); color: var(--bg); border: none; border-radius: 10px; font-weight: 700; font-size: 0.95rem; cursor: pointer; font-family: var(--font-b); display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all .2s; }
        .submit-btn:hover { background: var(--accent2); transform: translateY(-1px); }
        .back-link { display: flex; align-items: center; justify-content: center; gap: 0.4rem; margin-top: 1.5rem; color: var(--muted); font-size: 0.85rem; text-decoration: none; transition: color .2s; }
        .back-link:hover { color: var(--accent); }
        .demo-info { margin-top: 1.5rem; background: rgba(244,165,53,0.06); border: 1px solid rgba(244,165,53,0.2); border-radius: 10px; padding: 0.875rem 1rem; }
        .demo-title { font-size: 0.72rem; font-weight: 700; color: var(--accent); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.4rem; }
        .demo-cred { font-size: 0.82rem; color: var(--muted); }
        .demo-cred strong { color: var(--text); }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
<div class="bg-glow"></div>
<div class="grid-bg"></div>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-brand">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ asset('images/logo.png') }}" alt="SIB Group" class="login-logo-img">
            @else
                <div class="login-logo-text">Si<span>B</span></div>
            @endif
            <div class="login-tagline">Solusi Inovatif Bisnis</div>
        </div>

        <p class="login-title"> Selamat Datang </p>
        <p class="login-subtitle">Masuk ke panel administrasi SIB</p>

        @if($errors->any())
        <div class="error-box">
            <i data-lucide="alert-circle" size="16"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Alamat Email</label>
                <div class="input-wrapper">
                    <i data-lucide="mail" size="16" class="input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="admin@sib.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i data-lucide="lock" size="16" class="input-icon"></i>
                    <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i data-lucide="eye" size="16" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            <div class="form-options">
                <label class="form-check">
                    <input type="checkbox" name="remember"> <label>Ingat saya</label>
                </label>
            </div>
            <button type="submit" class="submit-btn">
                <i data-lucide="log-in" size="18"></i> Masuk ke Dashboard
            </button>
        </form>

        <a href="{{ route('home') }}" class="back-link">
            <i data-lucide="arrow-left" size="14"></i> Kembali ke Website
        </a>

       <!-- <div class="demo-info">
            <div class="demo-title">🔑 Demo Login</div>
            <div class="demo-cred">Email: <strong>admin@sib.com</strong></div>
            <div class="demo-cred">Password: <strong>admin123</strong></div>
        </div>-->
    </div>
</div>

<script>
    lucide.createIcons();
    let shown = false;
    function togglePassword() {
        shown = !shown;
        const pw = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        pw.type = shown ? 'text' : 'password';
        icon.setAttribute('data-lucide', shown ? 'eye-off' : 'eye');
        lucide.createIcons();
    }
</script>
</body>
</html>
