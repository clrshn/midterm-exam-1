@extends('layouts.app')

@section('content')
<h1>Product Details</h1>

<p><strong>ID:</strong> {{ $product->id }}</p>
<p><strong>Name:</strong> {{ $product->name }}</p>
<p><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</p>
<p><strong>Stock:</strong> {{ $product->stock }}</p>

<a href="{{ route('products.index') }}">← Back to Products</a>
@endsection
