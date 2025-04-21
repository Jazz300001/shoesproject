@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>My Orders</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if(count($orders) > 0)
                @foreach($orders as $order)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Order #{{ $order->id }}</strong>
                                </div>
                                <div class="col-md-4 text-md-center">
                                    <span>{{ date('M d, Y H:i', strtotime($order->created_at)) }}</span>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <span class="badge bg-success">Completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Shipping Address</h5>
                                    <p>{{ $order->full_name }}<br>
                                    {{ $order->address }}<br>
                                    {{ $order->city }}</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <h5>Order Total</h5>
                                    <h3>${{ number_format($order->total, 2) }}</h3>
                                </div>
                            </div>
                            
                            <h5>Order Items</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->size ?? 'N/A' }}</td>
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
                    You have no orders yet. <a href="{{ route('products') }}" class="alert-link">Start shopping</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection