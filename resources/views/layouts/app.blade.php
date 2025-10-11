<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra Sehat | @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                        'slide-in': 'slideIn 0.3s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        glow: {
                            '0%, 100%': { boxShadow: '0 0 20px rgba(20, 184, 166, 0.5)' },
                            '50%': { boxShadow: '0 0 30px rgba(20, 184, 166, 0.8)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-1000px 0' },
                            '100%': { backgroundPosition: '1000px 0' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        :root {
            --sidebar-width: 280px;
            --header-height: 80px;
            --primary-gradient: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            --secondary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }

        * {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            background: linear-gradient(135deg, #f0fdfa 0%, #ecfeff 50%, #f0f9ff 100%);
            transition: background 0.4s ease;
            overflow-x: hidden;
        }

        .dark body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        }

        /* ===== SIDEBAR ULTRA MODERN ===== */
        .sidebar {
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            background: rgba(255, 255, 255, 0.95);
            border-right: 1px solid rgba(148, 163, 184, 0.12);
            box-shadow: 
                4px 0 32px rgba(0, 0, 0, 0.08),
                inset -1px 0 0 rgba(255, 255, 255, 0.6);
            position: relative;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark .sidebar {
            background: rgba(15, 23, 42, 0.98);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 
                4px 0 32px rgba(0, 0, 0, 0.5),
                inset -1px 0 0 rgba(255, 255, 255, 0.05);
        }

        /* Animated Background Pattern */
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 400px;
            background: radial-gradient(circle at 50% -20%, rgba(20, 184, 166, 0.1) 0%, transparent 70%);
            pointer-events: none;
            animation: float 8s ease-in-out infinite;
        }

        .dark .sidebar::before {
            background: radial-gradient(circle at 50% -20%, rgba(20, 184, 166, 0.2) 0%, transparent 70%);
        }

        /* Logo Section Premium */
        .logo-section {
            background: var(--primary-gradient);
            box-shadow: 
                0 12px 48px rgba(20, 184, 166, 0.35),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
            position: relative;
            overflow: hidden;
        }

        .logo-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent 30%,
                rgba(255, 255, 255, 0.15) 50%,
                transparent 70%
            );
            animation: shimmer 4s infinite;
        }

        .logo-icon {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 
                0 10px 20px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            animation: float 5s ease-in-out infinite;
            transition: all 0.3s ease;
        }

        .logo-icon:hover {
            transform: scale(1.05) rotate(-5deg);
        }

        .logo-text {
            background: linear-gradient(135deg, #ffffff 0%, #d1fae5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 900;
            letter-spacing: -0.03em;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Enhanced Sidebar Links */
        .sidebar-link {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #475569;
            border-radius: 16px;
            overflow: hidden;
        }

        .dark .sidebar-link {
            color: #cbd5e1;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--primary-gradient);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-link::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(20, 184, 166, 0.08) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-link:hover:not(.active-link) {
            background: linear-gradient(90deg, rgba(20, 184, 166, 0.1) 0%, transparent 100%);
            transform: translateX(6px);
            color: #0d9488;
        }

        .dark .sidebar-link:hover:not(.active-link) {
            background: linear-gradient(90deg, rgba(20, 184, 166, 0.18) 0%, transparent 100%);
            color: #5eead4;
        }

        .sidebar-link:hover::before {
            transform: scaleY(1);
        }

        .sidebar-link:hover::after {
            opacity: 1;
        }

        /* Active Link Ultra Premium */
        .active-link {
            background: var(--primary-gradient);
            color: white !important;
            box-shadow: 
                0 10px 24px rgba(20, 184, 166, 0.35),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
            transform: translateX(6px);
        }

        .active-link::before {
            background: rgba(255, 255, 255, 0.6);
            transform: scaleY(1);
        }

        .active-link i {
            animation: float 4s ease-in-out infinite;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        /* Icon Animations */
        .sidebar-link i {
            transition: all 0.3s ease;
            width: 24px;
            text-align: center;
        }

        .sidebar-link:hover i {
            transform: scale(1.15) rotate(-8deg);
        }

        .active-link i {
            transform: scale(1.1);
        }

        /* Ultra Modern Search Bar */
        .sidebar-search {
            background: rgba(255, 255, 255, 0.7);
            border: 2px solid rgba(148, 163, 184, 0.15);
            border-radius: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .dark .sidebar-search {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }

        .sidebar-search:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #14b8a6;
            box-shadow: 
                0 0 0 4px rgba(20, 184, 166, 0.12),
                0 8px 20px rgba(0, 0, 0, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        .dark .sidebar-search:focus {
            background: rgba(30, 41, 59, 0.7);
            box-shadow: 
                0 0 0 4px rgba(20, 184, 166, 0.25),
                0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .sidebar-search:focus + .search-icon {
            color: #14b8a6;
            transform: translateY(-50%) scale(1.15);
        }

        /* Collapsible Section Enhanced */
        .collapsible-header {
            background: rgba(20, 184, 166, 0.04);
            border-radius: 14px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .collapsible-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-gradient);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .collapsible-header:hover {
            background: rgba(20, 184, 166, 0.1);
            transform: translateX(4px);
        }

        .collapsible-header:hover::before {
            transform: scaleY(1);
        }

        .dark .collapsible-header {
            background: rgba(20, 184, 166, 0.08);
        }

        .dark .collapsible-header:hover {
            background: rgba(20, 184, 166, 0.15);
        }

        .collapsible-content {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
        }

        .collapsible-content.open {
            max-height: 1000px;
            opacity: 1;
        }

        /* Category Label Premium */
        .category-label {
            position: relative;
            padding-left: 20px;
        }

        .category-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            background: var(--primary-gradient);
            border-radius: 50%;
            box-shadow: 
                0 0 12px rgba(20, 184, 166, 0.6),
                0 0 0 3px rgba(20, 184, 166, 0.15);
            animation: pulse-slow 3s ease-in-out infinite;
        }

        /* Header Ultra Modern */
        .header-bg {
            backdrop-filter: blur(28px) saturate(180%);
            -webkit-backdrop-filter: blur(28px) saturate(180%);
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(148, 163, 184, 0.12);
            box-shadow: 
                0 4px 24px rgba(0, 0, 0, 0.05),
                inset 0 -1px 0 rgba(255, 255, 255, 0.6);
        }

        .dark .header-bg {
            background: rgba(15, 23, 42, 0.98);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 
                0 4px 24px rgba(0, 0, 0, 0.3),
                inset 0 -1px 0 rgba(255, 255, 255, 0.05);
        }

        /* Header Button Premium */
        .header-btn {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 2px solid rgba(148, 163, 184, 0.15);
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .dark .header-btn {
            background: rgba(30, 41, 59, 0.7);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .header-btn:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-color: #14b8a6;
        }

        .dark .header-btn:hover {
            background: rgba(30, 41, 59, 0.9);
        }

        /* Avatar Ultra Premium */
        .user-avatar {
            background: var(--primary-gradient);
            box-shadow: 
                0 10px 24px rgba(20, 184, 166, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.35);
            position: relative;
            animation: glow 4s ease-in-out infinite;
            transition: all 0.3s ease;
        }

        .user-avatar::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            padding: 2px;
            background: linear-gradient(45deg, #14b8a6, #0d9488, #14b8a6);
            background-size: 200% 200%;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .user-avatar:hover::before {
            opacity: 1;
            animation: rotate 3s linear infinite;
        }

        @keyframes rotate {
            to { transform: rotate(360deg); }
        }

        /* Dropdown Ultra Premium */
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 24px;
            box-shadow: 
                0 24px 48px rgba(0, 0, 0, 0.15),
                0 12px 24px rgba(0, 0, 0, 0.1);
            transform-origin: top right;
            overflow: hidden;
        }

        .dark .dropdown-menu {
            background: rgba(15, 23, 42, 0.98);
            border-color: rgba(255, 255, 255, 0.1);
            box-shadow: 
                0 24px 48px rgba(0, 0, 0, 0.5),
                0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .dropdown-menu a {
            transition: all 0.2s ease;
            border-radius: 14px;
            position: relative;
            overflow: hidden;
        }

        .dropdown-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-gradient);
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }

        .dropdown-menu a:hover::before {
            transform: scaleY(1);
        }

        .dropdown-menu a:hover {
            background: linear-gradient(90deg, rgba(20, 184, 166, 0.1) 0%, transparent 100%);
            transform: translateX(6px);
            color: #0d9488;
        }

        .dark .dropdown-menu a:hover {
            background: linear-gradient(90deg, rgba(20, 184, 166, 0.2) 0%, transparent 100%);
            color: #5eead4;
        }

        /* Logout Button Special */
        .logout-btn {
            background: linear-gradient(90deg, rgba(239, 68, 68, 0.06) 0%, transparent 100%);
            border: 2px solid rgba(239, 68, 68, 0.15);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: linear-gradient(90deg, rgba(239, 68, 68, 0.12) 0%, transparent 100%);
            border-color: rgba(239, 68, 68, 0.3);
            transform: translateX(6px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.25);
        }

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 10px;
            height: 10px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 
                0 2px 8px rgba(239, 68, 68, 0.5),
                0 0 0 2px rgba(239, 68, 68, 0.2);
            animation: pulse-slow 2s ease-out infinite;
        }

        .dark .notification-badge {
            border-color: #0f172a;
        }

        /* Custom Scrollbar Ultra */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(148, 163, 184, 0.08);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gradient);
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        }

        .dark ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        /* Section Divider */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(148, 163, 184, 0.25), transparent);
            margin: 2rem 0;
        }

        .dark .section-divider {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
        }

        /* Mobile Overlay */
        .sidebar-overlay {
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        /* Page Title Gradient */
        .page-title {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 50%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 900;
            letter-spacing: -0.02em;
        }

        .dark .page-title {
            background: linear-gradient(135deg, #5eead4 0%, #2dd4bf 50%, #14b8a6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sidebar Toggle Animation */
        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.sidebar-open {
                transform: translateX(0);
                animation: slide-in 0.3s ease-out;
            }
        }
    </style>
</head>
<body>

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    @hasSection('hide_navigation')
    @else
    <div id="sidebar-overlay" class="lg:hidden fixed inset-0 sidebar-overlay hidden z-40" onclick="toggleSidebar()"></div>

    <aside id="sidebar" class="sidebar fixed inset-y-0 left-0 z-50 w-full max-w-[var(--sidebar-width)] flex flex-col lg:relative lg:translate-x-0">
        
        <!-- Logo Section -->
        <div class="logo-section h-[var(--header-height)] flex items-center justify-between px-6 relative z-10">
            <div class="flex items-center space-x-4">
                <div class="logo-icon">
                    <i class="fas fa-heartbeat text-white text-2xl"></i>
                </div>
                <div>
                    <span class="logo-text text-2xl block tracking-tight">Sentra Sehat</span>
                    <span class="text-white/70 text-xs font-medium">Healthcare System</span>
                </div>
            </div>
            <button class="lg:hidden text-white/90 hover:text-white transition-colors p-2.5 hover:bg-white/15 rounded-xl" onclick="toggleSidebar()">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-5 py-6 space-y-2 overflow-y-auto relative z-10">
            
            <!-- Search Bar -->
            <div class="search-wrapper mb-6">
                <input type="text" id="sidebar-search" placeholder="Cari menu..." 
                       class="sidebar-search w-full py-4 pl-14 pr-4 text-sm font-medium">
                <i class="fas fa-search search-icon text-lg"></i>
            </div>

            <!-- Dashboard -->
            <a href="{{ url('/home') }}" class="sidebar-link flex items-center gap-3 px-5 py-4 font-semibold {{ Request::is('home') ? 'active-link' : '' }}">
                <i class="fas fa-home text-lg"></i>
                <span>Dashboard</span>
            </a>

            @auth
            <!-- Main Menu -->
            <div class="category-label mt-8 mb-3">
                <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Menu Utama</span>
            </div>

            @if (in_array(Auth::user()->role->name, ['super_admin', 'puskesmas_admin', 'kades']))
            <a href="{{ route('penduduk.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-4 font-medium {{ Request::is('penduduk*') ? 'active-link' : '' }}">
                <i class="fas fa-users text-lg text-blue-500"></i>
                <span>Data Penduduk</span>
                <span class="ml-auto notification-badge"></span>
            </a>
            @endif

            @if (in_array(Auth::user()->role->name, ['super_admin', 'puskesmas_admin', 'dokter']))
            <a href="{{ route('intervensi.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-4 font-medium {{ Request::is('intervensi*') ? 'active-link' : '' }}">
                <i class="fas fa-stethoscope text-lg text-emerald-500"></i>
                <span>Intervensi</span>
            </a>

            <a href="{{ route('obat.index') }}" class="sidebar-link flex items-center gap-3 px-5 py-4 font-medium {{ Request::is('obat*') ? 'active-link' : '' }}">
                <i class="fas fa-pills text-lg text-purple-500"></i>
                <span>Data Obat</span>
            </a>
            @endif

            <div class="section-divider"></div>

            @if (in_array(Auth::user()->role->name, ['super_admin', 'puskesmas_admin', 'dokter']))
            <!-- Modul Kesehatan -->
            <div class="category-label mb-3">
                <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Modul Kesehatan</span>
            </div>

            <div>
                <button class="collapsible-header flex items-center justify-between w-full px-5 py-4 text-sm font-bold text-gray-600 dark:text-gray-300" onclick="toggleCollapse('kesehatan')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-clipboard-list text-lg"></i>
                        <span>Modul Kesehatan</span>
                    </div>
                    <i id="kesehatan-icon" class="fas fa-chevron-down text-xs transition-transform duration-300 rotate-180"></i>
                </button>
                <div id="kesehatan-content" class="collapsible-content open mt-2 space-y-1 ml-5 pl-4 border-l-2 border-gray-200 dark:border-gray-700">
                    <a href="{{ route('kesehatan_lingkungan.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium {{ Request::is('kesehatan_lingkungan*') ? 'active-link' : '' }}">
                        <i class="fas fa-tree text-emerald-500"></i>
                        <span>Lingkungan</span>
                    </a>
                    <a href="{{ route('penyakit.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium {{ Request::is('penyakit*') ? 'active-link' : '' }}">
                        <i class="fas fa-virus text-rose-500"></i>
                        <span>Penyakit</span>
                    </a>
                    <a href="{{ route('kesehatan_gizi.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium {{ Request::is('kesehatan_gizi*') ? 'active-link' : '' }}">
                        <i class="fas fa-apple-alt text-amber-500"></i>
                        <span>Gizi</span>
                    </a>
                    <a href="{{ route('kesehatan_anak_ibu.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium {{ Request::is('kesehatan_anak_ibu*') ? 'active-link' : '' }}">
                        <i class="fas fa-baby text-pink-500"></i>
                        <span>Anak & Ibu</span>
                    </a>
                </div>
            </div>
            @endif

            <div class="section-divider"></div>

            @if (in_array(Auth::user()->role->name, ['super_admin', 'dinkes_admin']))
            <!-- Administrasi -->
            <div class="category-label mb-3">
                <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Administrasi</span>
            </div>

            <div>
                <button class="collapsible-header flex items-center justify-between w-full px-5 py-4 text-sm font-bold text-gray-600 dark:text-gray-300" onclick="toggleCollapse('administrasi')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-cog text-lg"></i>
                        <span>Administrasi</span>
                    </div>
                    <i id="administrasi-icon" class="fas fa-chevron-down text-xs transition-transform duration-300 rotate-180"></i>
                </button>
                <div id="administrasi-content" class="collapsible-content open mt-2 space-y-1 ml-5 pl-4 border-l-2 border-gray-200 dark:border-gray-700">
                    <a href="{{ route('wilayah.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium {{ Request::is('wilayah*') ? 'active-link' : '' }}">
                        <i class="fas fa-map-marked-alt text-indigo-500"></i>
                        <span>Wilayah</span>
                    </a>
                    @if (Auth::user()->role->name == 'super_admin')
                    <a href="{{ route('users.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium {{ Request::is('users*') ? 'active-link' : '' }}">
                        <i class="fas fa-user-cog text-purple-500"></i>
                        <span>Pengguna</span>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            <!-- Logout -->
            <div class="pt-6 mt-6 border-t border-gray-200/50 dark:border-gray-700/50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn flex items-center gap-3 px-5 py-4 w-full text-left font-bold text-red-500 dark:text-red-400">
                        <i class="fas fa-sign-out-alt text-lg"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
            @endauth

        </nav>
    </aside>
    @endif

    {{-- MAIN CONTENT --}}
    <main class="flex flex-col flex-1 overflow-hidden">
        
        <!-- Header -->
        <header class="header-bg h-[var(--header-height)] flex items-center justify-between px-6 lg:px-8 z-30">
            
            <div class="flex items-center gap-4 flex-1">
                @if (!View::hasSection('hide_navigation'))
                <button id="sidebar-toggle" class="lg:hidden header-btn p-3" onclick="toggleSidebar()">
                    <i class="fas fa-bars text-lg text-gray-700 dark:text-gray-300"></i>
                </button>
                @endif
                <h1 class="page-title text-2xl lg:text-3xl @if (!View::hasSection('hide_navigation')) ml-0 lg:ml-0 @endif">@yield('title', 'Dashboard')</h1>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-3">
                
                <!-- Notifications -->
                <button class="header-btn p-3 relative">
                    <i class="fas fa-bell text-lg text-gray-700 dark:text-gray-300"></i>
                    <span class="notification-badge"></span>
                </button>

                <!-- Dark Mode Toggle -->
                <button id="dark-mode-toggle" class="header-btn p-3">
                    <i class="fas fa-moon text-lg text-gray-700 dark:hidden"></i>
                    <i class="fas fa-sun text-lg text-gray-300 hidden dark:block"></i>
                </button>

                @auth
                <!-- User Dropdown -->
                <div class="relative dropdown">
                    <button class="flex items-center gap-3 p-2 pr-4 rounded-2xl hover:bg-gray-100/50 dark:hover:bg-gray-800/50 transition-all" onclick="toggleDropdown()">
                        <div class="user-avatar w-11 h-11 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-bold text-gray-800 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->role->name }}</p>
                        </div>
                        <i class="fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400 transition-transform"></i>
                    </button>
                    
                    <div class="dropdown-menu absolute right-0 mt-3 w-72 py-2 z-50 opacity-0 invisible transition-all duration-300 origin-top-right scale-95">
                        
                        <!-- User Info -->
                        <div class="px-5 py-4 border-b border-gray-200/30 dark:border-gray-700/30">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="user-avatar w-14 h-14 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300">
                                    <i class="fas fa-crown mr-1.5 text-[10px]"></i>
                                    {{ ucwords(str_replace('_', ' ', Auth::user()->role->name)) }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse-slow"></span>
                                    Online
                                </span>
                            </div>
                        </div>
                        
                        <!-- Menu Items -->
                        <div class="py-2 px-2">
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400">
                                <i class="fas fa-user-circle w-5 text-lg"></i>
                                <span>Profile Saya</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400">
                                <i class="fas fa-cog w-5 text-lg"></i>
                                <span>Pengaturan</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400">
                                <i class="fas fa-palette w-5 text-lg"></i>
                                <span>Personalisasi</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400">
                                <i class="fas fa-question-circle w-5 text-lg"></i>
                                <span>Bantuan</span>
                            </a>
                        </div>

                        <!-- Logout -->
                        <div class="border-t border-gray-200/30 dark:border-gray-700/30 py-2 px-2 mt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 w-full text-left rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                                    <i class="fas fa-sign-out-alt w-5 text-lg"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth

                @guest
                <a href="{{ route('login') }}" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-300">Login</a>
                @endguest

            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto p-6 lg:p-8">
            @yield('content')
        </div>

    </main>

</div>

<script>
    // Toggle sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && overlay) {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('hidden');
        }
    }

    // Toggle collapsible sections
    function toggleCollapse(section) {
        const content = document.getElementById(section + '-content');
        const icon = document.getElementById(section + '-icon');
        
        if (content && icon) {
            content.classList.toggle('open');
            icon.classList.toggle('rotate-180');
        }
    }

    // Toggle dropdown
    function toggleDropdown() {
        const dropdown = document.querySelector('.dropdown');
        const menu = dropdown.querySelector('.dropdown-menu');
        const isOpen = menu.classList.contains('opacity-100');
        
        if (isOpen) {
            menu.classList.remove('opacity-100', 'visible', 'scale-100');
            menu.classList.add('opacity-0', 'invisible', 'scale-95');
        } else {
            menu.classList.remove('opacity-0', 'invisible', 'scale-95');
            menu.classList.add('opacity-100', 'visible', 'scale-100');
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        const dropdown = document.querySelector('.dropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            const menu = dropdown.querySelector('.dropdown-menu');
            if (menu) {
                menu.classList.remove('opacity-100', 'visible', 'scale-100');
                menu.classList.add('opacity-0', 'invisible', 'scale-95');
            }
        }
    });

    // Search functionality
    const searchInput = document.getElementById('sidebar-search');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase();
            const links = document.querySelectorAll('#sidebar a.sidebar-link');
            
            links.forEach(link => {
                const text = link.textContent.toLowerCase();
                link.style.display = text.includes(query) ? 'flex' : 'none';
            });
        });
    }

    // Dark mode toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const html = document.documentElement;
    const isDark = localStorage.getItem('darkMode') === 'true';
    
    if (isDark) {
        html.classList.add('dark');
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('darkMode', html.classList.contains('dark'));
        });
    }

    // Close sidebar on link click (mobile)
    document.querySelectorAll('#sidebar a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                toggleSidebar();
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar) {
                sidebar.classList.remove('sidebar-open');
            }
            if (overlay) {
                overlay.classList.add('hidden');
            }
        }
    });

    // Initialize collapsible sections as open
    document.addEventListener('DOMContentLoaded', () => {
        // Open collapsible sections by default
        document.querySelectorAll('.collapsible-content').forEach(content => {
            content.classList.add('open');
        });
        
        // Rotate icons for open sections
        document.querySelectorAll('[id$="-icon"]').forEach(icon => {
            if (icon.id.includes('kesehatan') || icon.id.includes('administrasi')) {
                icon.classList.add('rotate-180');
            }
        });

        // Add smooth scroll to all internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>

</body>
</html>