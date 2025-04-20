@extends('layout')

@section('title', 'Products')

@section('content')
<h1 class="mb-4">Our Shoes Collection</h1>

<div class="row">
    @foreach($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100 product-card">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
            @else
                <div class="text-center pt-3">
                    <div style="width: 100%; height: 180px; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                        <span class="text-muted">No Image</span>
                    </div>
                </div>
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->brand }} - {{ $product->color }}</p>
                <p class="card-text">Size: {{ $product->size }}</p>
                <p class="card-text text-primary fw-bold">${{ number_format($product->price, 2) }}</p>
                <div class="mt-auto">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary">View Details</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                {{ $product->stock_quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if(count($products) == 0)
    <div class="alert alert-info">
        No products found.
    </div>
@endif
@endsection