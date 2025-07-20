<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return Inventory::with(['product', 'warehouse'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'quantity' => 'required|integer',
        ]);

        $inventory = Inventory::create($validated);
        return response()->json($inventory, 201);
    }

    public function show($id)
    {
        return Inventory::with(['product', 'warehouse'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'quantity' => 'required|integer',
        ]);

        $inventory->update($validated);
        return response()->json($inventory);
    }

    public function destroy($id)
    {
        Inventory::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
