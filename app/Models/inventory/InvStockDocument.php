<?php

namespace App\Models\Inventory;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvStockDocument extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
                ->where('stock_code', 'like', '%'.$search.'%')
                ->orWhere('date_added', 'like', '%'.$search.'%')
                ->orWhere('grn', 'like', '%'.$search.'%')
                ->orWhere('delivery_no', 'like', '%'.$search.'%')
                ->orWhere('lop', 'like', '%'.$search.'%');
    }
}
