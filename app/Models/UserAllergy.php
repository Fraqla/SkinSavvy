<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAllergy extends Model
{
protected $fillable = ['user_id', 'ingredient_name'];

public function user()
{
    return $this->belongsTo(User::class);
}
}
