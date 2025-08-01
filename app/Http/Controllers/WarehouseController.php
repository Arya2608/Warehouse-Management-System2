<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        return Warehouse::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'nullable|string',
        ]);

        $warehouse = Warehouse::create($request->all());

        return response()->json($warehouse, 201);
    }

    public function show($id)
    {
        return Warehouse::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($request->all());

        return response()->json($warehouse);
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();

        return response()->json(['message' => 'Warehouse deleted']);
    }
}
