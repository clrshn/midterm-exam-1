@extends('layouts.app')

@section('content')
<h1>Products</h1>

{{-- ✅ Success message --}}
@if(session('success'))
    <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
@endif

{{-- ❌ Error message (e.g., duplicate product) --}}
@if(session('error'))
    <p style="color: red; font-weight: bold;">{{ session('error') }}</p>
@endif

{{-- ✅ Add product form --}}
<form action="{{ route('products.store') }}" method="POST" style="margin-bottom:20px;">
    @csrf
    <label>
        Name:
        <input type="text" name="name" value="{{ old('name') }}" required>
    </label>
    <br><br>
    <label>
        Price (₱):
        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required>
    </label>
    <br><br>
    <label>
        Stock:
        <input type="number" name="stock" value="{{ old('stock') }}" required>
    </label>
    <br><br>
    <button type="submit">Add Product</button>
</form>

{{-- ✅ Show validation errors --}}
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- ✅ Products table --}}
<table border="1" cellpadding="8" cellspacing="0">
    <tr style="background-color:#e91e63; color:white;">
        <th>ID</th>
        <th>Name</th>
        <th>Price (₱)</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>
    @foreach($products as $index => $product)
    <tr style="background-color: {{ $index % 2 == 0 ? '#9fa8da' : '#f06292' }};">
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ number_format($product->price, 2) }}</td>
        <td>{{ $product->stock }}</td>
        <td>
            <a href="{{ route('products.show', $product) }}">View</a> |
            <a href="{{ route('products.edit', $product) }}">Edit</a> |
            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                @csrf 
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
