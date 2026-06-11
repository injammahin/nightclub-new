<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
            'hero_poster' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:5120'],
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

            'happy_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:5120'],
            'happy_eyebrow' => ['nullable', 'string', 'max:255'],
            'happy_title' => ['nullable', 'string', 'max:255'],
            'happy_description' => ['nullable', 'string'],

            'why_eyebrow' => ['nullable', 'string', 'max:255'],
            'why_title' => ['nullable', 'string', 'max:255'],
            'why_description' => ['nullable', 'string'],

            // URL field only accepts real URLs.
            // Uploaded path will be stored in this same database column,
            // but it will not show in the URL input in Blade.
            'why_image' => ['nullable', 'url', 'max:1000'],
            'why_image_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:5120'],

            'entertainment_eyebrow' => ['nullable', 'string', 'max:255'],
            'entertainment_title' => ['nullable', 'string', 'max:255'],
            'entertainment_description' => ['nullable', 'string'],

            'happy_cards' => ['nullable', 'array'],
            'happy_cards.*.title' => ['nullable', 'string', 'max:255'],
            'happy_cards.*.text' => ['nullable', 'string', 'max:1000'],

            'why_cards' => ['nullable', 'array'],
            'why_cards.*.title' => ['nullable', 'string', 'max:255'],
            'why_cards.*.text' => ['nullable', 'string', 'max:1000'],

            'entertainment_cards' => ['nullable', 'array'],
            'entertainment_cards.*.image' => ['nullable', 'url', 'max:1000'],
            'entertainment_cards.*.image_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:5120'],
            'entertainment_cards.*.label' => ['nullable', 'string', 'max:255'],
            'entertainment_cards.*.title' => ['nullable', 'string', 'max:255'],
            'entertainment_cards.*.text' => ['nullable', 'string', 'max:1000'],

            'contact_eyebrow' => ['nullable', 'string', 'max:255'],
            'contact_title' => ['nullable', 'string', 'max:255'],
            'contact_description' => ['nullable', 'string'],
            'contact_button_text' => ['nullable', 'string', 'max:255'],
            'contact_button_url' => ['nullable', 'string', 'max:255'],
            'contact_secondary_button_text' => ['nullable', 'string', 'max:255'],
            'contact_secondary_button_url' => ['nullable', 'string', 'max:255'],
        ], [
            'hero_video.mimes' => 'Hero video must be MP4, WebM, or OGG.',
            'hero_video.max' => 'Hero video must not be larger than 100MB.',

            'hero_poster.mimes' => 'Hero poster must be JPG, PNG, WebP, or AVIF.',
            'hero_poster.max' => 'Hero poster must not be larger than 5MB.',

            'happy_image.mimes' => 'Happy Hour image must be JPG, PNG, WebP, or AVIF.',
            'happy_image.max' => 'Happy Hour image must not be larger than 5MB.',

            'why_image.url' => 'Why section image URL must be a valid full URL, for example: https://example.com/image.jpg',
            'why_image.max' => 'Why section image URL is too long.',
            'why_image_file.mimes' => 'Why section uploaded image must be JPG, PNG, WebP, or AVIF.',
            'why_image_file.max' => 'Why section uploaded image must not be larger than 5MB.',

            'entertainment_cards.*.image.url' => 'Entertainment card image URL must be a valid full URL, for example: https://example.com/image.jpg',
            'entertainment_cards.*.image.max' => 'Entertainment card image URL is too long.',
            'entertainment_cards.*.image_file.mimes' => 'Entertainment card uploaded image must be JPG, PNG, WebP, or AVIF.',
            'entertainment_cards.*.image_file.max' => 'Entertainment card uploaded image must not be larger than 5MB.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Remove temporary upload fields
        |--------------------------------------------------------------------------
        */
        unset($data['why_image_file']);

        /*
        |--------------------------------------------------------------------------
        | Standard uploads
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('hero_video') && $request->file('hero_video')->isValid()) {
            $data['hero_video'] = $this->storeAndReplaceFile(
                $home->hero_video,
                $request->file('hero_video'),
                'homepage/videos'
            );
        }

        if ($request->hasFile('hero_poster') && $request->file('hero_poster')->isValid()) {
            $data['hero_poster'] = $this->storeAndReplaceFile(
                $home->hero_poster,
                $request->file('hero_poster'),
                'homepage/images'
            );
        }

        if ($request->hasFile('happy_image') && $request->file('happy_image')->isValid()) {
            $data['happy_image'] = $this->storeAndReplaceFile(
                $home->happy_image,
                $request->file('happy_image'),
                'homepage/images'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Why image: URL or uploaded file
        |--------------------------------------------------------------------------
        */
        $data['why_image'] = $this->imageFromUrlOrUpload(
            $request,
            'why_image',
            'why_image_file',
            $home->why_image,
            'homepage/images'
        );

        /*
        |--------------------------------------------------------------------------
        | JSON sections
        |--------------------------------------------------------------------------
        */
        $data['happy_cards'] = $this->cardsFromRequest(
            $request,
            'happy_cards',
            $home->happy_cards ?? [],
            4
        );

        $data['why_cards'] = $this->cardsFromRequest(
            $request,
            'why_cards',
            $home->why_cards ?? [],
            4
        );

        $data['entertainment_cards'] = $this->entertainmentCardsFromRequest($request, $home);

        $home->update($data);

        return redirect()
            ->route('admin.homepage.edit')
            ->with('success', 'Home page updated successfully.');
    }

    private function storeAndReplaceFile(?string $oldPath, UploadedFile $file, string $folder): string
    {
        $newPath = $file->store($folder, 'public');

        if (!$newPath) {
            throw new \RuntimeException('File upload failed. Please try again.');
        }

        if ($this->isUploadedStoragePath($oldPath) && $oldPath !== $newPath) {
            Storage::disk('public')->delete($oldPath);
        }

        return $newPath;
    }

    private function imageFromUrlOrUpload(
        Request $request,
        string $urlInputName,
        string $fileInputName,
        ?string $oldPath,
        string $folder
    ): ?string {
        $file = $request->file($fileInputName);

        /*
        |--------------------------------------------------------------------------
        | Priority 1: uploaded file
        |--------------------------------------------------------------------------
        */
        if ($file instanceof UploadedFile && $file->isValid()) {
            return $this->storeAndReplaceFile($oldPath, $file, $folder);
        }

        /*
        |--------------------------------------------------------------------------
        | Priority 2: external URL
        |--------------------------------------------------------------------------
        */
        if ($request->filled($urlInputName)) {
            $newValue = trim((string) $request->input($urlInputName));

            if ($oldPath && $newValue !== $oldPath && $this->isUploadedStoragePath($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            return $newValue;
        }

        /*
        |--------------------------------------------------------------------------
        | Priority 3: keep old image
        |--------------------------------------------------------------------------
        | Important: uploaded storage paths are not shown inside the URL field.
        | So if URL is blank and no new file uploaded, keep old uploaded image.
        */
        return $oldPath;
    }

    private function isUploadedStoragePath(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        return !str_starts_with($path, 'assets/')
            && !str_starts_with($path, 'http://')
            && !str_starts_with($path, 'https://');
    }

    private function cardsFromRequest(Request $request, string $key, array $existingCards, int $limit): array
    {
        $cards = [];

        for ($i = 0; $i < $limit; $i++) {
            $cards[] = [
                'title' => $request->input("{$key}.{$i}.title", $existingCards[$i]['title'] ?? null),
                'text' => $request->input("{$key}.{$i}.text", $existingCards[$i]['text'] ?? null),
            ];
        }

        return $cards;
    }

    private function entertainmentCardsFromRequest(Request $request, HomepageSetting $home): array
    {
        $cards = [];
        $existingCards = $home->entertainment_cards ?? [];

        for ($i = 0; $i < 3; $i++) {
            $oldCard = $existingCards[$i] ?? [];
            $oldImage = $oldCard['image'] ?? null;

            $newImage = $oldImage;

            /*
            |--------------------------------------------------------------------------
            | Priority 1: uploaded file
            |--------------------------------------------------------------------------
            */
            $file = $request->file("entertainment_cards.{$i}.image_file");

            if ($file instanceof UploadedFile && $file->isValid()) {
                $newImage = $this->storeAndReplaceFile(
                    $oldImage,
                    $file,
                    'homepage/images/entertainment'
                );
            } elseif ($request->filled("entertainment_cards.{$i}.image")) {
                /*
                |--------------------------------------------------------------------------
                | Priority 2: external URL
                |--------------------------------------------------------------------------
                */
                $inputImage = trim((string) $request->input("entertainment_cards.{$i}.image"));

                if ($oldImage && $inputImage !== $oldImage && $this->isUploadedStoragePath($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }

                $newImage = $inputImage;
            }

            $cards[] = [
                'image' => $newImage,
                'label' => $request->input("entertainment_cards.{$i}.label", $oldCard['label'] ?? null),
                'title' => $request->input("entertainment_cards.{$i}.title", $oldCard['title'] ?? null),
                'text' => $request->input("entertainment_cards.{$i}.text", $oldCard['text'] ?? null),
            ];
        }

        return $cards;
    }
}