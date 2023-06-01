<?php

namespace App\Http\Livewire\DocumentManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DocumentManagement\DmDocument;
use App\Models\DocumentManagement\DmRequestDocuments;

class RecentDocumentsComponent extends Component
{
    use  WithPagination;

    public $perPage = 10;

    public $search = '';

    public $orderBy = 'name';

    public $show = 'categories';

    public $orderAsc = true;

    public $delete_id;

    public $name;   

    protected $paginationTheme = 'bootstrap';


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
  

    public function mount()
    {
    }
    public function render()
    {
        $data['documents']= DmRequestDocuments::search($this->search)->where('created_by',auth()->user()->id)->with(['category','signatories'])->get();
        return view('livewire.document-management.recent-documents-component',$data)->layout('livewire.document-management.layouts.app');
    }
}
