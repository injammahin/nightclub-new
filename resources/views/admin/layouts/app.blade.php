<!DOCTYPE html>
<html lang="en" x-data="{
        sidebarOpen: JSON.parse(localStorage.getItem('adminSidebarOpen') ?? 'true'),
        mobileSidebar: false
    }" x-init="$watch('sidebarOpen', value => localStorage.setItem('adminSidebarOpen', JSON.stringify(value)))">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | Al's Night Club</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#f6f7fb] text-slate-900">
    <div class="min-h-screen">

        <div x-show="mobileSidebar" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-black/50 lg:hidden"
            @click="mobileSidebar = false"></div>

        <aside
            class="fixed inset-y-0 left-0 z-50 h-screen overflow-y-auto border-r border-white/10 bg-[#08030a] text-white transition-all duration-300"
            :class="[
                sidebarOpen ? 'lg:w-72' : 'lg:w-24',
                mobileSidebar ? 'w-72 translate-x-0' : 'w-72 -translate-x-full lg:translate-x-0'
            ]">

            <div
                class="sticky top-0 z-10 h-20 flex items-center justify-between px-5 border-b border-white/10 bg-[#08030a]">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 overflow-hidden">
                    <div
                        class="h-11 w-11 shrink-0 rounded-2xl bg-gradient-to-br from-red-500 to-red-900 grid place-items-center font-black">
                        A
                    </div>

                    <div x-show="sidebarOpen" x-transition>
                        <h1 class="font-display text-xl leading-none">
                            AL'S
                        </h1>
                        <p class="text-[10px] uppercase tracking-[.22em] text-red-400">
                            Admin Panel
                        </p>
                    </div>
                </a>

                <button class="lg:hidden text-white/60 hover:text-white" @click="mobileSidebar = false">
                    ✕
                </button>
            </div>

            <nav class="p-4 space-y-2 pb-28">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                    <span class="text-lg shrink-0">⌂</span>
                    <span x-show="sidebarOpen" x-transition>Dashboard</span>
                </a>

                <a href="{{ route('admin.homepage.edit') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin.homepage.*') ? 'bg-red-600 text-white' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                    <span class="text-lg shrink-0">✎</span>
                    <span x-show="sidebarOpen" x-transition>Home Page</span>
                </a>
                <a href="{{ route('admin.event-page.edit') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin.event-page.*') ? 'bg-red-600 text-white' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                    <span class="text-lg shrink-0">▣</span>
                    <span x-show="sidebarOpen" x-transition>Events Hero</span>
                </a>

                <a href="{{ route('admin.events.index') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition
                   {{ request()->routeIs('admin.events.*') ? 'bg-red-600 text-white' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                    <span class="text-lg shrink-0">★</span>
                    <span x-show="sidebarOpen" x-transition>Events</span>
                </a>
                <a href="{{ route('admin.reservations.index') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin.reservations.*') ? 'bg-red-600 text-white' : 'text-white/65 hover:bg-white/10 hover:text-white' }}">
                    <span class="text-lg shrink-0">✉</span>
                    <span x-show="sidebarOpen" x-transition>Reservations</span>
                </a>

                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-white/65 transition hover:bg-white/10 hover:text-white">
                    <span class="text-lg shrink-0">↗</span>
                    <span x-show="sidebarOpen" x-transition>View Website</span>
                </a>
            </nav>

            <div class="fixed bottom-0 left-0 border-t border-white/10 bg-[#08030a] p-4 transition-all duration-300"
                :class="sidebarOpen ? 'lg:w-72 w-72' : 'lg:w-24 w-72'">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-white/65 transition hover:bg-white/10 hover:text-white">
                        <span class="text-lg shrink-0">⇢</span>
                        <span x-show="sidebarOpen" x-transition>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="min-h-screen transition-all duration-300" :class="sidebarOpen ? 'lg:pl-72' : 'lg:pl-24'">

            <header class="sticky top-0 z-30 h-20 border-b border-slate-200 bg-white/90 backdrop-blur-xl">
                <div class="h-full flex items-center justify-between px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button class="lg:hidden rounded-xl border border-slate-200 bg-white px-3 py-2 shadow-sm"
                            @click="mobileSidebar = true">
                            ☰
                        </button>

                        <button
                            class="hidden lg:inline-flex rounded-xl border border-slate-200 bg-white px-3 py-2 shadow-sm"
                            @click="sidebarOpen = !sidebarOpen">
                            ☰
                        </button>

                        <div>
                            <h2 class="text-lg sm:text-xl font-black text-slate-950">
                                @yield('page_title', 'Dashboard')
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500">
                                Website content management
                            </p>
                        </div>
                    </div>

                    <div class="hidden sm:flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-950">
                                {{ auth('admin')->user()->name ?? 'Admin' }}
                            </p>
                            <p class="text-xs text-slate-500">
                                Administrator
                            </p>
                        </div>

                        <div class="h-11 w-11 rounded-2xl bg-slate-950 text-white grid place-items-center font-black">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-4 sm:p-6 lg:p-8">
                @if (session('success'))
                    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>