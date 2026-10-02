@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<div class="auth-form-heading">
    <h2>Reset Password</h2>
    <p>Masukkan password baru untuk akun Anda.</p>
</div>

<form method="POST" action="{{ route('password.store') }}" id="resetForm">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="form-group">
        <label class="form-label" for="resetEmail">Email</label>
        <input
            id="resetEmail"
            type="email"
            name="email"
            class="form-input"
            value="{{ old('email', $request->email) }}"
            required
            readonly
            style="background:var(--color-bg); opacity:0.7;"
        >
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="resetPassword">Password Baru</label>
        <div style="position:relative;">
            <input
                id="resetPassword"
                type="password"
                name="password"
                class="form-input"
                required
                autofocus
                placeholder="Minimal 8 karakter"
                style="padding-right:2.5rem;"
            >
            <button type="button" onclick="togglePass('resetPassword')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--color-text-muted);padding:0;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
        </div>
        @error('password') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="resetPasswordConfirm">Konfirmasi Password Baru</label>
        <input
            id="resetPasswordConfirm"
            type="password"
            name="password_confirmation"
            class="form-input"
            required
            placeholder="Ulangi password baru"
        >
    </div>

    <button type="submit" class="btn-auth" id="resetSubmitBtn">Reset Password</button>
</form>

@endsection

@push('scripts')
<script>
    function togglePass(id) {
        const el = document.getElementById(id);
        el.type = el.type === 'password' ? 'text' : 'password';
    }
    document.getElementById('resetForm').addEventListener('submit', function() {
        const btn = document.getElementById('resetSubmitBtn');
        btn.textContent = 'Menyimpan...';
        btn.disabled = true;
    });
</script>
@endpush
