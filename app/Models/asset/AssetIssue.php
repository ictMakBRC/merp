<?php

namespace App\Models\asset;

use App\Models\Department;
use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AssetIssue extends Model
{
    use HasFactory;

    protected $fillable = ['reference', 'subject', 'issue_type',
        'asset_id', 'priority', 'deadline', 'station_id',
        'source_dept', 'destination_dept',
        'description', 'issue_status', 'reason', ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function sourcedept()
    {
        return $this->belongsTo(Department::class, 'source_dept');
    }

    public function destinationdept()
    {
        return $this->belongsTo(Department::class, 'destination_dept');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function maintenanceinfo()
    {
        return $this->hasOne(AssetMaintenanceInfo::class, 'issue_ref', 'reference');
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
