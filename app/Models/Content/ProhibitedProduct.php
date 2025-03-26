<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class ProhibitedProduct extends Model
{
    protected $fillable = ['product_name', 'detected_poison', 'effect', 'image'];
}
