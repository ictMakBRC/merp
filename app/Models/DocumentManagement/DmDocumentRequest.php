<?php

namespace App\Models\DocumentManagement;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DmDocumentRequest extends Model
{
    use HasFactory;

    
    public function category()
    {
        return $this->belongsTo(DmDocumentCategory::class, 'request_category', 'id');
    }

    public function documents()
    {
        return $this->hasMany(DmRequestDocuments::class, 'request_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
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
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
               ->where('title', 'like', '%'.$search.'%')
               ->orWhere('request_code', 'like', '%'.$search.'%')
               ->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
    }
}
