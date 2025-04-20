<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class CartItemModel {
    public static function getItems($cart_id) {
        return DB::select("
            SELECT ci.id, ci.product_id, ci.quantity, p.name, p.price, p.image_url, p.stock_quantity
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.cart_id = ?
        ", [$cart_id]);
    }

    public static function addItem($cart_id, $product_id, $quantity = 1) {
        $existing = DB::selectOne('SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?', [$cart_id, $product_id]);
        if ($existing) {
            DB::update('UPDATE cart_items SET quantity = quantity + ?, updated_at = NOW() WHERE id = ?', [$quantity, $existing->id]);
            return $existing->id;
        } else {
            DB::insert('INSERT INTO cart_items (cart_id, product_id, quantity, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())', [$cart_id, $product_id, $quantity]);
            return DB::getPdo()->lastInsertId();
        }
    }

    public static function updateItem($item_id, $quantity) {
        DB::update('UPDATE cart_items SET quantity = ?, updated_at = NOW() WHERE id = ?', [$quantity, $item_id]);
    }

    public static function removeItem($item_id) {
        DB::delete('DELETE FROM cart_items WHERE id = ?', [$item_id]);
    }

    public static function clearCart($cart_id) {
        DB::delete('DELETE FROM cart_items WHERE cart_id = ?', [$cart_id]);
    }
    
    public static function getTotalAmount($cart_id) {
        $cartItems = self::getItems($cart_id);
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->price * $item->quantity;
        }
        return $totalAmount;
    }
    
    public static function getItemsForOrder($cart_id) {
        $cartItems = self::getItems($cart_id);
        return array_map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'name' => $item->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ];
        }, $cartItems);
    }
}