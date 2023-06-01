<?php

namespace App\Models\DocumentManagement;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DmDocumentResourceCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subFolder()
    {
        return $this->hasMany('App\Models\DocumentManagement\Folder', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(DmDocumentResourceCategory::class, 'parent_id', 'id');
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
