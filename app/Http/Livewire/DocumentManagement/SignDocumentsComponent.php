<?php

namespace App\Http\Livewire\DocumentManagement;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentManagement\DmDocumentRequest;
use App\Models\DocumentManagement\DmRequestDocuments;
use App\Models\DocumentManagement\DmDocumentSignatory;
use App\Models\DocumentManagement\DmRequestSupportDocuments;

class SignDocumentsComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $requestCode, $active_document_id, $iteration=1, $signed_file;

    public function mount($request_code)
    {
        $this->requestCode = $request_code;
        try {
            // $this->active_document_id = DmDocumentRequest::where('request_code', $this->requestCode)->first()->id;
        } catch(\Exception $error) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! '.$error]);
        }
    }

    public function downloadDocument(DmRequestDocuments $document)
    {
        $file = storage_path('app/').$document->original_file;
        if (file_exists($file)) {
            return Storage::download($document->original_file, $document->title.' downloaded');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! ']);
        }
    }

    public function downloadSupportDocument(DmRequestSupportDocuments $document)
    {
        $file = storage_path('app/').$document->original_file;
        if (file_exists($file)) {
            return Storage::download($document->original_file, $document->title.' downloaded');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not deleted! ']);
        }
    }

    public function uploadSignedDoc()
    {
        $this->validate([
            'signed_file' => 'required|mimes:pdf,docx|max:20240|file|min:10', // 20MB Max
            // 'support_document_title' => 'required|string',
        ]);

        $data = DmRequestDocuments::where('id', $this->active_document_id)->first();
        $file_name = date('Ymdhis').'_'.$data->document_code.'.'.$this->signed_file->extension();
        $new_file = $this->signed_file->storeAs('Merp/documents/signed/'.date("Y-m"), $file_name);
        if ($data->signed_file != null) {
            Storage::delete($data->signed_file);
        }
        $data->signed_file = $new_file;
        $data->update();
        $this->iteration = rand();

        $signatory = DmDocumentSignatory::Where(['document_id' => $this->active_document_id, 'signatory_status'=>'Pending'])
        ->orderBy('signatory_level', 'asc')->first();
        if($signatory){
            $signatory->update(['signatory_status'=>'Active']);
        }
        DmDocumentSignatory::Where(['document_id' => $this->active_document_id, 'signatory_id'=>auth()->user()->id])
        ->update(['signatory_status'=>'Signed']);

        $this->dispatchBrowserEvent('alert', ['type' => 'Success',  'message' => 'File uploaded successfully! ']);
    }

    public function downloadSignedDocument(DmRequestDocuments $document)
    {
        if($document){
        $file = storage_path('app/').$document->signed_file;
        if (file_exists($file)) {
            return Storage::download($document->signed_file, $document->document_code.'_signed downloaded');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not found! ']);
        }
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not found! ']);
        }
    }

    public function render()
    {

        $data['requestData'] = $request= DmDocumentRequest::where('request_code',$this->requestCode)->with(['category','documents','user'])->first();
        
        $data['documents'] = DmRequestDocuments::where('request_code', $this->requestCode)->with(['signatories','suportDocuments'])->get();

        $data['active_document'] = $data['documents']->only($this->active_document_id)[0];
        return view('livewire.document-management.sign-documents-component', $data)->layout('livewire.document-management.layouts.app');
    }
}
