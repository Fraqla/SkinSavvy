<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'ingredient', 'image', 'category_id'];

    // Define the relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}

}
