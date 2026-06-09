@extends('layouts.app')

@php
    use App\Models\EventPageSetting;
    use App\Models\ClubEvent;
@endphp

@section('title', $eventPage->meta_title)

@section('meta_description', $eventPage->meta_description)

@section('content')

    <section class="events-video-hero relative min-h-screen flex items-center overflow-hidden thin-grid">
        <video id="eventsHeroVideo" class="events-bg-video" autoplay muted loop playsinline preload="auto">
            <source src="{{ EventPageSetting::mediaUrl($eventPage->hero_video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="events-video-overlay"></div>

        <div class="hero-action-stack">
            <button data-events-sound class="sound-toggle">
                Enable Sound
            </button>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 pt-32 pb-20">
            <p class="reveal text-red-500 uppercase tracking-[.55em] text-xs font-black mb-6">
                {{ $eventPage->hero_eyebrow }}
            </p>

            <h1 class="reveal hero-title font-display text-6xl md:text-[105px] lg:text-[130px] leading-[.82]">
                {{ $eventPage->hero_title_top }}<br>
                <span class="text-gradient">{{ $eventPage->hero_title_highlight }}</span>
            </h1>

            <p class="reveal max-w-3xl mt-8 text-white/75 leading-8 text-base md:text-lg">
                {{ $eventPage->hero_description }}
            </p>

            <div class="reveal mt-9 flex flex-wrap gap-4">
                <a href="{{ $eventPage->hero_primary_button_url }}"
                    class="btn-red px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                    {{ $eventPage->hero_primary_button_text }}
                </a>

                <a href="{{ url($eventPage->hero_secondary_button_url) }}"
                    class="btn-line px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                    {{ $eventPage->hero_secondary_button_text }}
                </a>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 text-white/45 animate-bounce">
            ↓
        </div>
    </section>

    @forelse($events as $index => $event)
        <section class="py-24 {{ $index % 2 === 0 ? 'split-red' : 'bg-[#070203]' }}">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid lg:grid-cols-[.85fr_1.15fr] gap-10 items-center">
                    <div class="reveal image-frame poster-frame {{ $index % 2 !== 0 ? 'lg:order-2' : '' }}">
                        @if($event->image)
                            <img src="{{ ClubEvent::mediaUrl($event->image) }}" alt="{{ $event->title }}"
                                class="w-full h-full object-cover">
                        @endif
                    </div>

                    <div class="reveal {{ $index % 2 !== 0 ? 'lg:order-1' : '' }}">
                        <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                            {{ $event->eyebrow }}
                        </p>

                        <h2 class="font-display text-5xl md:text-7xl mt-5 leading-tight">
                            {{ $event->title }}
                        </h2>

                        <p class="text-white/70 leading-8 mt-6 text-lg">
                            {{ $event->description }}
                        </p>

                        <div class="mt-8 grid sm:grid-cols-3 gap-4">
                            @foreach(($event->cards ?? []) as $card)
                                <div class="lux-card p-5">
                                    <b>{{ $card['title'] ?? '' }}</b>
                                    <p class="text-white/55 text-sm mt-2">
                                        {{ $card['text'] ?? '' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-9 flex flex-wrap gap-4">
                            @if($event->primary_button_text && $event->primary_button_url)
                                <a href="{{ $event->primary_button_url }}"
                                    class="btn-red px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                                    {{ $event->primary_button_text }}
                                </a>
                            @endif

                            @if($event->secondary_button_text && $event->secondary_button_url)
                                <a href="{{ url($event->secondary_button_url) }}"
                                    class="btn-line px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                                    {{ $event->secondary_button_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @empty
        <section class="py-24 split-red">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    Events
                </p>

                <h2 class="font-display text-5xl md:text-7xl mt-5">
                    No Active Events
                </h2>

                <p class="text-white/60 mt-5">
                    Please check back soon for upcoming events.
                </p>
            </div>
        </section>
    @endforelse

    <section class="py-28 bg-[#070203]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center reveal">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    Every Weekend
                </p>

                <h2 class="font-display text-5xl md:text-7xl mt-4">
                    What Happens at Al's
                </h2>

                <p class="text-white/60 mt-5 max-w-3xl mx-auto leading-8">
                    Al's Night Club welcomes all nationalities to enjoy restaurant food, music, dancing, live
                    entertainment, Caribbean energy, VIP sections, birthdays, and special nights out in Margate.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-14 stagger">
                <article class="image-frame">
                    <img class="h-80 w-full object-cover"
                        src="https://images.unsplash.com/photo-1574391884720-bbc3740c59d1?auto=format&fit=crop&w=900&q=85"
                        alt="Live music event">

                    <div class="p-7">
                        <p class="text-red-500 text-xs font-black tracking-[.2em]">
                            LIVE ARTISTS
                        </p>

                        <h2 class="font-display text-3xl mt-3">
                            Live & Caribbean Performances
                        </h2>

                        <p class="text-white/58 mt-4 leading-7">
                            Weekend performances with Haitian, Caribbean, Afrobeat, Latin, Hip-Hop, Reggae, Kompa, and
                            international entertainment.
                        </p>

                        <a class="btn-red w-full mt-6 py-4 text-xs font-black uppercase tracking-[.18em]"
                            href="{{ route('reservations') }}">
                            Reserve for This Weekend
                        </a>
                    </div>
                </article>

                <article class="image-frame">
                    <img class="h-80 w-full object-cover"
                        src="https://images.unsplash.com/photo-1541532713592-79a0317b6b77?auto=format&fit=crop&w=900&q=85"
                        alt="Birthday celebration at nightclub">

                    <div class="p-7">
                        <p class="text-red-500 text-xs font-black tracking-[.2em]">
                            CELEBRATIONS
                        </p>

                        <h2 class="font-display text-3xl mt-3">
                            Birthdays & Special Nights
                        </h2>

                        <p class="text-white/58 mt-4 leading-7">
                            VIP sections for birthdays, groups, celebrations and special nights out.
                        </p>

                        <a class="btn-red w-full mt-6 py-4 text-xs font-black uppercase tracking-[.18em]"
                            href="{{ route('reservations') }}">
                            Book a VIP Section
                        </a>
                    </div>
                </article>

                <article class="image-frame">
                    <img class="h-80 w-full object-cover"
                        src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=900&q=85"
                        alt="Dancing and nightlife">

                    <div class="p-7">
                        <p class="text-red-500 text-xs font-black tracking-[.2em]">
                            NIGHTLIFE
                        </p>

                        <h2 class="font-display text-3xl mt-3">
                            Food, Music & Dancing
                        </h2>

                        <p class="text-white/58 mt-4 leading-7">
                            Enjoy music, dancing, Caribbean energy, and international vibes at Al's Night Club.
                            Food is available through the restaurant at 181 S State Rd 7, Margate, FL 33068.
                        </p>

                        <a class="btn-red w-full mt-6 py-4 text-xs font-black uppercase tracking-[.18em]"
                            href="tel:+19548820864">
                            Call the Club
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6 image-frame min-h-[520px] flex items-center"
            style="background:linear-gradient(90deg,#050101 0%,rgba(5,1,1,.88) 38%,rgba(5,1,1,.18)),url('https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=1800&q=85') center/cover">
            <div class="p-8 md:p-14 max-w-2xl reveal">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    Reservations
                </p>

                <h2 class="font-display text-5xl md:text-7xl mt-5">
                    Promoters & VIP Tables
                </h2>

                <p class="text-white/65 leading-8 mt-6">
                    For promoter inquiries, artist nights, birthdays and VIP section reservations,
                    contact the reservations team.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a class="btn-red px-8 py-4 text-xs font-black uppercase tracking-[.18em]" href="tel:+17865647828">
                        1 (786) 564-7828
                    </a>

                    <a class="btn-line px-8 py-4 text-xs font-black uppercase tracking-[.18em]"
                        href="{{ route('reservations') }}">
                        Use Contact Form
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-[#070203]">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center reveal">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    Questions
                </p>

                <h2 class="font-display text-5xl mt-4">
                    Before You Arrive
                </h2>
            </div>

            <div class="mt-12 space-y-4">
                <div class="accordion lux-card">
                    <button class="w-full p-5 flex justify-between font-bold text-left">
                        How do I reserve a VIP section?<span>+</span>
                    </button>

                    <div class="accordion-content px-5 text-white/60">
                        <p class="pb-5">
                            Call the reservations number or submit the form with your date, guest count and celebration
                            details.
                        </p>
                    </div>
                </div>

                <div class="accordion lux-card">
                    <button class="w-full p-5 flex justify-between font-bold text-left">
                        Who should promoters contact?<span>+</span>
                    </button>

                    <div class="accordion-content px-5 text-white/60">
                        <p class="pb-5">
                            Promoters and reservation inquiries should call 1 (786) 564-7828.
                        </p>
                    </div>
                </div>

                <div class="accordion lux-card">
                    <button class="w-full p-5 flex justify-between font-bold text-left">
                        What makes Al's Night Club different?<span>+</span>
                    </button>

                    <div class="accordion-content px-5 text-white/60">
                        <p class="pb-5">
                            Al's combines Caribbean culture, international entertainment, restaurant food,
                            dancing, and four exclusive VIP sections in Margate, welcoming guests from all nationalities
                            and backgrounds.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection