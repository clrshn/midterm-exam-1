<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('items.product')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_date'  => 'required|date',
            'products'   => 'required|array',
            'quantities' => 'required|array',
        ]);

        // 🔹 Check stock first
        foreach ($request->products as $index => $productId) {
            $product  = Product::findOrFail($productId);
            $quantity = (int) $request->quantities[$index];

            if ($product->stock < $quantity) {
                return back()->withErrors([
                    'stock' => "Not enough stock for {$product->name}. Available: {$product->stock}, requested: {$quantity}."
                ])->withInput();
            }
        }

        // ✅ Create sale if all stock checks pass
        $sale = Sale::create([
            'sale_date' => $request->sale_date,
            'total'     => 0,
        ]);

        $total = 0;

        foreach ($request->products as $index => $productId) {
            $product  = Product::findOrFail($productId);
            $quantity = (int) $request->quantities[$index];
            $price    = $product->price;
            $subtotal = $price * $quantity;

            $sale->items()->create([
                'product_id' => $productId,
                'quantity'   => $quantity,
                'price'      => $price,
            ]);

            $total += $subtotal;

            // 🔹 Deduct stock but never go negative
            $newStock = max(0, $product->stock - $quantity);
            $product->update(['stock' => $newStock]);
        }

        $sale->update(['total' => $total]);

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully.');
    }

    public function show(Sale $sale)
    {
        $sale->load('items.product');
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $products = Product::all();
        $sale->load('items.product');
        return view('sales.edit', compact('sale', 'products'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'sale_date'  => 'required|date',
            'products'   => 'required|array',
            'quantities' => 'required|array',
        ]);

        // 🔹 Check stock first
        foreach ($request->products as $index => $productId) {
            $product  = Product::findOrFail($productId);
            $quantity = (int) $request->quantities[$index];

            if ($product->stock < $quantity) {
                return back()->withErrors([
                    'stock' => "Not enough stock for {$product->name}. Available: {$product->stock}, requested: {$quantity}."
                ])->withInput();
            }
        }

        // Delete old items before adding new ones
        $sale->items()->delete();

        $total = 0;

        foreach ($request->products as $index => $productId) {
            $product  = Product::findOrFail($productId);
            $quantity = (int) $request->quantities[$index];
            $price    = $product->price;
            $subtotal = $price * $quantity;

            $sale->items()->create([
                'product_id' => $productId,
                'quantity'   => $quantity,
                'price'      => $price,
            ]);

            $total += $subtotal;

            // 🔹 Deduct stock but never go negative
            $newStock = max(0, $product->stock - $quantity);
            $product->update(['stock' => $newStock]);
        }

        $sale->update([
            'sale_date' => $request->sale_date,
            'total'     => $total,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->items()->delete();
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
