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
                            <li class="breadcrumb-item active">Stock Documents</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Stock Documents</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    
        <div class="card">
            <div class="card-body">
                <div class="row">
    
                    <a href="{{route('receiveStock','SC'.date('y').mt_rand(100, 999).time())}}">+ stock Doc</a>
                    <!-- gantt view -->
                    <div class="col-xxl-12 mt-4 mt-xl-0 col-lg-12">
                        <div class="ps-xl-3">
                          
                            <div class="row">
                                <div class="col mt-3">
                                    <table id="example2" class="table w-100">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Stock Code</th>
                                                <th>GRN</th>
                                                <th>Delivery No</th>
                                                <th>LPO</th>
                                                <th>Created By</th>
                                                <th>Date Recieved</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($values)>0)
                                            @php($i=1)
                                            @foreach($values as $stockDocument)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$stockDocument->stock_code??''}}</td>
                                                <td>{{$stockDocument->grn}}</td>
                                                <td>{{ $stockDocument->delivery_no??''}}</td>
                                                <td>{{ $stockDocument->lop??''}}</td>
                                                <td>{{ $stockDocument->user->name??''}}</td>
                                                <td>{{ $stockDocument->date_added}}</td>    
                                                <td class="table-action">
                                                    @if($stockDocument->is_active==1)
                                                    <span class="badge badge-success-lighten float-center">Active</span>
                                                    @php($satate='Active' AND $Stvalue=1)
                                                    @elseif($stockDocument->is_active==0)
                                                    <span class="badge badge-danger-lighten float-center">InActive</span>
                                                    @php($satate='InActive' AND $Stvalue=0)
                                                    @endif
                                                    <a href="javascript: void(0);" 
                                                    wire:click="deleteConfirmation({{ $stockDocument->item_id }})" class="action-ico text-danger  mx-1">
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
