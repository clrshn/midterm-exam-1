<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show create form + list
    public function create()
    {
        $products = Product::all(); // fetch products for the table
        return view('products.create', compact('products'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // ✅ Check if product already exists
        $existing = Product::where('name', $request->name)->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Product already exists!')
                ->withInput(); // keeps user input in the form
        }

        Product::create($request->all());

        return redirect()->route('products.create')->with('success', 'Product created successfully!');
    }

    // Show product details
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // ✅ Check if new name conflicts with another product
        $exists = Product::where('name', $request->name)
            ->where('id', '!=', $product->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Another product with this name already exists!')
                ->withInput();
        }

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product + resequence IDs
    public function destroy(Product $product)
    {
        $product->delete();

        // ✅ Re-sequence IDs
        $products = Product::orderBy('id')->get();
        $id = 1;
        foreach ($products as $p) {
            DB::table('products')->where('id', $p->id)->update(['id' => $id]);
            $id++;
        }

        // ✅ Reset auto-increment to next ID
        DB::statement("ALTER TABLE products AUTO_INCREMENT = $id");

        return redirect()->route('products.create')->with('success', 'Product deleted and IDs resequenced!');
    }
}
