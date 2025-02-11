<?php

namespace App\Services\Cart;

use App\Models\Cart;

class CartService
{
    public function find($id)
    {
        return Cart::where('session_id', $id)->get();
    }
    public function store($data)
    {
        return Cart::create($data);
    }
}
