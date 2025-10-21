@extends('layouts.app')

@section('content')
<h1>Products</h1>
<a href="{{ route('products.create') }}">+ Add Product</a>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price (₱)</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ number_format($product->price, 2) }}</td>
        <td>{{ $product->stock }}</td>
        <td>
            <a href="{{ route('products.show', $product) }}">View</a> |
            <a href="{{ route('products.edit', $product) }}">Edit</a> |
            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
