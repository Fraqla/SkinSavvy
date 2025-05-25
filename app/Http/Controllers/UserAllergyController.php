<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAllergy;

class UserAllergyController extends Controller
{
public function index(Request $request)
{
    $user = auth()->user(); // ← is this null?
    return UserAllergy::where('user_id', $user->id)->get();
}
public function store(Request $request)
{
    $request->validate(['ingredient_name' => 'required|string']);
    
    $allergy = auth()->user()->allergies()->create([
        'ingredient_name' => $request->ingredient_name
    ]);
    
    return response()->json($allergy, 201); // Return the created allergy
}

public function destroy($ingredient)
{
    $deleted = auth()->user()->allergies()
        ->where('ingredient_name', $ingredient)
        ->delete();
        
    if ($deleted === 0) {
        return response()->json(['message' => 'Allergy not found'], 404);
    }
        
    return response()->json([], 200);
}
}
