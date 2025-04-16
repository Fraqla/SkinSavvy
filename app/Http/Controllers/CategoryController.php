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
        $category->image_url = asset('storage/' . $category->image); // 'category-images/filename.jpg'
    }

    return $categories;
}


    public function show(Category $category) 
    {
        return $category; // Return a single category by ID (using route model binding)
    }
}

