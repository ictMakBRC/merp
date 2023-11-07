<?php

namespace App\Http\Livewire\DocumentManagement;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Providers\CodeGeneratorService;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentManagement\DmDocumentRequest;
use App\Models\DocumentManagement\DmRequestDocuments;
use App\Jobs\DocumentManagement\SendEmailNotification;
use App\Models\DocumentManagement\DmDocumentSignatory;
use App\Models\DocumentManagement\DmRequestSupportDocuments;

class SignDocumentsComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $requestCode, $active_document_id, $iteration=1, $signed_file;
    public $action = false;
    public $comments, $support_file, $support_document_title;
    public $active_request;
    public function mount($request_code)
    {
        $this->requestCode = $request_code;
        try {
            // $this->active_document_id = DmDocumentRequest::where('request_code', $this->requestCode)->first()->id;
        } catch(\Exception $error) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! '.$error]);
        }
    }

    public function updatedActiveDocumentId()
    {
        $this->action = false;
    }

    public function uploadSignedDoc()
    {
        $this->validate([
            'signed_file' => 'required|mimes:pdf,docx|max:20240|file|min:10', // 20MB Max
            // 'support_document_title' => 'required|string',
        ]);

        
        $scode = CodeGeneratorService::getNumber(8);
        $sintials = CodeGeneratorService::generateInitials(auth()->user()->name);  

        $data = DmRequestDocuments::where('id', $this->active_document_id)->first();
        $file_name = date('Ymdhis').'_'.$data->document_code.'.'.$this->signed_file->extension();
        $new_file = $this->signed_file->storeAs('Merp/documents/signed/'.date("Y").'/'.date("m"), $file_name);
        if ($data->signed_file != null) {
            Storage::delete($data->signed_file);
        }
        $data->signed_file = $new_file;
        $data->update();
        $this->iteration = rand();      
        $signature = $sintials.'_'.$scode;

        $signatory = DmDocumentSignatory::Where(['document_id' => $this->active_document_id, 'signatory_status'=>'Pending'])
        ->orderBy('signatory_level', 'asc')->first();
        if($signatory){
            $signatory->update(['signatory_status'=>'Active']);
            try {
                $user = User::where('id',$signatory->signatory_id )->first();
               
                $signature_request = [
                    'to' => $user->email,
                    'phone' => $user->contact,
                    'subject' => 'New Request for Document singing',
                    'greeting' => 'Dear '.$user->title.' '.$user->name,
                    'body' => 'You have a document request '.$data->title.' Request No#'.$data->request_code.' to sign',
                    'thanks' => 'Thank you, incase of any question, please reply to support@makbrc.org',
                    'actionText' => 'View Details',
                    'actionURL' => url('/documents/request/'.$data->request_code.'/sign'),
                    'department_id' => $data->created_by,
                    'user_id' => $data->created_by,
                ];
                // WhatAppMessageService::sendReferralMessage($referral_request);
              $mm =  SendEmailNotification::dispatch($signature_request)->delay(Carbon::now()->addSeconds(20));
            //   dd($mm);
            } catch(Throwable $error) {
                // $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Referral Request '.$error.'!']);
            }
        }
        DmDocumentSignatory::Where(['document_id' => $this->active_document_id, 'signatory_id'=>auth()->user()->id])
        ->update(['signatory_status'=>'Signed','signature'=>$signature]);
        // ->whereIn('status', ['Submitted','Rejected','Active'])

        $pendinSignatory =  DmDocumentSignatory::where(['document_id' => $this->active_document_id])->where('signatory_status','!=','Signed')->first();
        // dd($pendinSignatory);
        if($pendinSignatory == null){
            // dd('done');
            $this->markDocumentComplete();
            $pendinRequest =  DmRequestDocuments::where(['request_code' => $this->requestCode, 'signed_file'=>null])->where('status','!=','Signed')->first();
            if($pendinRequest == null){
                // dd('done');
            $this->markRequestComplete();
            }
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'Success',  'message' => 'File uploaded successfully! ']);
    }

    public function markDocumentComplete()
    {
       $data = DmRequestDocuments::where('id', $this->active_document_id)->update(['status'=>'Signed']);
        try {
            $user = User::where('id',$data->created_by )->first();
           
            $signature_request = [
                'to' => $user->email,
                'phone' => $user->contact,
                'subject' => 'Document request has been fully signed',
                'greeting' => 'Dear '.$user->title.' '.$user->name,
                'body' => 'Your request #'.$data->title.' on request '.$data->request_code.' has been completed',
                'thanks' => 'Thank you, incase of any question, please reply to support@makbrc.org',
                'actionText' => 'View Details',
                'actionURL' => url('/documents/request/'.$data->request_code.'/sign'),
                'department_id' => $data->created_by,
                'user_id' => $data->created_by,
            ];
            // WhatAppMessageService::sendReferralMessage($referral_request);
          $mm=  SendEmailNotification::dispatch($signature_request)->delay(Carbon::now()->addSeconds(20));
        //   dd($mms);
        } catch(Throwable $error) {
            // $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Referral Request '.$error.'!']);
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'Success',  'message' => 'Document has been successfully marked complete! ']);
    }
    
    public function downloadProof()
    {
        DmRequestDocuments::where('id', $this->active_document_id)->update(['status'=>'Signed']);
        $this->dispatchBrowserEvent('alert', ['type' => 'Success',  'message' => 'Document has been successfully marked complete! ']);
    }

    public function markRequestComplete()
    {
      $data =  DmDocumentRequest::where('request_code',$this->requestCode)->first();
      $data->status ='Completed';
      $data->update();
        DmRequestDocuments::where('request_code', $this->requestCode)->update(['status'=>'Signed']);
        try {
            $user = User::where('id',$data->created_by )->first();
           
            $signature_request = [
                'to' => $user->email,
                'phone' => $user->contact,
                'subject' => 'Document request for '.$data->title.' Has been completed',
                'greeting' => 'Hi '.$user->title.' '.$user->name,
                'body' => 'Your request #'.$data->title.' on request '.$data->request_code.' has been completed',
                'thanks' => 'Thank you, incase of any question, please reply support@makbrc.org',
                'actionText' => 'View Details',
                'actionURL' => url('/documents/request/'.$data->request_code.'/sign'),
                'department_id' => $data->created_by,
                'user_id' => $data->created_by,
            ];
            // WhatAppMessageService::sendReferralMessage($referral_request);
          $mm=  SendEmailNotification::dispatch($signature_request)->delay(Carbon::now()->addSeconds(20));
        //   dd($mms);
        } catch(Throwable $error) {
            // $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Referral Request '.$error.'!']);
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'Success',  'message' => 'Document request has been successfully marked complete! ']);
    }

    public function rejectDocument()
    {
        $this->validate([
           
            'comments' => 'required|string',
        ]);

        $data = DmRequestDocuments::where('id', $this->active_document_id)->first();        
        $data->status = 'Rejected';
        $data->update();

        DmDocumentSignatory::Where(['document_id' => $this->active_document_id, 'signatory_id'=>auth()->user()->id])
        ->update(['signatory_status'=>'Rejected','comments'=>$this->comments]);
        

        $this->dispatchBrowserEvent('alert', ['type' => 'Success',  'message' => 'Decument successfully rejected! ']);
    }

    public function resubmitDocument($id)
    {
        
        $data = DmRequestDocuments::where(['id'=> $id, 'created_by'=>auth()->user()->id,])->first();        
        $data->status = 'Submitted';
        $data->update();        

        $signatory = DmDocumentSignatory::Where(['document_id' => $id,  'signatory_status'=>'Rejected'])
        ->orderBy('signatory_level', 'asc')->first();
        if( $signatory ){            
            $signatory->update(['signatory_status'=>'Active']);
        }      

        $otherSignatory = DmDocumentSignatory::Where(['document_id' => $id, 'signatory_status'=>'Rejected'])->first();
        if( $otherSignatory ){            
            $otherSignatory->update(['signatory_status'=>'Pending']);
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'Success',  'message' => 'Decument successfully resubmitted! ']);
    }

    public function downloadSignedDocument(DmRequestDocuments $document)
    {
        if($document){
        $file = storage_path('app/').$document->signed_file;
        if (file_exists($file)) {
            return Storage::download($document->signed_file, $document->title.'_signed downloaded');
        } else {
            dd($document->signed_file);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Not Found!',
                'text' => 'Attachment not found!',
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not found! ']);
        }
        }else{
            dd('78 89');
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not found! ']);
        }
    }
    
    public function downloadDocument(DmRequestDocuments $document)
    {
        $file = storage_path('app/').$document->original_file;
        if (file_exists($file)) {
            return Storage::download($document->original_file, $document->title.' downloaded');
        } else {
            dd($document->original_file);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Not Found!',
                'text' => 'Attachment not found!',
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! ']);
        }
    }

    public function downloadSupportDocument(DmRequestSupportDocuments $document)
    {
        $file = storage_path('app/').$document->original_file;
        if (file_exists($file)) {
            return Storage::download($document->original_file, $document->title.' downloaded');
        } else {
            dd($document->original_file);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Not Found!',
                'text' => 'Attachment not found!',
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! ']);
        }
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
        $document->request_id =  $this->active_request->id;
        $document->original_file = $document_path;
        $document->save();
        $this->iteration = rand();
        $this->support_document_title = null;
        $this->support_file = null;
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Document created successfully!']);

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

    public function render()
    {

        $data['requestData'] = $this->active_request = DmDocumentRequest::where('request_code',$this->requestCode)->with(['category','documents','user'])->first();
        
        $data['documents'] = DmRequestDocuments::where('request_code', $this->requestCode)->with(['signatories','suportDocuments'])->get();
        $data['pending_documents'] =  DmRequestDocuments::where('request_code', $this->requestCode)->where('status','!=','Signed')->count();
        $data['active_document'] = $data['documents']->only($this->active_document_id)[0];
        return view('livewire.document-management.sign-documents-component', $data)->layout('livewire.document-management.layouts.app');
    }
}
