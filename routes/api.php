<?php

use App\Http\Controllers\ProductsApi\ProductsApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductsApiController::class);
