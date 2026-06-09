@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <div class="space-y-8">

        {{-- Hero Welcome Panel --}}
        <section class="relative overflow-hidden rounded-[32px] bg-[#08030a] p-6 sm:p-8 lg:p-10 text-white shadow-xl">
            <div class="absolute inset-0 opacity-40">
                <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-red-600 blur-3xl"></div>
                <div class="absolute -bottom-28 -left-20 h-80 w-80 rounded-full bg-red-900 blur-3xl"></div>
            </div>

            <div class="relative grid gap-8 lg:grid-cols-[1.2fr_.8fr] lg:items-center">
                <div>
                    <p class="inline-flex rounded-full border border-red-500/30 bg-red-500/10 px-4 py-2 text-xs font-black uppercase tracking-[.18em] text-red-200">
                        Al's Night Club Admin
                    </p>

                    <h1 class="mt-6 max-w-3xl text-3xl sm:text-4xl lg:text-5xl font-black leading-tight">
                        Manage website content, reservations, and events from one premium dashboard.
                    </h1>

                    <p class="mt-5 max-w-2xl text-sm sm:text-base leading-7 text-white/60">
                        Your homepage, events page, and reservation requests are connected to the admin panel.
                        Review new submissions, manage event visibility, and update public content quickly.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('admin.homepage.edit') }}"
                            class="inline-flex rounded-2xl bg-red-600 px-5 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-red-700">
                            Edit Homepage
                        </a>

                        @if(\Illuminate\Support\Facades\Route::has('admin.events.index'))
                            <a href="{{ route('admin.events.index') }}"
                                class="inline-flex rounded-2xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-white/10">
                                Manage Events
                            </a>
                        @endif

                        <a href="{{ route('home') }}" target="_blank"
                            class="inline-flex rounded-2xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-white/10">
                            View Website
                        </a>
                    </div>
                </div>

                <div class="rounded-[28px] border border-white/10 bg-white/[.06] p-5 backdrop-blur-xl">
                    <p class="text-xs font-black uppercase tracking-[.18em] text-white/40">
                        Homepage Hero
                    </p>

                    <div class="mt-5 rounded-3xl border border-white/10 bg-black/30 p-5">
                        <p class="text-sm text-white/50">Hero title</p>

                        <h2 class="mt-3 text-3xl font-black">
                            {{ $home->hero_title_top }}
                        </h2>

                        <p class="mt-1 text-xl font-bold text-red-300">
                            {{ $home->hero_title_highlight }}
                        </p>

                        <p class="mt-5 line-clamp-4 text-sm leading-7 text-white/55">
                            {{ $home->hero_description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Stats --}}
        <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-5">
            <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Total Requests</p>
                        <h3 class="mt-3 text-4xl font-black text-slate-950">
                            {{ $reservationStats['total'] }}
                        </h3>
                    </div>

                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-slate-950 text-white text-xl">
                        ✉
                    </div>
                </div>

                <p class="mt-5 text-sm text-slate-500">
                    All submitted reservation forms.
                </p>
            </div>

            <div class="rounded-[28px] border border-red-100 bg-red-50 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-red-700">New Requests</p>
                        <h3 class="mt-3 text-4xl font-black text-red-700">
                            {{ $reservationStats['new'] }}
                        </h3>
                    </div>

                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-red-600 text-white text-xl">
                        !
                    </div>
                </div>

                <p class="mt-5 text-sm text-red-700/70">
                    Needs attention from admin.
                </p>
            </div>

            <div class="rounded-[28px] border border-green-100 bg-green-50 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-green-700">Confirmed</p>
                        <h3 class="mt-3 text-4xl font-black text-green-700">
                            {{ $reservationStats['confirmed'] }}
                        </h3>
                    </div>

                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-green-600 text-white text-xl">
                        ✓
                    </div>
                </div>

                <p class="mt-5 text-sm text-green-700/70">
                    Confirmed reservation requests.
                </p>
            </div>

            <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Active Events</p>
                        <h3 class="mt-3 text-4xl font-black text-slate-950">
                            {{ $eventStats['active'] }}
                        </h3>
                    </div>

                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-slate-950 text-white text-xl">
                        ★
                    </div>
                </div>

                <p class="mt-5 text-sm text-slate-500">
                    Showing on public events page.
                </p>
            </div>

            <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Paused Events</p>
                        <h3 class="mt-3 text-4xl font-black text-slate-950">
                            {{ $eventStats['paused'] }}
                        </h3>
                    </div>

                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-slate-100 text-slate-800 text-xl">
                        ⏸
                    </div>
                </div>

                <p class="mt-5 text-sm text-slate-500">
                    Hidden from public events page.
                </p>
            </div>
        </section>

        {{-- Quick Actions --}}
        <section class="grid gap-5 lg:grid-cols-4">
            <a href="{{ route('admin.homepage.edit') }}"
                class="group rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                <div class="grid h-14 w-14 place-items-center rounded-2xl bg-red-600 text-white text-xl transition group-hover:scale-105">
                    ✎
                </div>

                <h3 class="mt-5 text-xl font-black text-slate-950">
                    Edit Homepage
                </h3>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Update hero, sections, images, and homepage content.
                </p>
            </a>

            @if(\Illuminate\Support\Facades\Route::has('admin.event-page.edit'))
                <a href="{{ route('admin.event-page.edit') }}"
                    class="group rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-slate-950 text-white text-xl transition group-hover:scale-105">
                        ▣
                    </div>

                    <h3 class="mt-5 text-xl font-black text-slate-950">
                        Events Hero
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Update the public events page hero video and headline.
                    </p>
                </a>
            @endif

            @if(\Illuminate\Support\Facades\Route::has('admin.events.create'))
                <a href="{{ route('admin.events.create') }}"
                    class="group rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-red-600 text-white text-xl transition group-hover:scale-105">
                        +
                    </div>

                    <h3 class="mt-5 text-xl font-black text-slate-950">
                        Create Event
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Add new event sections like Happy Hour, live shows, or VIP nights.
                    </p>
                </a>
            @endif

            @if(\Illuminate\Support\Facades\Route::has('admin.reservations.index'))
                <a href="{{ route('admin.reservations.index') }}"
                    class="group rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="grid h-14 w-14 place-items-center rounded-2xl bg-slate-950 text-white text-xl transition group-hover:scale-105">
                        ✉
                    </div>

                    <h3 class="mt-5 text-xl font-black text-slate-950">
                        Reservations
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Review guest reservation requests and update request status.
                    </p>
                </a>
            @endif
        </section>

        {{-- Recent Data --}}
        <section class="grid gap-6 xl:grid-cols-[1.15fr_.85fr]">

            {{-- Recent Reservation Requests --}}
            <div class="rounded-[32px] border border-slate-200 bg-white p-5 sm:p-7 shadow-sm">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-xl font-black text-slate-950">
                            Recent Reservation Requests
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Latest submitted forms from the public reservation page.
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Route::has('admin.reservations.index'))
                        <a href="{{ route('admin.reservations.index') }}"
                            class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50">
                            View All
                        </a>
                    @endif
                </div>

                <div class="mt-6 space-y-4">
                    @forelse($recentReservations as $reservation)
                        <div class="rounded-3xl border border-slate-100 bg-slate-50 p-4">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h4 class="font-black text-slate-950">
                                            {{ $reservation->name }}
                                        </h4>

                                        <span class="rounded-full px-3 py-1 text-[11px] font-black
                                            @if($reservation->status === 'new') bg-red-100 text-red-700
                                            @elseif($reservation->status === 'contacted') bg-yellow-100 text-yellow-700
                                            @elseif($reservation->status === 'confirmed') bg-green-100 text-green-700
                                            @else bg-slate-200 text-slate-600
                                            @endif">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </div>

                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ $reservation->request_type }} · {{ $reservation->guests }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $reservation->created_at->format('M d, Y h:i A') }}
                                    </p>
                                </div>

                                @if(\Illuminate\Support\Facades\Route::has('admin.reservations.show'))
                                    <a href="{{ route('admin.reservations.show', $reservation) }}"
                                        class="inline-flex justify-center rounded-2xl bg-white px-4 py-2 text-sm font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-100">
                                        View
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="rounded-3xl border border-dashed border-slate-200 p-8 text-center">
                            <h4 class="font-black text-slate-950">No reservation requests yet</h4>
                            <p class="mt-2 text-sm text-slate-500">
                                New form submissions will appear here.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Events --}}
            <div class="rounded-[32px] border border-slate-200 bg-white p-5 sm:p-7 shadow-sm">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-xl font-black text-slate-950">
                            Event Management
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Recent public event sections.
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Route::has('admin.events.index'))
                        <a href="{{ route('admin.events.index') }}"
                            class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50">
                            Manage
                        </a>
                    @endif
                </div>

                <div class="mt-6 space-y-4">
                    @forelse($recentEvents as $event)
                        <div class="overflow-hidden rounded-3xl border border-slate-100 bg-slate-50">
                            <div class="grid grid-cols-[92px_1fr]">
                                <div class="bg-slate-200">
                                    @if($event->image)
                                        <img src="{{ \App\Models\ClubEvent::mediaUrl($event->image) }}"
                                            alt="{{ $event->title }}"
                                            class="h-full min-h-[96px] w-full object-cover">
                                    @else
                                        <div class="grid h-full min-h-[96px] place-items-center text-xs text-slate-400">
                                            No image
                                        </div>
                                    @endif
                                </div>

                                <div class="p-4">
                                    <div class="flex items-center justify-between gap-3">
                                        <h4 class="line-clamp-1 font-black text-slate-950">
                                            {{ $event->title }}
                                        </h4>

                                        <span class="shrink-0 rounded-full px-3 py-1 text-[11px] font-black
                                            {{ $event->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-600' }}">
                                            {{ $event->is_active ? 'Live' : 'Paused' }}
                                        </span>
                                    </div>

                                    <p class="mt-1 line-clamp-2 text-sm leading-6 text-slate-500">
                                        {{ $event->description }}
                                    </p>

                                    @if(\Illuminate\Support\Facades\Route::has('admin.events.edit'))
                                        <a href="{{ route('admin.events.edit', $event) }}"
                                            class="mt-3 inline-flex text-sm font-bold text-red-600 hover:text-red-700">
                                            Edit Event
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-3xl border border-dashed border-slate-200 p-8 text-center">
                            <h4 class="font-black text-slate-950">No events found</h4>
                            <p class="mt-2 text-sm text-slate-500">
                                Created events will appear here.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Website Preview Details --}}
        <section class="rounded-[32px] border border-slate-200 bg-white p-5 sm:p-7 shadow-sm">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-xl font-black text-slate-950">
                        Website Preview Details
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Quick view of important homepage information.
                    </p>
                </div>

                <a href="{{ route('home') }}" target="_blank"
                    class="inline-flex rounded-2xl bg-slate-950 px-5 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-slate-800">
                    Open Website
                </a>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-2">
                <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">
                        Meta Title
                    </p>
                    <p class="mt-2 font-semibold text-slate-800">
                        {{ $home->meta_title }}
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">
                        Call Number
                    </p>
                    <p class="mt-2 font-semibold text-slate-800">
                        {{ $home->call_phone }}
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5 lg:col-span-2">
                    <p class="text-xs uppercase tracking-widest text-slate-400 font-black">
                        Hero Description
                    </p>
                    <p class="mt-2 text-slate-600 leading-7">
                        {{ $home->hero_description }}
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection