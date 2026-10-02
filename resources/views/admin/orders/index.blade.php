@extends('layouts.admin')

@section('title', 'Transaksi')

@section('breadcrumb')
    <span class="sep">/</span>
    <span class="current">Transaksi</span>
@endsection

@section('content')

<div class="page-title-section">
    <h2 class="page-title">Manajemen Transaksi</h2>
    <p class="page-subtitle">Pantau semua transaksi pembayaran kursus di platform.</p>
</div>

{{-- Stats --}}
<div class="stats-grid" style="margin-bottom:1rem;">
    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $totalOrders ?? 0 }}</div>
            <div class="stat-label">Total Transaksi</div>
        </div>
        <div class="stat-icon" style="background:#6366f1;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg></div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-value">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pendapatan</div>
        </div>
        <div class="stat-icon" style="background:#10b981;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $pendingOrders ?? 0 }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
        <div class="stat-icon" style="background:#f59e0b;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:1rem; padding:0.875rem 1.25rem;">
    <form method="GET" action="{{ route('admin.orders.index') }}" style="display:flex; gap:0.75rem; flex-wrap:wrap; align-items:center;">
        <input type="text" name="search" id="orderSearchInput" value="{{ request('search') }}" placeholder="Cari pengguna atau kursus..."
            style="flex:1; min-width:200px; padding:0.5rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
        <select name="status" id="orderStatusFilter" style="padding:0.5rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
            <option value="">Semua Status</option>
            <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
        </select>
        <button type="submit" style="padding:0.5rem 1rem; background:var(--color-primary); color:#fff; border:none; border-radius:8px; font-size:0.875rem; cursor:pointer;">Filter</button>
    </form>
</div>

{{-- Orders Table --}}
<div class="card" style="padding:0; overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:0.875rem;" role="table" aria-label="Tabel Transaksi">
        <thead>
            <tr style="border-bottom:1px solid var(--color-border); background:var(--color-body-bg);">
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">ID</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Pengguna</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Kursus</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Jumlah</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Status</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders ?? [] as $order)
            <tr style="border-bottom:1px solid var(--color-border);" onmouseover="this.style.background='var(--color-body-bg)'" onmouseout="this.style.background=''">
                <td style="padding:0.875rem 1.25rem; color:var(--color-muted); font-family:monospace; font-size:0.8rem;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td style="padding:0.875rem 1.25rem; font-weight:500;">{{ $order->user->name ?? '-' }}</td>
                <td style="padding:0.875rem 1.25rem; color:var(--color-muted); max-width:180px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $order->course->title ?? '-' }}</td>
                <td style="padding:0.875rem 1.25rem; font-weight:500;">Rp {{ number_format($order->amount ?? 0, 0, ',', '.') }}</td>
                <td style="padding:0.875rem 1.25rem;">
                    @php $status = $order->status ?? 'pending' @endphp
                    @if($status === 'paid')
                        <span style="background:#dcfce7; color:#166534; font-size:0.7rem; padding:0.25rem 0.625rem; border-radius:9999px; font-weight:500;">Lunas</span>
                    @elseif($status === 'pending')
                        <span style="background:#fef9c3; color:#854d0e; font-size:0.7rem; padding:0.25rem 0.625rem; border-radius:9999px; font-weight:500;">Menunggu</span>
                    @else
                        <span style="background:#fee2e2; color:#991b1b; font-size:0.7rem; padding:0.25rem 0.625rem; border-radius:9999px; font-weight:500;">Gagal</span>
                    @endif
                </td>
                <td style="padding:0.875rem 1.25rem; color:var(--color-muted);">{{ $order->created_at->format('d M Y, H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:2.5rem; text-align:center; color:var(--color-muted);">Belum ada transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if(isset($orders) && $orders->hasPages())
    <div style="padding:0.875rem 1.25rem; border-top:1px solid var(--color-border);">
        {{ $orders->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection
