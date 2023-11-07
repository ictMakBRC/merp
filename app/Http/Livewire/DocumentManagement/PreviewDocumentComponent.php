<?php

namespace App\Http\Livewire\DocumentManagement;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentManagement\DmDocument;
use App\Models\DocumentManagement\DmDocumentSignatory;
use App\Services\GeneratorService;

class PreviewDocumentComponent extends Component
{
    use WithFileUploads, WithPagination;
    public $document_code;
    public $activeDocument;
    public $iteration =1;
    public $signed_file;
    public function mount($code)
    {
        $this->document_code = $code;
    }
    public function downloadDocument(DmDocument $document)
    {
        $file = storage_path('app/').$document->file;
        if (file_exists($file)) {
            return Storage::download($document->file, $document->document_code.'_downloaded');
        } else {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Not Found!',
                'text' => 'Attachment not found!',
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not found! ']);
        }
    }

    public function downloadSignedDocument(DmDocument $document)
    {
        $file = storage_path('app/').$document->signed_file;
        if (file_exists($file)) {
            return Storage::download($document->signed_file, $document->document_code.'_signed downloaded');
        } else {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Not Found!',
                'text' => 'Attachment not found!',
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not found! ']);
        }
    }


    public function uploadSignedDoc()
    {
        // $this->validate([
        //     'signed_file|mimes:pdf,docx|max:20240|file|min:10', // 20MB Max
        // ]);
        $scode = GeneratorService::getNumber(8);
        $sintials = GeneratorService::generateInitials(auth()->user()->name);
        
        $signature = $sintials.$scode;
        $data = DmDocument::where('id', $this->activeDocument->id)->first();
        $file_name = date('Ymdhis').'_'.$data->document_code.'.'.$this->signed_file->extension();
        $new_file = $this->signed_file->storeAs('Merp/documents/signed/'.date("Y").'/'.date("M"), $file_name);
        if ($data->signed_file != null) {
            Storage::delete($data->signed_file);
        }
        $data->signed_file = $new_file;
        $data->update();
        $this->iteration = rand();
        $signatory = DmDocumentSignatory::Where(['document_id' => $this->activeDocument->id, 'signatory_status'=>'Pending'])
        ->orderBy('signatory_level', 'asc')->first();
        if($signatory){
            $signatory->update(['signatory_status'=>'Active']);
        }
        DmDocumentSignatory::Where(['document_id' => $this->activeDocument->id, 'signatory_id'=>auth()->user()->id])
        ->update(['signatory_status'=>'Signed','signature'=>$signature]);

        $this->dispatchBrowserEvent('alert', ['type' => 'Success',  'message' => 'File uploaded successfully! ']);
    }
    public function render()
    {
      $this->activeDocument =  $document = DmDocument::where('document_code', $this->document_code)->with(['category','signatories','user'])->first();
        return view('livewire.document-management.preview-document-component', compact('document'))->layout('livewire.document-management.layouts.app');
    }
}
