<?php
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Content\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
{
    return response()->json(Ingredient::all());
}
    
    
}
