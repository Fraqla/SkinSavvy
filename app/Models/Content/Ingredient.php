<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['ingredient_name', 'facts', 'function', 'benefits', 'image'];
}
