<?php
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Content\SkinKnowledge;
use Illuminate\Http\Request;

class SkinKnowledgeController extends Controller
{
    public function index()
    {
        $skinknowledge = SkinKnowledge::all()->map(function ($skinknowledge) {
            // Use the /skin-knowledge/ route to generate the image URL
            $skinknowledge->image = url('skin-knowledge/' . $skinknowledge->image); // Use skinknowledge-image route
            return $skinknowledge;
        });
    
        return response()->json($skinknowledge);
    }
    
    
    
}
