<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $products = ProductModel::search($search);
        } else {
            $products = ProductModel::all();
        }

        return view('products', compact('products'));
    }

    public function show($id)
    {
        $product = ProductModel::find($id);

        if (!$product) {
            abort(404);
        }

        return view('product-show', compact('product'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search-bar');
        $products = ProductModel::search($searchTerm);
        return view('products', ['products' => $products]);
    }
}