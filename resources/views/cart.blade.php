@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Your Shopping Cart</h2>
    
    @if(count($cartItems) > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    @if($item->image_url)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" style="width: 80px; height: 80px; object-fit: contain;" class="me-3">
                                    @else
                                        <img src="/api/placeholder/80/80" alt="{{ $item->name }}" class="me-3">
                                    @endif
                                    <div>
                                        <h6 class="mb-0">{{ $item->name }}</h6>
                                        <small class="text-muted">Size: {{ $item->size }} | Color: {{ $item->color }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">${{ number_format($item->price, 2) }}</td>
                            <td class="align-middle" style="width: 150px;">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->stock_quantity }}" class="form-control form-control-sm me-2" style="width: 70px;">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="align-middle">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            <td class="align-middle">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>${{ number_format($totalAmount, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span>$0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span>${{ number_format($totalAmount, 2) }}</span>
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ route('checkout') }}" class="btn btn-primary w-100">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Have a Coupon?</h5>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter coupon code">
                            <button class="btn btn-outline-secondary" type="button">Apply</button>
                        </div>
                        
                        <h5 class="card-title mt-3">Continue Shopping</h5>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left me-2"></i>Back to Shop
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <p>Your shopping cart is empty.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">
                <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection