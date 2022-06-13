<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\Livres;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoriesLivresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'categories_id' => Categories::inRandomOrder()->first()->id,
            'livres_id' => Livres::inRandomOrder()->first()->id,
        ];
    }
}
