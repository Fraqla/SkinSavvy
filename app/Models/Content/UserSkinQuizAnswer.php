<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkinQuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skin_quiz_id',
        'user_answer',
        'score',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(SkinQuiz::class, 'skin_quiz_id');
    }
}
