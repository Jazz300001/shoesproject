@extends('layout')

@section('title', 'My Orders')

@section('content')
<h1 class="mb-4">My Orders</h1>

@if(count($orders) > 0)
    @foreach($orders as $order)
    <div class="card mb-4">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-4">
                    <strong>Order #{{ $order->id }}</strong>
                </div>
                <div class="col-md-4 text-md-center">
                    <span>{{ date('F j, Y', strtotime($order->created_at)) }}</span>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="badge bg-success">Completed</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Shipping Details</h5>
                    <p class="mb-0">{{ $order->full_name }}</p>
                    <p class="mb-0">{{ $order->address }}</p>
                    <p>{{ $order->city }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Total</h5>
                    <h3 class="text-primary">${{ number_format($order->total, 2) }}</h3>
                </div>
            </div>
            
            <h5>Items</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="alert alert-info">
        You don't have any orders yet. <a href="{{ route('products') }}">Start shopping</a>
    </div>
@endif
@endsection