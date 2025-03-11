<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\SignIn;
use App\Livewire\ManageContent\ContentList;
use App\Livewire\ManageProduct\ProductList;
use App\Livewire\ManagePromotion\PromotionNewsList;
use App\Livewire\Dashboard;

Route::get('/', function () {
    return redirect()->route('login'); // Redirect to login page when accessing "/"
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


Route::get('/sign-in', SignIn::class)->name('sign-in');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/manage-content', ContentList::class)->name('manage-content');
    Route::get('/manage-product', ProductList::class)->name('manage-product');
    Route::get('/manage-promotion', PromotionNewsList::class)->name('manage-promotion');
});