<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',

        'hero_video',
        'hero_poster',
        'hero_eyebrow',
        'hero_title_top',
        'hero_title_highlight',
        'hero_description',
        'hero_primary_button_text',
        'hero_primary_button_url',
        'hero_secondary_button_text',
        'hero_secondary_button_url',

        'call_label',
        'call_phone',
        'call_phone_link',

        'marquee_text',

        'happy_image',
        'happy_eyebrow',
        'happy_title',
        'happy_description',
        'happy_cards',

        'why_eyebrow',
        'why_title',
        'why_description',
        'why_cards',
        'why_image',

        'entertainment_eyebrow',
        'entertainment_title',
        'entertainment_description',
        'entertainment_cards',

        'contact_eyebrow',
        'contact_title',
        'contact_description',
        'contact_button_text',
        'contact_button_url',
        'contact_secondary_button_text',
        'contact_secondary_button_url',
    ];

    protected $casts = [
        'happy_cards' => 'array',
        'why_cards' => 'array',
        'entertainment_cards' => 'array',
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
            'meta_title' => "Al's Night Club | Caribbean & International Nightlife in Margate",
            'meta_description' => "Al's Night Club is a Caribbean and international nightlife destination in Margate, welcoming all nationalities for live entertainment, restaurant food, DJs, dancing, birthdays, VIP sections, and unforgettable weekend celebrations.",

            'hero_video' => 'assets/video/night.mp4',
            'hero_poster' => 'assets/images/happy-hour.png',
            'hero_eyebrow' => 'Margate • Caribbean Nightlife • International Energy',
            'hero_title_top' => "AL'S",
            'hero_title_highlight' => 'Night Club',
            'hero_description' => "Al's Night Club in Margate is a vibrant Caribbean and international nightlife destination owned by Al Baguidy. We proudly welcome guests of all nationalities, cultures, and backgrounds to enjoy unforgettable nights of live entertainment, DJs, dancing, delicious restaurant food, and VIP celebrations.",
            'hero_primary_button_text' => 'Reserve VIP Section',
            'hero_primary_button_url' => '/reservations',
            'hero_secondary_button_text' => 'View Events',
            'hero_secondary_button_url' => '/events',

            'call_label' => 'Call Us Now',
            'call_phone' => '1 (954) 882-0864',
            'call_phone_link' => 'tel:+19548820864',

            'marquee_text' => 'DAILY HAPPY HOUR • LIVE ENTERTAINMENT • CARIBBEAN MUSIC • INTERNATIONAL VIBES • VIP SECTIONS • RESTAURANT FOOD •',

            'happy_image' => 'assets/images/happy-hour.webp',
            'happy_eyebrow' => 'Featured Daily Event',
            'happy_title' => 'Daily Happy Hour',
            'happy_description' => "Make Happy Hour the start of your night at Al's Night Club. Come for the food, music, drinks, and nightlife energy, then stay for the weekend performances, dancing, and VIP celebrations.",
            'happy_cards' => [
                [
                    'title' => 'Happy Hour Focus',
                    'text' => 'Daily promotion highlighted from the official poster.',
                ],
                [
                    'title' => 'Restaurant Food',
                    'text' => 'Food is available through the restaurant at 181 S State Rd 7, Margate, FL 33068.',
                ],
                [
                    'title' => 'Weekend Energy',
                    'text' => 'Live entertainment, Caribbean music, and international vibes every weekend.',
                ],
                [
                    'title' => 'VIP Sections',
                    'text' => 'Four exclusive sections for birthdays and celebrations.',
                ],
            ],

            'why_eyebrow' => "Why Al's Night Club",
            'why_title' => 'Culture, Food, Music & VIP Nights',
            'why_description' => "Come experience the energy, culture, food, and entertainment that make Al's Night Club one of Margate's most exciting nightlife destinations. Built with Caribbean roots and open to the world, Al's Night Club brings people of all nationalities together for music, dancing, food, and unforgettable celebrations.",
            'why_image' => 'https://images.unsplash.com/photo-1571266028243-d220c6a7edbf?auto=format&fit=crop&w=1300&q=85',
            'why_cards' => [
                [
                    'title' => 'Owned by Al Baguidy',
                    'text' => 'A Caribbean nightlife destination with a welcoming international atmosphere.',
                ],
                [
                    'title' => 'Live Performances',
                    'text' => 'Enjoy Haitian, Caribbean, Afrobeat, Latin, Hip-Hop, Reggae, Kompa, and international entertainment.',
                ],
                [
                    'title' => 'Restaurant Experience',
                    'text' => 'Enjoy delicious food, drinks, music, and dancing all in one exciting destination.',
                ],
                [
                    'title' => 'Four VIP Sections',
                    'text' => 'Exclusive space for birthdays, group celebrations, special events, and unforgettable nights out.',
                ],
            ],

            'entertainment_eyebrow' => 'Weekend Entertainment',
            'entertainment_title' => 'Live Entertainment & International Nights',
            'entertainment_description' => "Al's Night Club brings together live artist performances, DJs, dancing, restaurant food and VIP celebrations every weekend.",
            'entertainment_cards' => [
                [
                    'image' => 'https://images.unsplash.com/photo-1574391884720-bbc3740c59d1?auto=format&fit=crop&w=900&q=85',
                    'label' => 'LIVE MUSIC',
                    'title' => 'Artist Performances',
                    'text' => 'Weekend performances with Haitian, Caribbean, Afrobeat, Latin, Hip-Hop, Reggae, Kompa, and international entertainment.',
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1541532713592-79a0317b6b77?auto=format&fit=crop&w=900&q=85',
                    'label' => 'VIP CELEBRATIONS',
                    'title' => 'Birthdays & Special Nights',
                    'text' => 'Reserve one of four VIP sections for birthdays and group celebrations.',
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=900&q=85',
                    'label' => 'FOOD & DANCING',
                    'title' => 'Restaurant + Nightclub',
                    'text' => 'Enjoy food, drinks, music and dancing in one Margate destination.',
                ],
            ],

            'contact_eyebrow' => 'Promoters & Reservations',
            'contact_title' => "Plan Your Night at Al's",
            'contact_description' => 'For VIP sections, birthdays, promoter inquiries and reservations, contact the team directly.',
            'contact_button_text' => '1 (786) 564-7828',
            'contact_button_url' => 'tel:+17865647828',
            'contact_secondary_button_text' => 'Open Form',
            'contact_secondary_button_url' => '/reservations',
        ];
    }
}