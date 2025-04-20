@extends('layout')

@section('title', 'Shopping Cart')

@section('content')
<h1 class="mb-4">Your Shopping Cart</h1>

@if(count($cartItems) > 0)
    <div class="row">
        <div class="col-md-8">
            @foreach($cartItems as $item)
            <div class="card mb-3 cart-item">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" class="img-fluid rounded" alt="{{ $item->name }}">
                            @else
                                <div style="width: 100%; height: 80px; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <h5>{{ $item->name }}</h5>
                            <p class="text-primary">${{ number_format($item->price, 2) }}</p>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="mb-2">
                                @csrf
                                <div class="input-group">
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->stock_quantity }}" class="form-control">
                                    <button class="btn btn-outline-secondary" type="submit">Update</button>
                                </div>
                            </form>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger w-100">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <p class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <span>${{ number_format($totalAmount, 2) }}</span>
                    </p>
                    <p class="d-flex justify-content-between">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </p>
                    <hr>
                    <p class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span>${{ number_format($totalAmount, 2) }}</span>
                    </p>
                    
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <h5 class="mb-3">Shipping Information</h5>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Proceed to Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info">
        Your cart is empty. <a href="{{ route('products') }}">Continue shopping</a>
    </div>
@endif
@endsection