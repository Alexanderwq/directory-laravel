<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\CheckApiToken::class)->group(function () {
    Route::get('/test', function () {
        return 'page!';
    });

    Route::resource('/companies', CompanyController::class)->only(['index', 'show']);
    Route::resource('/buildings', BuildingController::class)->only(['index', 'show']);
    Route::resource('/categories', CategoryController::class)->only(['index', 'show']);
});

Route::get('/', function () {
    return response()->json(['message' => 'Welcome']);
});
