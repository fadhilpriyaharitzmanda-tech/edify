@extends('layouts.auth')

@section('title', 'Masuk')
@section('meta_description', 'Masuk ke akun Edify Anda dan lanjutkan perjalanan belajar.')

@section('content')

<div class="auth-form-heading">
    <h2>Selamat Datang Kembali!</h2>
    <p>Masuk untuk melanjutkan perjalanan belajar Anda.</p>
</div>

{{-- Error Alert --}}
@if($errors->any())
<div class="alert-error" role="alert">
    {{ $errors->first() }}
</div>
@endif

@if(session('status'))
<div style="padding:0.75rem 1rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; font-size:0.85rem; color:#166534; margin-bottom:1rem;">
    {{ session('status') }}
</div>
@endif

{{-- Login Form --}}
<form method="POST" action="{{ route('login') }}" id="loginForm">
    @csrf

    <div class="form-group">
        <label class="form-label" for="loginEmail">Email</label>
        <input
            id="loginEmail"
            type="email"
            name="email"
            class="form-input"
            value="{{ old('email') }}"
            required
            autofocus
            autocomplete="username"
            placeholder="nama@email.com"
        >
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="loginPassword" style="display:flex; justify-content:space-between;">
            <span>Password</span>
            @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="auth-link">Lupa password?</a>
            @endif
        </label>
        <div style="position:relative;">
            <input
                id="loginPassword"
                type="password"
                name="password"
                class="form-input"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
                style="padding-right:2.5rem;"
            >
            <button type="button" onclick="togglePasswordVisibility('loginPassword', this)"
                style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--color-text-muted);padding:0;">
                <svg id="loginPasswordEyeOpen" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                <svg id="loginPasswordEyeClosed" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
            </button>
        </div>
        @error('password') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Remember me --}}
    <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:1rem;">
        <input type="checkbox" name="remember" id="rememberMe" style="width:16px;height:16px;accent-color:var(--color-primary);">
        <label for="rememberMe" style="font-size:0.825rem; color:var(--color-text-muted); cursor:pointer;">Ingat saya selama 30 hari</label>
    </div>

    <button type="submit" class="btn-auth" id="loginSubmitBtn">Masuk</button>
</form>

<p class="auth-footer-text">
    Belum punya akun?
    <a href="{{ route('register') }}" class="auth-link" style="font-weight:600;">Daftar gratis →</a>
</p>

@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, btn) {
        const input   = document.getElementById(inputId);
        const eyeOpen = document.getElementById(inputId + 'EyeOpen');
        const eyeClosed = document.getElementById(inputId + 'EyeClosed');
        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.style.display   = 'none';
            eyeClosed.style.display = '';
        } else {
            input.type = 'password';
            eyeOpen.style.display   = '';
            eyeClosed.style.display = 'none';
        }
    }

    // Loading state on submit
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginSubmitBtn');
        btn.textContent = 'Masuk...';
        btn.disabled = true;
    });
</script>
@endpush
