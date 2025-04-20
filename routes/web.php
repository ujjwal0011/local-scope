<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\GeolocationDealController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🏪 Business Routes
Route::get('/businesses', [BusinessController::class, 'viewAll'])->name('businesses.viewAll');
Route::get('/businesses/create', [BusinessController::class, 'createForm'])->name('businesses.createForm');
Route::post('/businesses/create', [BusinessController::class, 'storeFromForm'])->name('businesses.storeFromForm');

// 🧾 Category Routes
Route::get('/categories', [CategoryController::class, 'viewAll'])->name('categories.viewAll');
Route::get('/categories/create', [CategoryController::class, 'createForm'])->name('categories.createForm');
Route::post('/categories/create', [CategoryController::class, 'storeFromForm'])->name('categories.storeFromForm');

// 🔥 Deal Routes
Route::get('/deals', [DealController::class, 'viewAll'])->name('deals.viewAll');
Route::get('/deals/create', [DealController::class, 'createForm'])->name('deals.createForm');
Route::post('/deals/create', [DealController::class, 'storeFromForm'])->name('deals.storeFromForm');

Route::get('/nearby-deals', [GeolocationDealController::class, 'nearbyView'])->name('deals.nearby');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('api')
    ->middleware('api')
    ->group(base_path('routes/api.php'));

require __DIR__ . '/auth.php';
