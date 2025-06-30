<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class UserSkinType extends Model
{
    protected $table = 'user_skin_types'; // Add this if your table name is different
    protected $fillable = ['user_id', 'total_score', 'skin_type'];
    

public function user()
    {
        return $this->belongsTo(User::class);
    }

}
