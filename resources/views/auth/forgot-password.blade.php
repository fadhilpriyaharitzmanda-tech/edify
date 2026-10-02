@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')

<div class="auth-form-heading">
    <h2>Lupa Password?</h2>
    <p>Masukkan email Anda dan kami akan mengirimkan link reset password.</p>
</div>

@if(session('status'))
<div style="padding:0.75rem 1rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; font-size:0.85rem; color:#166534; margin-bottom:1rem;">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('password.email') }}" id="forgotForm">
    @csrf

    <div class="form-group">
        <label class="form-label" for="forgotEmail">Alamat Email</label>
        <input
            id="forgotEmail"
            type="email"
            name="email"
            class="form-input"
            value="{{ old('email') }}"
            required
            autofocus
            placeholder="nama@email.com"
        >
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn-auth" id="forgotSubmitBtn">Kirim Link Reset</button>
</form>

<p class="auth-footer-text">
    Ingat password?
    <a href="{{ route('login') }}" class="auth-link" style="font-weight:600;">Masuk di sini →</a>
</p>

@endsection

@push('scripts')
<script>
    document.getElementById('forgotForm').addEventListener('submit', function() {
        const btn = document.getElementById('forgotSubmitBtn');
        btn.textContent = 'Mengirim...';
        btn.disabled = true;
    });
</script>
@endpush
