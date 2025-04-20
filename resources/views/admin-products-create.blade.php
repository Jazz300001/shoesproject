@extends('layout')

@section('title', $product ? 'Edit Product' : 'Add Product')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="mb-0">{{ $product ? 'Edit Product' : 'Add New Product' }}</h1>
    </div>
    <div class="card-body">
        <form action="{{ $product ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST">
            @csrf
            @if($product)
                @method('PUT')
            @endif
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product ? $product->name : old('name') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="{{ $product ? $product->brand : old('brand') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ $product ? $product->category : old('category') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <input type="number" step="0.1" class="form-control" id="size" name="size" value="{{ $product ? $product->size : old('size') }}" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color" value="{{ $product ? $product->color : old('color') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product ? $product->price : old('price') }}" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ $product ? $product->stock_quantity : old('stock_quantity') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="image_url" name="image_url" value="{{ $product ? $product->image_url : old('image_url') }}">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ $product ? $product->description : old('description') }}</textarea>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.products') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ $product ? 'Update Product' : 'Add Product' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection