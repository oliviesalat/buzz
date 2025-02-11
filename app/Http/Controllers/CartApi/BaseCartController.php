<?php

namespace App\Http\Controllers\CartApi;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartService;

class BaseCartController extends Controller
{
    protected CartService $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }
}
