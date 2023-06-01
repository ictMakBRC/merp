<?php

namespace App\Http\Livewire\DocumentManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DocumentManagement\DmDocumentCategory;

class DocumentCategoryComponent extends Component
{
    use  WithPagination;

    public $perPage = 10;

    public $search = '';

    public $orderBy = 'name';

    public $show = 'categories';

    public $orderAsc = true;

    public $delete_id;

    public $name;

    public $parent_id = 0;

    public $is_pair;

    public $code;

    public $is_active;

    public $edit_id;

    protected $paginationTheme = 'bootstrap';

    public $createNew = false;

    public $toggleForm = false;

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

    public function export()
    {
        // return (new CouriersExport())->download('Couriers.xlsx');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetInputs()
    {
        $this->reset([
            'parent_id',
            'name',
        ]);
        $this->show = 'categories';
    }

    public function storeCategory()
    {
        $this->validate([
            'name' => 'required|string',

        ]);
        $folder = new DmDocumentCategory();
        $folder->name = $this->name;
        $folder->parent_id = $this->parent_id;
        $folder->code = $this->getNumber(8);
        $folder->save();
        $this->createNew = false;
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInputs();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Category created successfully!']);
    }

    public function getNumber($length)
    {
        $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
    public function editCategory(DmDocumentCategory $data)
    {
        $this->edit_id = $data->id;
        $this->name = $data->name;
        $this->parent_id = $data->parent_id;
        $this->code = $data->code;
        $this->createNew = 1;
        $this->toggleForm = true;
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|string',
            //'is_pair' => 'required|string',

        ]);
        $category = DmDocumentCategory::where('id', $this->edit_id)->first();
        $category->name = $this->name;
        $category->parent_id = $this->parent_id;
        $category->update();
        $this->createNew = false;
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInputs();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Category created successfully!']);
    }

    public function mount()
    {
    }
    public function render()
    {
        $categories = DmDocumentCategory::with('parent')->get();
        return view('livewire.document-management.document-category-component', compact('categories'))->layout('livewire.document-management.layouts.app');
    }
}
