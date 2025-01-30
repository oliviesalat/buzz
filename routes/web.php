<?php

use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return "welcome";
});

Route::get('/index', [StaticPageController::class, 'index']);
