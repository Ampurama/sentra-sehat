<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra Sehat | @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f9; }
        .active-link { background-color: #059669; color: white; }
        .active-link svg { color: #34d399; } /* emerald-400 */
        /* Transisi untuk off-canvas mobile menu */
        .sidebar-open { transform: translateX(0) scale(1); }
        .sidebar-closed { transform: translateX(-100%) scale(0.95); }
        /* Overlay untuk mobile */
        .sidebar-overlay { background: rgba(0, 0, 0, 0.5); z-index: 40; transition: opacity 0.3s ease; }
        .sidebar-overlay.hidden { opacity: 0; }

        /* Fixed scrollbar styling for cleaner look */
        .flex-1.overflow-y-auto::-webkit-scrollbar { width: 8px; }
        .flex-1.overflow-y-auto::-webkit-scrollbar-thumb { background-color: #a0aec0; border-radius: 4px; }
        .flex-1.overflow-y-auto::-webkit-scrollbar-track { background-color: #f7fafc; }

        /* Enhanced sidebar header */
        .sidebar-header {
            background: linear-gradient(135deg, #059669 0%, #047857 50%, #065f46 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Enhanced sidebar links */
        .sidebar-link {
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .sidebar-link:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Collapsible sections */
        .collapsible-content { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
        .collapsible-content.open { max-height: 500px; }

        /* Search input */
        .sidebar-search {
            background: #374151;
            border: 1px solid #4b5563;
            box-shadow: inset 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        /* Dropdown */
        .dropdown-menu { display: none; }
        .dropdown.open .dropdown-menu { display: block; }

        /* Rotate animation for icons */
        .rotate-180 { transform: rotate(180deg); }

        /* Dark mode */
        .dark body { background-color: #1a202c; color: #e2e8f0; }
        .dark .sidebar { background: linear-gradient(to bottom, #2d3748, #1a202c); }
        .dark .navbar { background: #2d3748; }
        .dark .active-link { background-color: #38a169; }
        .dark .sidebar-search { background: #4a5568; border-color: #718096; color: #e2e8f0; }
        .dark .sidebar-search::placeholder { color: #a0aec0; }
        .dark .dropdown-menu { background: #2d3748; border-color: #4a5568; }
        .dark .dropdown-menu a { color: #e2e8f0; }
        .dark .dropdown-menu a:hover { background: #4a5568; }
    </style>
</head>
<body>

    <div class="flex h-screen bg-gray-50">
        
        {{-- START: KONDISI NAVIGASI (SIDEBAR) --}}
        @hasSection('hide_navigation')
            {{-- Navigasi disembunyikan: Konten utama akan mengambil seluruh lebar. --}}
        @else
            <!-- Mobile Overlay -->
            <div id="sidebar-overlay" class="lg:hidden fixed inset-0 sidebar-overlay hidden transition duration-300 ease-in-out" 
                 onclick="toggleSidebar()"></div>
            
            <!-- Sidebar: Default hidden on mobile, fixed width on lg (desktop) -->
            <div id="sidebar" class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 bg-gradient-to-b from-gray-800 to-gray-900 shadow-xl
                                     lg:relative lg:translate-x-0 transition duration-300 ease-in-out sidebar-closed">

                <div class="sidebar-header flex items-center justify-between h-20 px-4">
                    <span class="text-xl font-extrabold text-white uppercase tracking-wider">Sentra Sehat</span>
                    <button id="sidebar-close" class="lg:hidden text-white hover:text-gray-200 transition-colors duration-200" onclick="toggleSidebar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto">

                    <!-- Search Input -->
                    <div class="px-2 py-2">
                        <input type="text" id="sidebar-search" placeholder="Cari menu..." class="sidebar-search text-gray-200 placeholder-gray-400 px-3 py-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    <a href="{{ url('/home') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('home') ? 'active-link' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path></svg>
                        <span>Dashboard</span>
                    </a>

                    @auth
                    {{-- Data Penduduk (Admin, Puskesmas, Kades) --}}
                    @if (Auth::user()->role->name == 'super_admin' || Auth::user()->role->name == 'puskesmas_admin' || Auth::user()->role->name == 'kades')
                    <a href="{{ route('penduduk.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('penduduk*') ? 'active-link' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>
                        <span>Data Penduduk</span>
                    </a>
                    @endif

                    {{-- Tindakan Intervensi (Admin, Puskesmas, Dokter) --}}
                    @if (Auth::user()->role->name == 'super_admin' || Auth::user()->role->name == 'puskesmas_admin' || Auth::user()->role->name == 'dokter')
                    <a href="{{ route('intervensi.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('intervensi*') ? 'active-link' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span>Intervensi</span>
                    </a>
                    @endif

                    {{-- Data Obat (Admin, Puskesmas, Dokter) --}}
                    @if (Auth::user()->role->name == 'super_admin' || Auth::user()->role->name == 'puskesmas_admin' || Auth::user()->role->name == 'dokter')
                    <a href="{{ route('obat.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('obat*') ? 'active-link' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        <span>Data Obat</span>
                    </a>
                    @endif

                    {{-- Modul Kesehatan (Admin, Puskesmas, Dokter) --}}
                    @if (Auth::user()->role->name == 'super_admin' || Auth::user()->role->name == 'puskesmas_admin' || Auth::user()->role->name == 'dokter')
                    <div class="pt-2 border-t border-gray-700 mt-4">
                        <button class="flex items-center justify-between w-full px-3 py-2 text-xs text-gray-500 uppercase hover:text-gray-300 transition duration-150" onclick="toggleCollapse('kesehatan')">
                            <span>Modul Kesehatan</span>
                            <svg id="kesehatan-icon" class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="kesehatan-content" class="collapsible-content open">
                            <a href="{{ route('kesehatan_lingkungan.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('kesehatan_lingkungan*') ? 'active-link' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg>
                                <span>Kesehatan Lingkungan</span>
                            </a>
                            <a href="{{ route('penyakit.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('penyakit*') ? 'active-link' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Data Penyakit</span>
                            </a>
                            <a href="{{ route('kesehatan_gizi.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('kesehatan_gizi*') ? 'active-link' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <span>Kesehatan Gizi</span>
                            </a>
                            <a href="{{ route('kesehatan_anak_ibu.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('kesehatan_anak_ibu*') ? 'active-link' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                <span>Kesehatan Anak & Ibu</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    {{-- Master Data Wilayah (Super Admin, Dinkes Admin) --}}
                    @if (Auth::user()->role->name == 'super_admin' || Auth::user()->role->name == 'dinkes_admin')
                    <div class="pt-2 border-t border-gray-700 mt-4">
                        <button class="flex items-center justify-between w-full px-3 py-2 text-xs text-gray-500 uppercase hover:text-gray-300 transition duration-150" onclick="toggleCollapse('administrasi')">
                            <span>Administrasi</span>
                            <svg id="administrasi-icon" class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="administrasi-content" class="collapsible-content open">
                            <a href="{{ route('wilayah.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('wilayah*') ? 'active-link' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                <span>Master Wilayah</span>
                            </a>
                            @if (Auth::user()->role->name == 'super_admin')
                            <a href="{{ route('users.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-200 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('users*') ? 'active-link' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>
                                <span>Kelola Pengguna</span>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="pt-4">
                        @csrf
                        <button type="submit" class="sidebar-link flex items-center px-4 py-2 text-red-300 rounded-lg w-full text-left hover:bg-gray-700 transition duration-150">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                    @endauth {{-- Tutup @auth untuk sidebar --}}

                </nav>
            </div>
        @endif
        {{-- END: KONDISI NAVIGASI (SIDEBAR) --}}

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            
            <header class="flex items-center justify-between h-16 bg-white border-b border-gray-200 px-4 sm:px-6 shadow-md">
                
                {{-- Tombol Toggle Sidebar (Hanya tampil di mobile/tablet, dan JIKA navigasi tidak disembunyikan) --}}
                @if (!View::hasSection('hide_navigation'))
                <button id="sidebar-toggle" class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition duration-150" onclick="toggleSidebar()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                </button>
                @endif

                <span class="text-xl font-semibold text-gray-700 flex-1 @if (!View::hasSection('hide_navigation')) ml-3 lg:ml-0 @endif">@yield('title', 'Dashboard')</span>
                
                @auth
                <div class="flex items-center space-x-4">
                    {{-- Dark Mode Toggle --}}
                    <button id="dark-mode-toggle" class="p-2 rounded-lg text-gray-600 hover:text-gray-800 hover:bg-gray-100 transition duration-150">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                    {{-- User Dropdown --}}
                    <div class="relative dropdown">
                        <button class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition duration-150" onclick="toggleDropdown()">
                            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-gray-700 hidden md:inline">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->role->name }}</p>
                            </div>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                            </form>
                        </div>
                    </div>

                    {{-- Tombol Logout kecil untuk mobile (jika sidebar disembunyikan di home) --}}
                    @if (View::hasSection('hide_navigation'))
                        <form method="POST" action="{{ route('logout') }}" class="md:hidden">
                            @csrf
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium p-2 rounded-lg bg-red-50/50 hover:bg-red-100 transition duration-150">
                                Logout
                            </button>
                        </form>
                    @endif

                </div>
                @endauth
                
                @guest
                <a href="{{ route('login') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-800">Login</a>
                @endguest
            </header>
            
            <main class="p-4 sm:p-6 flex-1">
                @yield('content')
            </main>

        </div>

    </div>

    <script>
        // Toggle sidebar untuk mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar.classList.contains('sidebar-closed')) {
                sidebar.classList.remove('sidebar-closed');
                sidebar.classList.add('sidebar-open');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.remove('sidebar-open');
                sidebar.classList.add('sidebar-closed');
                overlay.classList.add('hidden');
            }
        }

        // Toggle collapsible sections
        function toggleCollapse(section) {
            const content = document.getElementById(section + '-content');
            const icon = document.getElementById(section + '-icon');
            content.classList.toggle('open');
            icon.classList.toggle('rotate-180');
        }

        // Toggle dropdown
        function toggleDropdown() {
            const dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('open');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.dropdown');
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove('open');
            }
        });

        // Sidebar search
        document.getElementById('sidebar-search').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const links = document.querySelectorAll('#sidebar a span');
            links.forEach(span => {
                const link = span.parentElement;
                const text = span.textContent.toLowerCase();
                if (text.includes(query)) {
                    link.style.display = 'flex';
                } else {
                    link.style.display = 'none';
                }
            });
        });

        // Dark mode toggle
        document.getElementById('dark-mode-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark');
            const isDark = document.body.classList.contains('dark');
            localStorage.setItem('darkMode', isDark);
        });

        // Load dark mode preference
        document.addEventListener('DOMContentLoaded', function() {
            const darkMode = localStorage.getItem('darkMode') === 'true';
            if (darkMode) {
                document.body.classList.add('dark');
            }

            // Tutup sidebar saat klik link di mobile
            const sidebarLinks = document.querySelectorAll('#sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) { // lg breakpoint
                        toggleSidebar();
                    }
                });
            });

            // Tutup sidebar saat resize ke desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebar-overlay');
                    sidebar.classList.remove('sidebar-open');
                    sidebar.classList.add('sidebar-closed');
                    overlay.classList.add('hidden');
                }
            });
        });
    </script>

</body>
</html>
