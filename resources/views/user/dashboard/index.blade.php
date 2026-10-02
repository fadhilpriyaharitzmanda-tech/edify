@extends('layouts.app')

@section('title', 'Dashboard Saya')
@section('meta_description', 'Kelola kursus dan progres belajar Anda di Edify.')

@section('content')

<div class="container-md" style="padding-top: 2rem; padding-bottom: 4rem;">

    <h1 style="font-size:1.875rem; font-weight:700; margin-bottom:0.5rem;">Dashboard Saya</h1>
    <p style="color:var(--color-text-muted); margin-bottom:2rem;">Selamat datang, <strong>{{ auth()->user()->name ?? 'Pelajar' }}</strong>! Terus semangat belajar 🚀</p>

    {{-- Stats --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:1rem; margin-bottom:2rem;">
        <div style="background:var(--color-bg); border:1px solid var(--color-border); border-radius:var(--radius); padding:1.25rem;">
            <div style="font-size:1.75rem; font-weight:700; color:var(--color-primary);">0</div>
            <div style="font-size:0.85rem; color:var(--color-text-muted); margin-top:0.25rem;">Kursus Terdaftar</div>
        </div>
        <div style="background:var(--color-bg); border:1px solid var(--color-border); border-radius:var(--radius); padding:1.25rem;">
            <div style="font-size:1.75rem; font-weight:700; color:#10b981;">0</div>
            <div style="font-size:0.85rem; color:var(--color-text-muted); margin-top:0.25rem;">Kursus Selesai</div>
        </div>
        <div style="background:var(--color-bg); border:1px solid var(--color-border); border-radius:var(--radius); padding:1.25rem;">
            <div style="font-size:1.75rem; font-weight:700; color:#f59e0b;">0</div>
            <div style="font-size:0.85rem; color:var(--color-text-muted); margin-top:0.25rem;">Sertifikat</div>
        </div>
    </div>

    {{-- Empty state --}}
    <div style="border:1px solid var(--color-border); border-radius:var(--radius); padding:3rem; text-align:center; background:var(--color-bg);">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 1rem; display:block; opacity:0.3; color:var(--color-text-muted);">
            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
        </svg>
        <p style="color:var(--color-text-muted); font-size:0.95rem; margin-bottom:1rem;">Anda belum mendaftar ke kursus apapun.</p>
        <a href="{{ route('user.courses.index') }}"
           style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.625rem 1.25rem;background:var(--color-primary);color:#fff;border-radius:9999px;font-size:0.875rem;font-weight:500;text-decoration:none;">
            Jelajahi Kursus →
        </a>
    </div>

</div>

@endsection
