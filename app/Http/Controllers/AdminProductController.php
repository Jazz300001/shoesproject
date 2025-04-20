<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $products = ProductModel::search($search);
        } else {
            $products = ProductModel::all();
        }

        return view('admin-products', compact('products'));
    }

    public function create()
    {
        return view('admin-create', ['product' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'brand' => 'required|string',
            'size' => 'required|numeric',
            'color' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image_url' => 'nullable',
            'category' => 'nullable',
            'stock_quantity' => 'required|integer',
        ]);

        ProductModel::create($validated);

        return redirect()->route('admin.products')->with('success', 'Product added.');
    }

    public function edit($id)
    {
        $product = ProductModel::find($id);

        if (!$product) {
            abort(404);
        }

        return view('admin-create', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'brand' => 'required|string',
            'size' => 'required|numeric',
            'color' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image_url' => 'nullable',
            'category' => 'nullable',
            'stock_quantity' => 'required|integer',
        ]);

        ProductModel::update($id, $validated);

        return redirect()->route('admin.products')->with('success', 'Product updated.');
    }

    public function destroy($id)
    {
        ProductModel::delete($id);

        return redirect()->route('admin.products')->with('success', 'Product deleted.');
    }

    public function archive($id)
    {
        ProductModel::archive($id);

        return redirect()->route('admin.products')->with('success', 'Product archived.');
    }

    public function uploadForm()
    {
        return view('admin-upload');
    }

    public function uploadStore(Request $request)
    {
        $request->validate([
            'file_upload' => 'required|file|mimes:json,txt,csv',
        ]);
    
        $file = $request->file('file_upload');
        $content = file_get_contents($file->getRealPath());
    
        $products = json_decode($content, true);
    
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($products)) {
            return back()->with('error', 'Invalid JSON file format.');
        }
    
        $inserted = ProductModel::bulkUpload($products);
    
        return back()->with('success', "$inserted product(s) uploaded successfully.");
    }
}