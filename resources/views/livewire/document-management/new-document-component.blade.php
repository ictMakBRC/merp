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
                    <h4 class="page-title">New Request</h4>
                </div>
            </div>
        </div>
        @if ($createNew)
                <div class="card">
                    <div class="card-body">
                                
                            @if ($viewForm)                            
                                    <form
                                        @if (!$toggleForm) wire:submit.prevent="storeRequest"
                                        @else
                                        wire:submit.prevent="updateRequest" @endif>
                                        <div class="row"> 
                                            <div class="mb-3 col-md-2">
                                                <label for="priority" class="form-label">Priority</label>
                                                <select class="form-select" id="priority" wire:model.defer="priority">
                                                    <option selected value="">Select</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Urgent">Urgent</option>
                                                </select>
                                                @error('priority')
                                                    <div class="text-danger text-small">{{ $message }}</div>
                                                @enderror
                                            </div>   
                                            <div class="mb-3 col-md-3">
                                                <label for="document_category" class="form-label">Category</label>
                                                <select class="form-select" id="document_category" wire:model.defer="document_category">
                                                    <option selected value="">Select</option>
                                                    @foreach ($categories as $category)
                                                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('priority')
                                                    <div class="text-danger text-small">{{ $message }}</div>
                                                @enderror
                                            </div>                 
                                            <div class="mb-3 col-md-7">
                                                <label for="title" class="form-label">Request Title</label>
                                                <input type="text" id="title" class="form-control"
                                                    wire:model.defer="title">
                                                @error('title')
                                                    <div class="text-danger text-small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                                                                                    
                                            <div class="col-md-12">
                                                <label for="title" class="form-label">Request Description</label>
                                                <textarea name="details" id="details" class="form-control" wire:model.defer='details'></textarea>
                                            </div>
                                        </div>             
                                        <div class="modal-footer">
                                            @if (!$toggleForm)
                                                <x-button class="btn-success">{{ __('Save') }}</x-button>
                                            @else
                                                <x-button class="btn-success">{{ __('Update') }}</x-button>
                                            @endif
                                        </div>
                                    </form>  
                            @else

                            @if ($myRequest)
                                    <div class="col-12">                            
                                        <h4><b>Title:</b>{{$myRequest->title}}</h4>
                                        <p><b>Requester:</b>{{$myRequest->user->name}}</p>
                                        <p><b>Priority:</b>{{$myRequest->priority}}</p>
                                        <p><b>Description:</b>{{$myRequest->description}}</p>
                                    
                                    </div>

                                @endif 

                           

                            @if (count($myRequest->documents)>0) 
                                @php
                                    $display ='';
                                @endphp
                                @foreach ($myRequest->documents as $document)     
                                    <div class="card">  
                                        <div class="card-header">
                                           <a href="javacript:void()" wire:click="downloadDocument({{ $document->id }})">{{$document->title}}{{$active_document_id}}</a>
                                            <a class="text-danger" wire:click='deleteDocument({{$document->id}})' href="javascript:void(0)">Delete</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">    
                                                <div class="col-md-6 p-3">                                                   
                                                    <div class="row">
                                                        <h5>Document Signatories</h5>                                                   
                                                        <div class="row">
                                                            <a wire:click="$set('my_document_id',{{$document->id}})" href="javascript: void(0);" class=" btn btn-primary btn-sm  float-end" data-bs-toggle="modal" data-bs-target="#addNewSignatories">New Document Signatories</a>
                                                            @if (count($myRequest->documents)>0 && count($document->signatories)>0)                            
                                                                <div class="mt-2 col-12">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Title</th>
                                                                                <th>Level</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($document->signatories as $signatory)                                        
                                                                                <tr>
                                                                                    <td>{{$signatory->user->name}}</td>
                                                                                    <td>{{$signatory->title}}</td>
                                                                                    <td>{{$signatory->signatory_level}}</td>
                                                                                    <td>
                                                                                        <a href="javascript: void(0);" 
                                                                                        wire:click="deleteSignatory({{ $signatory->id }})" class="action-ico text-danger  mx-1">
                                                                                        <i class="mdi mdi-delete"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                            @php
                                                                $display ='d-none';
                                                            @endphp
                                                                <h6 class="text-center text-success mt-4"> No Signatory attached</h6>
                                                            @endif
                                                        </div>
                                                        
                                                    </div> 
                                                </div> 
                                                <div class="col-md-6 p-3">                                                   
                                                    <div class="row">
                                                        <h5>Support documents {{$active_document_id}}</h5>
                                                        <a wire:click="$set('my_document_id',{{$document->id}})" href="javascript: void(0);" class=" btn btn-primary btn-sm ms-auto float-end" data-bs-toggle="modal" data-bs-target="#addNewSuportDoc">New Support document</a>
                                                        @if (count($myRequest->documents)>0 && count($document->suportDocuments)>0)                            
                                                            <div class="mt-2 col-12">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Document Name</th>
                                                                            <th>Action</th>
                                                                           
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($document->suportDocuments as $document)                                        
                                                                            <tr>
                                                                                <td>{{$document->title}}</td>
                                                                                <td>
                                                                                    <a href="javascript: void(0);" 
                                                                                    wire:click="deleteSupportDocument({{ $document->id }})" class="action-ico text-danger  mx-1">
                                                                                    <i class="mdi mdi-delete"></i></a>
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
                                                            <h6 class="text-center text-success mt-4"> No Support documents attached</h6>
                                                        @endif
                                                    </div>     
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                @endforeach                                
                                @include('livewire.document-management.support_modal') 
                                    <button wire:click='submitRequest' class="btn btn-success {{$display}}">Submit Documents</button>
                                @else
                                    <h6 class="text-center text-success mt-2"> No support documents attached</h6>
                                @endif
                                                         
                            @endif                      
                        
                                 
                            @if ($addDocements)
                                <div class="row">
                                    <form wire:submit.prevent='addDocument'>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="title" class="form-label">Document Title</label>
                                                <input type="text" id="document_title" class="form-control"
                                                    wire:model.defer="document_title">
                                                @error('document_title')
                                                    <div class="text-danger text-small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-4">
                                                <label for="file" class="form-label">Upload File</label>
                                                <input type="file" id="file{{$iteration}}" class="form-control"
                                                    wire:model.lazy="file">
                                                @error('file')
                                                    <div class="text-danger text-small">{{ $message }}</div>
                                                @enderror
                                                <div class="text-success text-small" wire:loading
                                                wire:target="file">Uploading file...</div>
                                            </div> 
                                            <div class="col-md-2">
                                                <x-button class="btn-success mt-3">{{ __('Save') }}</x-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                        <a type="button" href="javascript:void()" class="btn btn-outline-danger float-end"
                        wire:click="$set('createNew',{{ !$createNew }})"><i class="mdi mdi-caret-up"></i>Close </a>
                       
                    </div>
                </div>
                {{-- @if ($active_document && count($active_document->signatories)>0)
                <button class="btn btn-success"wire:click="submutRequest">Submit Request</button>
                @endif --}}
        @else

            <div class="card">
                <div class="card-body">
                    <h6>Recently uploaded</h6>
                    <x-inventory.table-utilities>
                            <div class="text-sm-end mt-1 ms-auto position-relative">
                                <a type="button" href="javascript:void()" class="btn @if (!$createNew) btn-success
                                @else
                                btn-outline-danger @endif"
                                    wire:click="addnewEntry()">
                                    @if (!$createNew)
                                        <i class="mdi mdi-plus"></i>New
                                    @else
                                        <i class="mdi mdi-caret-up"></i>Close
                                    @endif
                                
                                </a>
                            </div>
                    </x-inventory.table-utilities>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Name <i class='mdi mdi-up-arrow-alt ms-2'></i></th>
                                    <th>Category</th>
                                    <th>Created by</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($myRequests as $requests)
                                <tr >
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div><i class='mdi mdis-file me-2 font-24 text-primary'></i>
                                            </div>
                                            <div class="font-weight-bold text-primary">{{$requests->title}}</div>
                                        </div>
                                    </td>
                                    <td>{{$requests->category->name??'N/A'}}</td>
                                    <td>{{$requests->user->name??'N/A'}}</td>
                                
                                    <th>{{$requests->created_at??'N/A'}}</th>
                                    <th>{{$requests->status??'N/A'}}</th>
                                    <td>
                                        
                                    <a href="{{route('document.sign',$requests->request_code)}}" class="text-success" ><i class='mdi mdi-eye font-20'></i></a> 
                                    @if ($requests->status == 'Pending')
                                    <a href="javascript:void()" wire:click="attachDocument({{$requests->id}})" class="text-info" ><i class='mdi mdi-pencil font-16'></i></a> 
                                    @endif                                
                                                
                                    </td>
                                </tr>
                                @empty                                                            
                                    
                                <tr>
                                
                                    <td colspan="6" class="text-center text-danger">You have no resources uploaded in the following folder</td>
                                
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif


        

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
