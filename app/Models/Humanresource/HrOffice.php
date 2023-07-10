<?php

namespace App\Models\Humanresource;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HrOffice extends Model
{
    use HasFactory;

    protected $fillable =['name','description','created_by','updated_by'];
    
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
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%');
    }
}
