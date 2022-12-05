<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'tin_number',
        'address',
        'contact',
        'email',
        'contact_person',
        'goods_supplied',
        'is_active',
        'created_by', ];

    public static function boot()
    {
        parent::boot();
        if (Auth::check()) {
            self::creating(function ($model) {
                $model->created_by = auth()->id();
            });
        }
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
                ->where('supplier_name', 'like', '%'.$search.'%')
                ->orWhere('contact_person', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search)
                ->orWhere('contact', 'like', '%'.$search)
                ->orWhere('tin_number', $search);
    }
}
