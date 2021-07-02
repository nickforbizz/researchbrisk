<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                'name' => 'superadmin',
                'email' => 'superadmin@researchbrisk.com',
                'email_verified_at' => now(),
                'active' => 1,
                'password' => '$2y$10$1zCMkZS6zL3SxvoYPBfGiuT8rRkWAn0uHdUEbGO7aufAoOCT1XSW.', // password
                'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@researchbrisk.com',
            'email_verified_at' => now(),
            'active' => 1,
            'password' => '$2y$10$h3rllLKG0g1gf0uhm8EMIef.353m040J.ucu787X3/cvCxChYGiF2', // password
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@researchbrisk.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$NEysfslpjyL2KzZIhWP68.sIhiToUjRnDtV9P/qLFOWlRTz10NJzq', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
