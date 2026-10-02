<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Edify Admin</title>
    <meta name="description" content="@yield('meta_description', 'Panel administrasi Edify')">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    {{-- Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <style>
        /* =====================================================
           DESIGN TOKENS  (mirroring AdminCN globals.css)
        ===================================================== */
        :root {
            /* Layout */
            --sidebar-width:           240px;
            --sidebar-icon-width:       56px;
            --header-height:            56px;

            /* AdminCN Light Palette */
            --background:              oklch(1 0 0);
            --foreground:              oklch(0.145 0 0);
            --card:                    oklch(1 0 0);
            --card-foreground:         oklch(0.145 0 0);
            --primary:                 oklch(0.205 0 0);
            --primary-foreground:      oklch(0.985 0 0);
            --secondary:               oklch(0.97 0 0);
            --secondary-foreground:    oklch(0.205 0 0);
            --muted:                   oklch(0.97 0 0);
            --muted-foreground:        oklch(0.556 0 0);
            --accent:                  oklch(0.97 0 0);
            --accent-foreground:       oklch(0.205 0 0);
            --destructive:             oklch(0.577 0.245 27.325);
            --border:                  oklch(0.922 0 0);
            --input:                   oklch(0.922 0 0);
            --ring:                    oklch(0.708 0 0);
            --radius:                  0.625rem;

            /* Sidebar */
            --sidebar:                 oklch(0.985 0 0);
            --sidebar-foreground:      oklch(0.145 0 0);
            --sidebar-primary:         oklch(0.205 0 0);
            --sidebar-primary-fg:      oklch(0.985 0 0);
            --sidebar-accent:          oklch(0.97 0 0);
            --sidebar-accent-fg:       oklch(0.205 0 0);
            --sidebar-border:          oklch(0.922 0 0);
            --sidebar-ring:            oklch(0.708 0 0);

            /* Accent colour — indigo like AdminCN with dark sidebar */
            --color-accent-primary:    #6366f1;
            --color-accent-light:      rgba(99,102,241,0.08);

            --transition: 0.22s cubic-bezier(0.22, 1, 0.36, 1);
        }

        [data-theme="dark"] {
            --background:              oklch(0.145 0 0);
            --foreground:              oklch(0.985 0 0);
            --card:                    oklch(0.205 0 0);
            --card-foreground:         oklch(0.985 0 0);
            --primary:                 oklch(0.922 0 0);
            --primary-foreground:      oklch(0.205 0 0);
            --secondary:               oklch(0.269 0 0);
            --secondary-foreground:    oklch(0.985 0 0);
            --muted:                   oklch(0.269 0 0);
            --muted-foreground:        oklch(0.708 0 0);
            --accent:                  oklch(0.269 0 0);
            --accent-foreground:       oklch(0.985 0 0);
            --destructive:             oklch(0.704 0.191 22.216);
            --border:                  oklch(1 0 0 / 10%);
            --input:                   oklch(1 0 0 / 15%);
            --ring:                    oklch(0.556 0 0);
            --sidebar:                 oklch(0.205 0 0);
            --sidebar-foreground:      oklch(0.985 0 0);
            --sidebar-primary:         oklch(0.488 0.243 264.376);
            --sidebar-primary-fg:      oklch(0.985 0 0);
            --sidebar-accent:          oklch(0.269 0 0);
            --sidebar-accent-fg:       oklch(0.985 0 0);
            --sidebar-border:          oklch(1 0 0 / 10%);
        }

        /* =====================================================
           RESET
        ===================================================== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--background);
            color: var(--foreground);
            -webkit-font-smoothing: antialiased;
        }

        /* =====================================================
           APP SHELL
        ===================================================== */
        .admin-shell {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* =====================================================
           SIDEBAR  (AdminCN collapsible icon style)
        ===================================================== */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar);
            border-right: 1px solid var(--sidebar-border);
            color: var(--sidebar-foreground);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            height: 100vh;
            overflow: hidden;
            transition: width var(--transition);
            position: fixed;
            top: 0; left: 0;
            z-index: 50;
        }
        .sidebar.collapsed {
            width: var(--sidebar-icon-width);
        }

        /* --- Header / Logo --- */
        .sidebar-header {
            padding: 0 0.875rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--sidebar-border);
            min-height: var(--header-height);
            height: var(--header-height);
            flex-shrink: 0;
            overflow: hidden;
        }
        .sidebar-logo-btn {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--sidebar-foreground);
            border-radius: var(--radius);
            padding: 0.35rem 0.5rem;
            min-width: 0;
            transition: background var(--transition);
            width: 100%;
        }
        .sidebar-logo-btn:hover { background: var(--sidebar-accent); }

        .sidebar-logo-full {
            display: flex;
            align-items: center;
        }
        .sidebar-logo-full img {
            height: 38px;
            width: auto;
            object-fit: contain;
            display: block;
        }
        .sidebar-logo-compact {
            display: none;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .sidebar-logo-compact img {
            width: 32px;
            height: 32px;
            object-fit: contain;
            display: block;
        }

        .sidebar.collapsed .sidebar-header {
            padding: 0 0.5rem;
            justify-content: center;
        }
        .sidebar.collapsed .sidebar-logo-btn {
            justify-content: center;
            padding: 0.35rem 0;
        }
        .sidebar.collapsed .sidebar-logo-full {
            display: none !important;
        }
        .sidebar.collapsed .sidebar-logo-compact {
            display: flex !important;
        }

        .logo-dark { display: none !important; }
        .logo-light { display: block !important; }
        [data-theme="dark"] .logo-light { display: none !important; }
        [data-theme="dark"] .logo-dark { display: block !important; }

        /* --- Nav Content --- */
        .sidebar-content {
            flex: 1;
            padding: 0.5rem 0;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: var(--sidebar-border) transparent;
        }
        .sidebar-content::-webkit-scrollbar { width: 4px; }
        .sidebar-content::-webkit-scrollbar-thumb { background: var(--sidebar-border); border-radius: 2px; }

        /* Nav Group */
        .nav-group { margin-bottom: 0.125rem; }

        .nav-group-label {
            font-size: 0.6875rem;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--muted-foreground);
            padding: 0.625rem 0.875rem 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity var(--transition), height var(--transition);
            height: 2rem;
        }
        .sidebar.collapsed .nav-group-label {
            opacity: 0;
            height: 0;
            padding: 0;
        }

        /* Nav Item */
        .nav-item { list-style: none; position: relative; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.5rem 0.75rem;
            margin: 0 0.375rem;
            border-radius: var(--radius);
            color: var(--sidebar-foreground);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background var(--transition), color var(--transition);
            white-space: nowrap;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            user-select: none;
        }
        .nav-link:hover  { background: var(--sidebar-accent); color: var(--sidebar-accent-fg); }
        .nav-link.active { background: var(--color-accent-light); color: var(--color-accent-primary); }
        .sidebar.collapsed .nav-link { justify-content: center; padding: 0.5rem; margin: 0 0.375rem; }

        .nav-icon { flex-shrink: 0; width: 18px; height: 18px; }

        .nav-label-text {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: opacity var(--transition), max-width var(--transition);
            max-width: 200px;
        }
        .sidebar.collapsed .nav-label-text { opacity: 0; max-width: 0; }

        /* Chevron */
        .nav-chevron {
            width: 14px; height: 14px;
            transition: transform var(--transition), opacity var(--transition);
            flex-shrink: 0;
            color: var(--muted-foreground);
        }
        .nav-link.submenu-open .nav-chevron { transform: rotate(90deg); }
        .sidebar.collapsed .nav-chevron { opacity: 0; width: 0; }

        /* Badge */
        .nav-badge {
            font-size: 0.6875rem;
            font-weight: 500;
            background: var(--color-accent-light);
            color: var(--color-accent-primary);
            padding: 0.1rem 0.4rem;
            border-radius: 9999px;
            flex-shrink: 0;
            transition: opacity var(--transition);
        }
        .sidebar.collapsed .nav-badge { opacity: 0; max-width: 0; overflow: hidden; }

        /* Sub-menu */
        .nav-sub {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .nav-sub.open { max-height: 600px; }
        .sidebar.collapsed .nav-sub { display: none; }

        .nav-sub-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.75rem 0.4rem 2.75rem;
            margin: 0 0.375rem;
            border-radius: calc(var(--radius) - 2px);
            color: var(--muted-foreground);
            text-decoration: none;
            font-size: 0.8125rem;
            font-weight: 400;
            transition: background var(--transition), color var(--transition);
        }
        .nav-sub-link:hover  { background: var(--sidebar-accent); color: var(--sidebar-accent-fg); }
        .nav-sub-link.active { background: var(--color-accent-light); color: var(--color-accent-primary); font-weight: 500; }

        /* Tooltip (shown only when sidebar is collapsed) */
        .nav-item .nav-tooltip {
            position: absolute;
            left: calc(var(--sidebar-icon-width) + 8px);
            top: 50%;
            transform: translateY(-50%);
            background: var(--foreground);
            color: var(--background);
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.35rem 0.7rem;
            border-radius: calc(var(--radius) - 2px);
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.15s;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .sidebar.collapsed .nav-item:hover .nav-tooltip { opacity: 1; }
        .nav-tooltip::before {
            content: '';
            position: absolute;
            left: -4px;
            top: 50%;
            transform: translateY(-50%);
            border: 4px solid transparent;
            border-right-color: var(--foreground);
            border-left: 0;
        }

        /* --- Sidebar Footer (user info) --- */
        .sidebar-footer {
            border-top: 1px solid var(--sidebar-border);
            padding: 0.75rem;
            flex-shrink: 0;
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.4rem 0.5rem;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background var(--transition);
            text-decoration: none;
            color: var(--sidebar-foreground);
            overflow: hidden;
        }
        .sidebar-user:hover { background: var(--sidebar-accent); }
        .sidebar.collapsed .sidebar-user { justify-content: center; }

        .user-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: var(--color-accent-primary);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .user-info {
            overflow: hidden;
            min-width: 0;
            transition: opacity var(--transition), max-width var(--transition);
            max-width: 200px;
        }
        .user-info strong { display: block; font-size: 0.8125rem; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-info small  { display: block; font-size: 0.75rem; color: var(--muted-foreground); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar.collapsed .user-info { opacity: 0; max-width: 0; }

        /* =====================================================
           MAIN WRAPPER
        ===================================================== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left var(--transition);
            overflow: hidden;
        }
        .main-wrapper.sidebar-collapsed {
            margin-left: var(--sidebar-icon-width);
        }

        /* =====================================================
           HEADER (AdminCN exact 1:1)
        ===================================================== */
        .admin-header {
            height: var(--header-height);
            background: var(--card);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 50;
            flex-shrink: 0;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-trigger-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius);
            color: var(--muted-foreground);
            transition: background var(--transition), color var(--transition);
        }
        .sidebar-trigger-btn:hover {
            background: var(--accent);
            color: var(--accent-foreground);
        }
        .sidebar-trigger-btn svg { width: 18px; height: 18px; }

        .header-sep {
            width: 1px;
            height: 16px;
            background: var(--border);
            flex-shrink: 0;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8125rem;
            color: var(--muted-foreground);
        }
        .breadcrumb a {
            color: var(--muted-foreground);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: color 0.15s;
        }
        .breadcrumb a:hover { color: var(--foreground); }
        .breadcrumb .sep { opacity: 0.45; font-size: 0.75rem; }
        .breadcrumb .current { color: var(--foreground); font-weight: 600; }

        .header-right {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        /* Web Preview Quick Button */
        .admin-web-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.85rem;
            font-size: 0.8125rem;
            font-weight: 500;
            border-radius: 9999px;
            border: 1px solid var(--border);
            background: var(--background);
            color: var(--muted-foreground);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .admin-web-btn:hover {
            background: var(--accent);
            color: var(--accent-foreground);
            border-color: var(--accent);
        }
        .admin-web-btn svg { width: 14px; height: 14px; }

        .icon-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius);
            color: var(--muted-foreground);
            transition: background var(--transition), color var(--transition);
            position: relative;
        }
        .icon-btn:hover { background: var(--accent); color: var(--accent-foreground); }
        .icon-btn svg, .icon-btn i { width: 18px; height: 18px; }

        /* Notif badge */
        .notif-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 7px;
            height: 7px;
            background: var(--destructive);
            border-radius: 50%;
            border: 2px solid var(--card);
        }

        /* Mode toggle */
        .mode-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border: none;
            background: transparent;
            border-radius: var(--radius);
            cursor: pointer;
            color: var(--muted-foreground);
            transition: background var(--transition), color var(--transition);
            position: relative;
            overflow: hidden;
        }
        .mode-toggle:hover { background: var(--accent); color: var(--accent-foreground); }
        .mode-toggle-sun, .mode-toggle-moon {
            position: absolute;
            width: 18px;
            height: 18px;
            transition: opacity 0.2s, transform 0.3s;
        }
        .mode-toggle-sun  { opacity: 1; transform: rotate(0deg); }
        .mode-toggle-moon { opacity: 0; transform: rotate(-90deg); }
        [data-theme="dark"] .mode-toggle-sun  { opacity: 0; transform: rotate(90deg); }
        [data-theme="dark"] .mode-toggle-moon { opacity: 1; transform: rotate(0deg); }

        /* Profile Dropdown (AdminCN 1:1) */
        .profile-dropdown-wrap {
            position: relative;
        }
        .profile-trigger-btn {
            position: relative;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 2px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.15s;
        }
        .profile-trigger-btn:hover {
            transform: scale(1.05);
        }
        .avatar-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #ffffff;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.25);
        }
        .avatar-status-dot {
            position: absolute;
            right: 1px;
            bottom: 1px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #16a34a;
            box-shadow: 0 0 0 2px var(--card);
        }

        .profile-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 260px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            box-shadow: 0 16px 36px -8px rgba(0,0,0,0.18), 0 0 0 1px rgba(0,0,0,0.04);
            padding: 0.4rem;
            z-index: 100;
            display: none;
            flex-direction: column;
            gap: 2px;
            animation: dropdownFadeIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .profile-menu.open {
            display: flex;
        }
        @keyframes dropdownFadeIn {
            from { opacity: 0; transform: translateY(-6px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .profile-menu-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0.65rem;
        }
        .profile-menu-avatar-wrap {
            position: relative;
            flex-shrink: 0;
        }
        .avatar-circle-lg {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .avatar-status-dot-lg {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #16a34a;
            box-shadow: 0 0 0 2px var(--card);
        }
        .profile-menu-user {
            flex: 1;
            min-width: 0;
        }
        .profile-menu-name {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--foreground);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .profile-menu-email {
            font-size: 0.75rem;
            color: var(--muted-foreground);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 1px;
        }
        .profile-menu-role {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--color-accent-primary);
            background: var(--color-accent-light);
            padding: 0.1rem 0.45rem;
            border-radius: 9999px;
            margin-top: 4px;
        }

        .profile-menu-divider {
            height: 1px;
            background: var(--border);
            margin: 0.35rem 0;
        }

        .profile-menu-item {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--foreground);
            text-decoration: none;
            border-radius: calc(var(--radius) - 2px);
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }
        .profile-menu-item:hover {
            background: var(--accent);
            color: var(--accent-foreground);
        }
        .profile-menu-item svg {
            width: 16px;
            height: 16px;
            color: var(--muted-foreground);
            flex-shrink: 0;
        }
        .profile-menu-item:hover svg {
            color: var(--accent-foreground);
        }
        .profile-menu-item-danger {
            color: var(--destructive) !important;
        }
        .profile-menu-item-danger svg {
            color: var(--destructive) !important;
        }
        .profile-menu-item-danger:hover {
            background: rgba(239, 68, 68, 0.1) !important;
        }

        /* =====================================================
           SCROLL TO TOP
        ===================================================== */
        .scroll-to-top {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            width: 36px; height: 36px;
            background: var(--foreground);
            color: var(--background);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.25s, transform 0.25s;
            z-index: 60;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .scroll-to-top.visible { opacity: 1; transform: translateY(0); }
        .scroll-to-top:hover { opacity: 0.85; }
        .scroll-to-top svg { width: 16px; height: 16px; }

        /* =====================================================
           PAGE CONTENT
        ===================================================== */
        .page-content {
            flex: 1;
            padding: 1.5rem;
            overflow-y: auto;
            max-width: 90rem;
            width: 100%;
            margin: 0 auto;
        }

        .page-title-section { margin-bottom: 1.5rem; }
        .page-title   { font-size: 1.375rem; font-weight: 700; }
        .page-subtitle { font-size: 0.85rem; color: var(--muted-foreground); margin-top: 0.2rem; }

        /* =====================================================
           ADMIN FOOTER
        ===================================================== */
        .admin-footer {
            border-top: 1px solid var(--border);
            padding: 0.625rem 1.25rem;
            font-size: 0.75rem;
            color: var(--muted-foreground);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
            background: var(--card);
            flex-shrink: 0;
        }
        .admin-footer a { color: var(--color-accent-primary); text-decoration: none; }
        .admin-footer a:hover { text-decoration: underline; }
        .footer-links { display: flex; gap: 1rem; }

        /* =====================================================
           CARD / STATS GRID (reusable page helpers)
        ===================================================== */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
        }
        .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
        .card-title  { font-size: 0.9rem; font-weight: 600; }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            display: flex; align-items: flex-start; justify-content: space-between;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.06); transform: translateY(-1px); }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .stat-icon svg { width: 22px; height: 22px; color: #fff; }
        .stat-value  { font-size: 1.5rem; font-weight: 700; }
        .stat-label  { font-size: 0.78rem; color: var(--muted-foreground); margin-top: 0.15rem; }
        .stat-change { font-size: 0.78rem; margin-top: 0.25rem; }
        .stat-change.up   { color: #10b981; }
        .stat-change.down { color: var(--destructive); }

        /* =====================================================
           MOBILE
        ===================================================== */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 49;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.active { display: block; }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform var(--transition), width var(--transition);
                width: var(--sidebar-width) !important;
            }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-wrapper { margin-left: 0 !important; }
            .breadcrumb { display: none; }
        }

        /* =====================================================
           ENTER ANIMATIONS (AdminCN heartbeat, fade-in)
        ===================================================== */
        @keyframes heartbeat {
            0%   { box-shadow: 0 0 0 0 rgba(99,102,241,0.4); transform: scale(1); }
            50%  { box-shadow: 0 0 0 6px transparent; transform: scale(1.03); }
            100% { box-shadow: 0 0 0 0 transparent; transform: scale(1); }
        }
        .animate-heartbeat { animation: heartbeat 2s infinite ease-in-out; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.35s ease both; }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-16px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .slide-in-left { animation: slideInLeft 0.3s ease both; }
    </style>

    @stack('styles')
</head>
<body>

{{-- Mobile sidebar overlay --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobileSidebar()"></div>

{{-- Scroll to top --}}
<button class="scroll-to-top" id="scrollToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Scroll to top">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
</button>

<div class="admin-shell">

    {{-- ====================================================
         SIDEBAR  (AdminCN style)
    ==================================================== --}}
    <aside class="sidebar slide-in-left" id="adminSidebar" role="navigation" aria-label="Navigasi Admin">

        {{-- Header / Logo (Image only, no separate text or Admin Panel) --}}
        <div class="sidebar-header">
            <a href="{{ route('home') }}" class="sidebar-logo-btn" aria-label="Edify" title="Kunjungi Website Edify">
                <div class="sidebar-logo-full">
                    <img src="{{ asset('images/logo.png') }}" class="logo-light" alt="Edify">
                    <img src="{{ asset('images/logo-dark.png') }}" class="logo-dark" alt="Edify">
                </div>
                <div class="sidebar-logo-compact">
                    <img src="{{ asset('images/logo-icon.png') }}" class="logo-light" alt="Edify">
                    <img src="{{ asset('images/logo-icon-dark.png') }}" class="logo-dark" alt="Edify">
                </div>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-content" aria-label="Menu utama">

            {{-- ---- MAIN ---- --}}
            <ul class="nav-group" role="list">
                <li class="nav-group-label">Main</li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       aria-current="{{ request()->routeIs('admin.dashboard') ? 'page' : 'false' }}">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                        <span class="nav-label-text">Dashboard</span>
                    </a>
                    <div class="nav-tooltip">Dashboard</div>
                </li>
            </ul>

            {{-- ---- MANAJEMEN ---- --}}
            <ul class="nav-group" role="list">
                <li class="nav-group-label">Manajemen</li>

                {{-- Kursus --}}
                <li class="nav-item">
                    <div class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active submenu-open' : '' }}"
                         role="button" tabindex="0"
                         id="trigger-courses"
                         onclick="toggleSubMenu('sub-courses','trigger-courses')"
                         onkeydown="if(event.key==='Enter'||event.key===' ')toggleSubMenu('sub-courses','trigger-courses')">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        <span class="nav-label-text">Kursus</span>
                        <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </div>
                    <ul class="nav-sub {{ request()->routeIs('admin.courses.*') ? 'open' : '' }}" id="sub-courses" role="list">
                        <li><a href="{{ route('admin.courses.index') }}" class="nav-sub-link {{ request()->routeIs('admin.courses.index') ? 'active' : '' }}">Semua Kursus</a></li>
                        <li><a href="{{ route('admin.courses.create') }}" class="nav-sub-link {{ request()->routeIs('admin.courses.create') ? 'active' : '' }}">Tambah Kursus</a></li>
                    </ul>
                    <div class="nav-tooltip">Kursus</div>
                </li>

                {{-- Pengguna --}}
                <li class="nav-item">
                    <div class="nav-link {{ request()->routeIs('admin.users.*') ? 'active submenu-open' : '' }}"
                         role="button" tabindex="0"
                         id="trigger-users"
                         onclick="toggleSubMenu('sub-users','trigger-users')"
                         onkeydown="if(event.key==='Enter'||event.key===' ')toggleSubMenu('sub-users','trigger-users')">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <span class="nav-label-text">Pengguna</span>
                        <svg class="nav-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </div>
                    <ul class="nav-sub {{ request()->routeIs('admin.users.*') ? 'open' : '' }}" id="sub-users" role="list">
                        <li><a href="{{ route('admin.users.index') }}" class="nav-sub-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">Daftar Pengguna</a></li>
                        <li><a href="{{ route('admin.users.create') }}" class="nav-sub-link {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">Tambah Pengguna</a></li>
                    </ul>
                    <div class="nav-tooltip">Pengguna</div>
                </li>

                {{-- Transaksi --}}
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}"
                       class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        <span class="nav-label-text">Transaksi</span>
                    </a>
                    <div class="nav-tooltip">Transaksi</div>
                </li>
            </ul>

            {{-- ---- WEBSITE PUBLIK ---- --}}
            <ul class="nav-group" role="list">
                <li class="nav-group-label">Website Publik</li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" target="_blank" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        <span class="nav-label-text">Halaman Depan</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;margin-left:auto;opacity:0.5;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </a>
                    <div class="nav-tooltip">Halaman Depan</div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.courses.index') }}" target="_blank" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        <span class="nav-label-text">Katalog Kursus</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;margin-left:auto;opacity:0.5;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    </a>
                    <div class="nav-tooltip">Katalog Kursus</div>
                </li>
            </ul>

            {{-- ---- PENGATURAN ---- --}}
            <ul class="nav-group" role="list">
                <li class="nav-group-label">Pengaturan</li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.profile') }}"
                       class="nav-link {{ request()->routeIs('admin.settings.profile') ? 'active' : '' }}">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span class="nav-label-text">Profil Admin</span>
                    </a>
                    <div class="nav-tooltip">Profil</div>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" style="margin:0">
                        @csrf
                        <button type="submit" class="nav-link" style="width:100%; border:none; background:none; text-align:left; font-family:inherit; font-size:0.875rem;">
                            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            <span class="nav-label-text">Keluar</span>
                        </button>
                    </form>
                    <div class="nav-tooltip">Keluar</div>
                </li>
            </ul>

        </nav>

        {{-- Sidebar Footer: user info --}}
        <div class="sidebar-footer">
            <a href="{{ route('admin.settings.profile') }}" class="sidebar-user">
                <div class="user-avatar" aria-hidden="true">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="user-info">
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                    <small>{{ auth()->user()->email ?? '' }}</small>
                </div>
            </a>
        </div>

    </aside>
    {{-- /sidebar --}}

    {{-- ====================================================
         MAIN WRAPPER
    ==================================================== --}}
    <div class="main-wrapper" id="mainWrapper">

        {{-- Header (AdminCN 1:1) --}}
        <header class="admin-header" role="banner">
            <div class="header-left">
                {{-- Sidebar Trigger (AdminCN panel-left icon) --}}
                <button class="sidebar-trigger-btn" id="sidebarToggleBtn" onclick="toggleSidebar()" aria-label="Toggle sidebar" title="Perluas / Ciutkan Menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                        <path d="M9 3v18"></path>
                    </svg>
                </button>

                <div class="header-sep" aria-hidden="true"></div>

                {{-- Breadcrumb (AdminCN breadcrumb navigation) --}}
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;opacity:0.75;"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span>Home</span>
                    </a>
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @else
                        <span class="sep">/</span>
                        <span class="current">Dashboard</span>
                    @endif
                </nav>
            </div>

            <div class="header-right">
                {{-- Quick Link to Website (AdminCN) --}}
                <a href="{{ url('/') }}" target="_blank" class="admin-web-btn" title="Buka website publik di tab baru">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                    <span>Lihat Web</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px;opacity:0.6;">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>

                {{-- Dark / Light Mode Toggle --}}
                <button class="mode-toggle" id="themeToggleBtn" onclick="toggleTheme()" aria-label="Toggle dark mode" title="Ganti Tema Gelap / Terang">
                    <svg class="mode-toggle-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                    <svg class="mode-toggle-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </button>

                {{-- Notifications Bell --}}
                <button class="icon-btn" aria-label="Notifikasi" title="Notifikasi Sistem">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    <span class="notif-dot" aria-hidden="true"></span>
                </button>

                {{-- Profile Dropdown (AdminCN 1:1) --}}
                <div class="profile-dropdown-wrap" id="adminProfileWrap">
                    <button class="profile-trigger-btn" id="adminProfileTrigger" onclick="toggleAdminProfileMenu(event)" aria-expanded="false" aria-haspopup="true" aria-label="Menu Akun Administrator">
                        <div class="avatar-circle">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <span class="avatar-status-dot" aria-hidden="true" title="Status: Online"></span>
                    </button>

                    <div class="profile-menu" id="adminProfileMenu" role="menu">
                        <div class="profile-menu-header">
                            <div class="profile-menu-avatar-wrap">
                                <div class="avatar-circle-lg">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                </div>
                                <span class="avatar-status-dot-lg" aria-hidden="true"></span>
                            </div>
                            <div class="profile-menu-user">
                                <div class="profile-menu-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
                                <div class="profile-menu-email">{{ auth()->user()->email ?? 'admin@edify.app' }}</div>
                                <span class="profile-menu-role">Administrator</span>
                            </div>
                        </div>

                        <div class="profile-menu-divider"></div>

                        <a href="{{ route('admin.settings.profile') }}" class="profile-menu-item" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span>Profil & Akun</span>
                        </a>

                        <a href="{{ route('admin.courses.index') }}" class="profile-menu-item" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            <span>Kelola Kursus</span>
                        </a>

                        <a href="{{ route('admin.users.index') }}" class="profile-menu-item" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span>Daftar Pengguna</span>
                        </a>

                        <a href="{{ route('admin.orders.index') }}" class="profile-menu-item" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                            <span>Riwayat Transaksi</span>
                        </a>

                        <div class="profile-menu-divider"></div>

                        <a href="{{ url('/') }}" target="_blank" class="profile-menu-item" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                            <span>Kunjungi Landing Page</span>
                        </a>

                        <div class="profile-menu-divider"></div>

                        <form method="POST" action="{{ route('logout') }}" style="margin:0; padding:0;">
                            @csrf
                            <button type="submit" class="profile-menu-item profile-menu-item-danger" role="menuitem">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                <span>Keluar (Log Out)</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="page-content fade-in-up" id="pageContent" role="main">
            @yield('content')
        </main>

        {{-- Admin Footer --}}
        <footer class="admin-footer" role="contentinfo">
            <p>© {{ date('Y') }} <a href="{{ url('/') }}">Edify</a>. Hak cipta dilindungi.</p>
            <div class="footer-links">
                <a href="#">Lisensi</a>
                <a href="#">Dokumentasi</a>
                <a href="#">Dukungan</a>
            </div>
        </footer>

    </div>{{-- /.main-wrapper --}}

</div>{{-- /.admin-shell --}}

{{-- Lucide Icons --}}
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>

<script>
/* ============================================================
   SIDEBAR TOGGLE  (AdminCN collapsible icon style)
============================================================ */
const sidebar  = document.getElementById('adminSidebar');
const wrapper  = document.getElementById('mainWrapper');
const overlay  = document.getElementById('sidebarOverlay');
let collapsed  = localStorage.getItem('rb-sidebar-collapsed') === 'true';

function applyCollapsed() {
    sidebar.classList.toggle('collapsed', collapsed);
    wrapper.classList.toggle('sidebar-collapsed', collapsed);
}

function toggleSidebar() {
    const isMobile = window.innerWidth <= 768;
    if (isMobile) {
        sidebar.classList.toggle('mobile-open');
        overlay.classList.toggle('active');
    } else {
        collapsed = !collapsed;
        applyCollapsed();
        localStorage.setItem('rb-sidebar-collapsed', collapsed);
    }
}

function closeMobileSidebar() {
    sidebar.classList.remove('mobile-open');
    overlay.classList.remove('active');
}

// Restore state on load
if (window.innerWidth > 768) applyCollapsed();

// Close mobile sidebar on resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
        applyCollapsed();
    }
});

/* ============================================================
   SUBMENU ACCORDION
============================================================ */
function toggleSubMenu(subId, triggerId) {
    const sub     = document.getElementById(subId);
    const trigger = document.getElementById(triggerId);
    if (!sub || !trigger) return;

    const isOpen = sub.classList.contains('open');

    // Close all open sub-menus first
    document.querySelectorAll('.nav-sub.open').forEach(el => el.classList.remove('open'));
    document.querySelectorAll('.nav-link.submenu-open').forEach(el => el.classList.remove('submenu-open'));

    // Open the clicked one if it was closed
    if (!isOpen) {
        sub.classList.add('open');
        trigger.classList.add('submenu-open');
    }
}

/* ============================================================
   DARK / LIGHT MODE  (AdminCN style)
============================================================ */
function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
}

function toggleTheme() {
    const current = document.documentElement.getAttribute('data-theme') || 'light';
    const next    = current === 'dark' ? 'light' : 'dark';
    applyTheme(next);
    localStorage.setItem('rb-theme', next);
}

applyTheme(localStorage.getItem('rb-theme') || 'light');

/* ============================================================
   SCROLL TO TOP
============================================================ */
const scrollBtn = document.getElementById('scrollToTop');
const pageContent = document.getElementById('pageContent');

pageContent.addEventListener('scroll', () => {
    scrollBtn.classList.toggle('visible', pageContent.scrollTop > 300);
});

scrollBtn.onclick = () => pageContent.scrollTo({ top: 0, behavior: 'smooth' });

/* ============================================================
   PROFILE DROPDOWN  (AdminCN 1:1)
============================================================ */
function toggleAdminProfileMenu(event) {
    if (event) event.stopPropagation();
    const menu = document.getElementById('adminProfileMenu');
    const trigger = document.getElementById('adminProfileTrigger');
    if (!menu) return;
    const isOpen = menu.classList.contains('open');
    menu.classList.toggle('open', !isOpen);
    if (trigger) trigger.setAttribute('aria-expanded', !isOpen);
}

// Close profile dropdown when clicking outside
document.addEventListener('click', (e) => {
    const wrap = document.getElementById('adminProfileWrap');
    const menu = document.getElementById('adminProfileMenu');
    const trigger = document.getElementById('adminProfileTrigger');
    if (menu && menu.classList.contains('open') && wrap && !wrap.contains(e.target)) {
        menu.classList.remove('open');
        if (trigger) trigger.setAttribute('aria-expanded', 'false');
    }
});

// Close with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const menu = document.getElementById('adminProfileMenu');
        const trigger = document.getElementById('adminProfileTrigger');
        if (menu && menu.classList.contains('open')) {
            menu.classList.remove('open');
            if (trigger) trigger.setAttribute('aria-expanded', 'false');
        }
    }
});

/* ============================================================
   PAGE FADE-IN  (card items stagger)
============================================================ */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.stat-card, .card').forEach((el, i) => {
        el.style.animationDelay = `${i * 0.06}s`;
        el.classList.add('fade-in-up');
    });
});
</script>

@stack('scripts')
</body>
</html>
