<?php

namespace App\Http\Livewire\Humanresource;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Humanresource\HrOffice;

class OfficesComponent extends Component
{
   
    use WithPagination;

    public $perPage = 10;

    public $search = '';

    public $orderBy = 'name';

    public $orderAsc = true;

    public $name;

    public $description;

    public $mode = 'add';

    public $delete_id;

    public $edit_id;

    public $iteration = 1;

    public $template;

    public $page_title;

    protected $paginationTheme = 'bootstrap';

    public function export()
    {
        // return (new officesExport())->download('offices.xlsx');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->page_title = 'Offices';
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:hr_offices',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|unique:hr_offices',

        ]);

        $office = new HrOffice();
        $office->name = $this->name;
        $office->description = $this->description;
        $office->save();

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'referral name created successfully!']);
    }

    public function editData(HrOffice $office)
    {
        $this->edit_id = $office->id;
        $this->name = $office->name;
        $this->description = $office->description;
        $this->mode = 'edit';
        //$this->dispatchBrowserEvent('edit-modal');
    }

    public function resetInputs()
    {
        $this->reset(['name', 'description']);
        $this->mode = 'add';
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required|unique:hr_offices,name,'.$this->edit_id.'',
        ]);

        $office = HrOffice::find($this->edit_id);
        $office->name = $this->name;
        $office->description = $this->description;
        $office->update();

        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'office updated successfully!']);
    }

    public function refresh()
    {
        return redirect(request()->header('Referer'));
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
        $data['offices'] = HrOffice::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.humanresource.offices-component',$data)->layout('humanResource.layouts.app');
    }
}
