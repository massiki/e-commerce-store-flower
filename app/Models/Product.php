<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'stock', 'image', 'images',
        'badge', 'is_featured', 'rating',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'price' => 'decimal:2',
            'rating' => 'decimal:1',
            'is_featured' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
