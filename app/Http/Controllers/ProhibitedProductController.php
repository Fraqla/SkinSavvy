<?php
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Content\ProhibitedProduct;
use Illuminate\Http\Request;

class ProhibitedProductController extends Controller
{
    public function index()
{
    return response()->json(ProhibitedProduct::all());
}
    
    
}
