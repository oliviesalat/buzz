<?php

namespace App\Http\Controllers\CartApi;

use App\Http\Controllers\Controller;

class CartApiController extends BaseCartController
{
    public function index()
    {
        //
    }

    public function store()
    {

    }

    public function show($id)
    {
        $cart = $this->service->find($id);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
