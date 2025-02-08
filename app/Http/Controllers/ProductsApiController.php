<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | string | max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0'
        ]);
        $product = Product::create($data);
        return response()->json([
            'message' => 'Product created',
            'product' => $product
        ], 201);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'product not found'], 404);
        }
        return response()->json([
            'product' => $product
        ]);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'product not found'], 404);
        }
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|integer|min:0'
        ]);
        $product->update($data);
        return response()->json([
            'message' => 'product updated',
            'product' => $product
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'product not found'], 404);
        }
        $product->delete();
        return response()->json([
            'message' => 'product deleted',
            'product' => $product
        ]);
    }
}
