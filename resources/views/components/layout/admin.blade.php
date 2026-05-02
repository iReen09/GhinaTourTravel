<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Ghina Tour Travel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        amber: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="h-full bg-neutral-50 dark:bg-[#0a0a0a] text-neutral-900 dark:text-[#EDEDEC]">
    <div class="flex h-full">

        {{-- ── Sidebar ── --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-neutral-900 border-r border-neutral-200 dark:border-neutral-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-200">
            <div class="flex flex-col h-full">

                <div class="flex items-center gap-3 px-6 h-16 border-b border-neutral-200 dark:border-neutral-800">
                    <div>
                        <h1 class="font-semibold text-sm">Ghina Tour</h1>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">Admin Panel</p>
                    </div>
                    <button type="button" onclick="closeSidebar()"
                        class="lg:hidden ml-auto p-1.5 rounded-lg text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                    <p class="px-3 py-2 text-xs font-semibold text-neutral-400 uppercase tracking-wider">Menu</p>

                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.dashboard') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400' : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.paket.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.paket.*') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400' : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                        Paket
                    </a>

                    <a href="{{ route('admin.pesanan.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.pesanan.*') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400' : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        Pesanan
                    </a>

                    <a href="{{ route('admin.gallery.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.gallery.*') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400' : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        Gallery
                    </a>

                    <a href="{{ route('admin.company-profile.show', 1) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                    {{ request()->routeIs('admin.company-profile.*') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400' : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                        Company Profile
                    </a>
                </nav>

                <div class="px-3 py-4 border-t border-neutral-200 dark:border-neutral-800">
                    <a href="{{ route('home') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Lihat Website
                    </a>
                </div>
            </div>
        </aside>

        <div id="sidebarBackdrop" class="fixed inset-0 z-40 bg-black/50 lg:hidden hidden" onclick="closeSidebar()">
        </div>

        <div class="flex-1 lg:ml-64 w-full">

            {{-- ── Header ── --}}
            <header
                class="sticky top-0 z-30 h-16 bg-white/80 dark:bg-neutral-900/80 backdrop-blur-xl border-b border-neutral-200 dark:border-neutral-800">
                <div class="flex items-center justify-between h-full px-4 lg:px-6">

                    <div class="flex items-center gap-3">
                        <button type="button" onclick="openSidebar()"
                            class="lg:hidden p-2 rounded-lg text-neutral-500 hover:bg-neutral-100 dark:hover:bg-neutral-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h2 class="text-base lg:text-lg font-semibold">@yield('header', 'Dashboard')</h2>
                    </div>

                    {{-- Dark Mode Toggle --}}
                    <button id="adminThemeToggle" type="button" title="Ganti tema"
                        class="p-2 rounded-lg text-neutral-500 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors focus:outline-none">
                        <svg id="adminSunIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg id="adminMoonIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    {{-- Profile Dropdown --}}
                    <div class="relative">
                        <button onclick="toggleLogoutMenu()"
                            class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors focus:outline-none">
                            <div class="w-8 h-8 rounded-full overflow-hidden bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700">
                                <img src="{{ asset('customer/assets/images/logos/logo.png') }}" class="w-full h-full object-cover" alt="Admin">
                            </div>
                            <div class="hidden sm:block text-left leading-tight">
                                <p class="text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-neutral-400">Administrator</p>
                            </div>
                            <svg class="w-4 h-4 text-neutral-400 hidden sm:block" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="logoutMenu"
                            class="hidden absolute right-0 top-full mt-2 w-52 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-lg z-50 overflow-hidden">
                            <div class="px-4 py-3 border-b border-neutral-100 dark:border-neutral-800">
                                <p class="text-sm font-semibold text-neutral-800 dark:text-neutral-100">
                                    {{ auth()->user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-neutral-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('home') }}"
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-neutral-600 dark:text-neutral-400 hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Lihat Website
                                </a>
                            </div>
                            <div class="py-1 border-t border-neutral-100 dark:border-neutral-800">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-4 lg:p-6">
                @if (session('success'))
                    <div
                        class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('failed'))
                    <div
                        class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm">
                        {{ session('failed') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div
                        class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebarBackdrop').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarBackdrop').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function toggleLogoutMenu() {
            document.getElementById('logoutMenu').classList.toggle('hidden');
        }
        window.addEventListener('click', function(e) {
            const menu = document.getElementById('logoutMenu');
            const button = menu.previousElementSibling;
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        // ── Admin Dark Mode Toggle ──
        (function() {
            const html = document.documentElement;
            const toggleBtn = document.getElementById('adminThemeToggle');
            const sunIcon = document.getElementById('adminSunIcon');
            const moonIcon = document.getElementById('adminMoonIcon');

            function applyTheme(isDark) {
                if (isDark) {
                    html.classList.add('dark');
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                } else {
                    html.classList.remove('dark');
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                }
            }

            // Load saved preference
            const saved = localStorage.getItem('admin-theme');
            applyTheme(saved === 'dark');

            toggleBtn?.addEventListener('click', function() {
                const isDark = !html.classList.contains('dark');
                localStorage.setItem('admin-theme', isDark ? 'dark' : 'light');
                applyTheme(isDark);
            });
        })();
    </script>

    {{-- ── Chatbot Widget (Admin Only) ── --}}
    <style>
        .cb-container {
            position: fixed; bottom: 90px; right: 26px; width: 370px; height: 520px;
            background: #fff; border: 1px solid #e5e5e5; border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12); display: flex; flex-direction: column;
            overflow: hidden; z-index: 1000; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(20px) scale(0.95); opacity: 0; pointer-events: none;
        }
        .cb-container.active { transform: translateY(0) scale(1); opacity: 1; pointer-events: auto; }
        .cb-header { background: #f59e0b; padding: 15px 20px; display: flex; align-items: center; justify-content: space-between; }
        .cb-header h3 { color: #000; font-weight: 700; font-size: 16px; margin: 0; }
        .cb-close { cursor: pointer; color: #000; display: flex; }
        .cb-messages { flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 12px; background: #fafaf9; }
        .cb-msg { max-width: 85%; padding: 10px 14px; border-radius: 15px; font-size: 14px; line-height: 1.6; word-wrap: break-word; }
        .cb-bot { align-self: flex-start; background: #fff; color: #333; border: 1px solid #e5e5e5; border-bottom-left-radius: 2px; }
        .cb-user { align-self: flex-end; background: #f59e0b; color: #000; border-bottom-right-radius: 2px; }
        .cb-input-area { padding: 15px; border-top: 1px solid #e5e5e5; display: flex; gap: 8px; background: #fff; }
        .cb-input { flex: 1; background: #f5f5f4; border: 1px solid #e5e5e5; border-radius: 999px; padding: 8px 16px; font-size: 14px; color: #333; outline: none; }
        .cb-input:focus { border-color: #f59e0b; }
        .cb-send { background: #f59e0b; color: #000; width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: none; flex-shrink: 0; transition: background 0.2s; }
        .cb-send:hover { background: #d97706; }
        .cb-trigger { position: fixed; bottom: 26px; right: 26px; background: #f59e0b; color: #000; width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 14px rgba(245,158,11,0.35); z-index: 999; transition: transform 0.2s; border: none; }
        .cb-trigger:hover { transform: scale(1.1); }
        .cb-quick { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 8px; }
        .cb-qbtn { font-size: 12px; padding: 4px 12px; border: 1px solid #f59e0b; border-radius: 999px; color: #b45309; background: transparent; cursor: pointer; transition: all 0.2s; }
        .cb-qbtn:hover { background: #f59e0b; color: #000; }
        .cb-typing { display: flex; gap: 4px; }
        .cb-typing span { width: 6px; height: 6px; background: #a8a29e; border-radius: 50%; animation: cbBounce 1.4s infinite ease-in-out both; }
        .cb-typing span:nth-child(1) { animation-delay: -0.32s; }
        .cb-typing span:nth-child(2) { animation-delay: -0.16s; }
        @keyframes cbBounce { 0%, 80%, 100% { transform: scale(0); } 40% { transform: scale(1); } }
    </style>

    <button id="cbTrigger" class="cb-trigger" title="Ghina Assistant">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
    </button>

    <div id="cbContainer" class="cb-container">
        <div class="cb-header">
            <h3>Ghina Assistant</h3>
            <span id="cbClose" class="cb-close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </span>
        </div>
        <div id="cbMessages" class="cb-messages"></div>
        <div class="cb-input-area">
            <input type="text" id="cbInput" class="cb-input" placeholder="Tulis pesan...">
            <button id="cbSend" class="cb-send">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
            </button>
        </div>
    </div>

    <script>
    (function() {
        const trigger = document.getElementById('cbTrigger');
        const container = document.getElementById('cbContainer');
        const closeBtn = document.getElementById('cbClose');
        const input = document.getElementById('cbInput');
        const sendBtn = document.getElementById('cbSend');
        const messages = document.getElementById('cbMessages');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        if (!trigger) return;

        trigger.addEventListener('click', () => {
            container.classList.toggle('active');
            if (container.classList.contains('active') && messages.children.length === 0) {
                fetchMenu();
            }
            input.focus();
        });

        closeBtn.addEventListener('click', () => container.classList.remove('active'));

        async function sendMessage(text) {
            if (!text.trim()) return;
            appendMsg(text, 'user');
            input.value = '';
            showTyping();

            try {
                const res = await fetch('/api/chatbot/message', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ message: text })
                });
                const data = await res.json();
                hideTyping();
                appendMsg(data.response || 'Tidak ada respons.', 'bot');
            } catch (err) {
                hideTyping();
                appendMsg('Terjadi kesalahan koneksi.', 'bot');
            }
        }

        sendBtn.addEventListener('click', () => sendMessage(input.value));
        input.addEventListener('keypress', (e) => { if (e.key === 'Enter') sendMessage(input.value); });

        async function fetchMenu() {
            showTyping();
            try {
                const res = await fetch('/api/chatbot/menu');
                const data = await res.json();
                hideTyping();
                if (data.success) appendMsg(data.response, 'bot', data.options);
            } catch (err) {
                hideTyping();
                appendMsg('Gagal memuat menu.', 'bot');
            }
        }

        function appendMsg(text, side, options = []) {
            const div = document.createElement('div');
            div.className = `cb-msg cb-${side}`;
            let html = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>').replace(/\n/g, '<br>');
            div.innerHTML = `<div>${html}</div>`;

            if (options && options.length > 0) {
                const qr = document.createElement('div');
                qr.className = 'cb-quick';
                options.forEach(opt => {
                    const btn = document.createElement('button');
                    btn.className = 'cb-qbtn';
                    btn.textContent = opt;
                    btn.onclick = () => sendMessage(opt);
                    qr.appendChild(btn);
                });
                div.appendChild(qr);
            }

            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
        }

        function showTyping() {
            const t = document.createElement('div');
            t.className = 'cb-msg cb-bot'; t.id = 'cbTyping';
            t.innerHTML = '<div class="cb-typing"><span></span><span></span><span></span></div>';
            messages.appendChild(t);
            messages.scrollTop = messages.scrollHeight;
        }

        function hideTyping() {
            const t = document.getElementById('cbTyping');
            if (t) t.remove();
        }
    })();
    </script>

    @stack('scripts')
</body>

</html>

