<?php

namespace App\Http\Livewire\DocumentManagement;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentManagement\DmDocument;
use App\Models\DocumentManagement\DmDocumentRequest;
use App\Models\DocumentManagement\DmDocumentCategory;
use App\Models\DocumentManagement\DmDocumentSignatory;
use App\Models\DocumentManagement\DmRequestDocuments;

class DocumentDashboardComponent extends Component
{
    use WithFileUploads, WithPagination;

    public $perPage = 10;

    public $search = '';

    public $search_folder = '';

    public $orderBy = 'name';

    public $orderAsc = true;

    public $delete_id;

    public $edit_id;

    protected $paginationTheme = 'bootstrap';

    public $createNew = false;

    public $toggleForm = false;

    //Document Categories fields
    public $name;

    public $home_folder;

    //Document Resources fields
    public $document_category_id;

    public $title;

    public $file;

    public $document_category;

    public $status;

    public $sub_categories;
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
    public $document_id;
    public $i = 1;
    
    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }
    public function mount()
    {
        $this->to_date = date('Y-m-d');       
          
            $this->home_folder = auth()->user()->emp_id;
            if (! Storage::has($this->home_folder)) {
                Storage::makeDirectory($this->home_folder);
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Your home Folder was created successfully!']);
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Folder already created!']);
            }
        
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetInputs()
    {
        $this->reset(['delete_id', 'name', 'document_category', 'title', 'file', 'priority', 'status']);
    }

    public function refresh()
    {
        return redirect(request()->header('Referer'));
    }

    // public function updated()
    // {
    //     $this->validate([
    //         'file' => 'required|mimes:pdf,docx|max:20240|file|min:10', // 20MB Max
    //         'title' => 'required|string',
    //         'priority' => 'required',
    //         'details' => 'nullable|string',
    //     ]);
    // }

    public function storeDocument()
    {
        $this->validate([
            'file' => 'required|mimes:pdf,docx|max:20240|file|min:10', // 20MB Max
            'title' => 'required|string',
            'priority' => 'required',
            'details' => 'nullable|string',
        ]);

        $path = $this->home_folder.'/'.$this->current_folder->code;
        $permit_name = date('Ymdhis').'_'.time().'.'.$this->file->extension();
        $document_path = $this->file->storeAs($path, $permit_name);
        $multple_id = 'mult_'.$this->getNumber(10);
        $document = new DmDocument();
        $document->title = $this->title;
        $document->expiry_date = $this->expiry_date;
        $document->priority = $this->priority;
        $document->document_code =$this->getNumber(10);
        $document->mulitple_identifier = $multple_id;
        $document->document_category_id = $this->document_category;
        $document->file = $document_path;
        $document->details = $this->details;
        $document->save();
        // $this->createNew = false;
        $this->addSignatory = true;
        $this->document_id = $document->id;
        $this->updateDocument($document->id);
        $this->dispatchBrowserEvent('close-modal');
        // $this->resetInputs();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Category created successfully!']);
        // return to_route('document.preview',$document->document_code);
    }

    public function updateDocument($id)
    {
       $document = DmDocument::where('id',$id)->with(['category','signatories','user'])->first();
       $this->title =  $document->title;
       $this->priority =  $document->priority;
       $this->file =  $document->file;
       $this->details =  $document->details;       
       $this->addSignatory = true;
       $this->toggleForm = true;
       $this->createNew = true;
       $this->document_id = $document->id;
    }
    public $signatory_id ,$signatory_level;
    public function addSignatory()
    {
        $signatory = new DmDocumentSignatory();
        $signatory->document_id = $this->document_id;
        $signatory->signatory_level = $this->signatory_level;
        $signatory->title = $this->name_title;
        $signatory->signatory_id = $this->signatory_id;
        $signatory->save();
        $this->name_title = null;
        $this->signatory_id = null;
        $this->signatory_id = null;
        $this->signatory_level = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Signatory created successfully!']);
    }

    public function submutRequest()
    {
        $document =  DmDocument::where('id',$this->document_id)->update(['status'=>'Submitted']);
        $signatory = DmDocumentSignatory::Where(['document_id' => $this->document_id, 'signatory_status'=>'Pending'])
        ->orderBy('signatory_level', 'asc')->first();
        // $signatory->signatory_status ='Active'
        $signatory->update(['signatory_status'=>'Active']);
        $this->addSignatory = false;
        $this->toggleForm = false;
        $this->createNew = false;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Document submitted successfully!']);
        // return to_route('document.preview',$document->document_code);
    }

    public function deleteSignatory($id)
    {
        $signatory = DmDocumentSignatory::Where('id', $id)->delete();
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

    public function downloadDocument(DmDocument $document)
    {
        $file = storage_path('app/').$document->file;
        if (file_exists($file)) {
            return Storage::download($document->file, $document->title.' downloaded');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! '.$error]);
        }
    }
    
    public function openFolder($id)
    {
        
        $this->current_folder = DmDocumentCategory::with('parent')->where('id', $id)->first();
        if($this->current_folder){
            $this->folder_open = true;
            $this->current_folder_name = $this->current_folder->name;
            $this->createNew = false;
            $this->parent_id = $this->current_folder->id;
            $this->document_category = $id;
        }else{
            $this->folder_open = false;
            $this->parent_id = 0;
            $this->current_folder_name = null;
            $this->createNew = false;
            $this->resetInputs();
        }
    }
    public function render()
    {
        if($this->document_id){
            $this->active_document =  DmDocument::where('id',$this->document_id)->with(['category','signatories','user'])->first();
        }
            $this->documents = DmDocument::search($this->search)
            ->when($this->active_status, function ($query) { $query->where('status',  $this->active_status);})
            ->when($this->document_category, function ($query) {$query->where('document_category_id', $this->document_category);
            })->with(['category','signatories','user'])->limit(10)->get();
            $data['categories'] = DmDocumentCategory::where('parent_id', $this->parent_id)->get();
            $data['users'] = User::all();
            $data['submited_requets'] = DmDocumentRequest::where('status','!=','Pending')->where('created_by',auth()->user()->id)->get();
            $data['recent_requets'] = DmDocumentRequest::where('status','!=','Pending')->where('status', 'Completed')
            ->when($this->document_category, function ($query) {$query->where('request_category', $this->document_category);})->where('created_by',auth()->user()->id)->get();
            $data['received_requets'] = DmDocumentRequest::where('status','!=','Pending')->WhereHas('documents.signatories', function ($query) {
                $query->where('signatory_id', auth()->user()->id);})->get();
            $data['incomingRequsests'] = DmDocumentRequest::with(['category','documents','user'])->where('status', '!=', 'Completed')
            ->WhereHas('documents.signatories', function ($query) {$query->where('signatory_id', auth()->user()->id);})
            ->when($this->document_category, function ($query) {$query->where('request_category', $this->document_category);})
            ->when($this->active_status, function ($query) { $query->where('status',  $this->active_status);})->where('status','!=','Pending')
            ->get();
        
        return view('livewire.document-management.document-dashboard-component',$data)->layout('livewire.document-management.layouts.app');
    }
}
