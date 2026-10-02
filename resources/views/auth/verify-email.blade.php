@extends('layouts.auth')

@section('title', 'Verifikasi Email')

@section('content')

<div style="text-align:center; margin-bottom:1.75rem;">
    <div style="width:64px;height:64px;background:rgba(99,102,241,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
    </div>
    <h2 style="font-size:1.5rem; font-weight:700; color:var(--color-text); margin-bottom:0.375rem;">Verifikasi Email Anda</h2>
    <p style="font-size:0.875rem; color:var(--color-text-muted); line-height:1.6;">
        Kami telah mengirimkan link verifikasi ke email Anda. Silakan cek inbox (dan folder spam) untuk mengaktifkan akun.
    </p>
</div>

@if(session('status') === 'verification-link-sent')
<div style="padding:0.75rem 1rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; font-size:0.85rem; color:#166534; margin-bottom:1rem; text-align:center;">
    Link verifikasi baru telah dikirimkan ke email Anda.
</div>
@endif

<form method="POST" action="{{ route('verification.send') }}" id="resendForm">
    @csrf
    <button type="submit" class="btn-auth" id="resendBtn">Kirim Ulang Email Verifikasi</button>
</form>

<form method="POST" action="{{ route('logout') }}" style="margin-top:0.75rem;">
    @csrf
    <button type="submit" style="width:100%;padding:0.7rem;background:transparent;color:var(--color-text-muted);border:1px solid var(--color-border);border-radius:8px;font-size:0.875rem;cursor:pointer;font-family:inherit;">
        Keluar
    </button>
</form>

@endsection

@push('scripts')
<script>
    document.getElementById('resendForm').addEventListener('submit', function() {
        const btn = document.getElementById('resendBtn');
        btn.textContent = 'Mengirim...';
        btn.disabled = true;
        setTimeout(() => { btn.textContent = 'Kirim Ulang Email Verifikasi'; btn.disabled = false; }, 5000);
    });
</script>
@endpush
