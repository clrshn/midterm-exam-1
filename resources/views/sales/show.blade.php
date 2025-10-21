@extends('layouts.app')

@section('content')
<h1>Sale Details #{{ $sale->id }}</h1>

<p><strong>Date:</strong> {{ $sale->sale_date }}</p>
<p><strong>Total:</strong> ₱{{ number_format($sale->total, 2) }}</p>

<h3>Products</h3>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Product</th>
        <th>Price (₱)</th>
        <th>Quantity</th>
        <th>Subtotal (₱)</th>
    </tr>
    @foreach($sale->items as $item)
    <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ number_format($item->price, 2) }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->subtotal, 2) }}</td>
    </tr>
    @endforeach
</table>

<br>

<a href="{{ route('sales.index') }}">⬅ Back to Sales</a>

<br><br>

<form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Delete this sale?')">🗑 Delete Sale</button>
</form>
@endsection
