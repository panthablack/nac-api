<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminName = env('ADMIN_NAME');
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if ($adminName && $adminEmail && $adminPassword) {
            User::factory()->create([
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => bcrypt($adminPassword)
            ]);
        }

        if (env('APP_ENV') === 'local') {
            User::factory()->create([
                'name' => 'Test User 1',
                'email' => 'test1@manmachineltd.com',
                'password' => bcrypt('secret')
            ]);

            User::factory()->create([
                'name' => 'Test User 2',
                'email' => 'test2@manmachineltd.com',
                'password' => bcrypt('secret')
            ]);
        }
    }
}
