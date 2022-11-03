<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vendor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['vendor_name', 'contact', 'address', 'comment', 'email', 'belongs_to'];

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
