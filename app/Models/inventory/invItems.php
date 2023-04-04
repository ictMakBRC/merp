<?php

namespace App\Models\inventory;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'inv_subunit_id',
        'cost_price',
        'inv_uom_id',
        'supplier_id',
        'max_qty',
        'min_qty',
        'inv_store_id',
        'description',
        'date_added',
        'is_active',
        'expires',
        'item_code',
        'user_id',
    ];

    public function departmentItems()
    {
        return $this->hasMany(departmentItems::class, 'id', 'inv_item_id');
    }

    public function parentcategory()
    {
        return $this->belongsTo(invSubunits::class, 'inv_subunit_id', 'id');
    }

    public function parentSupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function subUmit()
    {
        return $this->belongsTo(invSubunits::class, 'inv_subunit_id', 'id');
    }

    public function parentUom()
    {
        return $this->belongsTo(invUom::class, 'inv_uom_id', 'id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
                ->where('item_name', 'like', '%'.$search.'%')
                ->orWhere('item_code', 'like', '%'.$search.'%')
                ->orWhereHas('subUmit', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->orWhereHas('parentUom', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                    
                    ;
    }
}
