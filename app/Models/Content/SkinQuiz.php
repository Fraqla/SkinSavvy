<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkinQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];
    
}