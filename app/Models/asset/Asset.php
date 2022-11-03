<?php

namespace App\Models\asset;

use App\Models\Department;
use App\Models\Station;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_name',
        'asset_category_id',
        'asset_subcategory_id',
        'brand',
        'model',
        'serial_number',
        'barcode',
        'engraved_label',
        'status',
        'user_id',
        'station_id',
        'department_id',
        'condition',
        'vendor_id',
        'purchase_price',
        'purchase_date',
        'purchase_order_number',
        'warranty_end',
        'depreciation_method',
        'depreciation_rate',
        'expected_useful_years',
        'insurance_company',
        'insurance_type',
        'insurance_end',
        'remarks',

    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(AssetSubcategory::class, 'asset_subcategory_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function insurer()
    {
        return $this->belongsTo(Vendor::class, 'insurance_company', 'id');
    }

    public function insurancetype()
    {
        return $this->belongsTo(InsuranceType::class, 'insurance_type', 'id');
    }

    public function assignmenthistory()
    {
        return $this->hasMany(AssignmentHistory::class, 'asset_id', 'id')->orderBy('created_at', 'desc');
    }

    public function issues()
    {
        return $this->hasMany(AssetIssue::class);
    }

    public function maintenanceinfo()
    {
        return $this->hasManyThrough(AssetMaintenanceInfo::class, AssetIssue::class, 'asset_id', 'issue_ref', 'id', 'reference')->orderBy('created_at', 'desc');
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
