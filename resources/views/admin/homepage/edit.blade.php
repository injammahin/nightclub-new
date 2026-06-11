@extends('admin.layouts.app')

@php
    use App\Models\HomepageSetting;

    $happyCards = old('happy_cards', $home->happy_cards ?? []);
    $whyCards = old('why_cards', $home->why_cards ?? []);

    $storedEntertainmentCards = $home->entertainment_cards ?? [];
    $formEntertainmentCards = old('entertainment_cards', $storedEntertainmentCards);

    $isUrl = function (?string $path): bool {
        return $path && (str_starts_with($path, 'http://') || str_starts_with($path, 'https://'));
    };

    $isUploadedPath = function (?string $path): bool {
        return $path
            && !str_starts_with($path, 'http://')
            && !str_starts_with($path, 'https://')
            && !str_starts_with($path, 'assets/');
    };

    $urlInputValue = function (?string $path) use ($isUrl): string {
        return $isUrl($path) ? $path : '';
    };
@endphp

@section('title', 'Manage Home Page')
@section('page_title', 'Manage Home Page')

@section('content')
    <form method="POST" action="{{ route('admin.homepage.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        @if ($errors->any())
            <div class="rounded-3xl border border-red-200 bg-red-50 p-5 text-red-800">
                <div class="flex items-start gap-3">
                    <div
                        class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-red-100 text-lg font-black text-red-700">
                        !
                    </div>

                    <div>
                        <h3 class="text-base font-black">Please fix the following errors</h3>

                        <ul class="mt-3 list-disc space-y-1 pl-5 text-sm font-semibold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="rounded-3xl border border-green-200 bg-green-50 p-5 text-green-800">
                <p class="text-sm font-black">{{ session('success') }}</p>
            </div>
        @endif

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
                    <input name="meta_title" value="{{ old('meta_title', $home->meta_title) }}"
                        class="admin-input @error('meta_title') border-red-400 ring-2 ring-red-100 @enderror">

                    @error('meta_title')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="admin-label">Meta Description</label>
                    <textarea name="meta_description" rows="3"
                        class="admin-input @error('meta_description') border-red-400 ring-2 ring-red-100 @enderror">{{ old('meta_description', $home->meta_description) }}</textarea>

                    @error('meta_description')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
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

                        <p class="mb-3 break-all text-xs text-slate-500">
                            Current: {{ $home->hero_video }}
                        </p>
                    @endif

                    <input type="file" name="hero_video" accept=".mp4,.webm,.ogg"
                        class="admin-file @error('hero_video') border-red-400 ring-2 ring-red-100 @enderror">

                    @error('hero_video')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="admin-label">Hero Poster Image</label>

                    @if($home->hero_poster)
                        <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                            <img src="{{ HomepageSetting::mediaUrl($home->hero_poster) }}" class="h-56 w-full object-cover"
                                alt="Hero poster preview">
                        </div>

                        <p class="mb-3 break-all text-xs text-slate-500">
                            Current: {{ $home->hero_poster }}
                        </p>
                    @endif

                    <input type="file" name="hero_poster" accept=".jpg,.jpeg,.png,.webp,.avif"
                        class="admin-file @error('hero_poster') border-red-400 ring-2 ring-red-100 @enderror">

                    @error('hero_poster')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
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

                        <p class="mb-3 break-all text-xs text-slate-500">
                            Current: {{ $home->happy_image }}
                        </p>
                    @endif

                    <input type="file" name="happy_image" accept=".jpg,.jpeg,.png,.webp,.avif"
                        class="admin-file @error('happy_image') border-red-400 ring-2 ring-red-100 @enderror">

                    @error('happy_image')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
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
                @for($index = 0; $index < 4; $index++)
                    @php
                        $card = $happyCards[$index] ?? [];
                    @endphp

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <h4 class="font-black mb-4 text-slate-950">Card {{ $index + 1 }}</h4>

                        <label class="admin-label">Title</label>
                        <input name="happy_cards[{{ $index }}][title]"
                            value="{{ old("happy_cards.$index.title", $card['title'] ?? '') }}" class="admin-input mb-4">

                        <label class="admin-label">Text</label>
                        <textarea name="happy_cards[{{ $index }}][text]" rows="3"
                            class="admin-input">{{ old("happy_cards.$index.text", $card['text'] ?? '') }}</textarea>
                    </div>
                @endfor
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
                    <label class="admin-label">Right Side Image</label>

                    @if($home->why_image)
                        <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                            <img src="{{ HomepageSetting::mediaUrl($home->why_image) }}" class="h-72 w-full object-cover"
                                alt="Why section preview">
                        </div>

                        @if($isUrl($home->why_image))
                            <p class="mb-3 break-all text-xs text-slate-500">
                                Current URL: {{ $home->why_image }}
                            </p>
                        @elseif($isUploadedPath($home->why_image))
                            <p class="mb-3 break-all text-xs text-slate-500">
                                Current uploaded file: {{ $home->why_image }}
                            </p>
                        @else
                            <p class="mb-3 break-all text-xs text-slate-500">
                                Current asset: {{ $home->why_image }}
                            </p>
                        @endif
                    @endif

                    <div class="grid gap-4 lg:grid-cols-2">
                        <div>
                            <label class="admin-label">Image URL</label>
                            <input name="why_image" value="{{ old('why_image', $urlInputValue($home->why_image)) }}"
                                class="admin-input @error('why_image') border-red-400 ring-2 ring-red-100 @enderror"
                                placeholder="https://example.com/image.jpg">

                            <p class="mt-2 text-xs text-slate-500">
                                Only external image URLs should be entered here. Uploaded file paths will not show in this
                                field.
                            </p>

                            @error('why_image')
                                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="admin-label">Or Upload New Image</label>
                            <input type="file" name="why_image_file" accept=".jpg,.jpeg,.png,.webp,.avif"
                                class="admin-file @error('why_image_file') border-red-400 ring-2 ring-red-100 @enderror">

                            <p class="mt-2 text-xs text-slate-500">
                                Uploading a file will replace the current image.
                            </p>

                            @error('why_image_file')
                                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-7 grid gap-4 md:grid-cols-2">
                @for($index = 0; $index < 4; $index++)
                    @php
                        $card = $whyCards[$index] ?? [];
                    @endphp

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <h4 class="font-black mb-4 text-slate-950">Card {{ $index + 1 }}</h4>

                        <label class="admin-label">Title</label>
                        <input name="why_cards[{{ $index }}][title]"
                            value="{{ old("why_cards.$index.title", $card['title'] ?? '') }}" class="admin-input mb-4">

                        <label class="admin-label">Text</label>
                        <textarea name="why_cards[{{ $index }}][text]" rows="3"
                            class="admin-input">{{ old("why_cards.$index.text", $card['text'] ?? '') }}</textarea>
                    </div>
                @endfor
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
            <h3 class="text-xl font-black text-slate-950">Entertainment Cards</h3>

            <div class="mt-7 grid gap-4">
                @for($index = 0; $index < 3; $index++)
                    @php
                        $storedCard = $storedEntertainmentCards[$index] ?? [];
                        $card = $formEntertainmentCards[$index] ?? $storedCard;
                    @endphp

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <h4 class="font-black mb-4 text-slate-950">Entertainment Card {{ $index + 1 }}</h4>

                        @if(!empty($storedCard['image']))
                            <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                                <img src="{{ HomepageSetting::mediaUrl($storedCard['image']) }}" class="h-56 w-full object-cover"
                                    alt="{{ $storedCard['title'] ?? 'Entertainment card preview' }}">
                            </div>

                            @if($isUrl($storedCard['image']))
                                <p class="mb-3 break-all text-xs text-slate-500">
                                    Current URL: {{ $storedCard['image'] }}
                                </p>
                            @elseif($isUploadedPath($storedCard['image']))
                                <p class="mb-3 break-all text-xs text-slate-500">
                                    Current uploaded file: {{ $storedCard['image'] }}
                                </p>
                            @else
                                <p class="mb-3 break-all text-xs text-slate-500">
                                    Current asset: {{ $storedCard['image'] }}
                                </p>
                            @endif
                        @endif

                        <div class="grid gap-4 lg:grid-cols-2">
                            <div>
                                <label class="admin-label">Image URL</label>
                                <input name="entertainment_cards[{{ $index }}][image]"
                                    value="{{ old("entertainment_cards.$index.image", $urlInputValue($storedCard['image'] ?? null)) }}"
                                    class="admin-input @error("entertainment_cards.$index.image") border-red-400 ring-2 ring-red-100 @enderror"
                                    placeholder="https://example.com/image.jpg">

                                <p class="mt-2 text-xs text-slate-500">
                                    Only external image URLs should be entered here. Uploaded file paths will not show in this
                                    field.
                                </p>

                                @error("entertainment_cards.$index.image")
                                    <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="admin-label">Or Upload New Image</label>
                                <input type="file" name="entertainment_cards[{{ $index }}][image_file]"
                                    accept=".jpg,.jpeg,.png,.webp,.avif"
                                    class="admin-file @error("entertainment_cards.$index.image_file") border-red-400 ring-2 ring-red-100 @enderror">

                                <p class="mt-2 text-xs text-slate-500">
                                    Uploading a file will replace the current image.
                                </p>

                                @error("entertainment_cards.$index.image_file")
                                    <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                                @enderror
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

                            <div class="lg:col-span-2">
                                <label class="admin-label">Text</label>
                                <textarea name="entertainment_cards[{{ $index }}][text]" rows="3"
                                    class="admin-input">{{ old("entertainment_cards.$index.text", $card['text'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                @endfor
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