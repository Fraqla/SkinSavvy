<?php


use App\Http\Middleware\CheckAdminConsultantStatus;
use App\Livewire\ManageContent\ManageContent;
use App\Livewire\ManageContent\ManagePromotion;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\SignIn;
use App\Livewire\Auth\SignUp;
use App\Livewire\Auth\WaitingApproval;
use App\Livewire\ManagePromotion\PromotionNewsList;
use App\Livewire\Dashboard;
use App\Livewire\ManageUser\AdminConsultantApproval;
use App\Livewire\Actions\Logout;
use App\Livewire\ManageRole\ManageRoles;
use App\Livewire\ManageProduct\ManageProducts;
use App\Livewire\ManageCategory\ManageCategory;
use App\Livewire\ManageUser\ManageUsers;
use App\Livewire\ManageContent\ManageIngredient;
use App\Livewire\ManageContent\ManageProhibited;
use App\Livewire\ManageContent\ManageSkinKnowledge;
use App\Livewire\ManageContent\ManageSkinQuiz;
use App\Livewire\ManageContent\ManageTips;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

// Route for category images
Route::get('/category-image/{filename}', function ($filename) {
    $path = 'category-images/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return Response::make($file, 200)
        ->header('Content-Type', $type)
        ->header('Access-Control-Allow-Origin', '*'); // Allow CORS
});

// Route for tip images
Route::get('/tip-image/{filename}', function ($filename) {
    $path = 'tips/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return Response::make($file, 200)
        ->header('Content-Type', $type)
        ->header('Access-Control-Allow-Origin', '*'); // Allow CORS
});

// Route for product images
Route::get('/product-image/{filename}', function ($filename) {
    $path = 'products/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return Response::make($file, 200)
        ->header('Content-Type', $type)
        ->header('Access-Control-Allow-Origin', '*'); // Allow CORS
});

// Ingredient image route
Route::get('/ingredient-image/{filename}', function ($filename) {
    $path = 'ingredients/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return Response::make($file, 200)
        ->header('Content-Type', $type)
        ->header('Access-Control-Allow-Origin', '*'); // Allow CORS
});

// IPromotion image route
Route::get('/promotion-image/{filename}', function ($filename) {
    $path = 'promotions/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return Response::make($file, 200)
        ->header('Content-Type', $type)
        ->header('Access-Control-Allow-Origin', '*'); // Allow CORS
});

// Review image route
Route::get('/review-image/{filename}', function ($filename) {
    $path = 'reviews/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return Response::make($file, 200)
        ->header('Content-Type', $type)
        ->header('Access-Control-Allow-Origin', '*'); // Allow CORS
});

// Skin Knowledge image route
Route::get('/knowledge-image/{filename}', function ($filename) {
    $path = 'skin-knowledge/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return Response::make($file, 200)
        ->header('Content-Type', $type)
        ->header('Access-Control-Allow-Origin', '*'); // Allow CORS
});

Route::get('/', function () {
    return redirect()->route('sign-in'); // Redirect to login page when accessing "/"
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/sign-in'); // Redirect to login after logout
})->name('logout');
//Sign-in route
Route::get('/sign-in', SignIn::class)->name('sign-in');
// Sign-up route
Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');
Route::middleware(['auth'])->group(function () {


    Route::middleware(['auth', 'can:manage content'])->group(function () {
        Route::get('/manage-content', ManageContent::class)->name('manage-content');
        Route::get('/skinknowledge', ManageSkinKnowledge::class)->name('manage-content.skin-knowledge.skinknowledge');
        Route::get('/skinquiz', ManageSkinQuiz::class)->name('manage-content.skinquiz');
        Route::get('/ingredient', ManageIngredient::class)->name('manage-content.ingredient');
        Route::get('/tips', ManageTips::class)->name('manage-content.tips');
        Route::get('/promotion', ManagePromotion::class)->name('manage-content.promotion');
        Route::get('/prohibited', ManageProhibited::class)->name('manage-content.prohibited');
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

    Route::middleware(['auth'])->group(function () {
        Route::get('/waiting-approval', WaitingApproval::class)
            ->name('waiting-approval');
    });

    Route::middleware(['auth', 'can:manage roles'])->group(function () {
        Route::get('/manage-roles', ManageRoles::class)->name('manage-roles');
    });









});