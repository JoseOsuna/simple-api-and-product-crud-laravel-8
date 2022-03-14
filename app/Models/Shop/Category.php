<?php

namespace App\Models\Shop;

use App\Models\Image;
use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'created_at',
        'updated_at'
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
