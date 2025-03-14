<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\SignIn;
use App\Livewire\Auth\SignUp;
use App\Livewire\ManageContent\ContentList;
use App\Livewire\ManageProduct\ProductList;
use App\Livewire\ManagePromotion\PromotionNewsList;
use App\Livewire\Dashboard;
use App\Livewire\ManageUser\AdminConsultantApproval;
use App\Livewire\Actions\Logout;

Route::get('/', function () {
    return redirect()->route('sign-in'); // Redirect to login page when accessing "/"
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
Route::post('/logout', Logout::class)->name('logout');
//Sign-in route
Route::get('/sign-in', SignIn::class)->name('sign-in');
// Sign-up route
Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/manage-content', ContentList::class)->name('manage-content');
    Route::get('/manage-product', ProductList::class)->name('manage-product');
    Route::get('/manage-promotion', PromotionNewsList::class)->name('manage-promotion');

    Route::middleware(['auth', 'role:system_admin'])->group(function () {
        Route::get('/admin-approval', AdminConsultantApproval::class)->name('admin-approval');
    });
    
    Route::get('/waiting-approval', function () {
        return view('livewire.manage-user.waiting-approval');
    })->name('waiting-approval');
    
    
});