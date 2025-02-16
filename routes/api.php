<?php

use App\Http\Controllers\CartApi\CartApiController;
use App\Http\Controllers\ProductsApi\ProductsApiController;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductsApiController::class);



//Route::middleware([StartSession::class])->group(function () {
//    Route::apiresource('cart', CartApiController::class);
//});
