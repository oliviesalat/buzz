<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsApi\StoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ], 200);
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();
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
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'product not found'], 404);
        }
        $data = $request->validated();
        $product->update($data);
        return response()->json([
            'message' => 'product updated',
            'product' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'product not found'], 404);
        }
        $product->delete();
        return response()->json([
            'message' => 'product deleted',
            'product' => $product
        ], 200);
    }
}
