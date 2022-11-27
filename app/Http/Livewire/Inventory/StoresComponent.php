<?php

namespace App\Http\Livewire\Inventory;

use Exception;
use Livewire\Component;
use App\Models\inventory\invStores;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class StoresComponent extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $search = '';

    public $orderBy = 'Store_name';

    public $orderAsc = true;

    public $store_name;

    public $store_location;

    public $store_description;

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
            'store_name' => 'required',
            'store_location' => 'required',
            'store_description' => 'required',
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
            'store_name' => 'required',
            'store_location' => 'required',
            'store_description' => 'required',
        ]);

        $value = new invStores();
        $value->store_name = $this->store_name;
        $value->store_location = $this->store_location;
        $value->store_description = $this->store_description;
        $value->user_id = auth()->user()->id;
        $value->save();

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'value created successfully!']);
    }

    public function editdata($id)
    {
        $value = invStores::where('id', $id)->first();
        $this->store_name = $value->store_name;
        $this->store_location = $value->store_location;
        $this->store_description = $value->store_description;
        $this->is_active = $value->is_active;
        $this->edit_id = $id;
        $this->dispatchBrowserEvent('edit-modal');
    }

    public function resetInputs()
    {
        $this->reset(['store_name', 'store_location', 'store_description','is_active']);
    }

    public function updateData()
    {
        $this->validate([
            'store_name' => 'required',
            'store_location' => 'required',
            'store_description' => 'required',
            'is_active' => 'required',
        ]);
        $value = invStores::find($this->edit_id);
        $value->store_name = $this->store_name;
        $value->store_location = $this->store_location;
        $value->store_description = $this->store_description;
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
            $value = invStores::where('id', $this->delete_id)->first();
            $value->delete();
            $this->delete_id = '';
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'value deleted successfully!']);
        } catch(Exception $error) {
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
        $data = invStores::search($this->search)       
        ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
        ->paginate($this->perPage);       
        return view('livewire.inventory.stores-component',compact('data'))->layout('inventdashboard.layouts.app');
    }
}
