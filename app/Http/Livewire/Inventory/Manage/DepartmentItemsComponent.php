<?php

namespace App\Http\Livewire\Inventory\Manage;

use Livewire\Component;
use App\Models\Department;
use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invItems;

class DepartmentItemsComponent extends Component
{
    public $brand, $department_id, $inv_item_id = [];
    public $perPage = 10;

    public $search = '';
    public $orderAsc = true;
    public $edit_id;

    public $is_active;

    public $delete_id;

    public $is_update = 'false';

    protected $paginationTheme = 'bootstrap';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $validationAttributes = [
        'user_id' => 'facility',
        'is_active' => 'status',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'department_id' => 'required',
            'inv_item_id' => 'required',
            'is_active' => 'required',

        ]);
    }

    public function mount()
    {
        $this->studies = collect();
    }
    // lifecycle hook sometimes we require it for select2
    public function hydrate()
    {
        $this->emit('select2');
    }

    public function storeData()
    {
        $this->validate([
            'department_id' => 'required',
            'inv_item_id' => 'required',
            'brand' => 'required',
        ]);

        $input = [
            'inv_item_id' => $this->inv_item_id,
            'brand' => $this->brand,
            'department_id' => $this->department_id,
        ];
        inv_department_Item::create($input);
     
        $this->emit('productStore');

        // foreach ( $this->department_id as $value) {
        //     $department_id = $value;
        //     $inv_item_id =  $this->inv_item_id;
        //     $isExist = inv_department_Item::select('*')
        //     ->where('inv_item_id', $inv_item_id)
        //     ->where('department_id', $department_id)
        //     ->where('brand',  $this->brand)
        //     ->exists();
        //     if ($isExist) {
        //         inv_department_Item::where('inv_item_id', $inv_item_id)
        //         ->where('department_id', $department_id)->update(['is_active' => '1']);

        //     //return redirect()->back()->with('error', 'Some Records already exists !!');
        //     } else {
        //         $value = new  inv_department_Item();
        //         $value->inv_item_id = $inv_item_id;
        //         $value->department_id = $department_id;
        //         $value->brand =  $this->brand;
        //         $value->save();
        //     }
        // }

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'value created successfully!']);
    }

    public function editdata($id)
    {
        $value = invItems::where('id', $id)->first();
        $this->inv_item_id = $value->inv_item_id;
        $this->department_id = $value->department_id;
  
        // $this->dispatchBrowserEvent('edit-modal');
    }

    public function resetInputs()
    {
        $this->reset([
            'inv_item_id',
            'department_id',
           
        ]);
        $this->is_update = 'false';
    }

 
    public function refresh()
    {
        return redirect(request()->header('Referer'));
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('delete-modal');
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',  
            'message' => 'Are you sure?', 
            'text' => 'If deleted, you will not be able to recover this imaginary file!'
        ]);
        // if (Auth::user()->hasPermission(['manage-users'])) {

        // } else {
        //     $this->dispatchBrowserEvent('cant-delete', ['type' => 'warning',  'message' => 'Oops! You do not have the necessary permissions to delete this resource!']);
        // }
    }

    public function deleteData()
    {
        try {
            $value = inv_department_Item::where('id', $this->delete_id)->first();
            $value->delete();
            $this->delete_id = '';
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'value deleted successfully!']);
        } catch(\Exception $error) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'value can not be deleted!']);
        }
    }

    public function cancel()
    {
        $this->delete_id = '';
        $this->resetInputs();
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function render()
    {
        $data['items'] = invItems::leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('*', 'inv_items.id as item_id')
        ->get();
        $data['units'] = Department::orderBy('department_name', 'asc')->get();
        $data['values'] = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
        ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('*', 'inv_department__items.id as item_id')
        ->get();
        return view('livewire.inventory.manage.department-items-component', $data)->layout('inventdashboard.layouts.app');
    }
}
