<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'is_active', 'hub_category_id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function novels()
    {
        return $this->hasMany(Novel::class);
    }
}
