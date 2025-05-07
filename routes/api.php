<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\ProhibitedProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SkinQuizController;
use App\Http\Controllers\SkinKnowledgeController;

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
Route::post('/submit-skin-quiz', [SkinQuizController::class, 'submitAnswers'])->middleware('auth:sanctum');