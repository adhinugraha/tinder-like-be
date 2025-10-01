<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'age' => fake()->numberBetween(18, 40),
                'location' => fake()->city() . ', ' . fake()->country(),
            ]);

            // Create 3 images for each user
            for ($j = 1; $j <= 3; $j++) {
                $pictureId = rand(1, 1000);
                $pictureUrl = "https://picsum.photos/id/{$pictureId}/500/500";

                Image::create([
                    'user_id' => $user->id,
                    'url' => $pictureUrl
                ]);
            }
        }
    }
}
