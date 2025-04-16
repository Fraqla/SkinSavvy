<?php
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Content\Tip;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function index()
    {
        $tips = Tip::all()->map(function ($tip) {
            // Use the /tip-image/ route to generate the image URL
            $tip->image = url('tip-image/' . $tip->image); // Use tip-image route
            return $tip;
        });
    
        return response()->json($tips);
    }
    
    
    
}
