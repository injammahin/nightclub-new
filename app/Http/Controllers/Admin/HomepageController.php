<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function edit()
    {
        $home = HomepageSetting::current();

        return view('admin.homepage.edit', compact('home'));
    }

    public function update(Request $request)
    {
        $home = HomepageSetting::current();

        $data = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],

            'hero_video' => ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:102400'],
            'hero_poster' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'hero_eyebrow' => ['nullable', 'string', 'max:255'],
            'hero_title_top' => ['nullable', 'string', 'max:255'],
            'hero_title_highlight' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'hero_primary_button_text' => ['nullable', 'string', 'max:255'],
            'hero_primary_button_url' => ['nullable', 'string', 'max:255'],
            'hero_secondary_button_text' => ['nullable', 'string', 'max:255'],
            'hero_secondary_button_url' => ['nullable', 'string', 'max:255'],

            'call_label' => ['nullable', 'string', 'max:255'],
            'call_phone' => ['nullable', 'string', 'max:255'],
            'call_phone_link' => ['nullable', 'string', 'max:255'],

            'marquee_text' => ['nullable', 'string'],

            'happy_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'happy_eyebrow' => ['nullable', 'string', 'max:255'],
            'happy_title' => ['nullable', 'string', 'max:255'],
            'happy_description' => ['nullable', 'string'],

            'why_eyebrow' => ['nullable', 'string', 'max:255'],
            'why_title' => ['nullable', 'string', 'max:255'],
            'why_description' => ['nullable', 'string'],
            'why_image' => ['nullable', 'string', 'max:1000'],

            'entertainment_eyebrow' => ['nullable', 'string', 'max:255'],
            'entertainment_title' => ['nullable', 'string', 'max:255'],
            'entertainment_description' => ['nullable', 'string'],

            'contact_eyebrow' => ['nullable', 'string', 'max:255'],
            'contact_title' => ['nullable', 'string', 'max:255'],
            'contact_description' => ['nullable', 'string'],
            'contact_button_text' => ['nullable', 'string', 'max:255'],
            'contact_button_url' => ['nullable', 'string', 'max:255'],
            'contact_secondary_button_text' => ['nullable', 'string', 'max:255'],
            'contact_secondary_button_url' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('hero_video')) {
            $data['hero_video'] = $this->replaceFile($home->hero_video, $request->file('hero_video'), 'homepage/videos');
        }

        if ($request->hasFile('hero_poster')) {
            $data['hero_poster'] = $this->replaceFile($home->hero_poster, $request->file('hero_poster'), 'homepage/images');
        }

        if ($request->hasFile('happy_image')) {
            $data['happy_image'] = $this->replaceFile($home->happy_image, $request->file('happy_image'), 'homepage/images');
        }

        $data['happy_cards'] = $this->cardsFromRequest($request, 'happy_cards', 4);
        $data['why_cards'] = $this->cardsFromRequest($request, 'why_cards', 4);
        $data['entertainment_cards'] = $this->entertainmentCardsFromRequest($request);

        $home->update($data);

        return redirect()
            ->route('admin.homepage.edit')
            ->with('success', 'Home page updated successfully.');
    }

    private function replaceFile(?string $oldPath, $file, string $folder): string
    {
        if ($oldPath && !str_starts_with($oldPath, 'assets/') && !str_starts_with($oldPath, 'http')) {
            Storage::disk('public')->delete($oldPath);
        }

        return $file->store($folder, 'public');
    }

    private function cardsFromRequest(Request $request, string $key, int $limit): array
    {
        $cards = [];

        for ($i = 0; $i < $limit; $i++) {
            $title = $request->input("{$key}.{$i}.title");
            $text = $request->input("{$key}.{$i}.text");

            $cards[] = [
                'title' => $title,
                'text' => $text,
            ];
        }

        return $cards;
    }

    private function entertainmentCardsFromRequest(Request $request): array
    {
        $cards = [];

        for ($i = 0; $i < 3; $i++) {
            $cards[] = [
                'image' => $request->input("entertainment_cards.{$i}.image"),
                'label' => $request->input("entertainment_cards.{$i}.label"),
                'title' => $request->input("entertainment_cards.{$i}.title"),
                'text' => $request->input("entertainment_cards.{$i}.text"),
            ];
        }

        return $cards;
    }
}