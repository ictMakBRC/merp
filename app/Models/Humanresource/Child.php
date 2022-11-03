<?php

namespace App\Models\Humanresource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'child_name', 'birth_date'];
}
