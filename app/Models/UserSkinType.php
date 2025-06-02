<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkinType extends Model
{
    protected $fillable = ['user_id', 'total_score', 'skin_type'];
}
