<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $colorArray = ['#000000', '#FFFFFF', '#00FF00', '#FF0000', '#0000FF'];
        return [
            'name' => fake()->name(),
            'color' => Arr::random($colorArray),
        ];
    }
}
