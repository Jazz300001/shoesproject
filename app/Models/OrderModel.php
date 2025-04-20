<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class OrderModel {
    public static function placeOrder($cart_id, $items, $total_amount, $customer_info) {
        DB::insert("
            INSERT INTO completed_orders (cart_id, full_name, address, city, items, total, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            $cart_id,
            $customer_info['fullname'],
            $customer_info['address'],
            $customer_info['city'],
            json_encode($items),
            $total_amount
        ]);
        
        return DB::getPdo()->lastInsertId();
    }

    public static function getOrdersByCart($cart_id) {
        $orders = DB::table('completed_orders')->where('cart_id', $cart_id)->get();
        
        foreach ($orders as $order) {
            $order->items = json_decode($order->items);
        }
        
        return $orders;
    }
    
    public static function getAll() {
        $orders = DB::select('SELECT * FROM completed_orders ORDER BY created_at DESC');
        
        foreach ($orders as $order) {
            $order->items = json_decode($order->items);
        }
        
        return $orders;
    }
}