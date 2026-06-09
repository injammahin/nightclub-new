<?php

namespace Database\Seeders;

use App\Models\HomepageSetting;
use Illuminate\Database\Seeder;

class HomepageSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (!HomepageSetting::exists()) {
            HomepageSetting::create(HomepageSetting::defaultData());
        }
    }
}