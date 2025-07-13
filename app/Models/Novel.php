<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'image', 'price', 'is_active', 'stock'];
    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}