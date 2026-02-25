<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
            
        if (config('app.debug')) {
            // 🔹 Create 48 normal users
            for ($i = 0; $i < 100; $i++) {
                $user = User::create([
                    'email' => $faker->unique()->safeEmail(),
                    'password' => Hash::make('password123'),
                    'name' => $faker->name(),
                ]);

                // $user->assignRole('user');
            }
        }
    }
}
