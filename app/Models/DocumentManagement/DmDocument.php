<?php

namespace App\Models\DocumentManagement;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DmDocument extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(DmDocumentCategory::class, 'document_category_id', 'id');
    }

    public function signatories()
    {
        return $this->hasMany(DmDocumentSignatory::class, 'document_id', 'id');
        // ->leftJoin('users', 'users.id', '=', 'dm_document_signatories.signatory_id')
        // ->select('users.*', 'users.name as user_name');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    protected $fillable = ['document_category_id', 'parent_id', 'title', 'file','document_code', 'expiry_date', 'status', 'created_by','mulitple_identifier'];

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
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                });
    }
}
