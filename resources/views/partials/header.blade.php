<header class="nav-glass fixed top-0 left-0 right-0 z-50">
    <div class="mx-auto max-w-7xl px-6 h-20 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex h-full items-center">
            <img src="{{ asset('assets/logo.png') }}" alt="Al's Night Club"
                class="h-12 md:h-14 w-auto max-w-[170px] object-contain">
        </a>

        <nav class="hidden md:flex items-center gap-9">
            <a class="lux-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                Home
            </a>

            <a class="lux-link {{ request()->routeIs('events') ? 'active' : '' }}" href="{{ route('events') }}">
                Events
            </a>

            <a class="lux-link {{ request()->routeIs('reservations') ? 'active' : '' }}"
                href="{{ route('reservations') }}">
                Reservations
            </a>
        </nav>

        <div class="flex items-center gap-3">
            <a href="tel:+19548820864" class="hidden lg:inline-flex nav-phone">
                1 (954) 882-0864
            </a>

            <a href="{{ route('reservations') }}"
                class="btn-red px-5 md:px-6 py-3 text-[10px] md:text-xs font-black uppercase tracking-[.18em]">
                Book VIP
            </a>

            <button data-menu-btn class="md:hidden btn-line px-4 py-3 text-xs">
                Menu
            </button>
        </div>
    </div>

    <div class="mobile-menu md:hidden flex-col bg-black/95 border-t border-white/10 px-6 py-5 gap-4">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('events') }}">Events</a>
        <a href="{{ route('reservations') }}">Reservations</a>
        <a href="tel:+19548820864">Call Us Now: 1 (954) 882-0864</a>
    </div>
</header>