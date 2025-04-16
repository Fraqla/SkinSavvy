<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->query('category_id');
        
        // Fetch products and append full image URL
        $products = Product::where('category_id', $categoryId)->get()->map(function ($product) {
            $product->image = url('product-image/' . $product->image); // 👈 This adds full URL
            return $product;
        });
    
        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }
    
public function index()
    {
        $products = Product::all()->map(function ($product) {
            // Use the /tip-image/ route to generate the image URL
            $product->image = url('product-image/' . $product->image); // Use tip-image route
            return $product;
        });
    
        return response()->json($products);
    }

}
