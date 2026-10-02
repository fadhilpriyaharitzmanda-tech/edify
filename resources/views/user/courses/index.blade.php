@extends('layouts.app')

@section('title', 'Semua Kursus')
@section('meta_description', 'Jelajahi 200+ kursus online berkualitas tinggi di Edify. Teknologi, desain, bisnis, dan banyak lagi.')

@section('content')

<div class="container-md" style="padding-top:2rem; padding-bottom:4rem;">
    <h1 style="font-size:1.875rem; font-weight:700; margin-bottom:0.5rem; color:var(--color-text);">Semua Kursus</h1>
    <p style="color:var(--color-text-muted); margin-bottom:2rem;">Temukan kursus yang tepat untuk perjalanan belajar Anda.</p>

    {{-- Search + Filter --}}
    <form method="GET" action="{{ route('user.courses.index') }}" style="display:flex; gap:0.75rem; flex-wrap:wrap; margin-bottom:2rem;">
        <input type="text" name="search" id="courseSearchUser" value="{{ request('search') }}" placeholder="Cari kursus..."
            style="flex:1; min-width:200px; padding:0.625rem 1rem; border:1px solid var(--color-border); border-radius:9999px; font-size:0.875rem; font-family:inherit; background:var(--color-bg); color:var(--color-text); outline:none;">
        <select name="category" id="courseCategoryFilter" style="padding:0.625rem 1rem; border:1px solid var(--color-border); border-radius:9999px; font-size:0.875rem; font-family:inherit; background:var(--color-bg); color:var(--color-text); outline:none;">
            <option value="">Semua Kategori</option>
            <option value="teknologi" {{ request('category') === 'teknologi' ? 'selected' : '' }}>Teknologi</option>
            <option value="desain" {{ request('category') === 'desain' ? 'selected' : '' }}>Desain</option>
            <option value="bisnis" {{ request('category') === 'bisnis' ? 'selected' : '' }}>Bisnis</option>
            <option value="marketing" {{ request('category') === 'marketing' ? 'selected' : '' }}>Marketing</option>
        </select>
        <select name="price" id="coursePriceFilter" style="padding:0.625rem 1rem; border:1px solid var(--color-border); border-radius:9999px; font-size:0.875rem; font-family:inherit; background:var(--color-bg); color:var(--color-text); outline:none;">
            <option value="">Semua Harga</option>
            <option value="free" {{ request('price') === 'free' ? 'selected' : '' }}>Gratis</option>
            <option value="paid" {{ request('price') === 'paid' ? 'selected' : '' }}>Berbayar</option>
        </select>
        <button type="submit" style="padding:0.625rem 1.25rem; background:var(--color-primary); color:#fff; border:none; border-radius:9999px; font-size:0.875rem; font-weight:500; cursor:pointer;">Cari</button>
    </form>

    {{-- Courses Grid --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1.25rem;">
        @forelse($courses ?? [] as $course)
        <a href="{{ route('user.courses.show', $course) }}" style="background:var(--color-bg); border:1px solid var(--color-border); border-radius:var(--radius); overflow:hidden; text-decoration:none; display:block; transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="height:150px; background:linear-gradient(135deg,#6366f1,#8b5cf6); position:relative; overflow:hidden;">
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:0.25;">
                    <i data-lucide="book-open" style="width:60px;height:60px;color:#fff;"></i>
                </div>
                @if($course->price == 0)
                <span style="position:absolute;top:10px;right:10px;background:#10b981;color:#fff;font-size:0.7rem;font-weight:600;padding:0.2rem 0.5rem;border-radius:9999px;">GRATIS</span>
                @endif
            </div>
            <div style="padding:1rem;">
                <div style="font-size:0.75rem; color:var(--color-primary); font-weight:500; margin-bottom:0.35rem; text-transform:uppercase; letter-spacing:0.04em;">{{ $course->category ?? 'Teknologi' }}</div>
                <h2 style="font-size:0.9rem; font-weight:600; color:var(--color-text); margin-bottom:0.5rem; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $course->title }}</h2>
                <p style="font-size:0.8rem; color:var(--color-text-muted); margin-bottom:0.75rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $course->description }}</p>
                <div style="display:flex; align-items:center; justify-content:space-between; padding-top:0.625rem; border-top:1px solid var(--color-border);">
                    <div style="display:flex;align-items:center;gap:0.375rem;font-size:0.8rem;color:var(--color-text-muted);">
                        <i data-lucide="users" style="width:13px;height:13px;"></i>
                        {{ $course->enrollments_count ?? 0 }} pelajar
                    </div>
                    <span style="font-size:0.9rem; font-weight:700; color:{{ $course->price > 0 ? 'var(--color-primary)' : '#10b981' }};">
                        {{ $course->price > 0 ? 'Rp '.number_format($course->price, 0, ',', '.') : 'Gratis' }}
                    </span>
                </div>
            </div>
        </a>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:4rem 0; color:var(--color-text-muted);">
            <i data-lucide="search" style="width:48px;height:48px;margin:0 auto 1rem;display:block;opacity:0.3;"></i>
            <p>Tidak ada kursus yang ditemukan.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(isset($courses) && $courses->hasPages())
    <div style="margin-top:2rem; display:flex; justify-content:center;">
        {{ $courses->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection
