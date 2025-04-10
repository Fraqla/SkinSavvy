<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProductsByCategory(Request $request)
{
    $categoryId = $request->query('category_id');
    
    // Fetch products for the given category ID
    $products = Product::where('category_id', $categoryId)->get();

    // Return the products as JSON
    return response()->json([
        'success' => true,
        'data' => $products->toArray(), // Convert to array
    ]);
}

}
