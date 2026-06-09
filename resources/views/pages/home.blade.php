@extends('layouts.app')

@section('title', $home->meta_title)

@section('meta_description', $home->meta_description)

@section('content')

<section class="relative min-h-screen flex items-center justify-center overflow-hidden thin-grid">
    <video id="heroVideo" class="hero-video absolute inset-0 w-full h-full opacity-80" autoplay muted loop playsinline
        preload="auto" poster="{{ \App\Models\HomepageSetting::mediaUrl($home->hero_poster) }}">
        <source src="{{ \App\Models\HomepageSetting::mediaUrl($home->hero_video) }}" type="video/mp4">
    </video>

    <div class="absolute inset-0 video-overlay"></div>

    <div class="hero-action-stack">
        <a href="{{ $home->call_phone_link }}" class="call-now-box">
            <span>{{ $home->call_label }}</span>
            <strong>{{ $home->call_phone }}</strong>
        </a>

        <button data-sound class="sound-toggle">Enable Sound</button>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center pt-24">
        <p class="reveal text-red-500 uppercase tracking-[.45em] text-xs font-black mb-7">
            {{ $home->hero_eyebrow }}
        </p>

        <h1 class="reveal hero-title font-display text-[70px] md:text-[22px] lg:text-[50px] leading-[.78] font-black">
            {{ $home->hero_title_top }}<br>
            <span class="text-gradient">{{ $home->hero_title_highlight }}</span>
        </h1>

        <p class="reveal max-w-4xl mx-auto mt-9 text-lg md:text-xl text-white/76 leading-8">
            {{ $home->hero_description }}
        </p>

        <div class="reveal mt-11 mb-12 flex flex-wrap justify-center gap-4">
            <a href="{{ url($home->hero_primary_button_url) }}"
                class="btn-red px-9 py-4 text-xs font-black uppercase tracking-[.18em]">
                {{ $home->hero_primary_button_text }}
            </a>

            <a href="{{ url($home->hero_secondary_button_url) }}"
                class="btn-line px-9 py-4 text-xs font-black uppercase tracking-[.18em]">
                {{ $home->hero_secondary_button_text }}
            </a>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/45 animate-bounce">
        ↓
    </div>
</section>

<div class="marquee">
    <span>{{ $home->marquee_text }}</span>
    <span>{{ $home->marquee_text }}</span>
</div>

<section id="daily-happy-hour" class="py-24 split-red">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-[.95fr_1.05fr] gap-10 items-center">
            <div class="reveal image-frame poster-frame">
                <img src="{{ \App\Models\HomepageSetting::mediaUrl($home->happy_image) }}"
                    alt="{{ $home->happy_title }}"
                    class="w-full h-full object-cover">
            </div>

            <div class="reveal">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    {{ $home->happy_eyebrow }}
                </p>

                <h2 class="font-display text-5xl md:text-7xl mt-5 leading-tight">
                    {{ $home->happy_title }}
                </h2>

                <p class="text-white/70 leading-8 mt-6 text-lg">
                    {{ $home->happy_description }}
                </p>

                <div class="grid sm:grid-cols-2 gap-4 mt-8">
                    @foreach(($home->happy_cards ?? []) as $card)
                        <div class="lux-card p-5">
                            <b>{{ $card['title'] ?? '' }}</b>
                            <p class="text-white/55 text-sm mt-2">
                                {{ $card['text'] ?? '' }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-9 flex flex-wrap gap-4">
                    <a href="{{ $home->call_phone_link }}" class="btn-red px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                        Call {{ $home->call_phone }}
                    </a>

                    <a href="{{ route('reservations') }}"
                        class="btn-line px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                        Reserve Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-[#070203]">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div class="reveal">
            <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                {{ $home->why_eyebrow }}
            </p>

            <h2 class="font-display text-5xl md:text-7xl mt-5 leading-tight">
                {{ $home->why_title }}
            </h2>

            <p class="text-white/65 leading-8 mt-6">
                {{ $home->why_description }}
            </p>

            <div class="grid sm:grid-cols-2 gap-4 mt-8">
                @foreach(($home->why_cards ?? []) as $card)
                    <div class="lux-card p-5">
                        <b>{{ $card['title'] ?? '' }}</b>
                        <p class="text-white/50 text-sm mt-2">
                            {{ $card['text'] ?? '' }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="image-frame reveal parallax" data-speed="-.025">
            <img src="{{ \App\Models\HomepageSetting::mediaUrl($home->why_image) }}"
                class="w-full h-[620px] object-cover" alt="{{ $home->why_title }}">
        </div>
    </div>
</section>

<section class="py-28">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-[.9fr_1.1fr] gap-8 items-end">
            <div class="reveal">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    {{ $home->entertainment_eyebrow }}
                </p>

                <h2 class="font-display text-5xl md:text-7xl mt-4">
                    {{ $home->entertainment_title }}
                </h2>
            </div>

            <p class="reveal text-white/60 leading-8 max-w-2xl">
                {{ $home->entertainment_description }}
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-14 stagger">
            @foreach(($home->entertainment_cards ?? []) as $card)
                <article class="image-frame">
                    <img src="{{ \App\Models\HomepageSetting::mediaUrl($card['image'] ?? '') }}"
                        class="h-80 w-full object-cover" alt="{{ $card['title'] ?? '' }}">

                    <div class="p-6">
                        <p class="text-red-500 text-xs font-bold">
                            {{ $card['label'] ?? '' }}
                        </p>

                        <h3 class="font-display text-3xl mt-2">
                            {{ $card['title'] ?? '' }}
                        </h3>

                        <p class="text-white/55 mt-3 text-sm leading-6">
                            {{ $card['text'] ?? '' }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="py-24 bg-[#080203]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="contact-strip reveal">
            <div>
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    {{ $home->contact_eyebrow }}
                </p>

                <h2 class="font-display text-4xl md:text-6xl mt-4">
                    {{ $home->contact_title }}
                </h2>

                <p class="text-white/60 leading-8 mt-5 max-w-3xl">
                    {{ $home->contact_description }}
                </p>
            </div>

            <div class="contact-actions">
                <a href="{{ $home->contact_button_url }}" class="btn-red px-8 py-4 text-sm font-black uppercase tracking-[.14em]">
                    {{ $home->contact_button_text }}
                </a>

                <a href="{{ url($home->contact_secondary_button_url) }}"
                    class="btn-line px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                    {{ $home->contact_secondary_button_text }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection