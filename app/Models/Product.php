<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity_in_stock',
        'photo',
        'category_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
