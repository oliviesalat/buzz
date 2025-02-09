<?php

namespace App\Services\Product;

use App\Models\Product;

class Service
{
    public function index($request)
    {
        $query = Product::query();
        if (($request->filled('category') && $request->category !== 'all')) {
            $products = $query->where('category', $request->category)->paginate(9);
        } elseif ($request->category !== 'all') {
            $products = $query->paginate(9);
        }
        return $products;
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function store($data)
    {
        return Product::create($data);
    }

    public function update($data, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $product;
        }
        return $product->update($data);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $product;
        }
        $product->delete();
        return $product;
    }

}
