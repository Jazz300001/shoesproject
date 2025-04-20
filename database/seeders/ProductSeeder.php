<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
{
    \App\Models\Product::create([
        'sku' => 'BB-001',
        'name' => 'Air Dunk High',
        'brand' => 'Nike',
        'size' => 10,
        'color' => 'Red/White',
        'price' => 149.99,
        'description' => 'High performance basketball shoes.',
        'imageURL' => 'air_dunk_high.jpg',
        'category' => 'Men',
        'stock_quantity' => 20,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-002',
        'name' => 'Curry Flow 10',
        'brand' => 'Under Armour',
        'size' => 9.5,
        'color' => 'Blue/Gold',
        'price' => 139.99,
        'description' => 'Stephen Curry’s signature shoe for quick cuts.',
        'imageURL' => 'curry_flow_10.jpg',
        'category' => 'Men',
        'stock_quantity' => 15,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-003',
        'name' => 'LeBron Witness 7',
        'brand' => 'Nike',
        'size' => 11,
        'color' => 'Black/Crimson',
        'price' => 119.99,
        'description' => 'Built for explosive gameplay and durability.',
        'imageURL' => 'lebron_witness_7.jpg',
        'category' => 'Men',
        'stock_quantity' => 25,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-004',
        'name' => 'Harden Vol. 7',
        'brand' => 'Adidas',
        'size' => 10.5,
        'color' => 'White/Black',
        'price' => 129.99,
        'description' => 'James Harden’s lightweight, agile shoe.',
        'imageURL' => 'harden_vol_7.jpg',
        'category' => 'Men',
        'stock_quantity' => 30,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-005',
        'name' => 'Zoom Freak 4',
        'brand' => 'Nike',
        'size' => 12,
        'color' => 'Green/Black',
        'price' => 134.99,
        'description' => 'Giannis Antetokounmpo’s all-around performer.',
        'imageURL' => 'zoom_freak_4.jpg',
        'category' => 'Men',
        'stock_quantity' => 10,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-006',
        'name' => 'D.O.N. Issue #4',
        'brand' => 'Adidas',
        'size' => 9,
        'color' => 'Red/Black',
        'price' => 109.99,
        'description' => 'Signature shoe for Donovan Mitchell.',
        'imageURL' => 'don_issue_4.jpg',
        'category' => 'Men',
        'stock_quantity' => 18,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-007',
        'name' => 'KD Trey 5 X',
        'brand' => 'Nike',
        'size' => 10,
        'color' => 'White/Blue',
        'price' => 124.99,
        'description' => 'Kevin Durant’s reliable mid-tier court shoe.',
        'imageURL' => 'kd_trey_5.jpg',
        'category' => 'Men',
        'stock_quantity' => 22,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-008',
        'name' => 'Puma MB.02',
        'brand' => 'Puma',
        'size' => 10.5,
        'color' => 'Purple/Yellow',
        'price' => 114.99,
        'description' => 'LaMelo Ball’s signature shoe with a bold look.',
        'imageURL' => 'puma_mb_02.jpg',
        'category' => 'Men',
        'stock_quantity' => 14,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-009',
        'name' => 'New Balance TWO WXY v3',
        'brand' => 'New Balance',
        'size' => 11.5,
        'color' => 'Grey/Neon',
        'price' => 129.99,
        'description' => 'Balanced shoe for guards and wings.',
        'imageURL' => 'nb_two_wxy_v3.jpg',
        'category' => 'Men',
        'stock_quantity' => 16,
    ]);

    \App\Models\Product::create([
        'sku' => 'BB-010',
        'name' => 'Jordan Luka 2',
        'brand' => 'Jordan',
        'size' => 9.5,
        'color' => 'Black/White',
        'price' => 139.99,
        'description' => 'Luka Dončić’s sleek and responsive sneaker.',
        'imageURL' => 'jordan_luka_2.jpg',
        'category' => 'Men',
        'stock_quantity' => 19,
    ]);
}

    
}
