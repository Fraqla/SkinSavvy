<?php
use App\Http\Controllers\UserController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/register', [UserController::class, 'register']);
