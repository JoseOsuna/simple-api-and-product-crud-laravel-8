<?php

namespace Database\Factories\Shop;

use Illuminate\Support\Str as Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence;
        
        return [
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => $this->faker->text
        ];
    }
}
