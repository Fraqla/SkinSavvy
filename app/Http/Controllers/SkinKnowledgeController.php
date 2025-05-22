<?php
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Content\SkinKnowledge;
use Illuminate\Http\Request;

class SkinKnowledgeController extends Controller
{
public function index()
{
    $skinKnowledge = SkinKnowledge::all();

    foreach ($skinKnowledge as $item) {
        $item->image_url = url('knowledge-image/' . $item->image);
    }

    return response()->json($skinKnowledge);
}
    
}
