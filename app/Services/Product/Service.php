<?php

namespace App\Services\Product;

use App\Models\Product;

class Service
{
    public function index()
    {
        return Product::all();
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
