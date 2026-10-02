@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('breadcrumb')
    <span class="sep">/</span>
    <a href="#" style="color:var(--color-muted); text-decoration:none;">Pengaturan</a>
    <span class="sep">/</span>
    <span class="current">Profil</span>
@endsection

@section('content')

<div class="page-title-section">
    <h2 class="page-title">Profil Saya</h2>
    <p class="page-subtitle">Kelola informasi profil dan preferensi akun Anda.</p>
</div>

@if(session('success'))
<div style="padding:0.75rem 1rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; font-size:0.85rem; color:#166534; margin-bottom:1.25rem;">
    {{ session('success') }}
</div>
@endif

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; align-items:start;">

    {{-- Profile Info --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Informasi Profil</span>
        </div>

        <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.5rem; padding-bottom:1.25rem; border-bottom:1px solid var(--color-border);">
            <div style="width:72px;height:72px;border-radius:50%;background:var(--color-primary);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:700;flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <div style="font-size:1rem; font-weight:600;">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div style="font-size:0.85rem; color:var(--color-muted);">{{ auth()->user()->email ?? '' }}</div>
                <div style="font-size:0.78rem; color:var(--color-muted); margin-top:0.2rem;">Bergabung {{ auth()->user()->created_at?->format('d M Y') ?? '-' }}</div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.settings.profile.update') }}">
            @csrf @method('PATCH')

            <div class="form-group" style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.825rem; font-weight:500; margin-bottom:0.375rem;" for="profileName">Nama Lengkap</label>
                <input id="profileName" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                    style="width:100%; padding:0.6rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
                @error('name') <p style="font-size:0.78rem; color:#ef4444; margin-top:0.3rem;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group" style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.825rem; font-weight:500; margin-bottom:0.375rem;" for="profileEmail">Email</label>
                <input id="profileEmail" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                    style="width:100%; padding:0.6rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
                @error('email') <p style="font-size:0.78rem; color:#ef4444; margin-top:0.3rem;">{{ $message }}</p> @enderror
            </div>

            <button type="submit" style="padding:0.55rem 1.25rem; background:var(--color-primary); color:#fff; border:none; border-radius:8px; font-size:0.875rem; font-weight:500; cursor:pointer; font-family:inherit;">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Ubah Password</span>
        </div>

        <form method="POST" action="{{ route('admin.settings.password.update') }}">
            @csrf @method('PUT')

            <div class="form-group" style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.825rem; font-weight:500; margin-bottom:0.375rem;" for="currentPassword">Password Saat Ini</label>
                <input id="currentPassword" type="password" name="current_password" required
                    style="width:100%; padding:0.6rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
                @error('current_password') <p style="font-size:0.78rem; color:#ef4444; margin-top:0.3rem;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group" style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.825rem; font-weight:500; margin-bottom:0.375rem;" for="newPassword">Password Baru</label>
                <input id="newPassword" type="password" name="password" required
                    style="width:100%; padding:0.6rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
                @error('password') <p style="font-size:0.78rem; color:#ef4444; margin-top:0.3rem;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.825rem; font-weight:500; margin-bottom:0.375rem;" for="confirmPassword">Konfirmasi Password Baru</label>
                <input id="confirmPassword" type="password" name="password_confirmation" required
                    style="width:100%; padding:0.6rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
            </div>

            <button type="submit" style="padding:0.55rem 1.25rem; background:var(--color-primary); color:#fff; border:none; border-radius:8px; font-size:0.875rem; font-weight:500; cursor:pointer; font-family:inherit;">
                Ubah Password
            </button>
        </form>
    </div>

    {{-- Danger Zone --}}
    <div class="card" style="border-color:#fee2e2; grid-column:1/-1;">
        <div class="card-header">
            <span class="card-title" style="color:#dc2626;">Zona Berbahaya</span>
        </div>
        <p style="font-size:0.875rem; color:var(--color-muted); margin-bottom:1rem;">
            Menghapus akun bersifat permanen dan tidak dapat dibatalkan. Semua data Anda akan dihapus.
        </p>
        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')">
            @csrf @method('DELETE')
            <input type="password" name="password" placeholder="Masukkan password untuk konfirmasi" required
                style="padding:0.55rem 0.875rem; border:1px solid #fecaca; border-radius:8px; font-size:0.875rem; font-family:inherit; margin-right:0.75rem; outline:none; background:var(--color-body-bg); color:var(--color-text); width:280px;">
            <button type="submit" style="padding:0.55rem 1.25rem; background:#dc2626; color:#fff; border:none; border-radius:8px; font-size:0.875rem; font-weight:500; cursor:pointer;">
                Hapus Akun Saya
            </button>
        </form>
    </div>

</div>

@endsection
