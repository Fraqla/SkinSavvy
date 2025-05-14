<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishlistItem;

class WishlistController extends Controller
{
    // Fetch all wishlist items for authenticated user
    public function index(Request $request)
    {
        // Assuming you have a relationship with User and WishlistItem
        $user = $request->user(); // Get the authenticated user
        $wishlist = $user->wishlistItems; // Access wishlist items through a relationship

        return response()->json($wishlist);
    }

    // Add an item to the wishlist
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id', // Validate that the product exists
        ]);

        $user = $request->user();
        $wishlistItem = $user->wishlistItems()->create([
            'product_id' => $validated['product_id'],
        ]);

        return response()->json($wishlistItem, 201); // Return the created wishlist item
    }

    // Remove an item from the wishlist
    public function destroy($id, Request $request)
    {
        $user = $request->user();
        $wishlistItem = $user->wishlistItems()->findOrFail($id);

        $wishlistItem->delete();

        return response()->json(null, 204); // No content, just indicate successful deletion
    }
}
