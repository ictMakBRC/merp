<?php

namespace App\Models\asset;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AssetMaintenanceInfo extends Model
{
    use HasFactory;

    public $table = 'asset_maintenance_info';

    protected $fillable = [
        'type',
        'authorised_by',
        'issue_ref',
        'vendor',
        'intenal_vendor',
        'description',
        'recommendation',
        'maintenance_date',
        'next_maintenance',
    ];

    public function issue()
    {
        return $this->belongsTo(AssetIssue::class, 'issue_ref', 'reference');
    }

    public function authorisedby()
    {
        return $this->belongsTo(User::class, 'authorised_by', 'id');
    }

    public function externalvendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor', 'id');
    }

    public function internalvendor()
    {
        return $this->belongsTo(User::class, 'internal_vendor', 'id');
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
