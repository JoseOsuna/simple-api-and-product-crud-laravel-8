<?php

namespace Database\Factories\Shop;

use \App\Models\User;
use App\Models\Shop\Category;
use Illuminate\Support\Str as Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'price'       => $this->faker->numberBetween(10,499),
            'category_id' => $this->faker->numberBetween(1,10),
            'user_id'     => $this->faker->numberBetween(1,10),
            'description' => $this->faker->text
        ];
    }
}
