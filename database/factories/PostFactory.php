<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>Str::random(10),
            'description'=>$this->faker->paragraph(),
            'category_id'=>$this->faker->numberBetween(1,5),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
