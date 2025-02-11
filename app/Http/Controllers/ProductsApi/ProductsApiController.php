<?php

namespace App\Http\Controllers\ProductsApi;

use App\Http\Requests\ProductsApi\FilterRequest;
use App\Http\Requests\ProductsApi\StoreRequest;
use Illuminate\Http\Request;

class ProductsApiController extends BaseProductsController
{
    public function index(FilterRequest $request)
    {
        $products = $this->service->index($request);
        return response()->json([
            'products' => $products
        ], 200);
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $product = $this->service->store($data);
        return response()->json([
            'message' => 'Product created',
            'product' => $product
        ], 201);
    }

    public function show($id)
    {
        $product = $this->service->find($id);
        if (!$product) {
            return response()->json(['message' => 'product not found'], 404);
        }
        return response()->json([
            'product' => $product
        ], 200);
    }


    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $product = $this->service->update($data, $id);
        if ($product) {
            return response()->json([
                'message' => 'product updated',
                'product' => $product
            ], 200);
        } else {
            return response()->json(['message' => 'product not found'], 404);
        }
    }

    public function destroy($id)
    {
        $product = $this->service->destroy($id);
        if (!$product) {
            return response()->json(['message' => 'product not found'], 404);
        }
        return response()->json([
            'message' => 'product deleted',
            'product' => $product
        ], 200);
    }
}
