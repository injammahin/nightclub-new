@extends('layouts.app')

@section('title', "Reservations | Al's Night Club")

@section('meta_description', "Reserve VIP sections, birthday celebrations, promoter bookings, and special events at Al's Night Club in Margate, FL. A Caribbean and international nightlife destination welcoming all nationalities, cultures, and backgrounds.")

@section('content')

    <section class="relative min-h-[76vh] flex items-center overflow-hidden thin-grid">
        <img class="absolute inset-0 w-full h-full object-cover opacity-55"
            src="https://images.unsplash.com/photo-1566737236500-c8ac43014a67?auto=format&fit=crop&w=1800&q=85"
            alt="VIP nightclub lounge">

        <div class="absolute inset-0 video-overlay"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 pt-28">
            <p class="reveal text-red-500 uppercase tracking-[.55em] text-xs font-black mb-6">
                VIP Reservations
            </p>

            <h1 class="reveal hero-title font-display text-7xl md:text-[130px] leading-[.82]">
                Book Your<br>
                <span class="text-gradient">VIP Night</span>
            </h1>

            <p class="reveal max-w-3xl mt-8 text-white/70 leading-8">
                Reserve one of four exclusive VIP sections for birthdays, celebrations, promoter nights and special weekend
                events at Al's Night Club. We welcome all nationalities, cultures, and backgrounds for unforgettable
                Caribbean and international nightlife experiences.
            </p>

            <div class="reveal mt-8 flex flex-wrap gap-4">
                <a href="tel:+17865647828" class="btn-red px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                    Promoters & Reservations: 1 (786) 564-7828
                </a>

                <a href="tel:+19548820864" class="btn-line px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                    Call Us Now: 1 (954) 882-0864
                </a>
            </div>
        </div>
    </section>

    <section class="py-28 split-red">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center reveal">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    Reservation Options
                </p>

                <h2 class="font-display text-5xl md:text-7xl mt-4">
                    Choose Your Request
                </h2>

                <p class="text-white/60 mt-5 max-w-3xl mx-auto leading-8">
                    Select the option that matches your night. Whether it is a birthday, VIP night, promoter event,
                    or special celebration, all nationalities and communities are welcome.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-14 stagger">
                <button data-package="VIP Section Reservation" class="package lux-card p-8 text-left active">
                    <p class="text-red-500 text-xs font-black tracking-[.2em]">
                        VIP
                    </p>

                    <h3 class="font-display text-3xl mt-4">
                        VIP Section Reservation
                    </h3>

                    <p class="text-white/58 mt-5 leading-7">
                        Reserve one of four exclusive VIP sections for your group.
                    </p>
                </button>

                <button data-package="Birthday Celebration" class="package lux-card p-8 text-left">
                    <p class="text-red-500 text-xs font-black tracking-[.2em]">
                        CELEBRATION
                    </p>

                    <h3 class="font-display text-3xl mt-4">
                        Birthday Celebration
                    </h3>

                    <p class="text-white/58 mt-5 leading-7">
                        Plan a birthday night with music, food, dancing, VIP service, and a welcoming atmosphere for every
                        community.
                    </p>
                </button>

                <button data-package="Promoter or Artist Inquiry" class="package lux-card p-8 text-left">
                    <p class="text-red-500 text-xs font-black tracking-[.2em]">
                        PROMOTERS
                    </p>

                    <h3 class="font-display text-3xl mt-4">
                        Promoter or Artist Inquiry
                    </h3>

                    <p class="text-white/58 mt-5 leading-7">
                        Contact the team for promoter nights, artist bookings, cultural events, and international event
                        coordination.
                    </p>
                </button>
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-[.85fr_1.15fr] gap-8">
            <aside class="reveal lux-card p-8 md:p-10 h-fit">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    Direct Contact
                </p>

                <h2 class="font-display text-4xl mt-5">
                    Promoters & Reservations
                </h2>

                <a href="tel:+17865647828" class="reservation-phone mt-6">
                    1 (786) 564-7828
                </a>

                <p class="text-white/60 leading-8 mt-5">
                    Use this number for VIP sections, birthdays, promoter inquiries, reservation details,
                    and special event planning for guests of all nationalities and backgrounds.
                </p>

                <div class="mt-8 rounded-xl border border-red-500/30 bg-red-500/10 p-5">
                    <p class="text-sm text-white/70 leading-7">
                        For fastest confirmation, call the reservations team directly after submitting your request.
                    </p>
                </div>

                <div id="bookingSuccess"
                    class="hidden mt-8 border border-red-500/40 bg-red-500/10 p-5 text-sm text-white/75">
                    Thank you. Your reservation details are ready. For fastest confirmation, call 1 (786) 564-7828.
                </div>
            </aside>
            <form id="bookingForm" method="POST" action="{{ route('reservations.store') }}"
                class="reveal lux-card p-8 md:p-10">
                @csrf

                @if (session('reservation_success'))
                    <div class="mb-6 border border-red-500/40 bg-red-500/10 p-5 text-sm text-white/75">
                        {{ session('reservation_success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 border border-red-500/40 bg-red-500/10 p-5 text-sm text-white/75">
                        <strong>Please fix the following:</strong>

                        <ul class="mt-2 list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="hidden" id="selectedPackage" name="selected_package"
                    value="{{ old('selected_package', 'VIP Section Reservation') }}">

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Full Name</label>
                        <input required name="name" value="{{ old('name') }}" class="form-input mt-2"
                            placeholder="Your full name">
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        <input required name="email" type="email" value="{{ old('email') }}" class="form-input mt-2"
                            placeholder="you@example.com">
                    </div>

                    <div>
                        <label class="form-label">Phone</label>
                        <input required name="phone" value="{{ old('phone') }}" class="form-input mt-2"
                            placeholder="Your phone number">
                    </div>

                    <div>
                        <label class="form-label">Event Date</label>
                        <input required name="event_date" type="date" value="{{ old('event_date') }}"
                            class="form-input mt-2">
                    </div>

                    <div>
                        <label class="form-label">Request Type</label>
                        <select name="request_type" class="form-input mt-2">
                            <option {{ old('request_type') == 'VIP Section Reservation' ? 'selected' : '' }}>VIP Section
                                Reservation</option>
                            <option {{ old('request_type') == 'Birthday Celebration' ? 'selected' : '' }}>Birthday Celebration
                            </option>
                            <option {{ old('request_type') == 'Promoter or Artist Inquiry' ? 'selected' : '' }}>Promoter or
                                Artist Inquiry</option>
                            <option {{ old('request_type') == 'Weekend Table Reservation' ? 'selected' : '' }}>Weekend Table
                                Reservation</option>
                            <option {{ old('request_type') == 'General Question' ? 'selected' : '' }}>General Question
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Guests</label>
                        <select name="guests" class="form-input mt-2">
                            <option {{ old('guests') == '2 Guests' ? 'selected' : '' }}>2 Guests</option>
                            <option {{ old('guests') == '4 Guests' ? 'selected' : '' }}>4 Guests</option>
                            <option {{ old('guests') == '6 Guests' ? 'selected' : '' }}>6 Guests</option>
                            <option {{ old('guests') == '8 Guests' ? 'selected' : '' }}>8 Guests</option>
                            <option {{ old('guests') == '10+ Guests' ? 'selected' : '' }}>10+ Guests</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="form-label">Reservation Details</label>

                        <textarea name="message" class="form-input mt-2 min-h-36"
                            placeholder="Birthday, VIP section, promoter request, artist night, guest count, arrival time or special details">{{ old('message') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn-red w-full mt-7 py-5 text-xs font-black uppercase tracking-[.22em]">
                    Submit Reservation Request
                </button>

                <p class="text-center text-white/45 text-xs leading-6 mt-5">
                    For immediate support, call
                    <a class="text-red-400 font-bold" href="tel:+17865647828">1 (786) 564-7828</a>.
                </p>
            </form>
        </div>
    </section>

    <section class="py-24 bg-[#080203]">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-[1.1fr_.9fr] gap-10 items-center">
            <div class="reveal">
                <p class="text-red-500 uppercase tracking-[.4em] text-xs font-bold">
                    Daily Event
                </p>

                <h2 class="font-display text-5xl md:text-7xl mt-4">
                    Happy Hour Before Your VIP Night
                </h2>

                <p class="text-white/65 leading-8 mt-6">
                    Start with Happy Hour, then move into the full Al's Night Club weekend experience with food,
                    music, dancing, Caribbean energy, international vibes, and VIP service.
                </p>

                <a href="{{ route('events') }}"
                    class="btn-line mt-8 px-8 py-4 text-xs font-black uppercase tracking-[.18em]">
                    View Happy Hour
                </a>
            </div>

            <div class="reveal image-frame poster-frame-small">
                <img src="{{ asset('assets/images/happy-hour.webp') }}" alt="Al's Night Club Happy Hour poster"
                    class="w-full h-full object-cover">
            </div>
        </div>
    </section>

@endsection