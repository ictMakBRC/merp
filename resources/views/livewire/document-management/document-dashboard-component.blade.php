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

        <div class="row">
            <div class="col-12">
                <div class="card widget-inline">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class=" uil-envelope-check text-muted" style="font-size: 24px;"></i>
                                        <h3><span>{{$submited_requets->count()}}</span></h3>
                                        <p class="text-muted font-15 mb-0">Total Requests</p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="uil-envelope-exclamation text-muted" style="font-size: 24px;"></i>
                                        <h3><span>{{$submited_requets->where('status', '!=', 'Completed')->count()}}</span></h3>
                                        <p class="text-muted font-15 mb-0">Requests Pending</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="uil-copy-alt text-info" style="font-size: 24px;"></i>
                                        <h3><span>{{$received_requets->count()}}</span></h3>
                                        <p class="text-muted font-15 mb-0">Received Requests</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="uil-file-exclamation text-primary" style="font-size: 24px;"></i>
                                        <h3><span>{{$received_requets->where('status', '!=', 'Completed')->count()}}</span> <i class="mdi mdi-arrow-up text-success"></i></h3>
                                        <p class="text-muted font-15 mb-0">Pending Requests</p>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
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

                <h6>Recent requests</h6>
                <x-inventory.table-utilities>                   
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
                            @if (count($incomingRequsests)>0)                            
                                @forelse ($incomingRequsests as $requests)
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
                                @else
                                @forelse ($recent_requets as $requests)
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
                                
                                    <td colspan="6" class="text-center text-danger">You have no requests uploaded in the following folder</td>
                                
                                </tr>
                                @endforelse
                            @endif
                            

                        </tbody>
                    </table>
                </div>
                @if (count($incomingRequsests)>0) 
                    {{ $incomingRequsests->links('vendor.pagination.bootstrap-5') }}
                @else
                    {{ $recent_requets->links('vendor.pagination.bootstrap-5') }}
                @endif
            </div>
        </div>
    </div>
</div>