<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventPageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventPageController extends Controller
{
    public function edit()
    {
        $eventPage = EventPageSetting::current();

        return view('admin.event-page.edit', compact('eventPage'));
    }

    public function update(Request $request)
    {
        $eventPage = EventPageSetting::current();

        $data = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],

            'hero_video' => ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:102400'],
            'hero_eyebrow' => ['nullable', 'string', 'max:255'],
            'hero_title_top' => ['nullable', 'string', 'max:255'],
            'hero_title_highlight' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],

            'hero_primary_button_text' => ['nullable', 'string', 'max:255'],
            'hero_primary_button_url' => ['nullable', 'string', 'max:255'],
            'hero_secondary_button_text' => ['nullable', 'string', 'max:255'],
            'hero_secondary_button_url' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('hero_video')) {
            $data['hero_video'] = $this->replaceFile(
                $eventPage->hero_video,
                $request->file('hero_video'),
                'events/hero'
            );
        }

        $eventPage->update($data);

        return redirect()
            ->route('admin.event-page.edit')
            ->with('success', 'Event page hero updated successfully.');
    }

    private function replaceFile(?string $oldPath, $file, string $folder): string
    {
        if ($oldPath && !str_starts_with($oldPath, 'assets/') && !str_starts_with($oldPath, 'http')) {
            Storage::disk('public')->delete($oldPath);
        }

        return $file->store($folder, 'public');
    }
}