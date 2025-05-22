<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'photo' => 'nullable|image|max:2048',
    ]);

    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('reviews', 'public');
    }

    $review = Review::create([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
        'review' => $request->review,
        'rating' => $request->rating,
        'photo' => $photoPath,
    ]);

    $review->photo_url = $photoPath ? asset('storage/' . $photoPath) : null;

    return response()->json([
        'message' => 'Review added successfully',
        'data' => $review,
    ]);
}

public function index($productId)
{
    $reviews = Review::with('user')
        ->where('product_id', $productId)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($reviews);
}
}