<?php

namespace Database\Factories;

use App\Models\AuthorsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class LivresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(2),
            'pages' => rand(50, 1000),
            'authors_id' => AuthorsModel::inRandomOrder()->first()->id,
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(640, 480, 'films', true)
        ];
    }
}
