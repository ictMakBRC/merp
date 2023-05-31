<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="{{route('inventory')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Items</a></li>

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
                        <x-inventory.table-utilities>
                            <div class="text-sm-end mt-1 ms-auto position-relative">
                                <a type="button" href="#" class="btn btn-primary mb-2 me-1" data-bs-toggle="modal" data-bs-target="#addData">Add New</a>
                            </div>
                        </x-inventory.table-utilities> 
                    </div>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Subcategory</th>
                                    <th>Costprice</th>
                                    <th>Status</th>
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
                                    <td>{{ $value->description}}</td>
                                    <td>{{ $value->parentcategory->subunit_name}}</td>
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
                                    </td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-ico text-info mx-1"> <i
                                            class="mdi mdi-pencil" data-bs-toggle="modal" data-bs-target="#addData"
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
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="btn-group float-end">
                                {{ $values->links() }}
                            </div>
                        </div>
                    </div>
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

     <!-- ADD NEW Items Modal -->
    <div class="modal fade" wire:ignore.self id="addData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header text-center h3">
                    @if ($is_update=='false')
                     <h4 class="modal-title text-center" id="staticBackdropLabel">Add a new Item</h4>
                    @else
                    <h4 class="modal-title text-center" id="staticBackdropLabel">Update Item</h4>
                    @endif
                   
                    <button type="button"  wire:click="cancel()" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    @if ($is_update=='false')
                    <form wire:submit.prevent="storeData">
                   @else
                   <form wire:submit.prevent="updateData">
                   @endif
                   
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <h4 class="header-title mb-3 text- text-center"> General item Information</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="mb-3">
                                                        <label for="subCategory" class="form-label">Category</label>
                                                        <select name="inv_subunit_id" id="subunit" onchange="makeCode()" wire:model.lazy="inv_subunit_id" class="form-control">
                                                            <option value="">Select</option>
                                                            @if(count($subcat)>0)
                                                            @foreach($subcat as $sub)
                                                                <option value="{{ $sub->id }}">{{ $sub->subunit_name}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @error('inv_subunit_id')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="item_name" class="form-label">Item Name</label>
                                                        <input type="text" id="item_name" class="form-control" name="item_name" wire:model.lazy="item_name" required>
                                                        @error('item_name')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                 
                                                    <div class="mb-3">
                                                        <label for="item_code" class="form-label">Item code</label>
                                                        <input type="text" id="item_code" class="form-control" name="item_code" wire:model.differ="item_code" required>
                                                        @error('item_code')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
        
                                                    <div class="mb-3">
                                                        <label for="cost_price" class="form-label">Cost price</label>
                                                        <input type="text" id="cost_price" class="form-control" name="cost_price" wire:model.lazy="cost_price" required>
                                                        @error('cost_price')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inv_uom_id" class="form-label">UOM</label>
                                                        <select class="form-select " id="inv_uom_id" name="inv_uom_id" wire:model.lazy="inv_uom_id" required>
                                                            <option value="">Select</option>
                                                            @if(count($uoms)>0)
                                                            @foreach($uoms as $uom)
                                                                <option value="{{ $uom->id }}">{{ $uom->uom_name}}</option>
                                                            @endforeach
                                                            @endif
                                                            @error('inv_uom_id')
                                                            <div class="text-danger text-small">{{ $message }}</div>
                                                            @enderror
                                                        </select>
                                                    </div>
                                                    <div class="input-group">
                                                    <label for="">Expires</label>? &nbsp 
                                                    &nbsp<input type="checkbox" id="switch1" wire:model.lazy="expires" name="expires" checked data-switch="bool"/>
                                                    <label for="switch1" data-on-label="True" data-off-label="False"></label>
                                                    </div>
                                                  
        
                                                </div>
                                                <!-- end col -->
        
                                                <div class="col-lg-6">
                                                    <div>
                                                        <h4 class="header-title mb-3 text-center"> Item Details</h4>
                                                    </div>
                                                    <hr>
        
        
                                                    <div class="mb-3">
                                                        <label for="max_qty" class="form-label">Max Qty</label>
                                                        <input class="form-control" id="max_qty" type="text" wire:model.lazy="max_qty" name="max_qty" required>
                                                        @error('max_qty')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
        
                                                    <div class="mb-3">
                                                        <label for="min_qty" class="form-label">Min Qty</label>
                                                        <input class="form-control" id="min_qty" type="text" name="min_qty" wire:model.lazy="min_qty" required>
                                                        @error('min_qty')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
        
        
                                                  
                                                    <div class="mb-3">
                                                        <label  class="form-label">Supplier</label>
                                                        <select class="form-select " id="supplier_id" name="supplier_id" wire:model.lazy="supplier_id" wire:model="supplier_id">
                                                            <option value="">Select Supplier</option>
                                                            @if(count($suppliers)>0)
                                                            @foreach($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        @error('supplier_id')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description on Purchase transactions</label>
                                                        <textarea class="form-control" name="description" wire:model.lazy="description" required></textarea>
                                                        @error('description')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                          
                                                    <div class="mb-3">
                                                        <label for="date_added" class="form-label">As of</label>
                                                        <input class="form-control" id="date_added" type="date" name="date_added" wire:model="date_added" required>
                                                        @error('date_added')
                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="d-grid mb-3 text-center">
        
                                            </div>
                                                </div> <!-- end col -->
                                               
                                            </div>
                                            <!-- end row-->
        
        
                                    </div><!-- end card body-->
                                </div><!-- end card -->
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
            $('#addData').modal('show');
        });
        window.addEventListener('delete-modal', event => {
            $('#delete_modal').modal('show');
        });
    </script>
    <script>
        function makeCode(){
            var e = document.getElementById("subunit");                                                    
            var currentY = <?php echo time().rand(1,10); ?>;
            var name = e.options[e.selectedIndex].text;
            var prefix =  name.slice(0, 3).toUpperCase()
            document.getElementById('item_code').value = prefix + currentY;
        }
       
    </script>
    @endpush
</div>
