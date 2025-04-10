<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all(); // Return all categories
    }

    public function show(Category $category) 
    {
        return $category; // Return a single category by ID (using route model binding)
    }
}

