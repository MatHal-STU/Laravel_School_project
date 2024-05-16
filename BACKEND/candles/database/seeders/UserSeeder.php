<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'first_name' => 'Jozko',
            'last_name' => 'Admin',
            'phone_number' => '555-1234',

            'role' => 'admin',
            'registered_at' => now(),
        ]);
        
        User::create([
            'email' => 'mirekh@gmail.com',
            'password' => Hash::make('password456'),
            'first_name' => 'Miro',
            'last_name' => 'Hniezdič',
            'phone_number' => '555-5678',
            'role' => "client",
            'registered_at' => now(),
        ]);
    }
}
