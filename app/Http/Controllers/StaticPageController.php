<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function index()
    {
        return view('staticpages.index');
    }

    public function about()
    {
        return view('staticpages.about');
    }


}
