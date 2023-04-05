<?php

namespace App\Models\DocumentManagement;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DmRequestDocuments extends Model
{
    use HasFactory;

    public function signatories()
    {
        return $this->hasMany(DmDocumentSignatory::class, 'document_id', 'id');
    }
    public function suportDocuments()
    {
        return $this->hasMany(DmRequestSupportDocuments::class, 'parent_id', 'id');
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