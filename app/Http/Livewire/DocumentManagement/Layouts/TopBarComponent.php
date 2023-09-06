<?php

namespace App\Http\Livewire\DocumentManagement\Layouts;

use Livewire\Component;
use App\Models\DocumentManagement\DmRequestDocuments;

class TopBarComponent extends Component
{
    public $foundDocuments;
    public $search = '';
    public function mount()
    {
        $this->foundDocuments = collect([]);
    }
    public function updatedSearch()
    {
       $this->findDocument();
    }

    public function findDocument()
    {
        $this->foundDocuments = DmRequestDocuments::where('title', 'like', '%'.$this->search.'%')
        ->orWhere('request_code', $this->search)
        ->where('created_by',auth()->user()->id)
        ->orWhereHas('signatories', function ($query) {
            $query->where('signatory_id', auth()->user()->id);})->with(['category','signatories'])
        ->orderBy('id','DESC')->get();
    }
    public function render()
    {

        return view('livewire.document-management.layouts.top-bar-component');
    }
}
