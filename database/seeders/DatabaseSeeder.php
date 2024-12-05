<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Hasan Basri',
            'email' => 'hasanbasri1493@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $user1 = User::factory()->create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $user2 = User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        Artisan::call(' db:seed --class=ShieldSeeder');

        $admin->assignRole('super_admin');
        $user1->assignRole('client');
        $user2->assignRole('client');

    }
}
