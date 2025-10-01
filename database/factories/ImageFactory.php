<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $width = $this->faker->numberBetween(300, 800);
        $height = $this->faker->numberBetween(300, 800);
        $imageId = $this->faker->numberBetween(1, 1000);
        
        return [
            'person_id' => null, // Will be set when creating with relationship
            'url' => "https://picsum.photos/id/{$imageId}/{$width}/{$height}"
        ];
    }

    /**
     * Create a grayscale image.
     */
    public function grayscale(): static
    {
        return $this->state(function (array $attributes) {
            $width = $this->faker->numberBetween(300, 800);
            $height = $this->faker->numberBetween(300, 800);
            $imageId = $this->faker->numberBetween(1, 1000);
            
            return [
                'url' => "https://picsum.photos/id/{$imageId}/{$width}/{$height}?grayscale"
            ];
        });
    }

    /**
     * Create a blurred image.
     */
    public function blurred(): static
    {
        return $this->state(function (array $attributes) {
            $width = $this->faker->numberBetween(300, 800);
            $height = $this->faker->numberBetween(300, 800);
            $imageId = $this->faker->numberBetween(1, 1000);
            $blur = $this->faker->numberBetween(1, 5);
            
            return [
                'url' => "https://picsum.photos/id/{$imageId}/{$width}/{$height}?blur={$blur}"
            ];
        });
    }
}