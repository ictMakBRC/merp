<?php

namespace App\Http\Livewire\DocumentManagement;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\DocumentManagement\DmDocument;
use App\Models\DocumentManagement\DmDocumentRequest;
use App\Models\DocumentManagement\DmDocumentCategory;
use App\Models\DocumentManagement\DmRequestDocuments;
use App\Models\DocumentManagement\DmDocumentSignatory;
use App\Models\DocumentManagement\DmRequestSupportDocuments;

class NewDocumentComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $perPage = 10;

    public $search = '';

    public $search_folder = '';

    public $orderBy = 'name';

    public $orderAsc = true;

    public $delete_id;

    public $edit_id;

    public $document_category_id;

    public $title;

    public $file;

    public $document_category;

    public $status;

    protected $paginationTheme = 'bootstrap';

    public $createNew = false;

    public $toggleForm = false;
    public $document_id;
    public $active_document =[];
    public $active_status;
    public $details;
    public $expiry_date;
    public $inputs = [];
    public $name_title;
    public $user_id;
    public $parent_id = 0;
    public $mulitple_identifier, $priority;
    public $documents;  
    public $folder_open, $current_folder, $current_folder_name, $to_date;
    public $addSignatory = false;
    public $addDocument = false;
    public $iteration =1;
    
    public $signatory_id ,$signatory_level, $support_document_title, $support_file, $active_document_id;


    public function storeRequest()
    {
        $this->validate([
            'title' => 'required|string',
            'priority' => 'required',
            'document_category' => 'required',
            'details' => 'nullable|string',
        ]);     
        $request = new DmDocumentRequest();
        $request->title = $this->title;
        $request->priority = $this->priority;
        $request->request_code =$this->getNumber(10);
        $request->request_category = $this->document_category;
        $request->description = $this->details;
        $request->save();
        $this->viewForm = false;
        $this->toggleForm = false;
        $this->addDocument = true;
        // $this->document_id = $request->id;
        $this->attachDocument($request->id);
        $this->dispatchBrowserEvent('close-modal');
        //  $this->resetInputs();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Category created successfully!']);
        // return to_route('document.preview',$document->document_code);
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

    public $description, $addDocements = false ,$viewForm = true, $request_id, $document_title;
    public function attachDocument($id)
    {
       $this->active_document = $request = DmDocumentRequest::where('id',$id)->with(['category','documents','user'])->first();
       $this->title =  $request->title;
       $this->priority =  $request->priority;
       $this->document_category =  $request->request_category;
       $this->description =  $request->description;       
       $this->addDocements = true;
       $this->toggleForm = true;
       $this->createNew = true;
       $this->viewForm = false;
       $this->request_id = $request->id;
    }

    public function addnewEntry()
    {
        $this->viewForm = true;
        $this->createNew = true;
    }

    public function addDocument()
    {
        
        $this->validate([
            'file' => 'required|mimes:pdf,docx|max:20240|file|min:10', // 20MB Max
            'document_title' => 'required|string',
        ]);

        
        $path = 'Merp/documents/originals/'.date("Y-m");
        $permit_name = date('Ymdhis').'_'.time().'.'.$this->file->extension();
        $document_path = $this->file->storeAs($path, $permit_name);
        $document = new DmRequestDocuments();
        $document->title = $this->document_title;
        $document->document_code =$this->getNumber(12);
        $document->document_category_id =  $this->active_document->request_category;
        $document->request_code =  $this->active_document->request_code;
        $document->request_id =  $this->active_document->id;
        $document->original_file = $document_path;
        $document->save();
        $this->iteration = rand();
        $this->document_title = null;
        $this->file = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Document created successfully!']);

    }

    public function addSupportDocument()
    {
        
        $this->validate([
            'support_file' => 'required|mimes:pdf,docx|max:20240|file|min:10', // 20MB Max
            'support_document_title' => 'required|string',
        ]);

        
        $path = 'Merp/documents/support/'.date("Y-m");
        $permit_name = date('Ymdhis').'_'.time().'.'.$this->support_file->extension();
        $document_path = $this->support_file->storeAs($path, $permit_name);
        $document = new DmRequestSupportDocuments();
        $document->title = $this->support_document_title;
        $document->document_code =$this->getNumber(12);
        $document->parent_id =  $this->active_document_id;
        $document->request_id =  $this->active_document->id;
        $document->original_file = $document_path;
        $document->save();
        $this->iteration = rand();
        $this->support_document_title = null;
        $this->support_file = null;
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Document created successfully!']);

    }

    public function addSignatory()
    {
        $this->validate([
            'signatory_level' => 'required|numeric|max:6|min:1', // 20MB Max
            'name_title' => 'required|string',
            'signatory_id' => 'required|numeric',
        ]);
        $signatory = new DmDocumentSignatory();
        $signatory->document_id = $this->active_document_id;
        $signatory->signatory_level = $this->signatory_level;
        $signatory->title = $this->name_title;
        $signatory->signatory_id = $this->signatory_id;
        $signatory->save();
        $this->name_title = null;
        $this->signatory_id = null;
        $this->signatory_level = null;
        $this->active_document_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Signatory created successfully!']);
    }

    public function deleteSignatory($id)
    {
        $signatory = DmDocumentSignatory::Where('id', $id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Signatory removed successfully!']);
    }

    public function render()
    {
        if($this->request_id){
            $data['myRequest']  =   $this->active_document;
        }else{
            $data['myRequest']  = null;
        }

        $data['myRequests'] = DmDocumentRequest::where('created_by', auth()->user()->id)->get();
        $data['categories'] = DmDocumentCategory::where('parent_id', 0)->get();
        $data['users'] = User::all();
        return view('livewire.document-management.new-document-component',$data)->layout('livewire.document-management.layouts.app');
    }
}
