<?php

namespace App\Http\Controllers\ProductsApi;

use App\Http\Controllers\Controller;
use App\Services\Product\Service;

class BaseController extends Controller
{
    protected Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
