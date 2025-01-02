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

        if (env('APP_ENV') === 'local') {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@manmachineltd.com',
                'password' => bcrypt('secret')
            ]);

            User::factory()->create([
                'name' => 'James Randall',
                'email' => 'james@manmachineltd.com',
                'password' => bcrypt('secret')
            ]);

            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@manmachineltd.com',
                'password' => bcrypt('secret')
            ]);
        }
    }
}
