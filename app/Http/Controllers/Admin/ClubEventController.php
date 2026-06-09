<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClubEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClubEventController extends Controller
{
    public function index()
    {
        $events = ClubEvent::orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.club-events.index', compact('events'));
    }

    public function create()
    {
        $event = new ClubEvent([
            'cards' => ClubEvent::defaultCards(),
            'primary_button_text' => 'Call Us Now',
            'primary_button_url' => 'tel:+19548820864',
            'secondary_button_text' => 'Reserve VIP',
            'secondary_button_url' => '/reservations',
            'is_active' => true,
            'sort_order' => 0,
        ]);

        return view('admin.club-events.create', compact('event'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events/images', 'public');
        }

        $data['cards'] = $this->cardsFromRequest($request);
        $data['is_active'] = $request->boolean('is_active');

        ClubEvent::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit(ClubEvent $event)
    {
        return view('admin.club-events.edit', compact('event'));
    }

    public function update(Request $request, ClubEvent $event)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            if ($event->image && !str_starts_with($event->image, 'assets/') && !str_starts_with($event->image, 'http')) {
                Storage::disk('public')->delete($event->image);
            }

            $data['image'] = $request->file('image')->store('events/images', 'public');
        }

        $data['cards'] = $this->cardsFromRequest($request);
        $data['is_active'] = $request->boolean('is_active');

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(ClubEvent $event)
    {
        if ($event->image && !str_starts_with($event->image, 'assets/') && !str_starts_with($event->image, 'http')) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function toggle(ClubEvent $event)
    {
        $event->update([
            'is_active' => !$event->is_active,
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', $event->is_active ? 'Event published successfully.' : 'Event paused successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'primary_button_text' => ['nullable', 'string', 'max:255'],
            'primary_button_url' => ['nullable', 'string', 'max:255'],
            'secondary_button_text' => ['nullable', 'string', 'max:255'],
            'secondary_button_url' => ['nullable', 'string', 'max:255'],

            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function cardsFromRequest(Request $request): array
    {
        $cards = [];

        for ($i = 0; $i < 3; $i++) {
            $cards[] = [
                'title' => $request->input("cards.{$i}.title"),
                'text' => $request->input("cards.{$i}.text"),
            ];
        }

        return $cards;
    }
}