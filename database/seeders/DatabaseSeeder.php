<?php

namespace Database\Seeders;

use App\Models\Shop\Product;
use App\Models\Shop\Category;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseSeeder extends Seeder
{

    use RefreshDatabase;
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(30)->create();

    }
}
