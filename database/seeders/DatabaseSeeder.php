<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Rafi',
            'email' => '123@gmail.com',
            'password' => '123',
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'hafiz',
            'email' => '456@gmail.com',
            'password' => '123',
            'role' => 'user'
        ]);
       
    }
}
