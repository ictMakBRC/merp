<?php

namespace App\Models\DocumentManagement;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DmDocumentCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_by','code', 'category_type', 'is_pair'];

    public static function boot()
    {
        parent::boot();
        if (Auth::check()) {
            self::creating(function ($model) {
                $model->created_by = auth()->id();
            });
        }
    }

    public function documents()
    {
        return $this->hasMany(DmDocument::class, 'document_category_id', 'id');
    }

    public function parent()
    {
       return $this->belongsTo(DmDocumentCategory::class, 'parent_id', 'id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
                ->where('name', 'like', '%'.$search.'%');
    }
}
