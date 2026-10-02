<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Masuk') — Edify</title>
    <meta name="description" content="@yield('meta_description', 'Masuk atau daftar ke Edify untuk mulai belajar.')">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta name="robots" content="noindex, nofollow">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ===========================
           Design Tokens
        =========================== */
        :root {
            --color-primary:      #6366f1;
            --color-primary-dark: #4f46e5;
            --color-bg:           #f8fafc;
            --color-bg-dark:      #09090b;
            --color-text:         #1e293b;
            --color-text-muted:   #64748b;
            --color-border:       #e2e8f0;
            --color-card:         #ffffff;
            --color-card-dark:    #18181b;
            --radius:             0.75rem;
            --transition:         0.22s cubic-bezier(0.22,1,0.36,1);
        }

        [data-theme="dark"] {
            --color-bg:         var(--color-bg-dark);
            --color-text:       #f9fafb;
            --color-text-muted: #9ca3af;
            --color-border:     #27272a;
            --color-card:       var(--color-card-dark);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--color-bg);
            color: var(--color-text);
            transition: background var(--transition), color var(--transition);
        }

        /* ===========================
           Auth Shell — two-panel layout
        =========================== */
        .auth-shell {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* Left Panel — decorative / branding */
        .auth-panel-left {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 60%, #a21caf 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Decorative blobs */
        .auth-panel-left::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 360px; height: 360px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }
        .auth-panel-left::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 280px; height: 280px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
        }

        .auth-branding { position: relative; z-index: 1; text-align: center; color: #fff; }
        .auth-logo-box {
            width: 64px; height: 64px;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
            backdrop-filter: blur(8px);
        }
        .auth-logo-box svg { width: 36px; height: 36px; color: #fff; }
        .auth-branding h1 { font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; }
        .auth-branding p { font-size: 0.95rem; color: rgba(255,255,255,0.75); max-width: 22rem; line-height: 1.6; }

        /* Tagline cards */
        .auth-features {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            width: 100%;
            max-width: 22rem;
            position: relative;
            z-index: 1;
        }
        .auth-feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            backdrop-filter: blur(8px);
            color: #fff;
            font-size: 0.85rem;
        }
        .auth-feature-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* Right Panel — form area */
        .auth-panel-right {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.5rem;
            background: var(--color-card);
            position: relative;
        }

        /* Back to home link */
        .auth-back {
            position: absolute;
            top: 1.25rem; left: 1.5rem;
            display: flex; align-items: center; gap: 0.375rem;
            font-size: 0.8rem;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: color 0.15s;
        }
        .auth-back:hover { color: var(--color-primary); }
        .auth-back svg { width: 14px; height: 14px; }

        /* Theme toggle in auth */
        .auth-theme-btn {
            position: absolute;
            top: 1.25rem; right: 1.5rem;
            width: 36px; height: 36px;
            border: 1px solid var(--color-border);
            background: transparent; cursor: pointer;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--color-text-muted);
            transition: background var(--transition);
        }
        .auth-theme-btn:hover { background: var(--color-bg); }
        .auth-theme-btn svg { width: 16px; height: 16px; }

        /* Auth form card */
        .auth-form-wrap {
            width: 100%;
            max-width: 400px;
        }

        .auth-form-heading {
            margin-bottom: 1.75rem;
        }
        .auth-form-heading h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 0.375rem;
        }
        .auth-form-heading p {
            font-size: 0.875rem;
            color: var(--color-text-muted);
        }

        /* Form elements */
        .form-group { margin-bottom: 1.125rem; }
        .form-label {
            display: block;
            font-size: 0.825rem;
            font-weight: 500;
            color: var(--color-text);
            margin-bottom: 0.375rem;
        }
        .form-input {
            width: 100%;
            padding: 0.6rem 0.875rem;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            font-size: 0.875rem;
            font-family: inherit;
            background: var(--color-bg);
            color: var(--color-text);
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .form-input::placeholder { color: var(--color-text-muted); }

        /* Submit btn */
        .btn-auth {
            width: 100%;
            padding: 0.7rem;
            background: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: background var(--transition), transform 0.15s;
            margin-top: 0.5rem;
        }
        .btn-auth:hover { background: var(--color-primary-dark); transform: translateY(-1px); }

        /* Links */
        .auth-link { color: var(--color-primary); text-decoration: none; font-size: 0.8rem; }
        .auth-link:hover { text-decoration: underline; }
        .auth-footer-text { text-align: center; font-size: 0.8rem; color: var(--color-text-muted); margin-top: 1.25rem; }

        /* Divider */
        .auth-divider {
            display: flex; align-items: center; gap: 0.75rem;
            margin: 1rem 0;
            font-size: 0.75rem;
            color: var(--color-text-muted);
        }
        .auth-divider::before, .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--color-border);
        }

        /* Alert errors */
        .form-error { font-size: 0.78rem; color: #ef4444; margin-top: 0.3rem; }
        .alert-error {
            padding: 0.75rem 1rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            font-size: 0.85rem;
            color: #b91c1c;
            margin-bottom: 1rem;
        }
        [data-theme="dark"] .alert-error { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.3); color: #fca5a5; }

        /* Responsive — single column on mobile */
        @media (max-width: 768px) {
            .auth-shell { grid-template-columns: 1fr; }
            .auth-panel-left { display: none; }
            .auth-panel-right { min-height: 100vh; }
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="auth-shell">

    {{-- ======================== LEFT PANEL ======================== --}}
    <div class="auth-panel-left" aria-hidden="true">
        <div class="auth-branding">
            <a href="{{ url('/') }}" style="display:inline-block; margin-bottom: 1.5rem;" aria-label="Edify">
                <img src="{{ asset('images/logo-dark.png') }}" alt="Edify" style="height: 52px; width: auto; object-fit: contain; display: block; margin: 0 auto;">
            </a>
            <p>Platform pembelajaran online dan upskilling terbaik untuk mengembangkan skill dan meraih karier impian Anda bersama para mentor profesional.</p>
        </div>

        <div class="auth-features">
            <div class="auth-feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>200+ kursus dari instruktur berpengalaman</span>
            </div>
            <div class="auth-feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Belajar kapan saja, di mana saja</span>
            </div>
            <div class="auth-feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Sertifikat yang diakui industri</span>
            </div>
            <div class="auth-feature-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>Komunitas belajar aktif 50.000+ anggota</span>
            </div>
        </div>
    </div>

    {{-- ======================== RIGHT PANEL ======================== --}}
    <div class="auth-panel-right">

        {{-- Back to home --}}
        <a href="{{ url('/') }}" class="auth-back" aria-label="Kembali ke beranda">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali ke beranda
        </a>

        {{-- Theme toggle --}}
        <button class="auth-theme-btn" onclick="toggleAuthTheme()" aria-label="Toggle tema">
            <svg id="authSunIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            <svg id="authMoonIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </button>

        {{-- Form content --}}
        <div class="auth-form-wrap">
            @yield('content')
        </div>

    </div>

</div>

<script>
    function toggleAuthTheme() {
        const current = document.documentElement.getAttribute('data-theme') || 'light';
        const next    = current === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', next);
        document.getElementById('authSunIcon').style.display  = next === 'dark' ? 'none' : '';
        document.getElementById('authMoonIcon').style.display = next === 'dark' ? ''     : 'none';
        localStorage.setItem('rb-theme', next);
    }
    // On load
    const savedTheme = localStorage.getItem('rb-theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    if (savedTheme === 'dark') {
        document.getElementById('authSunIcon').style.display  = 'none';
        document.getElementById('authMoonIcon').style.display = '';
    }
</script>

@stack('scripts')
</body>
</html>
