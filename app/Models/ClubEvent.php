<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubEvent extends Model
{
    protected $fillable = [
        'image',
        'eyebrow',
        'title',
        'description',
        'cards',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'cards' => 'array',
        'is_active' => 'boolean',
    ];

    public static function mediaUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return asset('storage/' . $path);
    }

    public static function defaultCards(): array
    {
        return [
            [
                'title' => 'Food',
                'text' => 'Restaurant experience before the night gets louder.',
            ],
            [
                'title' => 'Music',
                'text' => 'Caribbean music, international vibes, and nightlife atmosphere for everyone.',
            ],
            [
                'title' => 'VIP',
                'text' => 'Sections available for birthdays and celebrations.',
            ],
        ];
    }
}