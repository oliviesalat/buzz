<?php

namespace App\Http\Controllers\CartApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartApi\CartRequest;
use App\Http\Requests\CartApi\UpdateCountRequest;
use App\Models\Cart;
use Illuminate\Http\Request;


class CartApiController extends BaseCartController
{

    public function index(Request $request)
    {
        $session_id = session()->getId();
        $cart = Cart::where('session_id', $session_id)->get();
        return response()->json($cart, 200);
    }

    public function store(CartRequest $request)
    {
//        $query = $request->query();
//        $product_id = $query['product_id'];
        $product_id = $request->validated('product_id');
        $session_id = session()->getId();
        $cart_item = Cart::where('session_id', $session_id)
            ->where('product_id', $product_id)->first();
        if ($cart_item) {
            $cart_item->increment('count');
            $cart = Cart::where('session_id', $session_id)->get();
            return response()->json($cart, 200);
        }
        $cart_item = Cart::create([
            'session_id' => $session_id,
            'product_id' => $product_id,
            'count' => 1]);
        return response()->json(Cart::where('session_id', $session_id)->get(), 201);
    }

    public function show($product_id)
    {
        $session_id = session()->getId();
        $cart_item = Cart::where('session_id', $session_id)
            ->where('product_id', $product_id)->first();
        if ($cart_item) {
            return response()->json($cart_item, 200);
        }
        return response()->json(['message' => 'product not found'], 404);
    }

    public function update(UpdateCountRequest $request, $product_id)
    {
        $count = $request->validated('count');
        $session_id = session()->getId();
        $cart_item = Cart::where('session_id', $session_id)
            ->where('product_id', $product_id)
            ->first();
        if ($cart_item) {
            $cart_item->update(['count' => $count]);
            return response()->json($cart_item, 200);
        }
        return response()->json(['message' => 'product not found'], 404);
    }

    public function destroy($product_id)
    {
        $session_id = session()->getId();
        $cart_item = Cart::where('product_id', $product_id)
            ->where('session_id', $session_id)
            ->first();
        if ($cart_item) {
            $cart_item->delete();
            $cart = Cart::where('session_id', $session_id)->get();
            return response()->json($cart, 200);
        }
        return response()->json(['message' => 'product not found'], 404);
    }
}
