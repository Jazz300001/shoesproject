<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ProductModel {
    public static function all() {
        return DB::select('SELECT * FROM products ORDER BY id');
    }

    public static function find($id) {
        return DB::selectOne('SELECT * FROM products WHERE id = ?', [$id]);
    }

    public static function create($data) {
        DB::insert("
            INSERT INTO products (name, brand, size, color, price, description, image_url, category, stock_quantity, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())
        ", [
            $data['name'],
            $data['brand'],
            $data['size'],
            $data['color'],
            $data['price'],
            $data['description'] ?? null,
            $data['image_url'] ?? null,
            $data['category'] ?? null,
            $data['stock_quantity'],
        ]);
        
        return DB::getPdo()->lastInsertId();
    }

    public static function update($id, $data) {
        DB::update("
            UPDATE products
            SET name = ?, brand = ?, size = ?, color = ?, price = ?, description = ?, image_url = ?, category = ?, stock_quantity = ?, updated_at = now()
            WHERE id = ?
        ", [
            $data['name'],
            $data['brand'],
            $data['size'],
            $data['color'],
            $data['price'],
            $data['description'] ?? null,
            $data['image_url'] ?? null,
            $data['category'] ?? null,
            $data['stock_quantity'],
            $id
        ]);
    }

    public static function delete($id) {
        DB::delete('DELETE FROM products WHERE id = ?', [$id]);
    }
    
    public static function search($term) {
        return DB::select("
            SELECT * FROM products
            WHERE name ILIKE ? OR category ILIKE ?
        ", ["%$term%", "%$term%"]);
    }
    
    public static function archive($id) {
        DB::update("UPDATE products SET category = 'archived', updated_at = now() WHERE id = ?", [$id]);
    }
    
    public static function decreaseStock($product_id, $quantity) {
        $product = self::find($product_id);
        if (!$product) {
            throw new \Exception("Product not found: " . $product_id);
        }
        
        $newStockQuantity = $product->stock_quantity - $quantity;
        if ($newStockQuantity < 0) {
            throw new \Exception("Insufficient stock for product: " . $product->name);
        }
        
        DB::update("
            UPDATE products
            SET stock_quantity = ?
            WHERE id = ?
        ", [
            $newStockQuantity,
            $product_id
        ]);
    }
    
    public static function bulkUpload($products) {
        $inserted = 0;
        foreach ($products as $product) {
            if (
                isset($product['id'], $product['name'], $product['brand'], $product['size'], 
                      $product['color'], $product['price'], $product['description'], 
                      $product['image_url'], $product['category'], $product['stock_quantity'])
            ) {
                DB::insert("
                    INSERT INTO products (id, name, brand, size, color, price, description, image_url, category, stock_quantity, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
                    ON CONFLICT (id) 
                    DO UPDATE SET
                        name = EXCLUDED.name,
                        brand = EXCLUDED.brand,
                        size = EXCLUDED.size,
                        color = EXCLUDED.color,
                        price = EXCLUDED.price,
                        description = EXCLUDED.description,
                        image_url = EXCLUDED.image_url,
                        category = EXCLUDED.category,
                        stock_quantity = EXCLUDED.stock_quantity,
                        updated_at = NOW();
                ", [
                    $product['id'],
                    $product['name'],
                    $product['brand'],
                    $product['size'],
                    $product['color'],
                    $product['price'],
                    $product['description'] ?? null, 
                    $product['image_url'] ?? null,
                    $product['category'] ?? null, 
                    $product['stock_quantity'],
                ]);
    
                $inserted++;
            }
        }
        return $inserted;
    }
}