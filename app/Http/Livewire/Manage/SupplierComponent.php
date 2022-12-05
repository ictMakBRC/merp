<?php

namespace App\Http\Livewire\Manage;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierComponent extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $search = '';

    public $orderBy = 'supplier_name';

    public $orderAsc = true;

    public $supplier_name;

    public $contact;

    public $address;

    public $email;

    public $contact_person;

    public $tin_number;

    public $edit_id;

    public $is_active;

    public $delete_id;

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
            'supplier_name' => 'required|unique:suppliers,supplier_name',
            'tin_number' => 'required|unique:suppliers,tin_number',
            'address' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:suppliers,email',
            'contact_person' => 'required',
            //'goods_supplied' => 'required',
            'is_active' => 'required',

        ]);
    }

    public function mount()
    {
        $this->studies = collect();
    }

    public function storeData()
    {
        $this->validate([
            'supplier_name' => 'required|unique:suppliers,supplier_name',
            'tin_number' => 'required|unique:suppliers,tin_number',
            'address' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:suppliers,email',
            'contact_person' => 'required',
            //'goods_supplied' => 'required',
        ]);

        $value = new Supplier();
        $value->supplier_name = $this->supplier_name;
        $value->tin_number = $this->tin_number;
        $value->address = $this->address;
        $value->contact = $this->contact;
        $value->email = $this->email;
        $value->contact_person = $this->contact_person;
        //$value->goods_supplied = $this->goods_supplied;
        $value->save();

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'value created successfully!']);
    }

    public function editdata($id)
    {
        $value = Supplier::where('id', $id)->first();
        $this->supplier_name = $value->supplier_name;
        $this->tin_number = $value->tin_number;
        $this->address = $value->address;
        $this->contact = $value->contact;
        $this->email = $value->email;
        $this->contact_person = $value->contact_person;
        //$this->goods_supplied = $value->goods_supplied;
        $this->is_active = $value->is_active;
        $this->edit_id = $id;
        $this->dispatchBrowserEvent('edit-modal');
    }

    public function resetInputs()
    {
        $this->reset([
            'supplier_name',
            'tin_number',
            'address',
            'contact',
            'email',
            'contact_person',
            // 'goods_supplied',
            'is_active', ]);
    }

    public function updateData()
    {
        $this->validate([
            'supplier_name' => 'required|unique:suppliers,supplier_name',
            'tin_number' => 'required|unique:suppliers,tin_number',
            'address' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:suppliers,email',
            'contact_person' => 'required',
            //'goods_supplied' => 'required',
            'is_active' => 'required',
        ]);
      //
        $value = Supplier::find($this->edit_id);
        $value->supplier_name = $this->supplier_name;
        $value->tin_number = $this->tin_number;
        $value->address = $this->address;
        $value->contact = $this->contact;
        $value->email = $this->email;
        $value->contact_person = $this->contact_person;
        //$value->goods_supplied = $this->goods_supplied;
        $value->is_active = $this->is_active;
        $value->update();

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'value updated successfully!']);
    }

    public function refresh()
    {
        return redirect(request()->header('Referer'));
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('delete-modal');
        // if (Auth::user()->hasPermission(['manage-users'])) {

        // } else {
        //     $this->dispatchBrowserEvent('cant-delete', ['type' => 'warning',  'message' => 'Oops! You do not have the necessary permissions to delete this resource!']);
        // }
    }

    public function deleteData()
    {
        try {
            $value = Supplier::where('id', $this->delete_id)->first();
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
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function render()
    {
        $values = Supplier::search($this->search)
        ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
        ->paginate($this->perPage);

        return view('livewire.manage.supplier-component', compact('values'))->layout('inventdashboard.layouts.app');
    }
}
