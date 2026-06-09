@php
    use App\Models\ClubEvent;

    $cards = old('cards', $event->cards ?: ClubEvent::defaultCards());
@endphp

<div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-xl font-black text-slate-950">Event Details</h3>
            <p class="text-sm text-slate-500 mt-1">Manage one public event section.</p>
        </div>

        <button type="submit"
            class="rounded-2xl bg-red-600 px-6 py-3 text-sm font-black uppercase tracking-wider text-white hover:bg-red-700">
            Save Event
        </button>
    </div>

    <div class="mt-6 grid gap-5 lg:grid-cols-2">
        <div class="lg:col-span-2">
            <label class="admin-label">Event Image</label>

            @if($event->image)
                <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                    <img src="{{ ClubEvent::mediaUrl($event->image) }}"
                        class="h-80 w-full object-cover"
                        alt="{{ $event->title }}">
                </div>

                <p class="mb-3 text-xs text-slate-500">
                    Current: {{ $event->image }}
                </p>
            @endif

            <input type="file" name="image" accept="image/*" class="admin-file">
        </div>

        <div>
            <label class="admin-label">Eyebrow</label>
            <input name="eyebrow" value="{{ old('eyebrow', $event->eyebrow) }}" class="admin-input">
        </div>

        <div>
            <label class="admin-label">Title</label>
            <input name="title" value="{{ old('title', $event->title) }}" class="admin-input" required>
        </div>

        <div>
            <label class="admin-label">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $event->sort_order ?? 0) }}" class="admin-input">
        </div>

        <div>
            <label class="admin-label">Status</label>

            <label class="mt-2 flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                <input type="checkbox" name="is_active" value="1"
                    class="rounded border-slate-300 text-red-600 focus:ring-red-600"
                    {{ old('is_active', $event->is_active ?? true) ? 'checked' : '' }}>
                <span class="text-sm font-bold text-slate-700">Published</span>
            </label>
        </div>

        <div class="lg:col-span-2">
            <label class="admin-label">Description</label>
            <textarea name="description" rows="5" class="admin-input">{{ old('description', $event->description) }}</textarea>
        </div>
    </div>
</div>

<div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
    <h3 class="text-xl font-black text-slate-950">Event Info Cards</h3>
    <p class="text-sm text-slate-500 mt-1">These are the small cards like Food, Music, VIP.</p>

    <div class="mt-6 grid gap-4 md:grid-cols-3">
        @for($i = 0; $i < 3; $i++)
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <h4 class="font-black mb-4 text-slate-950">Card {{ $i + 1 }}</h4>

                <label class="admin-label">Title</label>
                <input name="cards[{{ $i }}][title]"
                    value="{{ old("cards.$i.title", $cards[$i]['title'] ?? '') }}"
                    class="admin-input mb-4">

                <label class="admin-label">Text</label>
                <textarea name="cards[{{ $i }}][text]" rows="4" class="admin-input">{{ old("cards.$i.text", $cards[$i]['text'] ?? '') }}</textarea>
            </div>
        @endfor
    </div>
</div>

<div class="rounded-3xl bg-white p-5 sm:p-7 shadow-sm border border-slate-200">
    <h3 class="text-xl font-black text-slate-950">Buttons</h3>

    <div class="mt-6 grid gap-5 lg:grid-cols-2">
        <div>
            <label class="admin-label">Primary Button Text</label>
            <input name="primary_button_text" value="{{ old('primary_button_text', $event->primary_button_text) }}" class="admin-input">
        </div>

        <div>
            <label class="admin-label">Primary Button URL</label>
            <input name="primary_button_url" value="{{ old('primary_button_url', $event->primary_button_url) }}" class="admin-input">
        </div>

        <div>
            <label class="admin-label">Secondary Button Text</label>
            <input name="secondary_button_text" value="{{ old('secondary_button_text', $event->secondary_button_text) }}" class="admin-input">
        </div>

        <div>
            <label class="admin-label">Secondary Button URL</label>
            <input name="secondary_button_url" value="{{ old('secondary_button_url', $event->secondary_button_url) }}" class="admin-input">
        </div>
    </div>
</div>

<div class="sticky bottom-4 z-20 flex justify-end">
    <button type="submit"
        class="rounded-2xl bg-gradient-to-r from-red-600 to-red-900 px-8 py-4 text-sm font-black uppercase tracking-wider text-white shadow-xl shadow-red-900/30 hover:-translate-y-0.5 transition">
        Save Event
    </button>
</div>