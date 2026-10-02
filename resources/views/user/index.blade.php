@extends('layouts.app')

@section('title', 'Edify — Platform Belajar Online & Upskilling')
@section('meta_description', 'Tingkatkan karier dan skill Anda bersama Edify. Akses 200+ kursus terstruktur dari praktisi top industri.')

@section('content')

{{-- ============================================================
     HERO SECTION (ChatDeck Style)
============================================================ --}}
<section id="hero" style="padding: 5rem 0 4rem; overflow: hidden; position: relative;">
    {{-- Background subtle gradient glow --}}
    <div style="position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 700px; height: 350px; background: radial-gradient(ellipse at center, rgba(99,102,241,0.15), transparent 70%); pointer-events: none; z-index: -1;"></div>

    <div class="container-md" style="text-align: center;">
        {{-- Introducing Badge with Pulse --}}
        <div style="display: inline-flex; align-items: center; gap: 0.625rem; padding: 0.4rem 1.1rem; border: 1px solid var(--color-border); border-radius: 9999px; font-size: 0.85rem; color: var(--color-text-muted); margin-bottom: 2rem; background: rgba(99,102,241,0.03); backdrop-filter: blur(8px);">
            <span class="pulse-dot"></span>
            <span style="font-weight: 500;">Dipercaya 50.000+ pelajar & profesional 🎉</span>
        </div>

        {{-- Hero Headline --}}
        <h1 style="font-size: clamp(2.25rem, 5.5vw, 4rem); font-weight: 800; line-height: 1.15; letter-spacing: -0.03em; color: var(--color-text); margin-bottom: 1.5rem; max-width: 860px; margin-left: auto; margin-right: auto;">
            Belajar Skill Digital Masa Depan Bersama
            <span style="background: linear-gradient(135deg, #6366f1 20%, #a855f7 80%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Praktisi Terbaik</span>
        </h1>

        {{-- Subtitle --}}
        <p style="font-size: clamp(1rem, 2vw, 1.2rem); color: var(--color-text-muted); max-width: 40rem; margin: 0 auto 2.5rem; line-height: 1.7;">
            Kuasai Web Development, AI, UI/UX Design, dan Data Science dengan kurikulum standar industri. Belajar fleksibel, buat portofolio nyata, dan dapatkan sertifikat resmi.
        </p>

        {{-- Hero Actions (Shimmer Button) --}}
        <div style="display: flex; gap: 1rem; justify-content: center; align-items: center; flex-wrap: wrap; margin-bottom: 3.5rem;">
            <a href="{{ route('register') }}" class="shimmer-button">
                <span>Coba Belajar Gratis</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-left: 0.5rem;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('user.courses.index') }}" class="btn-ghost" style="padding: 0.85rem 1.75rem; font-size: 1rem; border-radius: 9999px;">
                <span>Jelajahi Kursus</span>
            </a>
        </div>

        {{-- Trust Indicators & Key Highlights (ChatDeck Style) --}}
        <div style="display: flex; align-items: center; justify-content: center; gap: 2rem; flex-wrap: wrap; margin-top: 1rem; padding-top: 2rem; border-top: 1px dashed var(--color-border); max-width: 800px; margin-left: auto; margin-right: auto;">
            <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--color-text-muted); font-weight: 500;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(16, 185, 129, 0.12); display: flex; align-items: center; justify-content: center; color: #10b981;">
                    <i data-lucide="check" style="width: 15px; height: 15px;"></i>
                </div>
                <span>200+ Kursus Terstruktur</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--color-text-muted); font-weight: 500;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(99, 102, 241, 0.12); display: flex; align-items: center; justify-content: center; color: var(--color-primary);">
                    <i data-lucide="award" style="width: 15px; height: 15px;"></i>
                </div>
                <span>Sertifikat Resmi</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--color-text-muted); font-weight: 500;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(245, 158, 11, 0.12); display: flex; align-items: center; justify-content: center; color: #f59e0b;">
                    <i data-lucide="users" style="width: 15px; height: 15px;"></i>
                </div>
                <span>Mentor Praktisi Top</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--color-text-muted); font-weight: 500;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(139, 92, 246, 0.12); display: flex; align-items: center; justify-content: center; color: #8b5cf6;">
                    <i data-lucide="shield-check" style="width: 15px; height: 15px;"></i>
                </div>
                <span>Akses Seumur Hidup</span>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     LOGO CAROUSEL / MARQUEE (ChatDeck LogoCarousel.tsx 100%)
============================================================ --}}
<section style="padding: 3rem 0; border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border); position: relative; overflow: hidden;">
    <div style="text-align: center; margin-bottom: 1.75rem;">
        <p style="font-size: 0.875rem; font-weight: 500; color: var(--color-text-muted); letter-spacing: 0.05em; text-transform: uppercase;">
            Dipercaya oleh talent & engineering team dari perusahaan global
        </p>
    </div>

    {{-- Gradient Edge Fade Masks (ChatDeck style) --}}
    <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 100px; background: linear-gradient(to right, var(--color-bg), transparent); z-index: 10; pointer-events: none;"></div>
    <div style="position: absolute; right: 0; top: 0; bottom: 0; width: 100px; background: linear-gradient(to left, var(--color-bg), transparent); z-index: 10; pointer-events: none;"></div>

    {{-- Seamless Infinite Marquee --}}
    @php
    $companies = [
        ['name' => 'Shopify',    'slug' => 'M15.337 23.979l7.216-1.561s-2.604-17.613-2.625-17.73c-.018-.116-.114-.192-.211-.192s-1.929-.136-1.929-.136-1.275-1.274-1.439-1.411c-.045-.037-.075-.057-.121-.074l-.914 21.104h.023zM11.71 11.305s-.81-.424-1.774-.424c-1.447 0-1.504.906-1.504 1.141 0 1.232 3.24 1.715 3.24 4.629 0 2.295-1.44 3.76-3.406 3.76-2.354 0-3.54-1.465-3.54-1.465l.646-2.086s1.245 1.066 2.28 1.066c.675 0 .975-.545.975-.932 0-1.619-2.654-1.694-2.654-4.359-.034-2.237 1.571-4.416 4.827-4.416 1.257 0 1.875.361 1.875.361l-.945 2.715-.02.01zM11.17.83c.136 0 .271.038.405.135-.984.465-2.064 1.639-2.508 3.992-.656.213-1.293.405-1.889.578C7.697 3.75 8.951.84 11.17.84V.83zm1.235 2.949v.135c-.754.232-1.583.484-2.394.736.466-1.777 1.333-2.645 2.085-2.971.193.501.309 1.176.309 2.1zm.539-2.234c.694.074 1.141.867 1.429 1.755-.349.114-.735.231-1.158.366v-.252c0-.752-.096-1.371-.271-1.871v.002zm2.992 1.289c-.02 0-.06.021-.078.021s-.289.075-.714.21c-.423-1.233-1.176-2.37-2.508-2.37h-.115C12.135.209 11.669 0 11.265 0 8.159 0 6.675 3.877 6.21 5.846c-1.194.365-2.063.636-2.16.674-.675.213-.694.232-.772.87-.075.462-1.83 14.063-1.83 14.063L15.009 24l.927-21.166z'],
        ['name' => 'Netflix',    'slug' => 'm5.398 0 8.348 23.602c2.346.059 4.856.398 4.856.398L10.113 0H5.398zm8.489 0v9.172l4.715 13.33V0h-4.715zM5.398 1.5V24c1.873-.225 2.81-.312 4.715-.398V14.83L5.398 1.5z'],
        ['name' => 'Spotify',    'slug' => 'M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z'],
        ['name' => 'Airbnb',     'slug' => 'M12.001 18.275c-1.353-1.697-2.148-3.184-2.413-4.457-.263-1.027-.16-1.848.291-2.465.477-.71 1.188-1.056 2.121-1.056s1.643.345 2.12 1.063c.446.61.558 1.432.286 2.465-.291 1.298-1.085 2.785-2.412 4.458zm9.601 1.14c-.185 1.246-1.034 2.28-2.2 2.783-2.253.98-4.483-.583-6.392-2.704 3.157-3.951 3.74-7.028 2.385-9.018-.795-1.14-1.933-1.695-3.394-1.695-2.944 0-4.563 2.49-3.927 5.382.37 1.565 1.352 3.343 2.917 5.332-.98 1.085-1.91 1.856-2.732 2.333-.636.344-1.245.558-1.828.609-2.679.399-4.778-2.2-3.825-4.88.132-.345.395-.98.845-1.961l.025-.053c1.464-3.178 3.242-6.79 5.285-10.795l.053-.132.58-1.116c.45-.822.635-1.19 1.351-1.643.346-.21.77-.315 1.246-.315.954 0 1.698.558 2.016 1.007.158.239.345.557.582.953l.558 1.089.08.159c2.041 4.004 3.821 7.608 5.279 10.794l.026.025.533 1.22.318.764c.243.613.294 1.222.213 1.858zm1.22-2.39c-.186-.583-.505-1.271-.9-2.094v-.03c-1.889-4.006-3.642-7.608-5.307-10.844l-.111-.163C15.317 1.461 14.468 0 12.001 0c-2.44 0-3.476 1.695-4.535 3.898l-.081.16c-1.669 3.236-3.421 6.843-5.303 10.847v.053l-.559 1.22c-.21.504-.317.768-.345.847C-.172 20.74 2.611 24 5.98 24c.027 0 .132 0 .265-.027h.372c1.75-.213 3.554-1.325 5.384-3.317 1.829 1.989 3.635 3.104 5.382 3.317h.372c.133.027.239.027.265.027 3.37.003 6.152-3.261 4.802-6.975z'],
        ['name' => 'Dropbox',    'slug' => 'M6 1.807L0 5.629l6 3.822 6.001-3.822L6 1.807zM18 1.807l-6 3.822 6 3.822 6-3.822-6-3.822zM0 13.274l6 3.822 6.001-3.822L6 9.452l-6 3.822zM18 9.452l-6 3.822 6 3.822 6-3.822-6-3.822zM6 18.371l6.001 3.822 6-3.822-6-3.822L6 18.371z'],
        ['name' => 'Stripe',     'slug' => 'M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.594-7.305h.003z'],
        ['name' => 'Google',     'slug' => 'M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z'],
        ['name' => 'Apple',      'slug' => 'M12.152 6.896c-.948 0-2.415-1.078-3.96-1.04-2.04.027-3.91 1.183-4.961 3.014-2.117 3.675-.546 9.103 1.519 12.09 1.013 1.454 2.208 3.09 3.792 3.039 1.52-.065 2.09-.987 3.935-.987 1.831 0 2.35.987 3.96.948 1.637-.026 2.676-1.48 3.676-2.948 1.156-1.688 1.636-3.325 1.662-3.415-.039-.013-3.182-1.221-3.22-4.857-.026-3.04 2.48-4.494 2.597-4.559-1.429-2.09-3.623-2.324-4.39-2.376-2-.156-3.675 1.09-4.61 1.09zM15.53 3.83c.843-1.012 1.4-2.427 1.245-3.83-1.207.052-2.662.805-3.532 1.818-.78.896-1.454 2.338-1.273 3.714 1.338.104 2.715-.688 3.559-1.701'],
        ['name' => 'Meta',       'slug' => 'M6.915 4.03c-1.968 0-3.683 1.28-4.871 3.113C.704 9.208 0 11.883 0 14.449c0 .706.07 1.369.21 1.973a6.624 6.624 0 0 0 .265.86 5.297 5.297 0 0 0 .371.761c.696 1.159 1.818 1.927 3.593 1.927 1.497 0 2.633-.671 3.965-2.444.76-1.012 1.144-1.626 2.663-4.32l.756-1.339.186-.325c.061.1.121.196.183.3l2.152 3.595c.724 1.21 1.665 2.556 2.47 3.314 1.046.987 1.992 1.22 3.06 1.22 1.075 0 1.876-.355 2.455-.843a3.743 3.743 0 0 0 .81-.973c.542-.939.861-2.127.861-3.745 0-2.72-.681-5.357-2.084-7.45-1.282-1.912-2.957-2.93-4.716-2.93-1.047 0-2.088.467-3.053 1.308-.652.57-1.257 1.29-1.82 2.05-.69-.875-1.335-1.547-1.958-2.056-1.182-.966-2.315-1.303-3.454-1.303zm10.16 2.053c1.147 0 2.188.758 2.992 1.999 1.132 1.748 1.647 4.195 1.647 6.4 0 1.548-.368 2.9-1.839 2.9-.58 0-1.027-.23-1.664-1.004-.496-.601-1.343-1.878-2.832-4.358l-.617-1.028a44.908 44.908 0 0 0-1.255-1.98c.07-.109.141-.224.211-.327 1.12-1.667 2.118-2.602 3.358-2.602zm-10.201.553c1.265 0 2.058.791 2.675 1.446.307.327.737.871 1.234 1.579l-1.02 1.566c-.757 1.163-1.882 3.017-2.837 4.338-1.191 1.649-1.81 1.817-2.486 1.817-.524 0-1.038-.237-1.383-.794-.263-.426-.464-1.13-.464-2.046 0-2.221.63-4.535 1.66-6.088.454-.687.964-1.226 1.533-1.533a2.264 2.264 0 0 1 1.088-.285z'],
        ['name' => 'Tesla',      'slug' => 'M12 5.362l2.475-3.026s4.245.09 8.471 2.054c-1.082 1.636-3.231 2.438-3.231 2.438-.146-1.439-1.154-1.79-4.354-1.79L12 24 8.619 5.034c-3.18 0-4.188.354-4.335 1.792 0 0-2.146-.795-3.229-2.43C5.28 2.431 9.525 2.34 9.525 2.34L12 5.362l-.004.002H12v-.002zm0-3.899c3.415-.03 7.326.528 11.328 2.28.535-.968.672-1.395.672-1.395C19.625.612 15.528.015 12 0 8.472.015 4.375.61 0 2.349c0 0 .195.525.672 1.396C4.674 1.989 8.585 1.435 12 1.46v.003z'],
        ['name' => 'Salesforce', 'slug' => 'M10.006 5.415a4.195 4.195 0 013.045-1.306c1.56 0 2.954.9 3.69 2.205.63-.3 1.35-.45 2.1-.45 2.85 0 5.159 2.34 5.159 5.22s-2.31 5.22-5.176 5.22c-.345 0-.69-.044-1.02-.104a3.75 3.75 0 01-3.3 1.95c-.6 0-1.155-.15-1.65-.375A4.314 4.314 0 018.88 20.4a4.302 4.302 0 01-4.05-2.82c-.27.062-.54.076-.825.076-2.204 0-4.005-1.8-4.005-4.05 0-1.5.811-2.805 2.01-3.51-.255-.57-.39-1.2-.39-1.846 0-2.58 2.1-4.65 4.65-4.65 1.53 0 2.85.705 3.72 1.8'],
        ['name' => 'GitHub',     'slug' => 'M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12']
    ];
    @endphp

    <div class="overflow-hidden">
        <div class="animate-logo-scroll">
            {{-- Loop 1 --}}
            @foreach($companies as $c)
            <div style="flex-shrink: 0; display: inline-flex; align-items: center; justify-content: center; height: 4rem; width: 10.5rem; opacity: 0.65; transition: opacity 0.2s; padding: 0 1rem; gap: 0.75rem;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.65'">
                <svg viewBox="0 0 24 24" style="width: 24px; height: 24px; fill: currentColor; color: var(--color-text); flex-shrink: 0;">
                    <path d="{{ $c['slug'] }}"/>
                </svg>
                <span style="font-size: 1.05rem; font-weight: 700; color: var(--color-text); letter-spacing: -0.01em;">{{ $c['name'] }}</span>
            </div>
            @endforeach

            {{-- Loop 2 for seamless loop --}}
            @foreach($companies as $c)
            <div style="flex-shrink: 0; display: inline-flex; align-items: center; justify-content: center; height: 4rem; width: 10.5rem; opacity: 0.65; transition: opacity 0.2s; padding: 0 1rem; gap: 0.75rem;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.65'">
                <svg viewBox="0 0 24 24" style="width: 24px; height: 24px; fill: currentColor; color: var(--color-text); flex-shrink: 0;">
                    <path d="{{ $c['slug'] }}"/>
                </svg>
                <span style="font-size: 1.05rem; font-weight: 700; color: var(--color-text); letter-spacing: -0.01em;">{{ $c['name'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     FEATURES SECTION (ChatDeck FeatureSection.tsx)
============================================================ --}}
<section id="fitur" style="padding: 6rem 0;">
    <div class="container-md">
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-bottom: 1rem; color: var(--color-text); letter-spacing: -0.02em;">
                Fitur Unggulan Pembelajaran
            </h2>
            <p style="font-size: 1.1rem; color: var(--color-text-muted); max-width: 36rem; margin: 0 auto; line-height: 1.7;">
                Dirancang khusus untuk membantu Anda bertransformasi dari pemula menjadi talent yang siap bersaing di industri global.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
            @php
            $chatdeckFeatures = [
                [
                    'icon'  => 'code-2',
                    'title' => 'Kurikulum Relevan Industri',
                    'desc'  => 'Materi disusun oleh tech lead dan engineer dari top tech company, selalu di-update sesuai tren teknologi terbaru.',
                    'color' => '#6366f1'
                ],
                [
                    'icon'  => 'terminal',
                    'title' => 'Hands-On Real Project',
                    'desc'  => 'Bukan sekadar teori. Anda akan membangun aplikasi skala nyata yang bisa langsung dijadikan portofolio profesional.',
                    'color' => '#10b981'
                ],
                [
                    'icon'  => 'users',
                    'title' => 'Mentoring & Code Review',
                    'desc'  => 'Dapatkan feedback langsung atas kode dan tugas Anda dari para mentor berpengalaman.',
                    'color' => '#f59e0b'
                ],
                [
                    'icon'  => 'award',
                    'title' => 'Sertifikat Terverifikasi',
                    'desc'  => 'Dapatkan sertifikat digital dengan kode verifikasi unik yang dapat disematkan di LinkedIn dan CV Anda.',
                    'color' => '#8b5cf6'
                ],
                [
                    'icon'  => 'briefcase',
                    'title' => 'Dukungan Penyaluran Kerja',
                    'desc'  => 'Akses ke hiring partner jaringan kami, simulasi interview, dan optimasi resume untuk mempercepat karier Anda.',
                    'color' => '#ec4899'
                ],
                [
                    'icon'  => 'sparkles',
                    'title' => 'AI Learning Assistant',
                    'desc'  => 'Tanyakan materi atau error kode kapan saja ke AI bot khusus kursus kami yang standby 24/7.',
                    'color' => '#06b6d4'
                ]
            ];
            @endphp

            @foreach($chatdeckFeatures as $f)
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; padding: 2.25rem 2rem; background: var(--color-bg); transition: all 0.25s ease; position: relative; overflow: hidden;"
                 onmouseover="this.style.borderColor='var(--color-primary)'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 32px rgba(99,102,241,0.08)';"
                 onmouseout="this.style.borderColor='var(--color-border)'; this.style.transform=''; this.style.boxShadow='';">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: {{ $f['color'] }}18; display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                    <i data-lucide="{{ $f['icon'] }}" style="width: 24px; height: 24px; color: {{ $f['color'] }};"></i>
                </div>
                <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.6rem; color: var(--color-text);">{{ $f['title'] }}</h3>
                <p style="font-size: 0.925rem; color: var(--color-text-muted); line-height: 1.65;">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     INTERACTIVE CODE SANDBOX SECTION (Multi-Language Cards)
============================================================ --}}
<section id="sandbox" style="padding: 6rem 0; border-top: 1px solid var(--color-border); position: relative; overflow: hidden;">
    {{-- Background subtle ambient glow --}}
    <div style="position: absolute; top: -60px; right: 10%; width: 450px; height: 300px; background: radial-gradient(ellipse at center, rgba(99,102,241,0.08), transparent 70%); pointer-events: none; z-index: 0;"></div>

    <div class="container-md" style="position: relative; z-index: 1;">
        {{-- Section Header --}}
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.35rem 1rem; border: 1px solid var(--color-border); border-radius: 9999px; font-size: 0.8125rem; font-weight: 500; color: var(--color-text-muted); background: rgba(99,102,241,0.04); backdrop-filter: blur(8px); margin-bottom: 1.25rem;">
                <span class="pulse-dot"></span>
                <span>Online Cloud Sandbox &bull; Tanpa Instalasi</span>
            </div>
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-bottom: 1rem; color: var(--color-text); letter-spacing: -0.02em;">
                Eksplorasi Kode Langsung di <span style="background: linear-gradient(135deg, #6366f1 20%, #a855f7 80%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Browser Anda</span>
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); max-width: 38rem; margin: 0 auto; line-height: 1.65;">
                Uji coba baris kode program secara real-time langsung dari peramban tanpa perlu konfigurasi lokal. Pilih lingkungan bahasa pemrograman untuk memulai:
            </p>
        </div>

        {{-- Programming Languages Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
            {{-- 1. PYTHON (ACTIVE & WORKING) --}}
            <div style="border: 2px solid var(--color-primary); border-radius: 1rem; padding: 2rem 1.75rem; background: var(--color-bg); display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden; box-shadow: 0 12px 32px -4px rgba(99,102,241,0.12); transition: all 0.25s ease;"
                 onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 20px 40px -4px rgba(99,102,241,0.2)';"
                 onmouseout="this.style.transform=''; this.style.boxShadow='0 12px 32px -4px rgba(99,102,241,0.12)';">
                
                <div>
                    {{-- Top Row: Icon + Status Pill --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(56, 189, 248, 0.12); display: flex; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" width="28" height="28" fill="none">
                                <path d="M12 2C6.48 2 6 3.5 6 5.5v2.25h6V9H4.25C2.25 9 1 10.25 1 12.25s1.25 3.25 3.25 3.25H6V17c0 2 1.5 3.5 6 3.5 4.5 0 6-1.5 6-3.5v-2.25h-6V13h7.75c2 0 3.25-1.25 3.25-3.25S21.75 6.5 19.75 6.5H18V5.5c0-2-1.5-3.5-6-3.5z" fill="#38bdf8"/>
                                <path d="M9.5 4.25a.75.75 0 110 1.5.75.75 0 010-1.5zm5 14a.75.75 0 110 1.5.75.75 0 010-1.5z" fill="#fbbf24"/>
                            </svg>
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; font-weight: 700; color: #10b981; background: rgba(16,185,129,0.12); padding: 0.25rem 0.65rem; border-radius: 9999px;">
                            <span class="pulse-dot" style="background:#10b981; width:6px; height:6px;"></span>
                            <span>Siap Digunakan</span>
                        </span>
                    </div>

                    <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--color-text); margin-bottom: 0.35rem;">
                        Python 3.11
                    </h3>
                    <div style="font-size: 0.825rem; font-weight: 600; color: var(--color-primary); margin-bottom: 0.75rem;">
                        Cloud Sandbox &bull; Real-time Engine
                    </div>
                    <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 1.75rem;">
                        Tulis dan jalankan kode Python secara instan di peramban. Lengkap dengan pintasan keyboard dan penanganan output real-time.
                    </p>
                </div>

                <a href="{{ route('playground.index') }}" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.65rem 1.25rem; border-radius: 9999px; font-weight: 600; font-size: 0.9rem; box-shadow: 0 4px 14px rgba(99,102,241,0.35); text-decoration: none;">
                    <span>Buka Python Sandbox</span>
                    <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                </a>
            </div>

            {{-- 2. PHP (COMING SOON) --}}
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; padding: 2rem 1.75rem; background: var(--color-bg); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.25s ease;">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.95rem; color: #6366f1;">
                            PHP
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; font-weight: 600; color: var(--color-text-muted); background: rgba(107,114,128,0.1); padding: 0.25rem 0.65rem; border-radius: 9999px;">
                            Segera Hadir
                        </span>
                    </div>

                    <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--color-text); margin-bottom: 0.35rem;">
                        PHP 8.3
                    </h3>
                    <div style="font-size: 0.825rem; font-weight: 600; color: var(--color-text-muted); margin-bottom: 0.75rem;">
                        Server Scripting Engine
                    </div>
                    <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 1.75rem;">
                        Jalankan script PHP modern, manipulasi array, fungsi bawaan, dan logika backend langsung dari browser.
                    </p>
                </div>

                <button type="button" disabled class="btn-ghost" style="width: 100%; justify-content: center; padding: 0.65rem 1.25rem; border-radius: 9999px; opacity: 0.6; cursor: not-allowed; font-size: 0.875rem;">
                    <i data-lucide="clock" style="width: 15px; height: 15px;"></i>
                    <span>Dalam Pengembangan</span>
                </button>
            </div>

            {{-- 3. JAVASCRIPT (COMING SOON) --}}
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; padding: 2rem 1.75rem; background: var(--color-bg); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.25s ease;">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(234, 179, 8, 0.12); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.95rem; color: #eab308;">
                            JS
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; font-weight: 600; color: var(--color-text-muted); background: rgba(107,114,128,0.1); padding: 0.25rem 0.65rem; border-radius: 9999px;">
                            Segera Hadir
                        </span>
                    </div>

                    <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--color-text); margin-bottom: 0.35rem;">
                        JavaScript (Node.js)
                    </h3>
                    <div style="font-size: 0.825rem; font-weight: 600; color: var(--color-text-muted); margin-bottom: 0.75rem;">
                        Modern ECMAScript Runtime
                    </div>
                    <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 1.75rem;">
                        Eksplorasi fitur ES6+, algoritma, fungsi asinkron (async/await), dan manipulasi data secara interaktif.
                    </p>
                </div>

                <button type="button" disabled class="btn-ghost" style="width: 100%; justify-content: center; padding: 0.65rem 1.25rem; border-radius: 9999px; opacity: 0.6; cursor: not-allowed; font-size: 0.875rem;">
                    <i data-lucide="clock" style="width: 15px; height: 15px;"></i>
                    <span>Dalam Pengembangan</span>
                </button>
            </div>

            {{-- 4. JAVA (COMING SOON) --}}
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; padding: 2rem 1.75rem; background: var(--color-bg); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.25s ease;">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.9rem; color: #ef4444;">
                            Java
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; font-weight: 600; color: var(--color-text-muted); background: rgba(107,114,128,0.1); padding: 0.25rem 0.65rem; border-radius: 9999px;">
                            Segera Hadir
                        </span>
                    </div>

                    <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--color-text); margin-bottom: 0.35rem;">
                        Java 21
                    </h3>
                    <div style="font-size: 0.825rem; font-weight: 600; color: var(--color-text-muted); margin-bottom: 0.75rem;">
                        Enterprise OOP Platform
                    </div>
                    <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 1.75rem;">
                        Kompilasi dan eksekusi struktur kelas, inheritance, polymorphism, dan algoritma dasar Java tanpa setup JDK.
                    </p>
                </div>

                <button type="button" disabled class="btn-ghost" style="width: 100%; justify-content: center; padding: 0.65rem 1.25rem; border-radius: 9999px; opacity: 0.6; cursor: not-allowed; font-size: 0.875rem;">
                    <i data-lucide="clock" style="width: 15px; height: 15px;"></i>
                    <span>Dalam Pengembangan</span>
                </button>
            </div>

            {{-- 5. C# (COMING SOON) --}}
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; padding: 2rem 1.75rem; background: var(--color-bg); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.25s ease;">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(168, 85, 247, 0.1); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.95rem; color: #a855f7;">
                            C#
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; font-weight: 600; color: var(--color-text-muted); background: rgba(107,114,128,0.1); padding: 0.25rem 0.65rem; border-radius: 9999px;">
                            Segera Hadir
                        </span>
                    </div>

                    <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--color-text); margin-bottom: 0.35rem;">
                        C# (.NET)
                    </h3>
                    <div style="font-size: 0.825rem; font-weight: 600; color: var(--color-text-muted); margin-bottom: 0.75rem;">
                        Microsoft .NET Runtime
                    </div>
                    <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 1.75rem;">
                        Uji coba sintaks C#, LINQ, struktur OOP, dan algoritma aplikasi berbasis ekosistem Microsoft .NET.
                    </p>
                </div>

                <button type="button" disabled class="btn-ghost" style="width: 100%; justify-content: center; padding: 0.65rem 1.25rem; border-radius: 9999px; opacity: 0.6; cursor: not-allowed; font-size: 0.875rem;">
                    <i data-lucide="clock" style="width: 15px; height: 15px;"></i>
                    <span>Dalam Pengembangan</span>
                </button>
            </div>

            {{-- 6. C++ / GO (COMING SOON) --}}
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; padding: 2rem 1.75rem; background: var(--color-bg); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.25s ease;">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(6, 182, 212, 0.1); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.85rem; color: #06b6d4;">
                            C++
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; font-weight: 600; color: var(--color-text-muted); background: rgba(107,114,128,0.1); padding: 0.25rem 0.65rem; border-radius: 9999px;">
                            Segera Hadir
                        </span>
                    </div>

                    <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--color-text); margin-bottom: 0.35rem;">
                        C++ &amp; Go
                    </h3>
                    <div style="font-size: 0.825rem; font-weight: 600; color: var(--color-text-muted); margin-bottom: 0.75rem;">
                        High-Performance Systems
                    </div>
                    <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 1.75rem;">
                        Latihan competitive programming, struktur data lanjutan, dan algoritma berkinerja tinggi.
                    </p>
                </div>

                <button type="button" disabled class="btn-ghost" style="width: 100%; justify-content: center; padding: 0.65rem 1.25rem; border-radius: 9999px; opacity: 0.6; cursor: not-allowed; font-size: 0.875rem;">
                    <i data-lucide="clock" style="width: 15px; height: 15px;"></i>
                    <span>Dalam Pengembangan</span>
                </button>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     POPULAR COURSES SECTION (Professional High-End EdTech Architecture)
============================================================ --}}
<section id="kursus" style="padding: 6.5rem 0; background: rgba(0,0,0,0.015); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
    <div class="container-md">
        {{-- Section Header --}}
        <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-primary); margin-bottom: 0.6rem; background: rgba(99,102,241,0.08); padding: 0.25rem 0.75rem; border-radius: 9999px;">
                    <i data-lucide="sparkles" style="width: 14px; height: 14px;"></i>
                    <span>Katalog Kursus Unggulan</span>
                </div>
                <h2 style="font-size: clamp(2rem, 4.5vw, 2.75rem); font-weight: 800; color: var(--color-text); letter-spacing: -0.025em; line-height: 1.2;">
                    Kursus Pilihan Terpopuler
                </h2>
                <p style="font-size: 1.05rem; color: var(--color-text-muted); margin-top: 0.5rem; max-width: 42rem; line-height: 1.6;">
                    Kurikulum komprehensif berbasis proyek nyata yang telah terbukti mengantarkan ribuan alumni meraih karier impian di industri teknologi.
                </p>
            </div>
            <a href="{{ route('user.courses.index') }}" class="btn-primary" style="padding: 0.75rem 1.6rem; font-size: 0.95rem; font-weight: 600; border-radius: 9999px; box-shadow: 0 4px 14px rgba(99,102,241,0.3);">
                <span>Jelajahi Semua Kursus</span>
                <i data-lucide="arrow-right" style="width: 18px; height: 18px;"></i>
            </a>
        </div>

        {{-- Category Filter Tabs --}}
        <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 2.75rem; overflow-x: auto; padding-bottom: 0.5rem; scrollbar-width: none;">
            <button type="button" class="course-filter-tab active" data-filter="all" onclick="filterCourses('all', this)">Semua Materi</button>
            <button type="button" class="course-filter-tab" data-filter="html-css" onclick="filterCourses('html-css', this)">HTML & CSS</button>
            <button type="button" class="course-filter-tab" data-filter="javascript" onclick="filterCourses('javascript', this)">JavaScript</button>
            <button type="button" class="course-filter-tab" data-filter="tools" onclick="filterCourses('tools', this)">Git & Tools</button>
            <button type="button" class="course-filter-tab" data-filter="backend" onclick="filterCourses('backend', this)">PHP & Database</button>
            <button type="button" class="course-filter-tab" data-filter="design" onclick="filterCourses('design', this)">UI/UX Design</button>
        </div>

        {{-- Professional Courses Grid (Simplified, Clean & Perfectly Aligned) --}}
        <div class="course-grid-pro" id="courseGridContainer">
            @php
            $defaultCourses = [
                [
                    'id'          => 1,
                    'tag_filter'  => 'html-css',
                    'title'       => 'Dasar HTML & Struktur Web',
                    'desc'        => 'Pahami pondasi website dari nol, elemen semantik modern, struktur formulir, dan pembuatan halaman web pertama Anda.',
                    'image'       => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80',
                    'original'    => 0,
                    'price'       => 0,
                    'icon'        => 'code',
                ],
                [
                    'id'          => 2,
                    'tag_filter'  => 'html-css',
                    'title'       => 'Dasar CSS & Styling Modern',
                    'desc'        => 'Kuasai tata letak Flexbox, CSS Grid, tipografi, variabel warna, responsive layout, dan estetika visual modern.',
                    'image'       => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=80',
                    'original'    => 0,
                    'price'       => 0,
                    'icon'        => 'palette',
                ],
                [
                    'id'          => 3,
                    'tag_filter'  => 'javascript',
                    'title'       => 'Dasar JavaScript & Interaktivitas Web',
                    'desc'        => 'Pelajari variabel, fungsi, logika kondisi, perulangan, manipulasi DOM, dan event interaktif halaman web untuk pemula.',
                    'image'       => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
                    'original'    => 199000,
                    'price'       => 99000,
                    'icon'        => 'braces',
                ],
                [
                    'id'          => 4,
                    'tag_filter'  => 'tools',
                    'title'       => 'Dasar Git & GitHub untuk Pemula',
                    'desc'        => 'Panduan lengkap version control, commit alur kerja, percabangan branch, serta kolaborasi repositori proyek di GitHub.',
                    'image'       => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&w=800&q=80',
                    'original'    => 0,
                    'price'       => 0,
                    'icon'        => 'git-branch',
                ],
                [
                    'id'          => 5,
                    'tag_filter'  => 'backend',
                    'title'       => 'Dasar Pemrograman PHP & Database MySQL',
                    'desc'        => 'Mulai membangun backend web dinamis, pengolahan data form, koneksi database MySQL, dan operasi CRUD mendasar.',
                    'image'       => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80',
                    'original'    => 249000,
                    'price'       => 129000,
                    'icon'        => 'database',
                ],
                [
                    'id'          => 6,
                    'tag_filter'  => 'design',
                    'title'       => 'Dasar UI/UX Design dengan Figma',
                    'desc'        => 'Fundamental perancangan antarmuka aplikasi, wireframe, hierarchy visual, auto-layout, dan pembuatan prototype interaktif.',
                    'image'       => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?auto=format&fit=crop&w=800&q=80',
                    'original'    => 199000,
                    'price'       => 99000,
                    'icon'        => 'layout-template',
                ],
            ];
            @endphp

            @foreach($defaultCourses as $dc)
            <div class="course-card-pro" data-course-filter="{{ $dc['tag_filter'] }}">
                {{-- Background Image with Zoom Effect on Hover --}}
                <img src="{{ $dc['image'] }}" alt="{{ $dc['title'] }}" class="course-card-bg-img" loading="lazy">

                {{-- Gradient Overlay for Text Readability --}}
                <div class="course-card-overlay"></div>

                {{-- Content Container --}}
                <div class="course-card-content">
                    {{-- Top Section: Logo Only --}}
                    <div class="course-card-top">
                        <div class="course-card-logo-circle" title="{{ $dc['title'] }}">
                            <i data-lucide="{{ $dc['icon'] }}" style="width: 24px; height: 24px;"></i>
                        </div>
                    </div>

                    {{-- Middle Section: Judul & Deskripsi Singkat Saja --}}
                    <div class="course-card-body">
                        <h3 class="course-card-title">{{ $dc['title'] }}</h3>
                        <p class="course-card-desc">{{ $dc['desc'] }}</p>
                    </div>

                    {{-- Bottom Section: Price & Action Aligned Perfectly Flush --}}
                    <div class="course-card-bottom">
                        <div class="course-price-wrap">
                            @if($dc['price'] == 0)
                                <span class="course-price-free-label">Akses Gratis</span>
                                <span class="course-price-free">GRATIS</span>
                            @else
                                <span class="course-price-orig">Rp {{ number_format($dc['original'], 0, ',', '.') }}</span>
                                <div class="course-price-current">
                                    <span class="course-price-val">Rp {{ number_format($dc['price'], 0, ',', '.') }}</span>
                                    <span class="course-price-period">/akses</span>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('user.courses.index') }}" class="course-book-btn">
                            <span>Mulai Belajar</span>
                            <i data-lucide="arrow-right" style="width: 13px; height: 13px;"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    function filterCourses(category, btn) {
        document.querySelectorAll('.course-filter-tab').forEach(b => b.classList.remove('active'));
        if (btn) btn.classList.add('active');

        const cards = document.querySelectorAll('.course-card-pro');
        cards.forEach(card => {
            const cardCategory = card.getAttribute('data-course-filter');
            if (category === 'all' || cardCategory === category) {
                card.style.display = 'flex';
                card.style.opacity = '0';
                card.style.transform = 'translateY(12px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.35s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 20);
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endpush

{{-- ============================================================
     TEAM SECTION (ChatDeck TeamSection.tsx 100%)
============================================================ --}}
<section id="tim" style="padding: 6rem 0;">
    <div class="container-md">
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-bottom: 1rem; color: var(--color-text); letter-spacing: -0.02em;">
                Temui Tim & Mentor Hebat Kami
            </h2>
            <p style="font-size: 1.1rem; color: var(--color-text-muted); max-width: 36rem; margin: 0 auto; line-height: 1.7;">
                Para ahli dan praktisi berdedikasi tinggi yang akan membimbing perjalanan belajar Anda menuju kesuksesan.
            </p>
        </div>

        @php
        $teamMembers = [
            [
                'name'        => 'Phillip Bothman',
                'role'        => 'Founder & CEO',
                'description' => 'A visionary leader driving education innovation and community collaboration.',
                'image'       => asset('team/phillip.png'),
                'initials'    => 'PB',
            ],
            [
                'name'        => 'James Kenter',
                'role'        => 'Engineering Manager',
                'description' => 'Leading high-performing engineering teams to build smart, scalable web platforms.',
                'image'       => asset('team/james.png'),
                'initials'    => 'JK',
            ],
            [
                'name'        => 'Cristofer Kenter',
                'role'        => 'Product Designer',
                'description' => 'Crafting intuitive, accessible, and delightful digital user experiences.',
                'image'       => asset('team/cristofer.png'),
                'initials'    => 'CK',
            ],
            [
                'name'        => 'Alena Lubin',
                'role'        => 'Frontend Specialist',
                'description' => 'Bringing beautiful responsive designs to life with modern CSS and reactive frameworks.',
                'image'       => asset('team/alena.png'),
                'initials'    => 'AL',
            ],
        ];
        @endphp

        <div class="team-grid-4">
            @foreach($teamMembers as $m)
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; background: var(--color-bg); overflow: hidden; padding: 2rem 1.5rem; text-align: center; transition: all 0.25s ease;"
                 onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='var(--color-primary)';"
                 onmouseout="this.style.transform=''; this.style.borderColor='var(--color-border)';">
                {{-- Avatar --}}
                <div style="width: 96px; height: 96px; margin: 0 auto 1.25rem; border-radius: 50%; overflow: hidden; border: 3px solid var(--color-border); background: var(--color-border); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(0,0,0,0.06);">
                    <img src="{{ $m['image'] }}" alt="{{ $m['name'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($m['name']) }}&background=6366f1&color=fff'">
                </div>

                <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--color-text); margin-bottom: 0.25rem;">{{ $m['name'] }}</h3>
                <div style="font-size: 0.85rem; font-weight: 600; color: var(--color-primary); margin-bottom: 0.85rem;">{{ $m['role'] }}</div>
                <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: 1.5rem;">{{ $m['description'] }}</p>

                {{-- Social Icons (Guaranteed Visible Inline SVGs with Tooltip & Hover Lift) --}}
                <div style="display: flex; justify-content: center; gap: 0.6rem; align-items: center;">
                    <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="team-social-link" title="Twitter / X" aria-label="Twitter / X">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="https://github.com" target="_blank" rel="noopener noreferrer" class="team-social-link" title="GitHub" aria-label="GitHub">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                        </svg>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="team-social-link" title="LinkedIn" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2V10.9H6.46M7.83 6.45a1.64 1.64 0 1 0 0 3.28 1.64 1.64 0 0 0 0-3.28z"/>
                        </svg>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="team-social-link" title="Instagram" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     TESTIMONIAL SECTION (ChatDeck 2-Row Bidirectional Marquee 100%)
============================================================ --}}
<section id="testimoni" style="padding: 6rem 0; background: rgba(0,0,0,0.015); border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border); position: relative; overflow: hidden;">
    <div class="container-md" style="margin-bottom: 3.5rem;">
        <div style="text-align: center;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-bottom: 1rem; color: var(--color-text); letter-spacing: -0.02em;">
                Dipercaya Ribuan Pelajar & Profesional
            </h2>
            <p style="font-size: 1.1rem; color: var(--color-text-muted); max-width: 38rem; margin: 0 auto; line-height: 1.7;">
                Cerita nyata dari para pelajar yang berhasil mengakselerasi kemampuan dan mendapatkan pekerjaan impian melalui Edify.
            </p>
        </div>
    </div>

    @php
    $row1 = [
        [
            'name'     => 'Sarah Chen',
            'username' => '@sarahchen · Fullstack Dev',
            'body'     => 'Materi pembelajaran di Edify sangat to-the-point dan praktis! Proyek portfolio yang saya buat langsung diapresiasi oleh recruiter.',
            'avatar'   => 'SC',
            'grad'     => 'linear-gradient(135deg, #6366f1, #8b5cf6)'
        ],
        [
            'name'     => 'Budi Santoso',
            'username' => '@budisantoso · Backend Engineer',
            'body'     => 'Kursus Laravel & Docker-nya luar biasa lengkap. Dalam 3 bulan belajar intensif, saya berhasil naik level ke posisi Senior Developer.',
            'avatar'   => 'BS',
            'grad'     => 'linear-gradient(135deg, #3b82f6, #06b6d4)'
        ],
        [
            'name'     => 'Emily Rodriguez',
            'username' => '@emilyr · UI/UX Designer',
            'body'     => 'Design system & Figma workshop-nya sangat terstruktur. Sangat recommended untuk siapapun yang ingin switch career ke dunia desain produk.',
            'avatar'   => 'ER',
            'grad'     => 'linear-gradient(135deg, #ec4899, #f43f5e)'
        ],
        [
            'name'     => 'Marcus Johnson',
            'username' => '@marcusj · Data Scientist',
            'body'     => 'Pendekatan hands-on machine learning dengan Python di sini membuat materi rumit terasa sangat intuitif dan menyenangkan untuk dipelajari.',
            'avatar'   => 'MJ',
            'grad'     => 'linear-gradient(135deg, #10b981, #059669)'
        ]
    ];

    $row2 = [
        [
            'name'     => 'David Kim',
            'username' => '@davidkim · Mobile App Dev',
            'body'     => 'Komunitas Discord eksklusif dan mentor yang selalu siap membantu saat blocker membuat proses belajar terasa memiliki tim support 24 jam.',
            'avatar'   => 'DK',
            'grad'     => 'linear-gradient(135deg, #f59e0b, #d97706)'
        ],
        [
            'name'     => 'Priya Patel',
            'username' => '@priyapatel · Frontend Specialist',
            'body'     => 'Sertifikat resmi terverifikasi dari Edify langsung saya pajang di LinkedIn dan banyak mendatangkan tawaran pekerjaan freelance internasional.',
            'avatar'   => 'PP',
            'grad'     => 'linear-gradient(135deg, #8b5cf6, #d946ef)'
        ],
        [
            'name'     => 'Ahmad Fauzi',
            'username' => '@ahmadf · Cloud Architect',
            'body'     => 'Modul arsitektur mikroservis dan cloud computing sangat komprehensif. Menjawab semua tantangan nyata yang saya temui di pekerjaan kantor.',
            'avatar'   => 'AF',
            'grad'     => 'linear-gradient(135deg, #06b6d4, #3b82f6)'
        ],
        [
            'name'     => 'Siti Nurhaliza',
            'username' => '@sitinur · Product Manager',
            'body'     => 'Platform ini bukan sekadar kursus video, tapi ekosistem upskilling terlengkap. Kualitas instrukturnya benar-benar kaliber praktisi top!',
            'avatar'   => 'SN',
            'grad'     => 'linear-gradient(135deg, #6366f1, #ec4899)'
        ]
    ];
    @endphp

    {{-- Two Row Marquee Container with Gradient Edge Masks --}}
    <div style="position: relative; width: 100%; overflow: hidden; display: flex; flex-direction: column; gap: 1.25rem;">
        {{-- Gradient Masks --}}
        <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 120px; background: linear-gradient(to right, var(--color-bg), transparent); z-index: 10; pointer-events: none;"></div>
        <div style="position: absolute; right: 0; top: 0; bottom: 0; width: 120px; background: linear-gradient(to left, var(--color-bg), transparent); z-index: 10; pointer-events: none;"></div>

        {{-- Baris 1: Bergerak ke Kiri (ChatDeck Row 1) --}}
        <div class="overflow-hidden">
            <div class="animate-marquee-left">
                @foreach($row1 as $r)
                <div class="review-card">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.85rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $r['grad'] }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; flex-shrink: 0;">
                            {{ $r['avatar'] }}
                        </div>
                        <div style="overflow: hidden;">
                            <div style="font-weight: 700; font-size: 0.95rem; color: var(--color-text); line-height: 1.2;">{{ $r['name'] }}</div>
                            <div style="font-size: 0.8rem; color: var(--color-text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $r['username'] }}</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.2rem; margin-bottom: 0.75rem;">
                        @for($s=0; $s<5; $s++)
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        @endfor
                    </div>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6; margin: 0;">"{{ $r['body'] }}"</p>
                </div>
                @endforeach

                {{-- Loop duplication for seamless infinite scroll --}}
                @foreach($row1 as $r)
                <div class="review-card">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.85rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $r['grad'] }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; flex-shrink: 0;">
                            {{ $r['avatar'] }}
                        </div>
                        <div style="overflow: hidden;">
                            <div style="font-weight: 700; font-size: 0.95rem; color: var(--color-text); line-height: 1.2;">{{ $r['name'] }}</div>
                            <div style="font-size: 0.8rem; color: var(--color-text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $r['username'] }}</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.2rem; margin-bottom: 0.75rem;">
                        @for($s=0; $s<5; $s++)
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        @endfor
                    </div>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6; margin: 0;">"{{ $r['body'] }}"</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Baris 2: Bergerak ke Kanan / Reverse (ChatDeck Row 2) --}}
        <div class="overflow-hidden">
            <div class="animate-marquee-right">
                @foreach($row2 as $r)
                <div class="review-card">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.85rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $r['grad'] }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; flex-shrink: 0;">
                            {{ $r['avatar'] }}
                        </div>
                        <div style="overflow: hidden;">
                            <div style="font-weight: 700; font-size: 0.95rem; color: var(--color-text); line-height: 1.2;">{{ $r['name'] }}</div>
                            <div style="font-size: 0.8rem; color: var(--color-text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $r['username'] }}</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.2rem; margin-bottom: 0.75rem;">
                        @for($s=0; $s<5; $s++)
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        @endfor
                    </div>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6; margin: 0;">"{{ $r['body'] }}"</p>
                </div>
                @endforeach

                {{-- Loop duplication for seamless infinite scroll --}}
                @foreach($row2 as $r)
                <div class="review-card">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.85rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $r['grad'] }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; flex-shrink: 0;">
                            {{ $r['avatar'] }}
                        </div>
                        <div style="overflow: hidden;">
                            <div style="font-weight: 700; font-size: 0.95rem; color: var(--color-text); line-height: 1.2;">{{ $r['name'] }}</div>
                            <div style="font-size: 0.8rem; color: var(--color-text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $r['username'] }}</div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.2rem; margin-bottom: 0.75rem;">
                        @for($s=0; $s<5; $s++)
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        @endfor
                    </div>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); line-height: 1.6; margin: 0;">"{{ $r['body'] }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     PRICING SECTION (ChatDeck PricingSection.tsx 100%)
============================================================ --}}
<section id="harga" style="padding: 6rem 0;">
    <div class="container-md" style="text-align: center;">
        <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-bottom: 1rem; color: var(--color-text); letter-spacing: -0.02em;">
            Pilihan Paket Berlangganan
        </h2>
        <p style="font-size: 1.1rem; color: var(--color-text-muted); max-width: 36rem; margin: 0 auto 2rem; line-height: 1.7;">
            Pilih paket yang paling sesuai dengan kebutuhan belajar dan akselerasi kemampuan Anda.
        </p>

        {{-- Billing Toggle (Monthly / Yearly) --}}
        <div class="billing-toggle-container">
            <button class="billing-btn active" id="btnMonthly" onclick="setBilling('monthly')">Tagihan Bulanan</button>
            <button class="billing-btn" id="btnYearly" onclick="setBilling('yearly')">
                Tahunan <span style="background: #10b981; color: #fff; font-size: 0.7rem; font-weight: 700; padding: 0.15rem 0.5rem; border-radius: 9999px; margin-left: 0.25rem;">Hemat 20%</span>
            </button>
        </div>

        {{-- 3 Plan Cards --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem; max-width: 1040px; margin: 0 auto; text-align: left;">
            {{-- Free Plan --}}
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; padding: 2.25rem 2rem; background: var(--color-bg); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-text); margin-bottom: 0.5rem;">Free Tier</h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 1.5rem;">Cocok untuk yang ingin mencoba dasar pemrograman & materi pengantar.</p>
                    <div style="margin-bottom: 2rem;">
                        <span style="font-size: 2.5rem; font-weight: 800; color: var(--color-text);">Rp 0</span>
                        <span style="color: var(--color-text-muted); font-size: 0.9rem;">/bulan</span>
                    </div>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 2rem;">
                        @foreach(['Akses 20+ kursus dasar gratis', 'Forum diskusi komunitas', 'Kuis latihan mandiri', 'Standard video playback'] as $f)
                        <li style="display: flex; align-items: center; gap: 0.625rem; font-size: 0.9rem; color: var(--color-text-muted);">
                            <i data-lucide="check" style="width: 16px; height: 16px; color: #10b981; flex-shrink: 0;"></i>
                            <span>{{ $f }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="btn-ghost" style="width: 100%; justify-content: center; padding: 0.75rem; font-weight: 600;">Mulai Gratis</a>
            </div>

            {{-- Pro Plan (Popular) --}}
            <div style="border: 2px solid var(--color-primary); border-radius: 1rem; padding: 2.25rem 2rem; background: rgba(99,102,241,0.02); display: flex; flex-direction: column; justify-content: space-between; position: relative; box-shadow: 0 12px 32px rgba(99,102,241,0.12);">
                <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: var(--color-primary); color: #fff; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 1rem; border-radius: 9999px; letter-spacing: 0.05em; text-transform: uppercase;">
                    Paling Populer
                </div>
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-text); margin-bottom: 0.5rem;">Pro Member</h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 1.5rem;">Akses penuh untuk siapa saja yang ingin serius membangun karier.</p>
                    <div style="margin-bottom: 2rem;">
                        <span id="pricePro" style="font-size: 2.5rem; font-weight: 800; color: var(--color-primary);">Rp 99.000</span>
                        <span id="periodPro" style="color: var(--color-text-muted); font-size: 0.9rem;">/bulan</span>
                    </div>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 2rem;">
                        @foreach(['Akses semua 200+ kursus premium', 'Sertifikat digital terverifikasi', 'Source code & file latihan proyek', 'Tanya mentor via Discord eksklusif', 'Dukungan karir & review CV'] as $f)
                        <li style="display: flex; align-items: center; gap: 0.625rem; font-size: 0.9rem; color: var(--color-text);">
                            <i data-lucide="check" style="width: 16px; height: 16px; color: var(--color-primary); flex-shrink: 0;"></i>
                            <span>{{ $f }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem; font-weight: 700; font-size: 1rem; box-shadow: 0 4px 16px rgba(99,102,241,0.3);">
                    Pilih Paket Pro →
                </a>
            </div>

            {{-- Team / Business Plan --}}
            <div style="border: 1px solid var(--color-border); border-radius: 1rem; padding: 2.25rem 2rem; background: var(--color-bg); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-text); margin-bottom: 0.5rem;">Enterprise / Tim</h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 1.5rem;">Untuk perusahaan dan institusi yang ingin melatih tim secara bersamaan.</p>
                    <div style="margin-bottom: 2rem;">
                        <span id="priceBiz" style="font-size: 2.5rem; font-weight: 800; color: var(--color-text);">Rp 299.000</span>
                        <span id="periodBiz" style="color: var(--color-text-muted); font-size: 0.9rem;">/user/bulan</span>
                    </div>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 2rem;">
                        @foreach(['Semua fitur Pro Member', 'Dashboard analitik progress tim', 'Dedicated mentor & workshop bulanan', 'Faktur pajak & invoice resmi', 'Prioritas support 24/7'] as $f)
                        <li style="display: flex; align-items: center; gap: 0.625rem; font-size: 0.9rem; color: var(--color-text-muted);">
                            <i data-lucide="check" style="width: 16px; height: 16px; color: #10b981; flex-shrink: 0;"></i>
                            <span>{{ $f }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <a href="mailto:support@edify.app?subject=Konsultasi Paket Tim" class="btn-ghost" style="width: 100%; justify-content: center; padding: 0.75rem; font-weight: 600;">Hubungi Sales</a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     FAQ SECTION (ChatDeck FaqSection.tsx 100% Full Container)
============================================================ --}}
<section id="faq" style="padding: 6rem 0; background: rgba(0,0,0,0.015); border-top: 1px solid var(--color-border);">
    <div class="container-md">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-bottom: 1rem; color: var(--color-text); letter-spacing: -0.02em;">
                Pertanyaan yang Sering Diajukan
            </h2>
            <p style="font-size: 1.1rem; color: var(--color-text-muted); line-height: 1.7;">
                Semua jawaban penting tentang Edify, metode pembelajaran, dan sertifikasi.
            </p>
        </div>

        @php
        $chatdeckFaqs = [
            [
                'q' => 'Apakah pemula tanpa latar belakang IT bisa mengikuti kursus?',
                'a' => 'Tentu saja! Kami memiliki jalur belajar (Learning Path) khusus dari level 0. Mulai dari konsep dasar, syntax bahasa pemrograman, hingga pembuatan proyek utuh dengan bimbingan langkah demi langkah.'
            ],
            [
                'q' => 'Berapa lama masa aktif akses kursus setelah dibeli?',
                'a' => 'Akses kursus bersifat seumur hidup (Lifetime Access). Anda dapat mengulang materi kapan pun dan mendapatkan semua update materi mendatang tanpa biaya tambahan.'
            ],
            [
                'q' => 'Bagaimana cara verifikasi sertifikat kelulusan?',
                'a' => 'Setiap sertifikat memiliki nomor seri digital dan link verifikasi unik yang dapat diakses oleh siapa saja (misalnya recruiter atau institusi) untuk membuktikan keaslian penyelesaian kursus Anda.'
            ],
            [
                'q' => 'Metode pembayaran apa saja yang didukung?',
                'a' => 'Kami mendukung berbagai saluran pembayaran populer di Indonesia: Transfer Bank (BCA, Mandiri, BNI, BRI), QRIS, E-Wallet (GoPay, OVO, Dana), kartu kredit/debit Visa & Mastercard, serta minimarket Alfamart/Indomaret.'
            ],
            [
                'q' => 'Apakah tersedia garansi uang kembali?',
                'a' => 'Ya, kami memberikan garansi 7 hari uang kembali tanpa syarat jika Anda merasa kursus yang diambil tidak sesuai dengan ekspektasi.'
            ]
        ];
        @endphp

        <div style="display: flex; flex-direction: column; gap: 0.85rem;">
            @foreach($chatdeckFaqs as $i => $item)
            <div style="border: 1px solid var(--color-border); border-radius: 0.875rem; background: var(--color-bg); overflow: hidden; transition: border-color 0.2s;">
                <button id="faq-btn-{{ $i }}" onclick="toggleChatDeckFaq({{ $i }})" style="width: 100%; padding: 1.25rem 1.5rem; background: none; border: none; cursor: pointer; display: flex; align-items: center; justify-content: space-between; text-align: left; font-size: 1rem; font-weight: 600; color: var(--color-text); font-family: inherit;">
                    <span>{{ $item['q'] }}</span>
                    <span id="faq-icon-{{ $i }}" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1); flex-shrink: 0; margin-left: 1rem; color: var(--color-text-muted);">
                        <i data-lucide="plus" style="width: 18px; height: 18px;"></i>
                    </span>
                </button>
                <div id="faq-ans-{{ $i }}" style="max-height: 0; overflow: hidden; transition: max-height 0.35s cubic-bezier(0.22, 1, 0.36, 1);">
                    <p style="padding: 0 1.5rem 1.25rem; font-size: 0.925rem; color: var(--color-text-muted); line-height: 1.7;">
                        {{ $item['a'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     CTA BANNER SECTION
============================================================ --}}
<section style="padding: 6rem 0;">
    <div class="container-md">
        <div style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border-radius: 1.5rem; padding: 4.5rem 2rem; text-align: center; position: relative; overflow: hidden; box-shadow: 0 20px 50px rgba(79,70,229,0.3);">
            <div style="position: absolute; top: -50px; right: -50px; width: 240px; height: 240px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -50px; left: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.06); border-radius: 50%;"></div>
            
            <div style="position: relative; z-index: 1;">
                <h2 style="font-size: clamp(2rem, 4.5vw, 3rem); font-weight: 800; color: #fff; margin-bottom: 1.25rem; letter-spacing: -0.02em;">
                    Siap Memulai Perjalanan Karier Impian Anda?
                </h2>
                <p style="font-size: 1.15rem; color: rgba(255,255,255,0.85); max-width: 34rem; margin: 0 auto 2.5rem; line-height: 1.7;">
                    Daftar akun gratis sekarang dan nikmati akses materi pengantar dan komunitas tech talent terbesar di Indonesia.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('register') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.95rem 2.25rem; background: #fff; color: #4f46e5; border-radius: 9999px; font-size: 1.05rem; font-weight: 700; text-decoration: none; transition: transform 0.2s, box-shadow 0.2s; box-shadow: 0 8px 24px rgba(0,0,0,0.18);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.25)';" onmouseout="this.style.transform=''; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.18)';">
                        <span>Daftar Sekarang — Gratis</span>
                        <i data-lucide="arrow-right" style="width: 18px; height: 18px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    /* ============================================================
       Pricing Billing Toggle (Monthly / Yearly)
    ============================================================ */
    function setBilling(type) {
        const btnM = document.getElementById('btnMonthly');
        const btnY = document.getElementById('btnYearly');
        const pricePro = document.getElementById('pricePro');
        const periodPro = document.getElementById('periodPro');
        const priceBiz = document.getElementById('priceBiz');
        const periodBiz = document.getElementById('periodBiz');

        if (type === 'yearly') {
            btnM.classList.remove('active');
            btnY.classList.add('active');
            pricePro.textContent = 'Rp 79.000';
            periodPro.textContent = '/bulan (ditagih tahunan)';
            priceBiz.textContent = 'Rp 239.000';
            periodBiz.textContent = '/user/bulan (ditagih tahunan)';
        } else {
            btnY.classList.remove('active');
            btnM.classList.add('active');
            pricePro.textContent = 'Rp 99.000';
            periodPro.textContent = '/bulan';
            priceBiz.textContent = 'Rp 299.000';
            periodBiz.textContent = '/user/bulan';
        }
    }

    /* ============================================================
       FAQ Accordion (ChatDeck Style)
    ============================================================ */
    function toggleChatDeckFaq(index) {
        const ans = document.getElementById('faq-ans-' + index);
        const icon = document.getElementById('faq-icon-' + index);
        const isOpen = ans.style.maxHeight && ans.style.maxHeight !== '0px';

        // Close others
        document.querySelectorAll('[id^="faq-ans-"]').forEach(el => el.style.maxHeight = '0px');
        document.querySelectorAll('[id^="faq-icon-"]').forEach(el => el.style.transform = '');

        if (!isOpen) {
            ans.style.maxHeight = ans.scrollHeight + 'px';
            icon.style.transform = 'rotate(45deg)';
        }
    }

    /* ============================================================
       ChatDeck Staggered Scroll Fade-Up Observer
    ============================================================ */
    document.addEventListener('DOMContentLoaded', () => {
        const sections = document.querySelectorAll('section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });

        sections.forEach((sec, idx) => {
            if (idx === 0) {
                // Hero renders immediately with smooth CSS fade
                sec.style.opacity = '1';
                sec.style.transform = 'translateY(0)';
            } else {
                sec.style.opacity = '0';
                sec.style.transform = 'translateY(24px)';
                sec.style.transition = 'opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                observer.observe(sec);
            }
        });
    });
</script>
@endpush
