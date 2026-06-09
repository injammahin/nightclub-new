<?php

namespace Database\Seeders;

use App\Models\ClubEvent;
use Illuminate\Database\Seeder;

class ClubEventSeeder extends Seeder
{
    public function run(): void
    {
        if (!ClubEvent::exists()) {
            ClubEvent::create([
                'image' => 'assets/images/1000796631.jpg',
                'eyebrow' => 'Main Daily Promotion',
                'title' => "Happy Hour at Al's",
                'description' => "The Happy Hour event is a main focus of the website. It appears in the hero flow, event page and call-to-action areas so visitors can quickly understand what is happening at Al's Night Club.",
                'cards' => ClubEvent::defaultCards(),
                'primary_button_text' => 'Call Us Now',
                'primary_button_url' => 'tel:+19548820864',
                'secondary_button_text' => 'Reserve VIP',
                'secondary_button_url' => '/reservations',
                'sort_order' => 1,
                'is_active' => true,
            ]);
        }
    }
}