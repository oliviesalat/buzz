<?php

namespace App\Http\Controllers\CartApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartApi\CartRequest;
use Illuminate\Http\Request;


class CartApiController extends BaseCartController
{
    public function index(Request $request)
    {
        $session_id = $request->session()->getId();

        $data['session_id'] = $session_id;
        $cart = $this->service->find($session_id);
        if (!$cart) {
            return response()->json(['message' => 'cart not found']);
        }
        return response()->json([
            'cart' => $cart
        ], 200);
    }

    public function store(CartRequest $request)
    {
        $data = $request->validated();

        $data['session_id'] = $request->session()->getId();
        $cart = $this->service->store($data);
        return response()->json([
            'data' => $cart
        ]);
    }

    public function show($session_id)
    {
        $cart = $this->service->find($session_id);
        if (!$cart) {
            return response()->json(['message' => 'cart not found'], 404);
        }
        return response()->json([
            'cart' => $cart
        ], 200);
    }

    public function update(CartRequest $request)
    {
        $data = $request->validated();
        $data['session_id'] = $request->session()->getId();
        $cart = $this->service->update($data);
        if ($cart) {
            return response()->json([
                'message' => 'product updated',
                'product' => $cart
            ], 200);
        } else {
            return response()->json(['message' => 'cart not found'], 404);
        }
    }

    public function destroy($id)
    {

    }
}
