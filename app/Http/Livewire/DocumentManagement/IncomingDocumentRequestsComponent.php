<?php

namespace App\Http\Livewire\DocumentManagement;

use App\Models\DocumentManagement\DmDocumentRequest;
use Livewire\Component;

class IncomingDocumentRequestsComponent extends Component
{

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
        $data['incomingRequsests'] = DmDocumentRequest::with('documents')
        ->WhereHas('documents.signatories', function ($query) {
            $query->where('signatory_id', auth()->user()->id);
        })->where('status','!=','Pending')->get();

        return view('livewire.document-management.incoming-document-requests-component',$data)->layout('livewire.document-management.layouts.app');;
    }
}
