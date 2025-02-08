<?php

use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/main', [StaticPageController::class, 'index'])->name('mainpage');
Route::get('/main/about', [StaticPageController::class, 'about'])->name('aboutpage');
