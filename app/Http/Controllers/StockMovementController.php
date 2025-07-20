<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out,transfer',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'from_warehouse_id' => 'nullable|exists:warehouses,id',
            'to_warehouse_id' => 'nullable|exists:warehouses,id',
        ]);

        $user = auth()->user();

        if ($request->type === 'in' && !$request->to_warehouse_id) {
            return response()->json(['error' => 'to_warehouse_id is required for stock in'], 422);
        }

        if ($request->type === 'out' && !$request->from_warehouse_id) {
            return response()->json(['error' => 'from_warehouse_id is required for stock out'], 422);
        }

        if ($request->type === 'transfer' && (!$request->from_warehouse_id || !$request->to_warehouse_id)) {
            return response()->json(['error' => 'from_warehouse_id and to_warehouse_id are required for transfer'], 422);
        }

        $movement = StockMovement::create([
            'product_id' => $request->product_id,
            'from_warehouse_id' => $request->from_warehouse_id,
            'to_warehouse_id' => $request->to_warehouse_id,
            'quantity' => $request->quantity,
            'type' => $request->type,
            'note' => $request->note,
            'user_id' => $user->id,
        ]);

        return response()->json($movement->load(['product', 'user', 'fromWarehouse', 'toWarehouse']), 201);
    }
}
