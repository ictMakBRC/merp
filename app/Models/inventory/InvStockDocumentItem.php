<?php

namespace App\Models\Inventory;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvStockDocumentItem extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(invItems::class, 'item_id', 'id');
    }
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
                ->where('stock_code', 'like', '%'.$search.'%')
                ->orWhere('stock_qty', 'like', '%'.$search.'%')
                ->orWhereHas('item', function ($query) use ($search) {
                    $query->where('item_name', 'like', '%'.$search.'%');
                })
                ->orWhereHas('item', function ($query) use ($search) {
                    $query->where('item_code', 'like', '%'.$search.'%');
                });
    }
}
