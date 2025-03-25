<?php


use App\Livewire\ManageContent\ManageContent;
use App\Livewire\ManageContent\ManagePromotion;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\SignIn;
use App\Livewire\Auth\SignUp;
use App\Livewire\ManagePromotion\PromotionNewsList;
use App\Livewire\Dashboard;
use App\Livewire\ManageUser\AdminConsultantApproval;
use App\Livewire\Actions\Logout;
use App\Livewire\ManageRole\ManageRoles;
use App\Livewire\ManageProduct\ManageProducts;
use App\Livewire\ManageCategory\ManageCategory;
use App\Livewire\ManageUser\ManageUsers;
use App\Livewire\ManageContent\Ingredient;
use App\Livewire\ManageContent\Prohibited;
use App\Livewire\ManageContent\ManageSkinKnowledge;
use App\Livewire\ManageContent\SkinQuiz;
use App\Livewire\ManageContent\Tips;

Route::get('/', function () {
    return redirect()->route('sign-in'); // Redirect to login page when accessing "/"
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
Route::post('/logout', Logout::class)->name('logout');
//Sign-in route
Route::get('/sign-in', SignIn::class)->name('sign-in');
// Sign-up route
Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/manage-promotion', PromotionNewsList::class)->name('manage-promotion');

    Route::middleware(['auth', 'can:manage content'])->group(function () {
        Route::get('/manage-content', ManageContent::class)->name('manage-content');
        Route::get('/skinknowledge', ManageSkinKnowledge::class)->name('manage-content.skin-knowledge.skinknowledge');
        Route::get('/skinquiz', SkinQuiz::class)->name('manage-content.skinquiz');
        Route::get('/ingredient', Ingredient::class)->name('manage-content.ingredient');
        Route::get('/tips', Tips::class)->name('manage-content.tips');
        Route::get('/promotion', ManagePromotion::class)->name('manage-content.promotion');
        Route::get('/prohibited', Prohibited::class)->name('manage-content.prohibited');
    });
    Route::middleware(['auth', 'can:manage product'])->group(function () {
        Route::get('/manage-product', ManageProducts::class)->name('manage-product');
        Route::get('/product-details/{id}', [ManageProducts::class, 'show'])->name('product.details');
    });

    Route::middleware(['auth', 'can:manage category'])->group(function () {
        Route::get('/manage-category', ManageCategory::class)->name('manage-category');
    });
    

    Route::middleware(['auth'])->group(function () {
        Route::get('/admin-approval', AdminConsultantApproval::class)->name('admin-approval');
    });

    Route::middleware(['auth', 'can:manage user'])->group(function () {
        Route::get('/manage-user', ManageUsers::class)->name('manage-user');
    });

   // Waiting approval page
Route::get('/waiting-approval', function () {
    return view('livewire.manage-user.waiting-approval');
})->name('waiting-approval');

Route::middleware(['auth'])->group(function () {
    Route::get('/manage-roles',ManageRoles::class)->name('manage-roles');
});








});