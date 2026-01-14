<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'stock', 
        'user_id',
        // add product image columns
        'file_path',
        'file_size',
        'original_filename',
        'mime_type',
        'storage_disk'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
