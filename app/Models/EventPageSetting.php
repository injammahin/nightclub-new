<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPageSetting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'hero_video',
        'hero_eyebrow',
        'hero_title_top',
        'hero_title_highlight',
        'hero_description',
        'hero_primary_button_text',
        'hero_primary_button_url',
        'hero_secondary_button_text',
        'hero_secondary_button_url',
    ];

    public static function current(): self
    {
        return self::first() ?? self::create(self::defaultData());
    }

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

    public static function defaultData(): array
    {
        return [
            'meta_title' => "Events | Al's Night Club | Caribbean & International Nightlife",
            'meta_description' => "Events at Al's Night Club in Margate, FL, including Daily Happy Hour, live entertainment, DJs, dancing, Caribbean music, international vibes, VIP celebrations, and a welcoming atmosphere for all nationalities.",

            'hero_video' => 'assets/video/1000796573.mp4',
            'hero_eyebrow' => "Al's Night Club Events",
            'hero_title_top' => 'Daily Happy Hour',
            'hero_title_highlight' => 'Weekend Performances',
            'hero_description' => "Food, music, dancing, live entertainment, Caribbean music, international vibes, VIP sections and the weekend energy that makes Al's Night Club the place to be for all nationalities.",

            'hero_primary_button_text' => 'Call Us Now',
            'hero_primary_button_url' => 'tel:+19548820864',
            'hero_secondary_button_text' => 'Reserve VIP',
            'hero_secondary_button_url' => '/reservations',
        ];
    }
}