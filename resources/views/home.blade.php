@extends('layout')

@section('title', 'Home')

@section('content')
<div class="jumbotron text-center bg-light p-5 rounded mb-4">
    <h1>Welcome to the Shoe Store</h1>
    <p class="lead">Find the perfect shoes for every occasion</p>
    <a href="{{ route('products') }}" class="btn btn-primary">Shop Now</a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Quality Selection</h5>
                <p class="card-text">We offer a wide variety of premium footwear for all occasions.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Fast Shipping</h5>
                <p class="card-text">Get your favorite shoes delivered quickly to your doorstep.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title">Easy Returns</h5>
                <p class="card-text">Not satisfied? Return your purchase within 30 days.</p>
            </div>
        </div>
    </div>
</div>

<div class="text-center mb-5">
    <h2>Featured Collections</h2>
    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Running Shoes</h5>
                    <p class="card-text">Performance footwear for your active lifestyle</p>
                    <a href="{{ route('products') }}?category=running" class="btn btn-outline-primary">View Collection</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Casual Shoes</h5>
                    <p class="card-text">Comfortable everyday footwear</p>
                    <a href="{{ route('products') }}?category=casual" class="btn btn-outline-primary">View Collection</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection