@extends('layouts.app')

@section('content')
<h1>Edit Product</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Name:</label><br>
    <input type="text" name="name" id="name" 
           value="{{ old('name', $product->name) }}" required><br><br>

    <label for="price">Price (₱):</label><br>
    <input type="number" step="0.01" name="price" id="price" 
           value="{{ old('price', $product->price) }}" required><br><br>

    <label for="stock">Stock:</label><br>
    <input type="number" name="stock" id="stock" 
           value="{{ old('stock', $product->stock) }}" required><br><br>

    <!-- Save button -->
    <button type="submit">Save</button>

    <!-- Cancel button -->
    <a href="{{ route('products.create') }}">
        <button type="button">Cancel</button>
    </a>
</form>

<br>
<a href="{{ route('products.create') }}">⬅ Back to Products</a>
@endsection
