@extends('admin.layouts.app')

@php
    use App\Models\EventPageSetting;
@endphp

@section('title', 'Manage Events Hero')
@section('page_title', 'Manage Events Hero')

@section('content')
    <form method="POST" action="{{ route('admin.event-page.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-xl font-black text-slate-950">Events Page SEO</h3>
                    <p class="text-sm text-slate-500 mt-1">Manage events page title and meta description.</p>
                </div>

                <button type="submit"
                    class="rounded-2xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-red-700">
                    Save Hero
                </button>
            </div>

            <div class="mt-6 grid gap-5">
                <div>
                    <label class="admin-label">Meta Title</label>
                    <input name="meta_title" value="{{ old('meta_title', $eventPage->meta_title) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Meta Description</label>
                    <textarea name="meta_description" rows="3"
                        class="admin-input">{{ old('meta_description', $eventPage->meta_description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <h3 class="text-xl font-black text-slate-950">Hero Section</h3>
            <p class="text-sm text-slate-500 mt-1">Only the events hero area will be updated from here.</p>

            <div class="mt-6 grid gap-5 lg:grid-cols-2">
                <div class="lg:col-span-2">
                    <label class="admin-label">Hero Video</label>

                    @if($eventPage->hero_video)
                        <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                            <video class="h-72 w-full object-cover" controls muted playsinline preload="metadata">
                                <source src="{{ EventPageSetting::mediaUrl($eventPage->hero_video) }}" type="video/mp4">
                            </video>
                        </div>

                        <p class="mb-3 text-xs text-slate-500">
                            Current: {{ $eventPage->hero_video }}
                        </p>
                    @endif

                    <input type="file" name="hero_video" accept="video/*" class="admin-file">
                </div>

                <div>
                    <label class="admin-label">Hero Eyebrow</label>
                    <input name="hero_eyebrow" value="{{ old('hero_eyebrow', $eventPage->hero_eyebrow) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Hero Title Top</label>
                    <input name="hero_title_top" value="{{ old('hero_title_top', $eventPage->hero_title_top) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Hero Highlight Title</label>
                    <input name="hero_title_highlight"
                        value="{{ old('hero_title_highlight', $eventPage->hero_title_highlight) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Primary Button Text</label>
                    <input name="hero_primary_button_text"
                        value="{{ old('hero_primary_button_text', $eventPage->hero_primary_button_text) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Primary Button URL</label>
                    <input name="hero_primary_button_url"
                        value="{{ old('hero_primary_button_url', $eventPage->hero_primary_button_url) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Secondary Button Text</label>
                    <input name="hero_secondary_button_text"
                        value="{{ old('hero_secondary_button_text', $eventPage->hero_secondary_button_text) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Secondary Button URL</label>
                    <input name="hero_secondary_button_url"
                        value="{{ old('hero_secondary_button_url', $eventPage->hero_secondary_button_url) }}"
                        class="admin-input">
                </div>

                <div class="lg:col-span-2">
                    <label class="admin-label">Hero Description</label>
                    <textarea name="hero_description" rows="5"
                        class="admin-input">{{ old('hero_description', $eventPage->hero_description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="sticky bottom-4 z-20 flex justify-end">
            <button type="submit"
                class="rounded-2xl bg-gradient-to-r from-red-600 to-red-900 px-8 py-4 text-sm font-black uppercase tracking-wider text-white shadow-xl shadow-red-900/30 hover:-translate-y-0.5 transition">
                Save Events Hero
            </button>
        </div>
    </form>
@endsection