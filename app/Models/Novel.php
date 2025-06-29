<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'price', 'category_id', 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
