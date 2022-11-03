<?php

namespace App\Models\asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AssetSubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['subcategory_name', 'asset_category_id'];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function asset()
    {
        return $this->hasMany(Asset::class);
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
