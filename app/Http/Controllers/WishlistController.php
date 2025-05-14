<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $wishlist = Wishlist::with('product')
            ->where('user_id', $user->id)
            ->get();

        return response()->json($wishlist);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $productId = $request->input('product_id');

        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already in wishlist'], 409);
        }

        $wishlist = Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return response()->json($wishlist, 201);
    }

    public function destroy(Request $request, $product_id)
    {
        $user = $request->user();

        $deleted = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Removed from wishlist']);
        } else {
            return response()->json(['message' => 'Item not found'], 404);
        }
    }
}