<?php

namespace App\Models\Shop;

use App\Models\User;
use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

    
}
