<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'content' => $this->faker->paragraph(10),
            'image_path' => $this->faker->imageUrl(640, 480, 'animals', true),
            'is_published' => $this->faker->boolean(),
            'category_id' => Category::all()->random()->id
        ];
    }
}
