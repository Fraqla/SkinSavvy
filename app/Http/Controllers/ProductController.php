<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
public function getProductsByCategory(Request $request)
{
    $categoryId = $request->query('category_id');

    $query = Product::query();

    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    $products = $query->get()->map(function ($product) {
        $product->image = url('product-image/' . $product->image);
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
