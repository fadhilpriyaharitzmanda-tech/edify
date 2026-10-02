@extends('layouts.app')

@section('title', 'Profil Saya')
@section('meta_description', 'Kelola profil dan pengaturan akun Edify Anda.')

@section('content')

<div class="container-md" style="padding-top:2rem; padding-bottom:4rem; max-width:680px; margin:0 auto;">

    <h1 style="font-size:1.875rem; font-weight:700; margin-bottom:0.5rem;">Profil Saya</h1>
    <p style="color:var(--color-text-muted); margin-bottom:2rem;">Kelola informasi akun Anda.</p>

    @if(session('success'))
    <div style="padding:0.75rem 1rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:var(--radius); font-size:0.85rem; color:#166534; margin-bottom:1.5rem;">
        {{ session('success') }}
    </div>
    @endif

    {{-- Profile Form --}}
    <div style="background:var(--color-bg); border:1px solid var(--color-border); border-radius:var(--radius); padding:1.5rem; margin-bottom:1.25rem;">
        <h2 style="font-size:1rem; font-weight:600; margin-bottom:1.25rem;">Informasi Profil</h2>

        <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.5rem; padding-bottom:1.25rem; border-bottom:1px solid var(--color-border);">
            <div style="width:64px;height:64px;border-radius:50%;background:var(--color-primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:700;flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
            </div>
            <div>
                <div style="font-weight:600;">{{ auth()->user()->name ?? 'Pelajar' }}</div>
                <div style="font-size:0.85rem; color:var(--color-text-muted);">{{ auth()->user()->email ?? '' }}</div>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('PATCH')
            <div style="margin-bottom:1rem;">
                <label for="profileName" style="display:block;font-size:0.825rem;font-weight:500;margin-bottom:0.375rem;">Nama Lengkap</label>
                <input id="profileName" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                    style="width:100%;padding:0.6rem 0.875rem;border:1px solid var(--color-border);border-radius:var(--radius);font-size:0.875rem;font-family:inherit;background:var(--color-bg);color:var(--color-text);outline:none;">
                @error('name')<p style="font-size:0.78rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="profileEmail" style="display:block;font-size:0.825rem;font-weight:500;margin-bottom:0.375rem;">Email</label>
                <input id="profileEmail" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                    style="width:100%;padding:0.6rem 0.875rem;border:1px solid var(--color-border);border-radius:var(--radius);font-size:0.875rem;font-family:inherit;background:var(--color-bg);color:var(--color-text);outline:none;">
                @error('email')<p style="font-size:0.78rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
            </div>
            <button type="submit"
                style="padding:0.55rem 1.25rem;background:var(--color-primary);color:#fff;border:none;border-radius:9999px;font-size:0.875rem;font-weight:500;cursor:pointer;font-family:inherit;">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- Change Password --}}
    <div style="background:var(--color-bg); border:1px solid var(--color-border); border-radius:var(--radius); padding:1.5rem;">
        <h2 style="font-size:1rem; font-weight:600; margin-bottom:1.25rem;">Ubah Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf @method('PUT')
            <div style="margin-bottom:1rem;">
                <label for="currentPass" style="display:block;font-size:0.825rem;font-weight:500;margin-bottom:0.375rem;">Password Saat Ini</label>
                <input id="currentPass" type="password" name="current_password" required
                    style="width:100%;padding:0.6rem 0.875rem;border:1px solid var(--color-border);border-radius:var(--radius);font-size:0.875rem;font-family:inherit;background:var(--color-bg);color:var(--color-text);outline:none;">
            </div>
            <div style="margin-bottom:1rem;">
                <label for="newPass" style="display:block;font-size:0.825rem;font-weight:500;margin-bottom:0.375rem;">Password Baru</label>
                <input id="newPass" type="password" name="password" required
                    style="width:100%;padding:0.6rem 0.875rem;border:1px solid var(--color-border);border-radius:var(--radius);font-size:0.875rem;font-family:inherit;background:var(--color-bg);color:var(--color-text);outline:none;">
            </div>
            <div style="margin-bottom:1.25rem;">
                <label for="confirmPass" style="display:block;font-size:0.825rem;font-weight:500;margin-bottom:0.375rem;">Konfirmasi Password</label>
                <input id="confirmPass" type="password" name="password_confirmation" required
                    style="width:100%;padding:0.6rem 0.875rem;border:1px solid var(--color-border);border-radius:var(--radius);font-size:0.875rem;font-family:inherit;background:var(--color-bg);color:var(--color-text);outline:none;">
            </div>
            <button type="submit"
                style="padding:0.55rem 1.25rem;background:var(--color-primary);color:#fff;border:none;border-radius:9999px;font-size:0.875rem;font-weight:500;cursor:pointer;font-family:inherit;">
                Ubah Password
            </button>
        </form>
    </div>

</div>

@endsection
