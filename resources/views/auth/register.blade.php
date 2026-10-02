@extends('layouts.auth')

@section('title', 'Daftar Akun')
@section('meta_description', 'Daftar akun Edify gratis dan mulai belajar hari ini.')

@section('content')

<div class="auth-form-heading">
    <h2>Buat Akun Gratis</h2>
    <p>Bergabunglah dengan 50.000+ pelajar di Edify.</p>
</div>

{{-- Error Alert --}}
@if($errors->any())
<div class="alert-error" role="alert">
    {{ $errors->first() }}
</div>
@endif

{{-- Register Form --}}
<form method="POST" action="{{ route('register') }}" id="registerForm">
    @csrf

    <div class="form-group">
        <label class="form-label" for="registerName">Nama Lengkap</label>
        <input
            id="registerName"
            type="text"
            name="name"
            class="form-input"
            value="{{ old('name') }}"
            required
            autofocus
            autocomplete="name"
            placeholder="Masukkan nama lengkap Anda"
        >
        @error('name') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="registerEmail">Email</label>
        <input
            id="registerEmail"
            type="email"
            name="email"
            class="form-input"
            value="{{ old('email') }}"
            required
            autocomplete="username"
            placeholder="nama@email.com"
        >
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="registerPassword">Password</label>
        <div style="position:relative;">
            <input
                id="registerPassword"
                type="password"
                name="password"
                class="form-input"
                required
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                style="padding-right:2.5rem;"
                oninput="checkPasswordStrength(this.value)"
            >
            <button type="button" onclick="togglePasswordVisibility('registerPassword', this)"
                style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--color-text-muted);padding:0;">
                <svg id="registerPasswordEyeOpen" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                <svg id="registerPasswordEyeClosed" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
            </button>
        </div>
        {{-- Password strength --}}
        <div id="passwordStrengthBar" style="height:3px; border-radius:9999px; margin-top:0.375rem; background:var(--color-border); overflow:hidden;">
            <div id="passwordStrengthFill" style="height:100%; width:0; border-radius:9999px; transition:width 0.3s, background 0.3s;"></div>
        </div>
        <p id="passwordStrengthText" style="font-size:0.72rem; color:var(--color-text-muted); margin-top:0.25rem;"></p>
        @error('password') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="registerPasswordConfirm">Konfirmasi Password</label>
        <input
            id="registerPasswordConfirm"
            type="password"
            name="password_confirmation"
            class="form-input"
            required
            autocomplete="new-password"
            placeholder="Ulangi password"
        >
    </div>

    {{-- Terms agreement --}}
    <div style="display:flex; align-items:flex-start; gap:0.5rem; margin-bottom:1.25rem;">
        <input type="checkbox" name="terms" id="agreeTerms" required style="width:16px;height:16px;margin-top:2px;accent-color:var(--color-primary); flex-shrink:0;">
        <label for="agreeTerms" style="font-size:0.8rem; color:var(--color-text-muted); cursor:pointer; line-height:1.5;">
            Saya menyetujui <a href="#" class="auth-link">Syarat & Ketentuan</a> dan <a href="#" class="auth-link">Kebijakan Privasi</a> Edify.
        </label>
    </div>

    <button type="submit" class="btn-auth" id="registerSubmitBtn">Buat Akun</button>
</form>

<p class="auth-footer-text">
    Sudah punya akun?
    <a href="{{ route('login') }}" class="auth-link" style="font-weight:600;">Masuk di sini →</a>
</p>

@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, btn) {
        const input     = document.getElementById(inputId);
        const eyeOpen   = document.getElementById(inputId + 'EyeOpen');
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

    function checkPasswordStrength(password) {
        const bar  = document.getElementById('passwordStrengthFill');
        const text = document.getElementById('passwordStrengthText');
        let strength = 0;
        if (password.length >= 8)     strength++;
        if (/[A-Z]/.test(password))   strength++;
        if (/[0-9]/.test(password))   strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        const levels = [
            { width: '0%',   color: '#e5e7eb', label: '' },
            { width: '25%',  color: '#ef4444', label: 'Lemah' },
            { width: '50%',  color: '#f59e0b', label: 'Sedang' },
            { width: '75%',  color: '#3b82f6', label: 'Kuat' },
            { width: '100%', color: '#10b981', label: 'Sangat Kuat' },
        ];
        const level = levels[strength];
        bar.style.width      = level.width;
        bar.style.background = level.color;
        text.textContent     = level.label;
        text.style.color     = level.color;
    }

    // Loading state
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('registerSubmitBtn');
        btn.textContent = 'Membuat Akun...';
        btn.disabled = true;
    });
</script>
@endpush
