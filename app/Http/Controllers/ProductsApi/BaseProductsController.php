<?php

namespace App\Http\Controllers\ProductsApi;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;

class BaseProductsController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
}
