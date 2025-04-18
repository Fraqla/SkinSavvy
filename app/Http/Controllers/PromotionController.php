<?php
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Content\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        return response()->json(Promotion::all());
    }
    
    
}
