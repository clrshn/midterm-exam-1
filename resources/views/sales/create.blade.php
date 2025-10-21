@extends('layouts.app')

@section('content')
<h1>Create Sale</h1>

<form action="{{ route('sales.store') }}" method="POST">
    @csrf

    <label>Sale Date:</label>
    <input type="date" name="sale_date" value="{{ old('sale_date', date('Y-m-d')) }}">

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0" width="100%" id="sale-items-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price (₱)</th>
                <th>Quantity</th>
                <th>Subtotal (₱)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="items-body">
            <tr class="sale-item">
                <td>
                    <select name="products[]" class="product-select">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }} (₱{{ number_format($product->price, 2) }}, Stock: {{ $product->stock }})
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="price">₱0.00</td>
                <td><input type="number" name="quantities[]" class="quantity-input" value="1" min="1"></td>
                <td class="subtotal">₱0.00</td>
                <td><button type="button" class="remove-item">Remove</button></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right"><strong>Total Purchase:</strong></td>
                <td colspan="2" id="grand-total">₱0.00</td>
            </tr>
        </tfoot>
    </table>

    <br>
    <button type="button" id="add-item">+ Add Another Product</button>
    <br><br>
    <button type="submit">Save Sale</button>
</form>

<script>
function updateRow(row) {
    const productSelect = row.querySelector('.product-select');
    const price = parseFloat(productSelect.options[productSelect.selectedIndex].dataset.price);
    const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;

    // Update price + subtotal
    row.querySelector('.price').textContent = "₱" + price.toFixed(2);
    row.querySelector('.subtotal').textContent = "₱" + (price * quantity).toFixed(2);

    updateGrandTotal();
}

function updateGrandTotal() {
    let total = 0;
    document.querySelectorAll('#items-body .subtotal').forEach(cell => {
        total += parseFloat(cell.textContent.replace('₱','')) || 0;
    });
    document.getElementById('grand-total').textContent = "₱" + total.toFixed(2);
}

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('product-select') || e.target.classList.contains('quantity-input')) {
        updateRow(e.target.closest('.sale-item'));
    }
});

document.getElementById('add-item').addEventListener('click', function() {
    const tbody = document.getElementById('items-body');
    const newRow = tbody.querySelector('.sale-item').cloneNode(true);

    newRow.querySelector('.quantity-input').value = 1;
    newRow.querySelector('.price').textContent = "₱0.00";
    newRow.querySelector('.subtotal').textContent = "₱0.00";

    tbody.appendChild(newRow);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-item')) {
        const row = e.target.closest('.sale-item');
        row.remove();
        updateGrandTotal();
    }
});

// Initialize first row
document.querySelectorAll('.sale-item').forEach(updateRow);
</script>
@endsection
