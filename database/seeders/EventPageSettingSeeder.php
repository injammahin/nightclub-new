<?php

namespace Database\Seeders;

use App\Models\EventPageSetting;
use Illuminate\Database\Seeder;

class EventPageSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (!EventPageSetting::exists()) {
            EventPageSetting::create(EventPageSetting::defaultData());
        }
    }
}