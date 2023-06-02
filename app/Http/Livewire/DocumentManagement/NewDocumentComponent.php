<?php

namespace App\Http\Livewire\DocumentManagement;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentManagement\DmDocument;
use App\Models\DocumentManagement\DmDocumentRequest;
use App\Models\DocumentManagement\DmDocumentCategory;
use App\Models\DocumentManagement\DmRequestDocuments;
use App\Jobs\DocumentManagement\SendEmailNotification;
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
    public $active_request =[];
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
    public $person_exists = false;
    
    public $signatory_id ,$signatory_level, $support_document_title, $support_file, $active_document_id, $summary;

    public $description, $addDocements = false ,$viewForm = true, $request_id, $document_title, $my_document_id;

    public function updatedMyDocumentId(){
        

        $level = DmDocumentSignatory::where('document_id', $this->my_document_id)->orderBy('id','DESC')->first();
        if($level){
            $this->signatory_level = $level->signatory_level +1;
        }else{
            $this->signatory_level = 1;
        }
    }

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

    public function attachDocument($id)
    {
       $this->active_request = $request = DmDocumentRequest::where('id',$id)->with(['category','documents','user'])->first();
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

        
        $path = 'Merp/documents/originals/'.date("Y").'/'.date("m");
        $permit_name = date('Ymdhis').'_'.time().'.'.$this->file->extension();
        $document_path = $this->file->storeAs($path, $permit_name);
        $document = new DmRequestDocuments();
        $document->title = $this->document_title;
        $document->document_code =$this->getNumber(12);
        $document->document_category_id =  $this->active_request->request_category;
        $document->request_code =  $this->active_request->request_code;
        $document->request_id =  $this->active_request->id;
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

        
        $path = 'Merp/documents/support/'.date("Y").'/'.date("m");
        $permit_name = date('Ymdhis').'_'.time().'.'.$this->support_file->extension();
        $document_path = $this->support_file->storeAs($path, $permit_name);
        $document = new DmRequestSupportDocuments();
        $document->title = $this->support_document_title;
        $document->document_code =$this->getNumber(12);
        $document->parent_id =  $this->my_document_id;
        $document->request_id =  $this->active_request->id;
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
            // 'signatory_level' => 'required|numeric|max:6|min:1', // 20MB Max
            'name_title' => 'required|string',
            'signatory_id' => 'required|numeric',
        ]);
        $exists = DmDocumentSignatory::where(['signatory_id'=>$this->signatory_id, 'document_id'=>$this->my_document_id])->first();
        // dd($exists);
        if($exists){
            $this->person_exists = true;
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Signatory already exists on this particular document, please select another different person']);
        }else{
        $signatory = new DmDocumentSignatory();
        $signatory->document_id = $this->my_document_id;
        $level = DmDocumentSignatory::where('document_id', $this->my_document_id)->orderBy('id','DESC')->first();
        if($level){
            $signatory->signatory_level = $level->signatory_level +1;
        }else{
            $signatory->signatory_level = 1;
            // $signatory->signatory_status = 'Active';
            // $signatory->is_active = '1';
        }
        // $signatory->signatory_level = $this->signatory_level;
        $signatory->title = $this->name_title;
        $signatory->signatory_id = $this->signatory_id;
        $signatory->save();
        $this->signatory_level = $signatory->signatory_level+1;
        $this->name_title = null;
        $this->signatory_id = null;
        $this->summary = null;
        $this->signatory_level = null;
        $this->active_document_id = null;
        $this->person_exists = false;
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Signatory created successfully!']);
    }
    }

    public function downloadDocument(DmRequestDocuments $document)
    {
        $file = storage_path('app/').$document->original_file;
        if (file_exists($file)) {
            return Storage::download($document->original_file, $document->title.' downloaded');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! '.$error]);
        }
    }

    public function downloadSupportDocument(DmRequestSupportDocuments $document)
    {
        $file = storage_path('app/').$document->original_file;
        if (file_exists($file)) {
            return Storage::download($document->original_file, $document->title.' downloaded');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! '.$error]);
        }
    }

    public function deleteSignatory($id)
    {
        $signatory = DmDocumentSignatory::Where('id', $id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Signatory removed successfully!']);
    }

    public function deleteDocument($id)
    {
        try {
            $data = DmRequestDocuments::where('id', $id)->first();
            Storage::delete($data->original_file);
            $data->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Document file deleted successfully!']);
        } catch(\Exception $error) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! '.$error]);
        }
    }

    public function deleteSupportDocument($id)
    {
        try {
            $data = DmRequestSupportDocuments::where('id', $id)->first();
            Storage::delete($data->original_file);
            $data->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Document file deleted successfully!']);
        } catch(\Exception $error) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! '.$error]);
        }
    }

    public function submitRequest()
    {
           

        $myRequest = DmDocumentRequest::where('id',$this->request_id)->with(['documents'])->first();
        if ($myRequest && count($myRequest->documents)){
            foreach ($myRequest->documents as $document)   {
                $signatory = DmDocumentSignatory::Where(['document_id' => $document->id, 'signatory_status'=>'Pending'])
                ->orderBy('signatory_level', 'asc')->first();
                $signatory->update(['signatory_status'=>'Active']);
                try {
                    $user = User::where('id',$signatory->signatory_id )->first();
                   
                    $signature_request = [
                        'to' => $user->email,
                        'phone' => $user->contact,
                        'subject' => 'Document request for '.$myRequest->title.' needs your signature',
                        'greeting' => 'Hi '.$user->title.' '.$user->name,
                        'body' => 'You have a document request for document #'.$myRequest->title.' on request '.$myRequest->request_code.' to sign',
                        'thanks' => 'Thank you, incase of any question, please reply support@makbrc.org',
                        'actionText' => 'View Details',
                        'actionURL' => url('/documents/request/'.$myRequest->request_code.'/sign'),
                        'department_id' => $myRequest->created_by,
                        'user_id' => $myRequest->created_by,
                    ];
                    // WhatAppMessageService::sendReferralMessage($referral_request);
                 $mm=   SendEmailNotification::dispatch($signature_request)->delay(Carbon::now()->addSeconds(20));
                //  dd($mm);
                } catch(Throwable $error) {
                    // $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Referral Request '.$error.'!']);
                }
            }
            DmRequestDocuments::where('request_id',$this->request_id)->update(['status'=>'Submitted']);
            DmDocumentRequest::where('id',$this->request_id)->update(['status'=>'Submitted']);
        }

        $this->addSignatory = false;
        $this->toggleForm = false;
        $this->createNew = false;
        $this->addDocements = false;
        $this->addSignatory = false;
        $this->addDocument = false;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Document submitted successfully!']);
        // return to_route('document.preview',$document->document_code);
    }

    public function render()
    {
        if($this->request_id){
            $data['myRequest']  =   DmDocumentRequest::where('id',$this->request_id)->with(['category','documents','user'])->first();
        }else{
            $data['myRequest']  = null;
        }

        $data['myRequests'] = DmDocumentRequest::search($this->search)->where('created_by', auth()->user()->id)->orderBy('id','DESC')->get();
        $data['categories'] = DmDocumentCategory::where('parent_id', 0)->get();
        $data['users'] = User::all();
        return view('livewire.document-management.new-document-component',$data)->layout('livewire.document-management.layouts.app');
    }
}
