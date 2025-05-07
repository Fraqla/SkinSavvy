<?php
namespace App\Http\Controllers;

use App\Models\Content\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();

        foreach ($ingredients as $ingredient) {
            $ingredient->image_url = url('ingredient-image/' . $ingredient->image);
        }

        // Return the modified collection with image_url
        return response()->json($ingredients); 
    }
}
