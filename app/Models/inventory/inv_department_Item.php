<?php

namespace App\Models\inventory;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inv_department_Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'inv_item_id', 'department_id','brand'
    ];

    public function departmentItem()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    // public function itemDpeartments()
    // {
    //     return $this->belongsTo(invItems::class, 'inv_item_id', 'project_acronym')->select('*', 'specimen_type_id', DB::raw('count(biospecimen.id) as count'))
    //     ->groupBy('ProjectAcronym');

    // }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(invItems::class, 'inv_item_id', 'id');
    }
}
