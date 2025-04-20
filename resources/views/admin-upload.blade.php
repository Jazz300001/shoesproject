@extends('layout')

@section('title', 'Upload Products')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="mb-0">Upload Products</h1>
    </div>
    <div class="card-body">
        <p class="alert alert-info">
            Upload a JSON, TXT, or CSV file containing product data. The file should contain an array of product objects with the following fields:
            id, name, brand, size, color, price, description, image_url, category, and stock_quantity.
        </p>
        
        <form action="{{ route('admin.products.upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="file_upload" class="form-label">Select File</label>
                <input type="file" class="form-control" id="file_upload" name="file_upload" required>
                <div class="form-text">Accepted formats: JSON, TXT, CSV</div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.products') }}" class="btn btn-secondary">Back to Products</a>
                <button type="submit" class="btn btn-primary">Upload Products</button>
            </div>
        </form>
    </div>
</div>
@endsection