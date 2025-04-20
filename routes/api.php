<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\GeolocationDealController;

Route::get('deals/nearby', [GeolocationDealController::class, 'nearby']);
Route::apiResource('businesses', BusinessController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('deals', DealController::class);
