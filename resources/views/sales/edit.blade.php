@extends('layouts.app')

@section('content')
<h1>Edit Sale #{{ $sale->id }}</h1>
<form action="{{ route('sales.update', $sale->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Sale Date:</label>
    <input type="date" name="sale_date" value="{{ $sale->sale_date }}" required><br><br>

    <h3>Products</h3>
    <div id="products-container">
        @foreach($sale->items as $item)
        <div>
            <select name="products[]">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} (Stock: {{ $product->stock }})
                    </option>
                @endforeach
            </select>
            Quantity: <input type="number" name="quantities[]" min="1" value="{{ $item->quantity }}">
            <button type="button" onclick="this.parentElement.remove()">Remove</button>
        </div>
        @endforeach
    </div>

    <br>
    <button type="submit">Update Sale</button>
</form>
@endsection
