<?php
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Content\ProhibitedProduct;
use Illuminate\Http\Request;

class ProhibitedProductController extends Controller
{
 public function index()
    {
        $prohibitedProducts = ProhibitedProduct::all();

        // Add full image URL to each product
        foreach ($prohibitedProducts as $prohibited) {
            $prohibited->image_url = url('prohibited-products/' . $prohibited->image);

        }

        return response()->json($prohibitedProducts);
    }

    public function show($id)
{
    $prohibitedProduct = ProhibitedProduct::findOrFail($id);
    
    $prohibitedProduct->image_url = url('prohibited-products/' . $prohibitedProduct->image);
    
    return response()->json($prohibitedProduct);
}
    
}

