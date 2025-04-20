@extends('layout')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-6">
        @if($product->image_url)
            <img src="{{ $product->image_url }}" class="img-fluid rounded" alt="{{ $product->name }}">
        @else
            <div style="width: 100%; height: 400px; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                <span class="text-muted">No Image</span>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <h5 class="text-muted">{{ $product->brand }}</h5>
        
        <p class="h3 text-primary my-4">${{ number_format($product->price, 2) }}</p>
        
        <div class="mb-3">
            <p><strong>Color:</strong> {{ $product->color }}</p>
            <p><strong>Size:</strong> {{ $product->size }}</p>
            <p><strong>Category:</strong> {{ $product->category ?? 'N/A' }}</p>
            <p><strong>Availability:</strong> 
                @if($product->stock_quantity > 5)
                    <span class="text-success">In Stock ({{ $product->stock_quantity }} available)</span>
                @elseif($product->stock_quantity > 0)
                    <span class="text-warning">Low Stock (Only {{ $product->stock_quantity }} left)</span>
                @else
                    <span class="text-danger">Out of Stock</span>
                @endif
            </p>
        </div>
        
        <div class="mb-4">
            <h5>Description:</h5>
            <p>{{ $product->description ?? 'No description available.' }}</p>
        </div>
        
        <div class="d-grid gap-2">
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg w-100" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                    {{ $product->stock_quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                </button>
            </form>
            <a href="{{ route('products') }}" class="btn btn-outline-secondary">Back to Products</a>
        </div>
    </div>
</div>
@endsection