@extends('layouts.admin')

@section('title', 'Manajemen Kursus')

@section('breadcrumb')
    <span class="sep">/</span>
    <span class="current">Kursus</span>
@endsection

@section('content')

<div class="page-title-section" style="display:flex; align-items:center; justify-content:space-between;">
    <div>
        <h2 class="page-title">Manajemen Kursus</h2>
        <p class="page-subtitle">Kelola semua kursus yang tersedia di platform Edify.</p>
    </div>
    <a href="{{ route('admin.courses.create') }}" id="addCourseBtn" style="display:inline-flex;align-items:center;gap:0.4rem;padding:0.55rem 1rem;background:var(--color-primary);color:#fff;border-radius:8px;text-decoration:none;font-size:0.875rem;font-weight:500;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Buat Kursus
    </a>
</div>

{{-- Stats row --}}
<div class="stats-grid" style="margin-bottom:1rem;">
    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $totalCourses ?? 0 }}</div>
            <div class="stat-label">Total Kursus</div>
        </div>
        <div class="stat-icon" style="background:#6366f1;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $publishedCourses ?? 0 }}</div>
            <div class="stat-label">Dipublikasikan</div>
        </div>
        <div class="stat-icon" style="background:#10b981;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $draftCourses ?? 0 }}</div>
            <div class="stat-label">Draft</div>
        </div>
        <div class="stat-icon" style="background:#f59e0b;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-value">{{ $totalEnrollments ?? 0 }}</div>
            <div class="stat-label">Total Pendaftar</div>
        </div>
        <div class="stat-icon" style="background:#8b5cf6;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
    </div>
</div>

{{-- Search & Filter --}}
<div class="card" style="margin-bottom:1rem; padding:0.875rem 1.25rem;">
    <form method="GET" action="{{ route('admin.courses.index') }}" style="display:flex; gap:0.75rem; flex-wrap:wrap; align-items:center;">
        <input type="text" name="search" id="courseSearchInput" value="{{ request('search') }}" placeholder="Cari judul kursus..."
            style="flex:1; min-width:200px; padding:0.5rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
        <select name="status" id="courseStatusFilter" style="padding:0.5rem 0.875rem; border:1px solid var(--color-border); border-radius:8px; font-size:0.875rem; font-family:inherit; background:var(--color-body-bg); color:var(--color-text); outline:none;">
            <option value="">Semua Status</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Dipublikasikan</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
        <button type="submit" style="padding:0.5rem 1rem; background:var(--color-primary); color:#fff; border:none; border-radius:8px; font-size:0.875rem; cursor:pointer;">Filter</button>
    </form>
</div>

{{-- Courses Table --}}
<div class="card" style="padding:0; overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:0.875rem;" role="table" aria-label="Tabel Kursus">
        <thead>
            <tr style="border-bottom:1px solid var(--color-border); background:var(--color-body-bg);">
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Kursus</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Instruktur</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Harga</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Pendaftar</th>
                <th style="text-align:left; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Status</th>
                <th style="text-align:center; padding:0.75rem 1.25rem; color:var(--color-muted); font-weight:600; font-size:0.775rem; text-transform:uppercase; letter-spacing:0.04em;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses ?? [] as $course)
            <tr style="border-bottom:1px solid var(--color-border);" onmouseover="this.style.background='var(--color-body-bg)'" onmouseout="this.style.background=''">
                <td style="padding:0.875rem 1.25rem;">
                    <div style="font-weight:500; max-width:220px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $course->title }}</div>
                    <div style="font-size:0.78rem; color:var(--color-muted); margin-top:0.15rem;">{{ $course->category ?? 'Umum' }}</div>
                </td>
                <td style="padding:0.875rem 1.25rem; color:var(--color-muted);">{{ $course->instructor->name ?? '-' }}</td>
                <td style="padding:0.875rem 1.25rem;">
                    @if($course->price > 0)
                        Rp {{ number_format($course->price, 0, ',', '.') }}
                    @else
                        <span style="color:#10b981; font-weight:500;">Gratis</span>
                    @endif
                </td>
                <td style="padding:0.875rem 1.25rem;">{{ $course->enrollments_count ?? 0 }}</td>
                <td style="padding:0.875rem 1.25rem;">
                    @if(($course->status ?? '') === 'published')
                        <span style="background:#dcfce7; color:#166534; font-size:0.7rem; padding:0.25rem 0.625rem; border-radius:9999px; font-weight:500;">Publik</span>
                    @else
                        <span style="background:#fef9c3; color:#854d0e; font-size:0.7rem; padding:0.25rem 0.625rem; border-radius:9999px; font-weight:500;">Draft</span>
                    @endif
                </td>
                <td style="padding:0.875rem 1.25rem; text-align:center;">
                    <div style="display:flex; align-items:center; justify-content:center; gap:0.375rem;">
                        <a href="{{ route('admin.courses.show', $course) }}" title="Lihat" style="width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:6px;color:var(--color-muted);" onmouseover="this.style.background='#e0e7ff';this.style.color='#4f46e5'" onmouseout="this.style.background='';this.style.color='var(--color-muted)'">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('admin.courses.edit', $course) }}" title="Edit" style="width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:6px;color:var(--color-muted);" onmouseover="this.style.background='#fef9c3';this.style.color='#ca8a04'" onmouseout="this.style.background='';this.style.color='var(--color-muted)'">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Hapus kursus ini?')" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" title="Hapus" style="width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:6px;color:var(--color-muted);background:transparent;border:none;cursor:pointer;" onmouseover="this.style.background='#fee2e2';this.style.color='#dc2626'" onmouseout="this.style.background='';this.style.color='var(--color-muted)'">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:2.5rem; text-align:center; color:var(--color-muted);">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 0.75rem; display:block; opacity:0.4;"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    Belum ada kursus. <a href="{{ route('admin.courses.create') }}" style="color:var(--color-primary);">Buat sekarang →</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if(isset($courses) && $courses->hasPages())
    <div style="padding:0.875rem 1.25rem; border-top:1px solid var(--color-border);">
        {{ $courses->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection
