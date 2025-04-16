<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
    
        foreach ($categories as $category) {
            // Use the /category-image/ route to generate the image URL
            $category->image_url = url('category-image/' . $category->image); // Use category-image route
        }
    
        return response()->json($categories);
    }
    
    


    public function show(Category $category) 
    {
        return $category; // Return a single category by ID (using route model binding)
    }
}

