<?php

use App\Models\Shop\Category;
use Illuminate\Support\Str as Str;
// 'name',
//         'slug',
//         'description',
function  get_category_id($category_name){
    $category = Category::firstOrCreate(
        ['name' =>  $category_name],
        ['slug' => Str::slug($category_name)]
    );

    return $category->id;
}