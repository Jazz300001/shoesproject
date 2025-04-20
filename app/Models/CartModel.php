<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartModel {
    public static function getOrCreateCart($cart_id = null) {
        if ($cart_id) {
            $cart = DB::selectOne('SELECT * FROM cart WHERE id = ?', [$cart_id]);
            if ($cart) {
                return $cart;
            }
        }
        
        // Create new cart with random ID
        $newCartId = Str::random(40);
        DB::insert('INSERT INTO cart (id) VALUES (?)', [$newCartId]);
        return DB::selectOne('SELECT * FROM cart WHERE id = ?', [$newCartId]);
    }
    
    public static function deleteCart($cart_id) {
        DB::delete("DELETE FROM cart WHERE id = ?", [$cart_id]);
    }
    
    public static function cartExists($cart_id) {
        $cart = DB::selectOne("SELECT * FROM cart WHERE id = ?", [$cart_id]);
        return $cart !== null;
    }
}