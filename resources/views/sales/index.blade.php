@extends('layouts.app')

@section('content')
<h1>Sales</h1>

<a href="{{ route('sales.create') }}">+ New Sale</a>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>#</th> {{-- Changed from ID --}}
            <th>Date</th>
            <th>Product</th>
            <th>Price (₱)</th>
            <th>Quantity</th>
            <th>Subtotal (₱)</th>
            <th>Total (₱)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $saleIndex => $sale)
            @php
                $rowspan = $sale->items->count();
            @endphp

            @foreach($sale->items as $index => $item)
                <tr>
                    {{-- Sequential Number & Date (only on first row of each sale) --}}
                    @if($index === 0)
                        <td rowspan="{{ $rowspan }}">{{ $saleIndex + 1 }}</td>
                        <td rowspan="{{ $rowspan }}">{{ $sale->sale_date }}</td>
                    @endif

                    {{-- Product Info --}}
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>

                    {{-- Subtotal --}}
                    <td>{{ number_format($item->subtotal, 2) }}</td>

                    {{-- Sale Total + Actions (only on first row of each sale) --}}
                    @if($index === 0)
                        <td rowspan="{{ $rowspan }}">
                            <strong>₱{{ number_format($sale->total, 2) }}</strong>
                        </td>
                        <td rowspan="{{ $rowspan }}">
                            <a href="{{ route('sales.show', $sale) }}">View</a> |
                            <a href="{{ route('sales.edit', $sale) }}">Edit</a> |
                            <form action="{{ route('sales.destroy', $sale) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this sale?')">Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection
