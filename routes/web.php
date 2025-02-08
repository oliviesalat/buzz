<?php

use App\Http\Controllers\ProductsApiController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/main', [StaticPageController::class, 'index'])->name('mainpage');
Route::get('/main/about', [StaticPageController::class, 'about'])->name('aboutpage');
Route::get('/shop', [ShopController::class, 'mainpage'])->name('shop');
//API
//Route::apiResource('/products', ProductsApiController::class);
