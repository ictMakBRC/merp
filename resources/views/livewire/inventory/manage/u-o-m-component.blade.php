<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="{{route('inventory')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UOM</a></li>

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
                            <h4 class="header-title mb-3  text-center"> MakBRC UOM</h4>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-end mt-3">
                            <a type="button" href="#" class="btn btn-primary mb-2 me-1" data-bs-toggle="modal" data-bs-target="#addData">Add UOM</a>
                        </div>
                    </div><!-- end col-->
                </div>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="example1" class="table w-100 nowrap sortable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>UOM Name</th>
                                    <th>Date Added</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($values)>0)
                                @php($i=1)
                                @foreach($values as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{ $value->uom_name}}</td>
                                    <td>{{ $value->created_at}}</td>
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
     <!-- ADD NEW UOM Modal -->
     <div class="modal fade" wire:ignore.self data-bs-backdrop="static"  id="editData" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditData">Edit UOM</h5>
                    <button type="button" wire:click="cancel()" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form wire:submit.prevent="updateData" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">


                                <div class="mb-3">
                                    <label for="UOMName" class="form-label">UOM Name</label>
                                    <input type="text" id="UOMName"  class="form-control" name="uom_name" wire:model="uom_name" required>
                                    @error('uom_name')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="isActive" class="form-label">State</label>
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
                            <button class="btn btn-primary" type="submit">Update UOM</button>
                        </div>

                    </form>

                </div>

            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
     <!-- ADD NEW UOM Modal -->
    <div class="modal fade" wire:ignore.self id="addData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Unit Of Measure</h5>
                    <button type="button"  wire:click="cancel()" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form wire:submit.prevent="storeData" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">


                                <div class="mb-3">
                                    <label for="UOMName" class="form-label">UOM Name</label>
                                    <input type="text" id="UOMName" name="uom_name" wire:model='uom_name' class="form-control"  required>
                                    @error('uom_name')
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
    @push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addData').modal('hide');
            $('#editData').modal('hide');
            $('#delete_modal').modal('hide');
            $('#show-delete-confirmation-modal').modal('hide');
        });

        window.addEventListener('edit-modal', event => {
            $('#editData').modal('show');
        });
        window.addEventListener('delete-modal', event => {
            $('#delete_modal').modal('show');
        });
    </script>
    @endpush
</div>
