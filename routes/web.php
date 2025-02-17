<?php

use App\Http\Controllers\CartApi\CartApiController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return '<a href="' . route('mainpage') . '">main</a>';
});

Route::get('/main', [StaticPageController::class, 'index'])->name('mainpage');
Route::get('/main/about', [StaticPageController::class, 'about'])->name('aboutpage');
Route::get('/shop', [ShopController::class, 'mainpage'])->name('shop');
Route::get('/shop/cart', [ShopController::class, 'cart'])->name('cartpage');


Route::get('sessionid', function (){return (session()->getId());});
//Route::get('/cart/index', [CartApiController::class, 'index']);
//Route::get('/cart/store/{product_id}', [CartApiController::class, 'store']);
//Route::get('/cart/show/{product_id}', [CartApiController::class, 'show']);
//
//Route::delete('/cart/delete/{product_id}', [CartApiController::class, 'destroy']);
//
//Route::resource('cart', CartApiController::class);
Route::middleware([StartSession::class])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->group(function () {
        Route::get('/cart/{product_id}', [CartApiController::class, 'show']);
        Route::get('/cart', [CartApiController::class, 'index']);

        Route::post('/cart', [CartApiController::class, 'store'])->name('store');

        Route::put('/cart/{product_id}', [CartApiController::class, 'update']);
        Route::delete('/cart/{product_id}', [CartApiController::class, 'destroy']);
    });


Route::get('/shop/{id}', [ShopController::class, 'product'])->name('product');



