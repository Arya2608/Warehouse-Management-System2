<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with(['category', 'creator'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'sku' => 'required|string|unique:products',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string',
        ]);

        $validated['created_by'] = Auth::id();

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        return Product::with(['category', 'creator'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'sku' => 'sometimes|string|unique:products,sku,' . $id,
            'category_id' => 'sometimes|exists:categories,id',
            'unit' => 'sometimes|string',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return response()->json(['message' => 'Product deleted']);
    }
}
