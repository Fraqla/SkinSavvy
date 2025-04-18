<?php
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Content\SkinQuiz;
use Illuminate\Http\Request;

class SkinQuizController extends Controller
{
    public function index()
    {
        return response()->json(SkinQuiz::all());
    }
    
    
}
