<?php

namespace App\Services\Cart;

use App\Models\Cart;

class CartService
{
    public function find($session_id)
    {
        return Cart::where('session_id', $session_id)->get();
    }

    public function store($data)
    {
        $cartItem = Cart::where('session_id', $data['session_id'])
            ->where('product_id', $data['product_id'])
            ->first();
        if ($cartItem) {
            $cartItem->update(['count' => $cartItem->count + 1]);
            return $cartItem;
        } else {
            return Cart::create($data);
        }

    }

    public function update($data)
    {
        $cartItem = Cart::where('session_id', $data['session_id'])
            ->where('product_id', $data['product_id'])
            ->first();
        if ($cartItem) {
            $cartItem->update(['count' => $cartItem->data['count']]);
            return $cartItem;
        } else {
            return $cartItem;
        }
    }
}
