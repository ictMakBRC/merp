<?php

namespace App\Http\Livewire\DocumentManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DocumentManagement\DmDocumentRequest;
use App\Models\DocumentManagement\DmRequestDocuments;

class IncomingDocumentRequestsComponent extends Component
{
    use  WithPagination;
    public $perPage = 10;

    public $search = '';
    public $orderBy = 'id';
    protected $paginationTheme = 'bootstrap';

    public function incomingRequests()
    {
        // Retrieve the list of DocumentRequests from the database
        $documentRequests = DmDocumentRequest::all();

        // Loop through each DocumentRequest
        foreach ($documentRequests as $documentRequest) {
            // Eager load the associated Documents with Signatories
            $documentRequest->load('documents.signatories');

            // Filter the Signatories to only include those associated with the current DocumentRequest
            $filteredSignatories = $documentRequest->documents->flatMap(function ($document) use ($documentRequest) {
                return $document->signatories->filter(function ($signatory) use ($documentRequest) {
                    return $signatory->document->request_id === $documentRequest->id;
                });
            });

            // Associate the filtered Signatories with the current DocumentRequest
            $documentRequest->setRelation('signatories', $filteredSignatories);
        }

            // Return the list of DocumentRequests with associated Documents and filtered Signatories
            return $documentRequests;

    }
    public function render()
    {
        // $data['incoming'] = $this->incomingRequests();
        $data['incomingRequsests'] = DmDocumentRequest::search($this->search)->with('documents')
        ->WhereHas('documents.signatories', function ($query) {
            $query->where('signatory_id', auth()->user()->id);
        })->where('status','!=','Pending')->orderBy('id','DESC')->paginate($this->perPage);

        $data['submited_requets'] = DmDocumentRequest::where('status','!=','Pending')->WhereHas('documents.signatories', function ($query) {
            $query->where('signatory_id', auth()->user()->id);})->get();
        $data['submited_documents'] = DmRequestDocuments::where('status','!=','Pending')->WhereHas('signatories', function ($query) {
            $query->where('signatory_id', auth()->user()->id);})->get();

        return view('livewire.document-management.incoming-document-requests-component',$data)->layout('livewire.document-management.layouts.app');;
    }
}
