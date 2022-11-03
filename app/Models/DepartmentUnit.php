<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DepartmentUnit extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'unit_name', 'belongs_to', 'status', 'description'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        if (Auth::check()) {
            self::creating(function ($model) {
                $model->created_by = auth()->id();
            });
        }
    }
}
