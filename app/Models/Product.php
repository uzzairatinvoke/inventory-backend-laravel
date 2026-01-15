<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock', 'user_id', 'file_path', 'original_filename', 'file_size', 'storage_disk', 'mime_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
