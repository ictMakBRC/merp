<div>

    <div class="container-fluid">
    
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Documents</a></li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                    <h4 class="page-title">View Request</h4>
                </div>
            </div>
        </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                    <div class="col-12">                            
                        <h4><b>Title:</b>{{$requestData->title}}</h4>
                        <p><b>Requester:</b>{{$requestData->user->name}} &nbsp; &nbsp;
                        <b>Priority:</b>{{$requestData->priority}}</p>
                        <p><b>Description:</b>{{$requestData->description}}</p>                    
                    </div>
                <div class="col-4 card">
                    <div class="card-body">                
                        <div class="list-group" id="list-tab" role="tablist"> 
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action active">
                                Submitted Documents
                            </a>
                            @forelse ($requestData->documents as $key=>$document)                          
                                <a class="list-group-item list-group-item-action @if ($document->status =='Rejected') alert-warning text-warning @endif"  id="list-home-list"
                                    data-toggle="list" href="javascript:void(0)" wire:click="$set('active_document_id',{{$document->id}})" role="tab"><strong>Doc #{{$key+1}}</strong> : {{ $document->title }}</a>
                            @empty
                            @endforelse  
                            @php
                                $signed = '';
                            @endphp                                  
                        </div>
                        @if ($pending_documents<=0 && $requestData->status =='Submitted')
                        <button class="btn mt-2 float-end btn-success btn-sm" wire:click='markRequestComplete'>Mark Request Complete</button>
                        @endif
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">                        
                        <div class="card-body">
                            @if (!$active_document_id)
                                <div class="row">
                                    <div class="col">
                                        <h5 class="text-center">Please click on a document to view its details and actions</h5>
                                    </div>
                                </div>
                            @else
                            <div class="row">  
                                <div class="col-12">
                                    <a href="javascript:void(0)" wire:click='downloadDocument({{$active_document->id}})' class="text-center h4"><b>Doc: </b>{{$active_document->title}}</a>
                                </div>
                                <div class="col m-1" >
                                @if ($active_document->status !="Pending" && auth()->user()->id == $active_document->created_by)
                                    <tr class="alert alert-success" >
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col">
                                                    <h6>Original Version</h6>
                                                    <a class ="btn btn-info btn-sm" href="javascript:void()" wire:click='downloadDocument({{$active_document->id}})'> 
                                                    <i class="mdi mdi-file font-20"></i>
                                                        Download Original
                                                    </a>
                                                </div>
                                                @if ($active_document->signed_file != null)
                                                    <div class="col text-success">
                                                        <h6>Recent Version</h6>
                                                        <a href="javascript:void()" class=" btn btn-success btn-sm" wire:click='downloadSignedDocument({{$active_document->id}})'> 
                                                            <i class="mdi mdi-file font-20"></i>
                                                            Download Signed Version
                                                        </a>
                                                    </div>
                                                @endif
                                                  
                                            </div>
                                        </td>
                                    </tr>                             
                                @endif
                                </div>                              
                                <style>
                                    .hideContent {
                                        overflow: hidden;
                                        line-height: 1em;
                                        height: 1em;
                                    }

                                    .showContent {
                                        line-height: 2em;
                                        height: auto;
                                    }
                                </style>
                                <div class="col-md-12">                                                   
                                    <div class="row">
                                        <h5>Document Status: {{$active_document->status}}</h5>                                                   
                                        <h5>Document Signatories</h5>                                                   
                                        <div class="row">
                                            @if (count($active_document->signatories)>0)                            
                                                <div class=" col-12">
                                                    <table class="table table-boarded font-9">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Title</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($active_document->signatories as $signatory)                                        
                                                                <tr  @if ($signatory->signatory_status =="Active" && auth()->user()->id == $signatory->signatory_id) class="alert alert-success" @endif>
                                                                    <td>{{$signatory->user->name}}</td>
                                                                    <td>{{$signatory->title}}
                                                                        @if ($signatory->summary != null && $signatory->signatory_status =="Active" && auth()->user()->id == $signatory->signatory_id)
                                                                            <br>
                                                                            <strong>Summary</strong>
                                                                            <textarea readonly class="form-control">{{$signatory->summary}}</textarea>
                                                                           
                                                                        @endif
                                                                       
                                                                    </td>
                                                                    <td>
                                                                        {{$signatory->signatory_status}}
                                                                        @php
                                                                            if ($signatory->signatory_status =="Active") {
                                                                                $signed = 'd-none';
                                                                            }
                                                                        @endphp
                                                                    </td>
                                                                </tr>
                                                                    @if ($signatory->signatory_status =="Active" && auth()->user()->id == $signatory->signatory_id)
                                                                        <tr class="alert alert-success" >
                                                                            <td colspan="3">
                                                                                <div class="row">
                                                                                    @if ($active_document->signed_file !='')
                                                                                    <div class="col-md-6 text-success">
                                                                                        <h6>New Version</h6>
                                                                                        <a href="javascript:void()" class="text-success" wire:click='downloadSignedDocument({{$active_document->id}})'> 
                                                                                            <i class="mdi mdi-file font-20"></i>
                                                                                            Download Signed Version
                                                                                        </a>
                                                                                    </div>
                                                                                    @else
                                                                                    <div class="col-md-6">
                                                                                        <h6>Original Version</h6>
                                                                                    <a href="javascript:void()" wire:click='downloadDocument({{$active_document->id}})'> 
                                                                                        <i class="mdi mdi-file font-20"></i>
                                                                                         Download Original
                                                                                        </a>
                                                                                    </div>                                                    
                                                                                    @endif
                                                                                    <div class="col-md-6">
                                                                                        <h6>Signed Version</h6>                                                                                    
                                                                                       @if ($action=='approve')
                                                                                        <form wire:submit.prevent='uploadSignedDoc'>
                                                                                            <div class="input-group">
                                                                                            <input type="file"  id="{{$iteration}}" class="form-control"
                                                                                                name="signed_file" required wire:model.lazy="signed_file">
                                                                                                <button type="submit" class="btn btn-success">Upload</button>
                                                                                            </div>
                                                                                            <div class="text-success text-small" wire:loading
                                                                                            wire:target="signed_file">Uploading document...</div> 
                                                                                            @error('signed_file')
                                                                                            <div class="text-danger text-small">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </form>
                                                                                        @elseif ($action=='reject')
                                                                                        <form wire:submit.prevent='rejectDocument'>
                                                                                            <div class="input-group">
                                                                                           <textarea name="comments" class="form-control" wire:model.differ="comments" required id="comment" ></textarea>
                                                                                                <button type="submit" class="btn btn-danger">Reject</button>
                                                                                            </div>
                                                                                            @error('comments')
                                                                                            <div class="text-danger text-small">{{ $message }}</div>
                                                                                            @enderror
                                                                                        </form>
                                                                                       @else
                                                                                       <div class="btn-group mb-2">
                                                                                            <button type="button" wire:click="$set('action','approve')" class="btn btn-success">Approve Doc</button>
                                                                                            <button type="button" wire:click="$set('action','reject')" class="btn btn-danger">Reject Doc</button>
                                                                                        </div>
                                                                                       @endif
                                                                                      
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @elseif ($signatory->signatory_status =="Signed" && auth()->user()->id == $signatory->signatory_id && auth()->user()->id != $active_document->created_by)
                                                                        <tr class="alert alert-success" >
                                                                            <td colspan="3">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 text-success">
                                                                                        <h6>New Version</h6>
                                                                                        <a href="javascript:void()" class="text-success" wire:click='downloadSignedDocument({{$active_document->id}})'> 
                                                                                            <i class="mdi mdi-file font-20"></i>
                                                                                            Download Signed Version
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <h6>Original Version</h6>
                                                                                    <a href="javascript:void()" wire:click='downloadDocument({{$active_document->id}})'> 
                                                                                        <i class="mdi mdi-file font-20"></i>
                                                                                            Download Original
                                                                                        </a>
                                                                                    </div>  
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @elseif ($signatory->signatory_status =="Rejected")
                                                                        @if (auth()->user()->id == $signatory->signatory_id || auth()->user()->id == $active_document->created_by)
                                                                                
                                                                            <tr class="alert alert-warning" >
                                                                                <td colspan="3">
                                                                                    <div class="row">
                                                                                        @if (auth()->user()->id == $active_document->created_by)
                                                                                            <div class="col-md-6">
                                                                                                <h6>Take Action</h6>
                                                                                                <div class="btn-group mb-2">
                                                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#addNewSuportDoc" class="btn btn-primary">Add Support Document</button>
                                                                                                    <button type="button" wire:click="resubmitDocument({{$active_document->id}})" class="btn btn-success">Re-submit Document</button>
                                                                                                </div>
                                                                                            </div> 
                                                                                        @else
                                                                                        <div class="col-md-6">
                                                                                            <h6>Original Version</h6>
                                                                                        <a href="javascript:void()" wire:click='downloadDocument({{$active_document->id}})'> 
                                                                                            <i class="mdi mdi-file font-20"></i>
                                                                                                Download Original
                                                                                            </a>
                                                                                        </div> 
                                                                                        @endif
                                                                                        <div class="col-md-6 text-success">
                                                                                            <h6>Comment</h6>
                                                                                        <textarea class="form-control" readonly>{{$signatory->comments}}</textarea>
                                                                                        </div> 
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @include('livewire.document-management.support_modal') 
                                            @else
                                                <h6 class="text-center text-success mt-1"> No Signatory attached</h6>
                                            @endif
                                        </div>                                        
                                    </div> 
                                </div> 
                                <hr>
                                <div class="col-md-12">                                                   
                                    <div class="row">
                                        <h5>Support documents</h5>
                                        @if (count($active_document->suportDocuments)>0)                            
                                            <div class="col-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Document Name</th>
                                                            <th>Action</th>
                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($active_document->suportDocuments as $document)                                        
                                                            <tr>
                                                                <td>{{$document->title}}</td>
                                                                <td>
                                                                    <a href="javascript: void(0);" 
                                                                    wire:click="downloadSupportDocument({{ $document->id }})" class="action-ico text-success  mx-1">
                                                                    <i class="mdi mdi-download"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <h6 class="text-center text-success mt-1"> No Support documents attached</h6>
                                        @endif
                                    </div>     
                                </div>
                            </div>
                                @if ($active_document->status =="Submitted")
                                 <button class="btn {{$signed}} btn-success btn-sm" wire:click='markDocumentComplete'>Mark Document Complete</button>
                                 @elseif($active_document->status =="Signed")
                                 <button class="btn  btn-info btn-sm" wire:click='downloadProof'>Download Proof of Signature</button>
                                @endif
                                @if ($pending_documents<=0 && $requestData->status =='Submitted')
                                <button class="btn btn-success btn-sm" wire:click='markRequestComplete'>Mark Request Complete</button>
                                @endif
                            
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    <script>
        window.addEventListener('close-modal', event => {
            $('#addNewSuportDoc').modal('hide');
            $('#addNewSignatories').modal('hide');
        });
        window.addEventListener('comment-modal', event => {
            $('#comment-modal').modal('show');
        });
        window.addEventListener('lab-preview', event => {
            $('#lab-preview').modal('show');
        });
    </script>
@endpush

</div>
