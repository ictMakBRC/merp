<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="{{url('inventory/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Store</a></li>

                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                               <h4 class="header-title mb-3  text-center"> MakBRC Stores</h4>
                           </div>
                       </div>
                       <div class="col-sm-8">
                        <div class="text-sm-end mt-3">
                            <a type="button" href="#" class="btn btn-primary mb-2 me-1" data-bs-toggle="modal" data-bs-target="#addStore">Add Store</a>
                        </div>
                    </div><!-- end col-->
                </div>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="example1" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>StoreName</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($data)>0)
                                @php($i=1)
                                @foreach($data as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{ $value->store_name}}</td>
                                    <td>{{ $value->store_location}}</td>
                                    <td>{{ $value->store_description}}</td>
                                    <td>@if($value->is_active==1)
                                        <span class="badge badge-success-lighten float-center">Active</span>
                                        @php($satate='Active' AND $Stvalue=1)
                                        @elseif($value->is_active==0)
                                        <span class="badge badge-danger-lighten float-center">InActive</span>
                                        @php($satate='InActive' AND $Stvalue=0)
                                        @endif
                                    </td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-ico text-info mx-1"> <i
                                            class="mdi mdi-pencil" data-bs-toggle="modal"
                                            wire:click="editdata({{ $value->id}})"
                                            data-bs-target="#editcourier"></i></a>
                                    <a href="javascript: void(0);"
                                        wire:click="deleteConfirmation({{ $value->id }})" class="action-ico text-danger  mx-1">
                                        <i class="mdi mdi-delete"></i></a>
                                       
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- end preview-->


                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div>
<div class="modal fade" wire:ignore.self id="delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabeld" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Info</h5>
                    <button type="button" class="btn-close" wire:click="cancel()" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Are you sure you want to delete this Record?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteData()">Yes! Delete</button>
                </div>
            </div>
        </div>
</div>
     <!-- ADD NEW Category Modal -->
 <div class="modal fade" wire:ignore.self id="addStore" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Store</h5>
                <button type="button" class="btn-close" wire:click="cancel()" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form wire:submit.prevent="storeData">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="storeName" class="form-label">Store Name</label>
                                <input type="text" id="storeName" wire:model='store_name' name="store_name" class="form-control"  required>
                                @error('store_name')
                                <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="storeloc" class="form-label">Store Location</label>
                                <input type="text" id="storeloc" wire:model='store_location' name="store_location" class="form-control"  required>
                                @error('store_location')
                                <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="storeloc" class="form-label">Store description</label>
                              <textarea class="form-control" wire:model='store_description' name="store_description"></textarea>
                              @error('store_description')
                              <div class="text-danger text-small">{{ $message }}</div>
                              @enderror
                            </div>
                        </div> <!-- end col -->

                    </div>
                    <!-- end row-->
                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>

                </form>

            </div>

        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
     <!-- ADD NEW Category Modal -->
     <div class="modal fade" wire:ignore.self id="editStore" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Store</h5>
                    <button type="button" class="btn-close" wire:click="cancel()" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">
                        @csrf
    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="storeName" class="form-label">Store Name</label>
                                    <input type="text" id="storeName" wire:model='store_name' name="store_name" class="form-control"  required>
                                    @error('store_name')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="storeloc" class="form-label">Store Location</label>
                                    <input type="text" id="storeloc" wire:model='store_location' name="store_location" class="form-control"  required>
                                    @error('store_location')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="mb-3">
                                    <label for="storeloc" class="form-label">Store description</label>
                                  <textarea class="form-control" wire:model='store_description' name="store_description"></textarea>
                                  @error('store_description')
                                  <div class="text-danger text-small">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="is_active" wire:model="is_active">
                                        <option value="">select</option>
                                        <option value="1" style="color: green" selected>Active</option>
                                        <option value="0" style="color: red">Suspended</option>
                                    </select>
                                </div>
                            </div> <!-- end col -->
    
                        </div>
                        <!-- end row-->
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
    
                    </form>
    
                </div>
    
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
@push('scripts')
        <script>
            window.addEventListener('close-modal', event => {
                $('#addStore').modal('hide');
                $('#editStore').modal('hide');
                $('#delete_modal').modal('hide');
                $('#show-delete-confirmation-modal').modal('hide');
            });

            window.addEventListener('edit-modal', event => {
                $('#editStore').modal('show');
            });
            window.addEventListener('delete-modal', event => {
                $('#delete_modal').modal('show');
            });
        </script>
@endpush

</div>
