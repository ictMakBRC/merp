 <!--start page wrapper -->
 <div>
    <div class="container-fluid">
         <div >
            <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header pt-0">
                             <div class="row mb-2">
                                 <div class="col-sm-12 mt-3">
                                     <div class="d-sm-flex align-items-center">
                                         <h5 class="mb-2 mb-sm-0">
                                             Document Resources

                                         </h5>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="card-body">




                             <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                                 <div class="col">
                                     <div class="card radius-10 bg-light-success">
                                         <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                 <div>
                                                     <p class="mb-0 text-secondary">Uploaded Documents
                                                     </p>
                                                     <h4 class="my-1">20</h4>
                                                 </div>
                                                 <div class="widgets-icons bg-light-success text-success ms-auto"><i
                                                         class='bx bxs-file'></i>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col">
                                     <div class="card radius-10 bg-light-warning">
                                         <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                 <div>
                                                     <p class="mb-0 text-secondary"> Archived Documents
                                                     </p>
                                                     <h4 class="my-1">5</h4>
                                                 </div>
                                                 <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                                         class='bx bxs-file'></i>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col">
                                     <div class="card radius-10 bg-light-danger">
                                         <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                 <div>
                                                     <p class="mb-0 text-secondary"> Expired Documents
                                                     </p>
                                                     <h4 class="my-1">11</h4>
                                                 </div>
                                                 <div class="widgets-icons bg-light-danger text-danger ms-auto"><i
                                                         class='bx bxs-file'></i>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col">
                                     <div class="card radius-10 bg-light-info">
                                         <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                 <div>
                                                     <p class="mb-0 text-secondary"> Shared Documents
                                                     </p>
                                                     <h4 class="my-1">1</h4>
                                                 </div>
                                                 <div class="widgets-icons bg-light-info text-info ms-auto"><i
                                                         class='bx bxs-file'></i>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-12 col-lg-3">
                                     <div class="card">
                                         <div class="card-body">
                                             <h6 class="my-3">Document Categories</h6>
                                             <div class="fm-menu">
                                                 <div class="list-group list-group-flush">
                                                     <a href="javascript:;" wire:click="$set('document_category','0')"
                                                         class="list-group-item py-1"><i
                                                             class='bx bx-devices me-2'></i><span>All</span></a>
                                                             @forelse ($categories as $category)
                                                             <a href="javascript:;"
                                                                 wire:click="$set('document_category','{{ $category->id }}')"
                                                                 class="list-group-item py-1"><i
                                                                     class='bx bx-devices me-2'></i><span>{{ $category->name }}</span></a>
                                                         @empty
                                                             <a href="javascript:;" wire:click='createCategory' class="list-group-item py-1"><i
                                                                     class='bx bx-devices me-2'></i><span>{{ __('Create a new category') }}</span></a>
                                                         @endforelse
                                                   

                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-12 col-lg-9">
                                     <div class="card">
                                         <div class="card-body">

                                             <h6> Parent Folders</h6>

                                             <nav class="nav justify-content-left" aria-label="Secondary navigation">
                                                @foreach ($folders as $folder)
                                                    <li class="nav-item dropdown card radius-1 m-2"
                                                        wire:click='openFolder({{ $folder->id }})'>
                                                        <a class="nav-link" href="javascript:void()" role="button">
                                                            <div class="font-30 text-primary"><i class='fa fa-folder'></i>
                                                            </div>{{ $folder->name }}
                                                        </a>                                                      
                                                    </li>
                                                @endforeach
                                            </nav>
                                             <h6 class="mb-0"> Recent Files</h6>
                                             <div class="d-xl-flex align-items-center">

                                                <div class="flex-grow-1 mx-xl-2 my-2 my-xl-0">
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class="bx bx-search"></i></span>
                                                        <input wire:model.debounce.300ms="search" type="text"
                                                            class="form-control" placeholder="Search the files">
                                                    </div>
                                                </div>
    
                                                <div class="d-flex align-items-center">
    
                                                    <div class="btn btn-white">
                                                        <input class="form-check-input"
                                                            wire:click="$set('active_status',{{ $active_status ? 'false' : 'true' }})"
                                                            @if ($active_status == 3) checked @endif
                                                            type="checkbox">
                                                        {{ __('Archived') }}
                                                    </div>
                                                    <div class="btn btn-white">
                                                        <input class="form-check-input"
                                                            wire:click="$set('expired',{{ $expired ? 'false' : 'true' }})"
                                                            @if ($expired) checked @endif
                                                            type="checkbox">
                                                        {{ __('Expired') }}
                                                    </div>    
                                                </div>
                                            </div>
    
                                            <div class="table-responsive mt-3">
                                                <table class="table table-striped table-hover table-sm mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th> {{ __('Name') }}<i class='bx bx-up-arrow-alt ms-2'></i>
                                                            </th>
                                                            <th> {{ __('Category') }}</th>
                                                            <th> {{ __('Expires On') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($documents as $document)
                                                            <tr
                                                                @if ($document->expiry_date <= $to_date && $document->expiry_date != null) class="bg-light-warning  " @else class="text-primary" @endif>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div><i
                                                                                class='bx bxs-file me-2 font-24 text-primary'></i>
                                                                        </div>
                                                                        <div class="font-weight-bold">
                                                                            {{ $document->title }}</div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $document->category->name ?? 'N/A' }}</td>
                                                                <td>{{ $document->expiry_date ?? 'N/A' }} @if ($document->expiry_date <= $to_date && $document->expiry_date != null)
                                                                        {{ __('Expired') }}
                                                                    @endif
                                                                </td>
                                                                <td><a href=""
                                                                        wire:click='downloadDocument({{ $document->id }})'><i
                                                                            class='bx bx-download font-20'></i>({{$document->downloads}})</a>
                                                                </td>
                                                            </tr>
                                                        @empty
    
                                                            <tr>
    
                                                                <td colspan="4" class="text-center text-danger">
                                                                    {{ __('You have no resources uploaded') }}
                                                                </td>
    
                                                            </tr>
                                                        @endforelse
    
                                                    </tbody>
                                                </table>
                                            </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <!--end row-->
                         </div> <!-- end card body-->
                     </div> <!-- end card -->
                 </div><!-- end col-->
                 <div wire:ignore.self class="modal fade" id="add_new_folder" tabindex="-1"
                     aria-labelledby="add_new_folder" aria-hidden="true">
                     <div class="modal-dialog">
                         <form wire:submit.prevent="storeFolder">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title">Create a new Folder</h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                                         aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">

                                     <div class="row">
                                         <div class="mb-3 col">
                                             <label for="folder_name" class="form-label">Folder Name</label>
                                             <input type="text" id="folder_name" class="form-control"
                                                 wire:model.lazy="folder_name">
                                         </div>
                                         <div class="mb-3 col-md-4 d-none">
                                             <label for="folder_name" class="form-label">Folder type</label>
                                             <select id="type" class="form-control"
                                                 wire:model.lazy="folder_type">
                                                 <option value="Public">Public</option>
                                                 <option value="Shared">Shared</option>
                                                 <option value="Private">Private</option>
                                             </select>
                                         </div>
                                         <div class="mb-3 col">
                                             <label for="parent_id" class="form-label">Parent Folder</label>
                                             <select name="parent_id" class="form-select" id="parent_id"
                                                 wire:model="parent_id">
                                                 <option selected value="0">None</option>
                                                 <option value="1">Sample Referral</option>

                                                 <option value="2">Shared Folder</option>
                                                 <option value="4">-Policies</option>

                                                 <option value="3">SOPs</option>

                                             </select>
                                         </div>

                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="submit" class="btn btn-success">
                                         Create
                                     </button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
