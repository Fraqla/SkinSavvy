<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\ProhibitedProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SkinQuizController;
use App\Http\Controllers\SkinKnowledgeController;
use App\Http\Controllers\WishlistController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::get('/products', [ProductController::class, 'getProductsByCategory']);
Route::get('/tips', [TipsController::class, 'index']);
Route::get('/skin-knowledge', [SkinKnowledgeController::class, 'index']);
Route::get('/prohibited-products', [ProhibitedProductController::class, 'index']);
Route::get('/promotions', [PromotionController::class, 'index']);
Route::get('/ingredients', [IngredientController::class, 'index']);
Route::get('/skin-quizzes', [SkinQuizController::class, 'index']);
Route::post('/submit-skin-quiz', [SkinQuizController::class, 'submit']);
// Fetch user's wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('auth:api');

// Add product to wishlist
Route::post('/wishlist', [WishlistController::class, 'store'])->middleware('auth:api');

// Remove product from wishlist
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->middleware('auth:api');

// Allow CORS for the specific route
Route::post('/submit-skin-quiz', function () {
    // Handle your quiz submission logic here
    // Example response for the submitted skin quiz
    return response()->json(['message' => 'Skin quiz submitted successfully!'], 200)
        ->header('Access-Control-Allow-Origin', '*')  // Allow all origins (you can specify a domain here)
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')  // Allowed HTTP methods
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');  // Allowed headers
});