<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;

class OrderController extends Controller
{
    public function showUserOrders(Request $request)
    {
        $cartId = $request->cookie('cart_id'); 
    
        if (!$cartId) {
            return view('orders', ['orders' => collect()]);
        }
    
        $orders = OrderModel::getOrdersByCart($cartId);
    
        return view('orders', compact('orders'));
        
    }
}