<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Step - @yield('title', 'Welcome')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f7fc;
            color: #333;
        }

        .navbar {
            background-color: #6f42c1;
        }

        .navbar .navbar-brand,
        .navbar .nav-link,
        .navbar .btn,
        .navbar form input {
            color: white !important;
        }

        .navbar .nav-link:hover {
            text-decoration: underline;
        }

        .btn-outline-light {
            border-color: white;
            color: white;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #6f42c1;
        }

        .product-card {
            height: 100%;
            transition: transform 0.3s ease;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            margin-bottom: 15px;
        }

        footer {
            margin-top: 60px;
            padding: 20px 0;
            background-color: #6f42c1;
            color: white;
        }

        .form-control::placeholder {
            color: #e0d9f1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg mb-4 shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Flash Step</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders') }}">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products') }}">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders') }}">Admin orders</a>
                    </li>
                </ul>
                <form class="d-flex me-2" action="{{ route('product.search') }}" method="POST">
                    @csrf
                    <input class="form-control me-2 bg-black text-dark" type="search" name="search-bar" placeholder="Search shoes...">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-light ms-2">
                    <i class="bi bi-cart3"></i> Cart
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} Shoe Store. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
