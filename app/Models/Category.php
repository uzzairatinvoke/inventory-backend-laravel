<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    // A category can has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}


