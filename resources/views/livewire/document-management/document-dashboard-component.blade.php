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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Documents</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6>Active Folder: @if ($current_folder?->parent!='')
                    <a href="javascript:void()"  wire:click='openFolder(0)'><i class="mdi mdi-home"></i>Root Folder/</a><a wire:click='openFolder({{$current_folder->parent_id}})' href="javascrip:void(0)">{{$current_folder->parent->name??'Root'}}/</a>   
                    @else
                    <a href="javascript:void()" wire:click='openFolder(0)'><i class="mdi mdi-home"></i>Root Folder/</a>
                @endif  <span class="text-success">{{$current_folder_name}}</span></h6>
                @if ( $categories && count($categories)>0)
                <h6>Parent categories</h6>
                @endif
                
                <nav class="nav justify-content-left" aria-label="Secondary navigation">
                    @foreach($categories as $folder)
                    <li class="nav-item dropdown card radius-1 m-2" wire:click='openFolder({{$folder->id}})'>
                    <a    class="nav-link"  href="javascript:void()" role="button" >
                        <div class="font-30 text-primary"><i class='mdi mdi-folder'></i>
                        </div>{{$folder->name}}
                    </a>
                    </li>
                    @endforeach
                </nav>
                @if ($createNew)
                    @include('livewire.document-management.new-document-form')
                @endif

                <h6>Recently uploaded</h6>
                <x-inventory.table-utilities>
                    @if ($folder_open)
                        <div class="text-sm-end mt-1 ms-auto position-relative">
                            <a type="button" href="javascript:void()" class="btn @if (!$createNew) btn-success
                            @else
                            btn-outline-danger @endif"
                                wire:click="$set('createNew',{{ !$createNew }})">
                                @if (!$createNew)
                                    <i class="mdi mdi-plus"></i>New
                                @else
                                    <i class="mdi mdi-caret-up"></i>Close
                                @endif
                            
                            </a>
                        </div>
                    @endif
                </x-inventory.table-utilities>
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Name <i class='mdi mdi-up-arrow-alt ms-2'></i></th>
                                <th>Category</th>
                                <th>Uploaded by</th>
                                <th>Uploaded On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $document)
                            <tr @if ($document->expiry_date <= $to_date && $document->expiry_date!=null) class="bg-light-warning" @else class="text-primary" @endif >
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div><i class='mdi mdis-file me-2 font-24 text-primary'></i>
                                        </div>
                                        <div class="font-weight-bold text-primary">{{$document->title}}</div>
                                    </div>
                                </td>
                                <td>{{$document->category->name??'N/A'}}</td>
                                <td>{{$document->user->name??'N/A'}}</td>
                            
                                <th>{{$document->created_at??'N/A'}}</th>
                                <th>{{$document->status??'N/A'}}</th>
                                <td>
                                    
                                <a href="{{route('document.preview',$document->document_code)}}" class="text-success" ><i class='mdi mdi-eye font-20'></i></a> 
                                @if ($document->status == 'Pending')
                                 <a href="javascript:void()" wire:click="updateDocument({{$document->id}})" class="text-info" ><i class='mdi mdi-pencil font-16'></i></a> 
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
    </div>
</div>