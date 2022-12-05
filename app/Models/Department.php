<?php

namespace App\Models;

use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invUserdeparment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['department_name', 'parent_department', 'type', 'description', 'status', 'prefix', 'autonumber', 'created_by'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_department', 'id');
    }

    public function child()
    {
        return $this->hasMany(Department::class, 'parent_department', 'id');
    }

    public function invdepatmentItems()
    {
        return $this->hasMany(inv_department_Item::class, 'department_id', 'id');
    }

    public function depatmentUsers()
    {
        return $this->hasMany(invUserdeparment::class, 'department_id', 'id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function units()
    {
        return $this->hasMany(DepartmentUnit::class, 'department_id', 'id');
    }

    // protected $parentColumn = 'parent_id';

    // public function parent()
    // {
    //     return $this->belongsTo(Test::class,$this->parentColumn);
    // }

    // public function children()
    // {
    //     return $this->hasMany(Test::class, $this->parentColumn);
    // }

    // public function allChildren()
    // {
    //     return $this->children()->with('allChildren');
    // }
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
