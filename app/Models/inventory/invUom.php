<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invUom extends Model
{
    use HasFactory;

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('uom_name', 'like', '%'.$search.'%');
    }
}
