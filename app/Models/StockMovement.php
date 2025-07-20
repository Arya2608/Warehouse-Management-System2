<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'from_warehouse_id',
        'to_warehouse_id',
        'quantity',
        'type',
        'user_id',
        'note',
        'timestamp',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'from_warehouse_id');
    }

    public function toWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'to_warehouse_id');
    }

    // 👇 Kode otomatis update stok
    protected static function booted()
    {
        static::created(function ($movement) {
            switch ($movement->type) {
                case 'in':
                    self::adjustStock($movement->product_id, $movement->to_warehouse_id, $movement->quantity);
                    break;

                case 'out':
                    self::adjustStock($movement->product_id, $movement->from_warehouse_id, -$movement->quantity);
                    break;

                case 'transfer':
                    self::adjustStock($movement->product_id, $movement->from_warehouse_id, -$movement->quantity);
                    self::adjustStock($movement->product_id, $movement->to_warehouse_id, $movement->quantity);
                    break;
            }
        });
    }

    protected static function adjustStock($productId, $warehouseId, $qtyChange)
    {
        $inventory = \App\Models\Inventory::firstOrNew([
            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
        ]);

        $inventory->quantity = ($inventory->quantity ?? 0) + $qtyChange;
        $inventory->save();
    }
}
