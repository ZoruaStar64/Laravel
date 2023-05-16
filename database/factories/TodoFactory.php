<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{

    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userArray = [1,2];
        //$categoryArray = [1,2,3,4];
        $randomCategory = Category::all()->random();
        $descriptiveArray = ['Hi.', 'This is a test.', 'Description.', 'Number 15 Burger King foot lettuce.'];
        return [
            'user_id' => Arr::random($userArray),
            //'categories_id' => Arr::random($categoryArray),
            'categories_id' => $randomCategory,
            'checked' => 0,
            'name' => fake()->name(),
            'description' => Arr::random($descriptiveArray),
        ];
    }
}
