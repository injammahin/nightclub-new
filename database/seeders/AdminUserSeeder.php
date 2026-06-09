<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::updateOrCreate(
            [
                'username' => env('ADMIN_USERNAME', 'alsnight'),
            ],
            [
                'name' => 'Al Night Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Alsnight1099$')),
            ]
        );
    }
}