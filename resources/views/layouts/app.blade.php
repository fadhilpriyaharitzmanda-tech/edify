<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Edify') — Platform Belajar Online & Upskilling</title>
    <meta name="description" content="@yield('meta_description', 'Edify — Platform pembelajaran online terbaik untuk mengembangkan skill dan karier Anda.')">

    {{-- Canonical & Favicon --}}
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <style>
        /* ===========================
           Design Tokens (ChatDeck style)
        =========================== */
        :root {
            --color-primary:       #6366f1;
            --color-primary-dark:  #4f46e5;
            --color-accent:        #a5b4fc;
            --color-bg:            #ffffff;
            --color-bg-dark:       #09090b;
            --color-text:          #111827;
            --color-text-muted:    #6b7280;
            --color-border:        #e5e7eb;
            --color-border-dark:   #27272a;
            --navbar-height:       64px;
            --radius:              0.75rem;
            --transition:          0.25s cubic-bezier(0.22,1,0.36,1);
        }

        [data-theme="dark"] {
            --color-bg:         var(--color-bg-dark);
            --color-text:       #f9fafb;
            --color-text-muted: #9ca3af;
            --color-border:     var(--color-border-dark);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--color-bg);
            color: var(--color-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background var(--transition), color var(--transition);
        }

        /* ===========================
           Navbar (ChatDeck style with Smooth Shrink on Scroll)
        =========================== */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 50;
            padding: 0.5rem 1rem;
            pointer-events: none;
        }

        .navbar-inner {
            position: relative;
            pointer-events: auto;
            max-width: 72rem; /* ChatDeck standard: max-w-6xl (1152px) */
            width: 100%;
            margin: 0 auto;
            padding: 0.65rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 9999px;
            background: transparent;
            border: 1px solid transparent;
            transition: max-width 0.35s cubic-bezier(0.16, 1, 0.3, 1),
                        padding 0.35s cubic-bezier(0.16, 1, 0.3, 1),
                        background 0.3s ease,
                        border-color 0.3s ease,
                        box-shadow 0.3s ease,
                        backdrop-filter 0.3s ease;
        }

        /* Scrolled state: shrinks smoothly to ChatDeck max-w-4xl (56rem / 896px) with pill blur */
        .navbar-inner.scrolled {
            max-width: 56rem; /* ChatDeck standard: max-w-4xl (896px) */
            padding: 0.45rem 1.5rem;
            background: rgba(255, 255, 255, 0.75);
            border-color: var(--color-border);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        [data-theme="dark"] .navbar-inner.scrolled {
            background: rgba(9, 9, 11, 0.8);
            border-color: var(--color-border-dark);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.4), 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* Logo */
        .navbar-brand {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: var(--color-text);
            z-index: 2;
        }
        .navbar-logo-img {
            height: 38px;
            width: auto;
            object-fit: contain;
            display: block;
            transition: transform 0.2s ease;
        }
        .navbar-brand:hover .navbar-logo-img {
            transform: scale(1.03);
        }
        .logo-dark { display: none !important; }
        .logo-light { display: block !important; }
        [data-theme="dark"] .logo-light { display: none !important; }
        [data-theme="dark"] .logo-dark { display: block !important; }

        /* Center Nav Links - Dead-Center on Screen */
        .navbar-links {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
            white-space: nowrap;
            z-index: 1;
        }
        .navbar-links a {
            font-size: 0.9rem;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: color 0.15s;
        }
        .navbar-links a:hover { color: var(--color-text); }

        /* Right Actions */
        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 2;
        }

        /* Theme Toggle */
        .theme-toggle-btn {
            width: 36px; height: 36px;
            border: none; background: transparent; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            color: var(--color-text-muted);
            transition: background var(--transition);
        }
        .theme-toggle-btn:hover { background: var(--color-border); }
        .theme-toggle-btn svg { width: 18px; height: 18px; }

        /* CTA Button */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.4rem 1rem;
            background: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background var(--transition), transform 0.15s;
        }
        .btn-primary:hover { background: var(--color-primary-dark); transform: translateY(-1px); }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.4rem 1rem;
            background: transparent;
            color: var(--color-text);
            border: 1px solid var(--color-border);
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background var(--transition);
        }
        .btn-ghost:hover { background: var(--color-border); }

        /* Mobile menu toggle */
        .mobile-menu-btn {
            display: none;
            border: none; background: transparent; cursor: pointer;
            color: var(--color-text);
            padding: 0.25rem;
        }
        .mobile-menu-btn svg { width: 24px; height: 24px; }

        /* Mobile menu drawer */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: var(--color-bg);
            z-index: 60;
            padding: 1.5rem;
            flex-direction: column;
            gap: 1.5rem;
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu-header { display: flex; align-items: center; justify-content: space-between; }
        .mobile-close-btn {
            border: none; background: transparent; cursor: pointer;
            color: var(--color-text);
        }
        .mobile-menu-links { list-style: none; display: flex; flex-direction: column; gap: 1rem; }
        .mobile-menu-links a { font-size: 1.1rem; color: var(--color-text); text-decoration: none; }
        .mobile-menu-actions { display: flex; flex-direction: column; gap: 0.75rem; }

        @media (max-width: 1024px) {
            .navbar-links { display: none; }
            .navbar-actions .btn-ghost,
            .navbar-actions .btn-primary { display: none; }
            .mobile-menu-btn { display: block; }
        }

        /* ===========================
           Main + Content
        =========================== */
        main {
            flex: 1;
            padding-top: var(--navbar-height);
        }

        /* ===========================
           Footer (ChatDeck Clean Style)
        =========================== */
        .site-footer {
            border-top: 1px solid var(--color-border);
            margin-top: 6rem;
            background: var(--color-bg);
            transition: background var(--transition), border-color var(--transition);
        }
        .footer-inner {
            max-width: 82.5rem;
            margin: 0 auto;
            padding: 4.5rem 2rem 3.5rem;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
        }
        .footer-brand {
            display: flex;
            flex-direction: column;
        }
        .footer-brand p {
            font-size: 0.9rem;
            color: var(--color-text-muted);
            line-height: 1.65;
            margin: 1rem 0 1.5rem;
            max-width: 20rem;
        }
        .footer-social-links {
            display: flex;
            gap: 0.75rem;
        }
        .footer-social-btn {
            width: 34px; height: 34px;
            border-radius: 50%;
            border: 1px solid var(--color-border);
            display: flex; align-items: center; justify-content: center;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .footer-social-btn:hover {
            color: var(--color-primary);
            border-color: var(--color-primary);
            transform: translateY(-2px);
            background: rgba(99,102,241,0.06);
        }
        .footer-col h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 1.25rem;
            letter-spacing: -0.01em;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.75rem; }
        .footer-col a {
            font-size: 0.875rem;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: color 0.15s ease, transform 0.15s ease;
            display: inline-block;
        }
        .footer-col a:hover {
            color: var(--color-text);
            transform: translateX(2px);
        }
        .footer-bottom {
            border-top: 1px solid var(--color-border);
            padding: 1.75rem 2rem;
            font-size: 0.875rem;
            color: var(--color-text-muted);
        }
        .footer-bottom-inner {
            max-width: 82.5rem;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .footer-bottom a { color: var(--color-text); text-decoration: none; font-weight: 500; }
        .footer-bottom a:hover { color: var(--color-primary); text-decoration: underline; }

        @media (max-width: 1024px) {
            .footer-inner {
                grid-template-columns: 1fr 1fr;
                gap: 2.5rem;
            }
            .footer-brand { grid-column: 1 / -1; }
        }
        @media (max-width: 640px) {
            .footer-inner {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .footer-bottom-inner {
                flex-direction: column;
                text-align: center;
            }
        }

        /* ===========================
           Team 4-Column Grid
        =========================== */
        .team-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
        @media (max-width: 1024px) {
            .team-grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 640px) {
            .team-grid-4 {
                grid-template-columns: 1fr;
            }
        }

        /* ===========================
           Testimonial 2-Row Marquee Animations (ChatDeck Style)
        =========================== */
        @keyframes marquee-left {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes marquee-right {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }

        .animate-marquee-left {
            display: flex;
            width: max-content;
            gap: 1.25rem;
            animation: marquee-left 32s linear infinite;
        }
        .animate-marquee-right {
            display: flex;
            width: max-content;
            gap: 1.25rem;
            animation: marquee-right 32s linear infinite;
        }
        .animate-marquee-left:hover,
        .animate-marquee-right:hover {
            animation-play-state: paused;
        }

        .review-card {
            width: 350px;
            flex-shrink: 0;
            padding: 1.25rem 1.5rem;
            border-radius: 1rem;
            border: 1px solid var(--color-border);
            background: var(--color-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
            cursor: default;
        }
        .review-card:hover {
            transform: translateY(-2px);
            border-color: var(--color-primary);
            box-shadow: 0 8px 24px rgba(99,102,241,0.08);
        }

        /* ===========================
           Utility helpers (ChatDeck 82.5rem / ~1320px Spacious Layout)
        =========================== */
        .container {
            width: 100%;
            max-width: 82.5rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .container-md {
            width: 100%;
            max-width: 82.5rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        @media (min-width: 640px) {
            .container, .container-md {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
        @media (min-width: 1024px) {
            .container, .container-md {
                padding-left: 2.5rem;
                padding-right: 2.5rem;
            }
        }
        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }

        /* ===========================
           View Transitions (Circular Expand Theme Toggle - ChatDeck Style)
        =========================== */
        ::view-transition-old(root),
        ::view-transition-new(root) {
            animation: none;
            mix-blend-mode: normal;
        }
        ::view-transition-old(root) {
            z-index: 1;
        }
        ::view-transition-new(root) {
            z-index: 9999;
        }

        /* ===========================
           Course Card Pro (TravelCard Architecture - Proportional & Animated)
        =========================== */
        .course-grid-pro {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 2rem;
        }
        @media (max-width: 768px) {
            .course-grid-pro {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        .course-card-pro {
            position: relative;
            width: 100%;
            height: 460px;
            min-height: 460px;
            overflow: hidden;
            border-radius: 1.25rem;
            border: 1px solid var(--color-border);
            background: #09090b;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.15);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-decoration: none;
            color: #ffffff;
        }
        .course-card-pro:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(99, 102, 241, 0.35);
            border-color: rgba(99, 102, 241, 0.5);
        }

        /* Background Image with Zoom Effect on Hover */
        .course-card-bg-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 0;
        }
        .course-card-pro:hover .course-card-bg-img {
            transform: scale(1.08);
        }

        /* Gradient Overlay for Text Readability */
        .course-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(9, 9, 11, 0.96) 0%, rgba(9, 9, 11, 0.78) 46%, rgba(9, 9, 11, 0.32) 76%, rgba(9, 9, 11, 0.5) 100%);
            z-index: 1;
            pointer-events: none;
        }

        /* Content Container */
        .course-card-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            padding: 1.75rem;
        }

        /* Top Section: Logo Circle */
        .course-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            width: 100%;
        }
        .course-card-logo-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.35);
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease;
        }
        .course-card-pro:hover .course-card-logo-circle {
            transform: scale(1.08) rotate(4deg);
            border-color: rgba(255, 255, 255, 0.75);
            background: rgba(99, 102, 241, 0.25);
        }

        /* Middle Section: Clean Judul & Deskripsi Singkat */
        .course-card-body {
            margin-top: auto;
            margin-bottom: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .course-card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.35;
            letter-spacing: -0.015em;
            transition: color 0.2s ease;
        }
        .course-card-desc {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.74);
            line-height: 1.55;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin: 0;
        }

        /* Bottom Section: Perfectly Aligned Price & CTA */
        .course-card-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding-top: 1.1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }
        .course-price-wrap {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 38px;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .course-price-free-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: #34d399;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            line-height: 1;
            margin-bottom: 2px;
            white-space: nowrap;
        }
        .course-price-free {
            font-size: 1.15rem;
            font-weight: 800;
            color: #34d399;
            line-height: 1.1;
            letter-spacing: -0.01em;
            white-space: nowrap;
        }
        .course-price-orig {
            font-size: 0.68rem;
            color: rgba(255, 255, 255, 0.45);
            text-decoration: line-through;
            line-height: 1;
            margin-bottom: 2px;
            white-space: nowrap;
        }
        .course-price-current {
            display: inline-flex;
            align-items: baseline;
            gap: 0.25rem;
            white-space: nowrap;
        }
        .course-price-val {
            font-size: 1.15rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.1;
            letter-spacing: -0.01em;
            white-space: nowrap;
        }
        .course-price-period {
            font-size: 0.68rem;
            color: rgba(255, 255, 255, 0.6);
            white-space: nowrap;
        }

        .course-book-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.48rem 0.95rem;
            background: #ffffff;
            color: #09090b;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(255, 255, 255, 0.18);
            transition: all 0.25s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .course-book-btn:hover {
            background: #6366f1;
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
            transform: translateY(-2px);
        }
        .course-card-pro:hover .course-book-btn {
            background: #6366f1;
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
        }
        .course-card-pro:hover .course-book-btn i,
        .course-card-pro:hover .course-book-btn svg {
            transform: translateX(3px);
            transition: transform 0.2s ease;
        }

        /* Team Social Media Links */
        .team-social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--color-border);
            background: rgba(99, 102, 241, 0.04);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .team-social-link:hover {
            color: #ffffff !important;
            background: var(--color-primary);
            border-color: var(--color-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
        }
        .team-social-link svg {
            width: 16px;
            height: 16px;
            transition: transform 0.2s ease;
        }
        .team-social-link:hover svg {
            transform: scale(1.1);
        }

        .course-filter-tab {
            padding: 0.55rem 1.25rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 9999px;
            border: 1px solid var(--color-border);
            background: transparent;
            color: var(--color-text-muted);
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .course-filter-tab:hover {
            border-color: var(--color-primary);
            color: var(--color-text);
        }
        .course-filter-tab.active {
            background: var(--color-primary);
            border-color: var(--color-primary);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
        }

        /* ===========================
           ChatDeck Specific Animations & Components
        =========================== */
        @keyframes logo-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-logo-scroll {
            display: flex;
            width: max-content;
            animation: logo-scroll 35s linear infinite;
        }
        .animate-logo-scroll:hover {
            animation-play-state: paused;
        }

        /* Shimmer Button */
        .shimmer-button {
            position: relative;
            z-index: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 9999px;
            border: 1px solid rgba(255,255,255,0.15);
            padding: 0.875rem 2rem;
            white-space: nowrap;
            color: #ffffff;
            background: #09090b;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(99,102,241,0.25);
            transition: transform 0.2s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.2s;
        }
        [data-theme="light"] .shimmer-button {
            background: #111827;
            color: #ffffff;
        }
        .shimmer-button:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 30px rgba(99,102,241,0.4);
        }
        .shimmer-button::before {
            content: '';
            position: absolute;
            inset: -150%;
            background: conic-gradient(from 0deg, transparent 0 340deg, #6366f1 360deg);
            animation: spin-around 4s linear infinite;
            z-index: -2;
        }
        .shimmer-button::after {
            content: '';
            position: absolute;
            inset: 1.5px;
            border-radius: 9999px;
            background: #09090b;
            z-index: -1;
            transition: background 0.2s;
        }
        [data-theme="light"] .shimmer-button::after {
            background: #111827;
        }
        @keyframes spin-around {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Pulse glow */
        @keyframes pulse-glow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.4); }
        }
        .pulse-dot {
            width: 8px; height: 8px; border-radius: 50%; background: #10b981; display: inline-block; position: relative;
        }
        .pulse-dot::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.4);
            animation: pulse-glow 2s ease-in-out infinite;
        }

        /* Pricing Billing Switch */
        .billing-toggle-container {
            display: inline-flex;
            align-items: center;
            background: var(--color-border);
            padding: 0.25rem;
            border-radius: 9999px;
            margin-bottom: 2.5rem;
            gap: 0.25rem;
        }
        .billing-btn {
            border: none;
            background: transparent;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-text-muted);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .billing-btn.active {
            background: var(--color-bg);
            color: var(--color-text);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            font-weight: 600;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- ========================== MOBILE MENU ========================== --}}
    <div class="mobile-menu" id="mobileMenu" role="dialog" aria-modal="true" aria-label="Menu Navigasi">
        <div class="mobile-menu-header">
            <a href="{{ url('/') }}" class="navbar-brand" onclick="closeMobileMenu()" aria-label="Edify">
                <img src="{{ asset('images/logo.png') }}" alt="Edify" class="navbar-logo-img logo-light" style="height: 36px;">
                <img src="{{ asset('images/logo-dark.png') }}" alt="Edify" class="navbar-logo-img logo-dark" style="height: 36px;">
            </a>
            <button class="mobile-close-btn" onclick="closeMobileMenu()" aria-label="Tutup menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <ul class="mobile-menu-links">
            <li><a href="{{ url('/#fitur') }}" onclick="closeMobileMenu()">Fitur</a></li>
            <li><a href="{{ route('user.courses.index') }}" onclick="closeMobileMenu()">Kursus</a></li>
            <li><a href="{{ url('/#tim') }}" onclick="closeMobileMenu()">Tim Kami</a></li>
            <li><a href="{{ url('/#harga') }}" onclick="closeMobileMenu()">Harga</a></li>
            <li><a href="{{ url('/#faq') }}" onclick="closeMobileMenu()">FAQ</a></li>
        </ul>
        <div class="mobile-menu-actions">
            @auth
                <a href="{{ route('user.dashboard') }}" class="btn-ghost">Dashboard Saya</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-ghost" style="justify-content:center;">Masuk</a>
                <a href="{{ route('register') }}" class="btn-primary" style="justify-content:center;">Mulai Gratis</a>
            @endauth
        </div>
    </div>

    {{-- ========================== NAVBAR ========================== --}}
    <nav class="navbar" role="navigation" aria-label="Navigasi Utama">
        <div class="navbar-inner" id="navbarInner">
            {{-- Brand --}}
            <a href="{{ url('/') }}" class="navbar-brand" aria-label="Edify - Beranda">
                <img src="{{ asset('images/logo.png') }}" alt="Edify" class="navbar-logo-img logo-light">
                <img src="{{ asset('images/logo-dark.png') }}" alt="Edify" class="navbar-logo-img logo-dark">
            </a>

            {{-- Desktop Nav Links --}}
            <ul class="navbar-links" role="list">
                <li><a href="{{ url('/#fitur') }}">Fitur</a></li>
                <li><a href="{{ route('user.courses.index') }}">Kursus</a></li>
                <li><a href="{{ url('/#tim') }}">Tim Kami</a></li>
                <li><a href="{{ url('/#harga') }}">Harga</a></li>
                <li><a href="{{ url('/#faq') }}">FAQ</a></li>
            </ul>

            {{-- Actions --}}
            <div class="navbar-actions">
                <button class="theme-toggle-btn" id="userThemeToggle" onclick="toggleUserTheme(event)" aria-label="Toggle tema">
                    <i data-lucide="sun" id="userSunIcon"></i>
                    <i data-lucide="moon" id="userMoonIcon" style="display:none"></i>
                </button>

                @auth
                    <a href="{{ route('user.dashboard') }}" class="btn-ghost">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-primary">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary">Mulai Gratis</a>
                @endauth

                {{-- Mobile toggle --}}
                <button class="mobile-menu-btn" onclick="openMobileMenu()" aria-label="Buka menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
            </div>
        </div>
    </nav>

    {{-- ========================== MAIN CONTENT ========================== --}}
    <main role="main">
        @yield('content')
    </main>

    {{-- ========================== FOOTER ========================== --}}
    <footer class="site-footer" role="contentinfo">
        <div class="footer-inner">
            {{-- Brand --}}
            <div class="footer-brand">
                <a href="{{ url('/') }}" class="navbar-brand" style="margin-bottom: 0.5rem;" aria-label="Edify">
                    <img src="{{ asset('images/logo.png') }}" alt="Edify" class="navbar-logo-img logo-light" style="height: 40px;">
                    <img src="{{ asset('images/logo-dark.png') }}" alt="Edify" class="navbar-logo-img logo-dark" style="height: 40px;">
                </a>
                <p>Platform pembelajaran online dan upskilling teknologi terdepan untuk mengakselerasi karier talenta digital Indonesia.</p>
                
                {{-- Social Icons --}}
                <div class="footer-social-links">
                    <a href="https://twitter.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Twitter">
                        <i data-lucide="twitter" style="width: 16px; height: 16px;"></i>
                    </a>
                    <a href="https://github.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="GitHub">
                        <i data-lucide="github" style="width: 16px; height: 16px;"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Instagram">
                        <i data-lucide="instagram" style="width: 16px; height: 16px;"></i>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="LinkedIn">
                        <i data-lucide="linkedin" style="width: 16px; height: 16px;"></i>
                    </a>
                </div>
            </div>

            {{-- Product --}}
            <div class="footer-col">
                <h4>Produk</h4>
                <ul>
                    <li><a href="{{ route('user.courses.index') }}">Katalog Kursus</a></li>
                    <li><a href="#fitur">Fitur Unggulan</a></li>
                    <li><a href="#harga">Paket Belajar</a></li>
                    <li><a href="#faq">Pusat Bantuan / FAQ</a></li>
                </ul>
            </div>

            {{-- Perusahaan --}}
            <div class="footer-col">
                <h4>Perusahaan</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Tentang Kami</a></li>
                    <li><a href="#tim">Tim & Instruktur</a></li>
                    <li><a href="#testimoni">Kisah Sukses Siswa</a></li>
                    <li><a href="mailto:support@edify.app">Hubungi Support</a></li>
                </ul>
            </div>

            {{-- Legal --}}
            <div class="footer-col">
                <h4>Ketentuan</h4>
                <ul>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Lisensi Sertifikat</a></li>
                    <li><a href="#">Kebijakan Cookie</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                <p>© {{ date('Y') }} <a href="{{ url('/') }}">Edify</a>. Seluruh hak cipta dilindungi undang-undang.</p>
                <p style="font-size: 0.825rem; color: var(--color-text-muted);">
                    Dibuat dengan ❤️ untuk kemajuan pendidikan & teknologi Indonesia
                </p>
            </div>
        </div>
    </footer>

    {{-- Lucide Icons --}}
    <script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons())</script>

    <script>
        /* ============================================================
           Navbar scroll effect (Smooth Shrink on Scroll)
        ============================================================ */
        const navbarInner = document.getElementById('navbarInner');
        const checkScroll = () => {
            if (navbarInner) {
                navbarInner.classList.toggle('scrolled', window.scrollY > 30);
            }
        };
        window.addEventListener('scroll', checkScroll, { passive: true });
        checkScroll();

        /* ============================================================
           Mobile Menu
        ============================================================ */
        function openMobileMenu() {
            document.getElementById('mobileMenu').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeMobileMenu() {
            document.getElementById('mobileMenu').classList.remove('open');
            document.body.style.overflow = '';
        }

        /* ============================================================
           Theme Toggle with Expanding Circle (ChatDeck Style)
        ============================================================ */
        const userSunIcon  = document.getElementById('userSunIcon');
        const userMoonIcon = document.getElementById('userMoonIcon');

        function applyUserTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                if (userSunIcon) userSunIcon.style.display  = 'none';
                if (userMoonIcon) userMoonIcon.style.display = '';
            } else {
                document.documentElement.classList.remove('dark');
                if (userSunIcon) userSunIcon.style.display  = '';
                if (userMoonIcon) userMoonIcon.style.display = 'none';
            }
        }

        let isThemeTransitioning = false;

        async function toggleUserTheme(event) {
            if (isThemeTransitioning) return;

            const current = document.documentElement.getAttribute('data-theme') || 
                            (document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            const next    = current === 'dark' ? 'light' : 'dark';

            // Fallback for browsers that do not support View Transitions
            if (!document.startViewTransition) {
                applyUserTheme(next);
                localStorage.setItem('rb-theme', next);
                return;
            }

            isThemeTransitioning = true;

            const btn = (event && (event.currentTarget || (event.target && event.target.closest('button')))) || document.getElementById('userThemeToggle');
            const rect = btn ? btn.getBoundingClientRect() : { left: window.innerWidth - 45, top: 25, width: 36, height: 36 };
            const x = rect.left + rect.width / 2;
            const y = rect.top + rect.height / 2;
            const maxRadius = Math.hypot(
                Math.max(x, window.innerWidth - x),
                Math.max(y, window.innerHeight - y)
            );

            const transition = document.startViewTransition(() => {
                applyUserTheme(next);
                localStorage.setItem('rb-theme', next);
            });

            try {
                await transition.ready;

                const animation = document.documentElement.animate(
                    {
                        clipPath: [
                            `circle(0px at ${x}px ${y}px)`,
                            `circle(${maxRadius}px at ${x}px ${y}px)`,
                        ],
                    },
                    {
                        duration: 500,
                        easing: "ease-in-out",
                        pseudoElement: "::view-transition-new(root)",
                    }
                );
                await animation.finished;
            } catch (e) {
                // Ignore animation cancellations
            } finally {
                isThemeTransitioning = false;
            }
        }

        applyUserTheme(localStorage.getItem('rb-theme') || 'light');
    </script>

    @stack('scripts')
</body>
</html>
