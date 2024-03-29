<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Departments</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All department items</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    
        <div class="card">
            <div class="card-body">
                <div class="row">
    
    
                    <!-- gantt view -->
                    <div class="col-xxl-12 mt-4 mt-xl-0 col-lg-12">
                        <div class="ps-xl-3">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ url('inventory/departments/addItems') }}" method="POST">
                                        @csrf
    
                                        <div class="row" wire:ignore>
    
                                                <div class="col-md-4">
                                                    <select  class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose departments... "  name="department_id[]" required>
    
                                                        @if(count($units)>0)
                                                    @foreach($units as $valueUnit)
                                                        <option value="{{ $valueUnit->id }}">{{ $valueUnit->department_name}}</option>
                                                    @endforeach
                                                    @endif
    
                                                      </select>
                                                </div>
    
                                                <div class="col-md-4">
                                                    <select class="form-select myselect" data-placeholder="Choose ... item"  name="inv_item_id" required>
                                                        <option value="">Select an item </option>
                                                        @if(count($items)>0)
                                                    @foreach($items as $value)
                                                        <option value="{{ $value->item_id}}">{{ $value->item_name.'    '.$value->item_code}}</option>
                                                    @endforeach
                                                    @endif
    
                                                      </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="brand" placeholder="brand" class="form-control" id="">
                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                </div>
    
                                        </div>
                                        <!-- end row-->
    
    
                                    </form>
    
                                </div>
    
    
    
                            </div>
    
                            <div class="row">
                                <div class="col mt-3">
                                    <table class="table table-centered w-100 dt-responsive" id="example2">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Department</th>
                                                <th>Category</th>
                                                <th>Costprice</th>
                                                <th>Date added</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($values)>0)
                                            @php($i=1)
                                            @foreach($values as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$value->item_name}}</td>
                                                <td ><p style="white-space: nowrap;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    max-width: 150px;">{{ $value->brand}}</p></td>
                                                <td>{{ $value->department_name}}</td>
                                                <td>{{ $value->subunit_name}}</td>
                                                <td>{{ $value->cost_price}}</td>
                                                <td>{{ $value->date_added}}</td>
    
                                                <td class="table-action">
                                                    @if($value->is_active==1)
                                                    <span class="badge badge-success-lighten float-center">Active</span>
                                                    @php($satate='Active' AND $Stvalue=1)
                                                    @elseif($value->is_active==0)
                                                    <span class="badge badge-danger-lighten float-center">InActive</span>
                                                    @php($satate='InActive' AND $Stvalue=0)
                                                    @endif
                                                    <a href="javascript: void(0);" 
                                                    wire:click="deleteConfirmation({{ $value->item_id }})" class="action-ico text-danger  mx-1">
                                                    <i class="mdi mdi-delete"></i></a>
                                                   
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
    
    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end gantt view -->
                </div>
            </div>
        </div>

    
    </div> <!-- container -->
    <div class="modal fade" wire:ignore.self id="delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabeld" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Info</h5>
                    <button type="button" class="btn-close" wire:click="cancel()" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Are you sure you want to delete this Record? {{$delete_id}}</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteData()">Yes! Delete</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
  
    <script>
        window.addEventListener('close-modal', event => {
            $('#addData').modal('hide');
            $('#editData').modal('hide');
            $('#delete_modal').modal('hide');
            $('#show-delete-confirmation-modal').modal('hide');
        });

        window.addEventListener('edit-modal', event => {
            $('#addData').modal('show');
        });
        window.addEventListener('delete-modal', event => {
            $('#delete_modal').modal('show');
        });
    </script>
     @endpush
</div>
