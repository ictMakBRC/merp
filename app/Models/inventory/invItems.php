<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invItems extends Model
{
    use HasFactory;

    public function departmentItems()
    {
        return $this->hasMany(departmentItems::class, 'id', 'inv_item_id');
    }
}
