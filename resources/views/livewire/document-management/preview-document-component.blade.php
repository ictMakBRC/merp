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
                                <li class="breadcrumb-item active">{{$document_code}}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Document</h4>
                    </div>
                </div>
            </div>
    
            <div class="card">
                <div class="card-body">
                    @if ($document)
                    <div class="row">
                        <div class="col-12">                            
                            <h4><b>Title:</b>{{$document->title}}</h4>
                            <p><b>Requester:</b>{{$document->user->name}}</p>
                            <p><b>Details:</b>{{$document->details}}</p>
                        </div>
                            {{-- @if ($signatory->signatory_status !="Active" && auth()->user()->id != $signatory->signatory_id) --}}
                                <div class="col-md-3">
                                    <h6>Original Version</h6>
                                    <a href="javascript:void()" wire:click='downloadDocument({{$document->id}})'> 
                                    <div class="card">
                                        <div class="card-body">
                                            <i class="mdi mdi-file font-20"></i>
                                            Download Original Original
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                @if ($document->signed_file !='')
                                    <div class="col-md-3 text-success">
                                        <h6>Signed Version</h6>
                                        <a href="javascript:void()" class="text-success" wire:click='downloadSignedDocument({{$document->id}})'> 
                                        <div class="card">
                                            <div class="card-body">
                                                <i class="mdi mdi-file font-20"></i>
                                                Download Signed Version
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                @endif
                            {{-- @endif --}}
                      
                    </div>
                    <div class="mt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($document?->signatories as $signatory)                                        
                                    <tr>
                                        <td>{{$signatory->user->name}}</td>
                                        <td>{{$signatory->title}}</td>
                                        <td>{{$signatory->signatory_level}}</td>
                                        <td>
                                            {{$signatory->signatory_status}}
                                        </td>
                                    </tr>
                                    @if ($signatory->signatory_status =="Active" && auth()->user()->id == $signatory->signatory_id)
                                        <tr>
                                            <td colspan="4">
                                                <div class="row">
                                                    @if ($document->signed_file !='')
                                                    <div class="col-md-3 text-success">
                                                        <h6>New Version</h6>
                                                        <a href="javascript:void()" class="text-success" wire:click='downloadSignedDocument({{$document->id}})'> 
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <i class="mdi mdi-file font-20"></i>
                                                                Download Signed Version
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    @else
                                                    <div class="col-md-6">
                                                        <h6>Original Version</h6>
                                                    <a href="javascript:void()" wire:click='downloadDocument({{$document->id}})'> 
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <i class="mdi mdi-file font-20">Download Original</i>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>                                                    
                                                    @endif
                                                    <div class="col-md-6">
                                                        <h6>Signed Version</h6>
                                                    
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form wire:submit.prevent='uploadSignedDoc'>
                                                                    <div class="input-group">
                                                                    <input type="file"  id="{{$iteration}}" class="form-control"
                                                                        name="signed_file" required wire:model.lazy="signed_file">
                                                                        <button type="submit" class="btn btn-success">Upload</button>
                                                                    </div>
                                                                    <div class="text-success text-small" wire:loading
                                                                    wire:target="custom_invoice_path">Uploading document...</div> 
                                                                    @error('signed_file')
                                                                    <div class="text-danger text-small">{{ $message }}</div>
                                                                    @enderror
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
</div>
