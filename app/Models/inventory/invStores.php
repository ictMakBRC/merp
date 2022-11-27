<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invStores extends Model
{
    use HasFactory;

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
                ->where('store_name', 'like', '%'.$search.'%')
                ->orWhere('store_location', 'like', '%'.$search.'%');
    }
}
