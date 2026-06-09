@extends('admin.layouts.app')

@php
    use App\Models\HomepageSetting;
@endphp

@section('title', 'Manage Home Page')
@section('page_title', 'Manage Home Page')

@section('content')
    <form method="POST" action="{{ route('admin.homepage.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-xl font-black text-slate-950">SEO Settings</h3>
                    <p class="text-sm text-slate-500 mt-1">Manage homepage title and description.</p>
                </div>

                <button type="submit"
                    class="rounded-2xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-red-700">
                    Save Changes
                </button>
            </div>

            <div class="mt-6 grid gap-5">
                <div>
                    <label class="admin-label">Meta Title</label>
                    <input name="meta_title" value="{{ old('meta_title', $home->meta_title) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Meta Description</label>
                    <textarea name="meta_description" rows="3"
                        class="admin-input">{{ old('meta_description', $home->meta_description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <h3 class="text-xl font-black text-slate-950">Hero Section</h3>
            <p class="text-sm text-slate-500 mt-1">Update hero video, title, text, buttons and call box.</p>

            <div class="mt-6 grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="admin-label">Hero Video</label>

                    @if($home->hero_video)
                        <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                            <video class="h-56 w-full object-cover" controls muted playsinline preload="metadata">
                                <source src="{{ HomepageSetting::mediaUrl($home->hero_video) }}" type="video/mp4">
                            </video>
                        </div>
                        <p class="mb-3 text-xs text-slate-500">
                            Current: {{ $home->hero_video }}
                        </p>
                    @endif

                    <input type="file" name="hero_video" accept="video/*" class="admin-file">
                </div>

                <div>
                    <label class="admin-label">Hero Poster Image</label>

                    @if($home->hero_poster)
                        <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                            <img src="{{ HomepageSetting::mediaUrl($home->hero_poster) }}" class="h-56 w-full object-cover"
                                alt="Hero poster preview">
                        </div>
                        <p class="mb-3 text-xs text-slate-500">
                            Current: {{ $home->hero_poster }}
                        </p>
                    @endif

                    <input type="file" name="hero_poster" accept="image/*" class="admin-file">
                </div>

                <div>
                    <label class="admin-label">Hero Eyebrow</label>
                    <input name="hero_eyebrow" value="{{ old('hero_eyebrow', $home->hero_eyebrow) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Hero Title Top</label>
                    <input name="hero_title_top" value="{{ old('hero_title_top', $home->hero_title_top) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Hero Highlight Title</label>
                    <input name="hero_title_highlight"
                        value="{{ old('hero_title_highlight', $home->hero_title_highlight) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Call Label</label>
                    <input name="call_label" value="{{ old('call_label', $home->call_label) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Call Phone</label>
                    <input name="call_phone" value="{{ old('call_phone', $home->call_phone) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Call Phone Link</label>
                    <input name="call_phone_link" value="{{ old('call_phone_link', $home->call_phone_link) }}"
                        class="admin-input">
                </div>

                <div class="lg:col-span-2">
                    <label class="admin-label">Hero Description</label>
                    <textarea name="hero_description" rows="5"
                        class="admin-input">{{ old('hero_description', $home->hero_description) }}</textarea>
                </div>

                <div>
                    <label class="admin-label">Primary Button Text</label>
                    <input name="hero_primary_button_text"
                        value="{{ old('hero_primary_button_text', $home->hero_primary_button_text) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Primary Button URL</label>
                    <input name="hero_primary_button_url"
                        value="{{ old('hero_primary_button_url', $home->hero_primary_button_url) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Secondary Button Text</label>
                    <input name="hero_secondary_button_text"
                        value="{{ old('hero_secondary_button_text', $home->hero_secondary_button_text) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Secondary Button URL</label>
                    <input name="hero_secondary_button_url"
                        value="{{ old('hero_secondary_button_url', $home->hero_secondary_button_url) }}"
                        class="admin-input">
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <h3 class="text-xl font-black text-slate-950">Marquee</h3>

            <div class="mt-6">
                <label class="admin-label">Marquee Text</label>
                <textarea name="marquee_text" rows="3"
                    class="admin-input">{{ old('marquee_text', $home->marquee_text) }}</textarea>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <h3 class="text-xl font-black text-slate-950">Happy Hour Section</h3>

            <div class="mt-6 grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="admin-label">Happy Hour Image</label>

                    @if($home->happy_image)
                        <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                            <img src="{{ HomepageSetting::mediaUrl($home->happy_image) }}" class="h-64 w-full object-cover"
                                alt="Happy hour preview">
                        </div>
                        <p class="mb-3 text-xs text-slate-500">
                            Current: {{ $home->happy_image }}
                        </p>
                    @endif

                    <input type="file" name="happy_image" accept="image/*" class="admin-file">
                </div>

                <div>
                    <label class="admin-label">Eyebrow</label>
                    <input name="happy_eyebrow" value="{{ old('happy_eyebrow', $home->happy_eyebrow) }}"
                        class="admin-input">

                    <div class="mt-5">
                        <label class="admin-label">Title</label>
                        <input name="happy_title" value="{{ old('happy_title', $home->happy_title) }}" class="admin-input">
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label class="admin-label">Description</label>
                    <textarea name="happy_description" rows="4"
                        class="admin-input">{{ old('happy_description', $home->happy_description) }}</textarea>
                </div>
            </div>

            <div class="mt-7 grid gap-4 md:grid-cols-2">
                @foreach(($home->happy_cards ?? []) as $index => $card)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <h4 class="font-black mb-4 text-slate-950">Card {{ $index + 1 }}</h4>

                        <label class="admin-label">Title</label>
                        <input name="happy_cards[{{ $index }}][title]"
                            value="{{ old("happy_cards.$index.title", $card['title'] ?? '') }}" class="admin-input mb-4">

                        <label class="admin-label">Text</label>
                        <textarea name="happy_cards[{{ $index }}][text]" rows="3"
                            class="admin-input">{{ old("happy_cards.$index.text", $card['text'] ?? '') }}</textarea>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <h3 class="text-xl font-black text-slate-950">Why Al's Section</h3>

            <div class="mt-6 grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="admin-label">Eyebrow</label>
                    <input name="why_eyebrow" value="{{ old('why_eyebrow', $home->why_eyebrow) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Title</label>
                    <input name="why_title" value="{{ old('why_title', $home->why_title) }}" class="admin-input">
                </div>

                <div class="lg:col-span-2">
                    <label class="admin-label">Description</label>
                    <textarea name="why_description" rows="4"
                        class="admin-input">{{ old('why_description', $home->why_description) }}</textarea>
                </div>

                <div class="lg:col-span-2">
                    <label class="admin-label">Right Side Image URL</label>

                    @if($home->why_image)
                        <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                            <img src="{{ HomepageSetting::mediaUrl($home->why_image) }}" class="h-72 w-full object-cover"
                                alt="Why section preview">
                        </div>
                    @endif

                    <input name="why_image" value="{{ old('why_image', $home->why_image) }}" class="admin-input">
                </div>
            </div>

            <div class="mt-7 grid gap-4 md:grid-cols-2">
                @foreach(($home->why_cards ?? []) as $index => $card)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <h4 class="font-black mb-4 text-slate-950">Card {{ $index + 1 }}</h4>

                        <label class="admin-label">Title</label>
                        <input name="why_cards[{{ $index }}][title]"
                            value="{{ old("why_cards.$index.title", $card['title'] ?? '') }}" class="admin-input mb-4">

                        <label class="admin-label">Text</label>
                        <textarea name="why_cards[{{ $index }}][text]" rows="3"
                            class="admin-input">{{ old("why_cards.$index.text", $card['text'] ?? '') }}</textarea>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <h3 class="text-xl font-black text-slate-950">Entertainment Cards</h3>

            <div class="mt-7 grid gap-4">
                @foreach(($home->entertainment_cards ?? []) as $index => $card)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <h4 class="font-black mb-4 text-slate-950">Entertainment Card {{ $index + 1 }}</h4>

                        @if(!empty($card['image']))
                            <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                                <img src="{{ HomepageSetting::mediaUrl($card['image']) }}" class="h-56 w-full object-cover"
                                    alt="{{ $card['title'] ?? 'Entertainment card preview' }}">
                            </div>
                        @endif

                        <div class="grid gap-4 lg:grid-cols-2">
                            <div>
                                <label class="admin-label">Image URL</label>
                                <input name="entertainment_cards[{{ $index }}][image]"
                                    value="{{ old("entertainment_cards.$index.image", $card['image'] ?? '') }}"
                                    class="admin-input">
                            </div>

                            <div>
                                <label class="admin-label">Label</label>
                                <input name="entertainment_cards[{{ $index }}][label]"
                                    value="{{ old("entertainment_cards.$index.label", $card['label'] ?? '') }}"
                                    class="admin-input">
                            </div>

                            <div>
                                <label class="admin-label">Title</label>
                                <input name="entertainment_cards[{{ $index }}][title]"
                                    value="{{ old("entertainment_cards.$index.title", $card['title'] ?? '') }}"
                                    class="admin-input">
                            </div>

                            <div>
                                <label class="admin-label">Text</label>
                                <textarea name="entertainment_cards[{{ $index }}][text]" rows="3"
                                    class="admin-input">{{ old("entertainment_cards.$index.text", $card['text'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <h3 class="text-xl font-black text-slate-950">Contact Strip</h3>

            <div class="mt-6 grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="admin-label">Eyebrow</label>
                    <input name="contact_eyebrow" value="{{ old('contact_eyebrow', $home->contact_eyebrow) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Title</label>
                    <input name="contact_title" value="{{ old('contact_title', $home->contact_title) }}"
                        class="admin-input">
                </div>

                <div class="lg:col-span-2">
                    <label class="admin-label">Description</label>
                    <textarea name="contact_description" rows="3"
                        class="admin-input">{{ old('contact_description', $home->contact_description) }}</textarea>
                </div>

                <div>
                    <label class="admin-label">Button Text</label>
                    <input name="contact_button_text" value="{{ old('contact_button_text', $home->contact_button_text) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Button URL</label>
                    <input name="contact_button_url" value="{{ old('contact_button_url', $home->contact_button_url) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Secondary Button Text</label>
                    <input name="contact_secondary_button_text"
                        value="{{ old('contact_secondary_button_text', $home->contact_secondary_button_text) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Secondary Button URL</label>
                    <input name="contact_secondary_button_url"
                        value="{{ old('contact_secondary_button_url', $home->contact_secondary_button_url) }}"
                        class="admin-input">
                </div>
            </div>
        </div>

        <div class="sticky bottom-4 z-20 flex justify-end">
            <button type="submit"
                class="rounded-2xl bg-gradient-to-r from-red-600 to-red-900 px-8 py-4 text-sm font-black uppercase tracking-wider text-white shadow-xl shadow-red-900/30 hover:-translate-y-0.5 transition">
                Save Home Page
            </button>
        </div>
    </form>
@endsection