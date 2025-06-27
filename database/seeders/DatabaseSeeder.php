<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Malano Labillow',
            'username' => 'Maalamo',
            'email' => 'maalamo@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
        
        $this->call([
            CategorySeeder::class,
            // WorkSeeder::class,
        ]);
    }
}
