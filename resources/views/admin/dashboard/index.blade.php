@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <span class="sep">/</span>
    <span class="current">Dashboard</span>
@endsection

@section('content')

<div class="page-title-section">
    <h2 class="page-title">Dashboard</h2>
    <p class="page-subtitle">Selamat datang kembali, {{ auth()->user()->name ?? 'Admin' }}! Berikut ringkasan aktivitas hari ini.</p>
</div>

{{-- Stats Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $totalUsers ?? '0' }}</div>
            <div class="stat-label">Total Pengguna</div>
            <div class="stat-change up">↑ 12% dari bulan lalu</div>
        </div>
        <div class="stat-icon" style="background: #6366f1;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $totalCourses ?? '0' }}</div>
            <div class="stat-label">Total Kursus</div>
            <div class="stat-change up">↑ 5 kursus baru</div>
        </div>
        <div class="stat-icon" style="background: #10b981;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $totalOrders ?? '0' }}</div>
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-change up">↑ 8% dari bulan lalu</div>
        </div>
        <div class="stat-icon" style="background: #f59e0b;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <div class="stat-value">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-change up">↑ 18% dari bulan lalu</div>
        </div>
        <div class="stat-icon" style="background: #8b5cf6;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
    </div>
</div>

{{-- Content Grid --}}
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">

    {{-- Recent Users --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Pengguna Terbaru</span>
            <a href="{{ route('admin.users.index') }}" style="font-size:0.8rem; color: var(--color-primary); text-decoration:none;">Lihat semua →</a>
        </div>
        <table style="width:100%; border-collapse:collapse; font-size:0.85rem;">
            <thead>
                <tr style="border-bottom:1px solid var(--color-border);">
                    <th style="text-align:left; padding:0.5rem 0; color:var(--color-muted); font-weight:500;">Nama</th>
                    <th style="text-align:left; padding:0.5rem 0; color:var(--color-muted); font-weight:500;">Email</th>
                    <th style="text-align:left; padding:0.5rem 0; color:var(--color-muted); font-weight:500;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers ?? [] as $user)
                <tr style="border-bottom:1px solid var(--color-border);">
                    <td style="padding:0.6rem 0;">{{ $user->name }}</td>
                    <td style="padding:0.6rem 0; color:var(--color-muted);">{{ $user->email }}</td>
                    <td style="padding:0.6rem 0;">
                        <span style="background:#dcfce7; color:#166534; font-size:0.7rem; padding:0.2rem 0.5rem; border-radius:9999px; font-weight:500;">Aktif</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="padding:1rem 0; text-align:center; color:var(--color-muted);">Belum ada pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Recent Orders --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Transaksi Terbaru</span>
            <a href="{{ route('admin.orders.index') }}" style="font-size:0.8rem; color: var(--color-primary); text-decoration:none;">Lihat semua →</a>
        </div>
        <table style="width:100%; border-collapse:collapse; font-size:0.85rem;">
            <thead>
                <tr style="border-bottom:1px solid var(--color-border);">
                    <th style="text-align:left; padding:0.5rem 0; color:var(--color-muted); font-weight:500;">Kursus</th>
                    <th style="text-align:left; padding:0.5rem 0; color:var(--color-muted); font-weight:500;">Jumlah</th>
                    <th style="text-align:left; padding:0.5rem 0; color:var(--color-muted); font-weight:500;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders ?? [] as $order)
                <tr style="border-bottom:1px solid var(--color-border);">
                    <td style="padding:0.6rem 0;">{{ $order->course->title ?? '-' }}</td>
                    <td style="padding:0.6rem 0;">Rp {{ number_format($order->amount ?? 0, 0, ',', '.') }}</td>
                    <td style="padding:0.6rem 0;">
                        <span style="background:#dbeafe; color:#1e40af; font-size:0.7rem; padding:0.2rem 0.5rem; border-radius:9999px; font-weight:500;">Lunas</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="padding:1rem 0; text-align:center; color:var(--color-muted);">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
