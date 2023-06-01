<?php

namespace App\Models\inventory;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class inv_department_Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'inv_item_id', 'department_id','brand'
    ];

    public function departmentItem()
    {
        return $this->belongsTo(invItems::class, 'inv_item_id', 'id');
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
        // ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        // ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id');
    }
    public function subUnit()
    {
        return $this->belongsTo(invSubunits::class, 'inv_subunit_id', 'id');
    }
    public function uom()
    {
        
        return $this->belongsTo(invUom::class, 'inv_uom_id', 'id');
    }
}
