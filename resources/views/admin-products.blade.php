@extends('layout')

@section('title', 'Admin - Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Product Management</h1>
    <div>
        <a href="{{ route('admin.products.upload') }}" class="btn btn-secondary me-2">Upload Products</a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <form action="{{ route('admin.products') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>
    </div>
    <div class="card-body">
        @if(count($products) > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->category ?? 'N/A' }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            @if($product->stock_quantity > 5)
                                <span class="text-success">{{ $product->stock_quantity }}</span>
                            @elseif($product->stock_quantity > 0)
                                <span class="text-warning">{{ $product->stock_quantity }}</span>
                            @else
                                <span class="text-danger">Out of Stock</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.products.archive', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                </form>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info">
            No products found.
        </div>
        @endif
    </div>
</div>
@endsection