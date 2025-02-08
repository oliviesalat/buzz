<?php
use App\Http\Controllers\ProductsApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductsApiController::class);
