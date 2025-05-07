<?php
namespace App\Http\Controllers;

use App\Models\Content\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();

        foreach ($promotions as $promotion) {
            $promotion->image_url = url('promotion-image/' . $promotion->image);
        }

        // Return the modified collection with image_url
        return response()->json($promotions); 

    }
    


}