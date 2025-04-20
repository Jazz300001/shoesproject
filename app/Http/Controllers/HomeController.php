<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cartId = $request->cookie('cart_id'); 
        return view('home', compact('cartId')); 
    }
}
