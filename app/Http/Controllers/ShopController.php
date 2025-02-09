<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function mainpage()
    {
        return view('shop.shop');
    }


    public function show($id)
    {
        return view('shop.product');
    }
}
