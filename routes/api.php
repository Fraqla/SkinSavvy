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
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserAllergyController;
use App\Http\Controllers\DialogflowController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user/profile', [UserController::class, 'getProfile']);
Route::middleware('auth:sanctum')->put('/user/profile', [UserController::class, 'updateProfile']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::get('/products', [ProductController::class, 'getProductsByCategory']);
Route::get('/tips', [TipsController::class, 'index']);
Route::get('/skin-knowledge', [SkinKnowledgeController::class, 'index']);
Route::get('/prohibited-products', [ProhibitedProductController::class, 'index']);
Route::get('prohibited-products/{id}', [ProhibitedProductController::class, 'show']);
Route::get('/promotions', [PromotionController::class, 'index']);
Route::get('/ingredients', [IngredientController::class, 'index']);
Route::get('/skin-quizzes', [SkinQuizController::class, 'index']);
Route::middleware('auth:sanctum')->post('/skin-quizzes/submit', [SkinQuizController::class, 'submit']);
Route::post('/dialogflow-webhook', [DialogflowController::class, 'handle']);
Route::post('/dialogflow-send-message', [DialogflowController::class, 'sendMessage']);

// Fetch user's wishlist
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/wishlist', [WishlistController::class, 'store']);
    Route::delete('/wishlist/{product_id}', [WishlistController::class, 'destroy']);
    Route::get('/wishlist', [WishlistController::class, 'index']);
    
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store']);
});

Route::get('/reviews/{productId}', [ReviewController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user-allergies', [UserAllergyController::class, 'index']);
    Route::post('/user-allergies', [UserAllergyController::class, 'store']);
    Route::delete('/user-allergies/{ingredient}', [UserAllergyController::class, 'destroy']);
});


