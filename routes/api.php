<?php

use App\Http\Controllers\CartApi\CartApiController;
use App\Http\Controllers\ProductsApi\ProductsApiController;
use App\Http\Middleware\CartMiddleware;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

Route::get('/bbbb', function (Request $request){
    dd($request->session()->getId());
});

Route::apiResources([
    'products' => ProductsApiController::class,
]);

Route::middleware([StartSession::class])->group(function () {
    Route::apiResource('cart', CartApiController::class);
});
