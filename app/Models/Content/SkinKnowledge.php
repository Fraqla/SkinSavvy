<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkinKnowledge extends Model
{
    use HasFactory;

    protected $table = 'skin_knowledges';

    protected $fillable = [
        'skin_type',
        'characteristics',
        'best_ingredient',
        'image',
        'description',
    ];

    protected $casts = [
        'characteristics' => 'array',
        'best_ingredient' => 'array',
    ];
    

}
