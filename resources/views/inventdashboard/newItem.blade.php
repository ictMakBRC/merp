@extends('inventdashboard.layouts.formLayout')
@section('title', 'New Item')
@section('content')
<div class="container-fluid">

    <!-- start quote -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item"><a href="{{url('inventory/')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('inventory/newItem')}}">Items</a></li>
                                    <li class="breadcrumb-item active">Add Item</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
        <!-- end quote -->
        <form method="POST" action="{{ url('inventory/add-item') }}">
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
                                                <select name="inv_subunit_id" id="subunit" onchange="makeCode()" class="form-control myselect">
                                                    <option value="">Select</option>
                                                    @if(count($subcat)>0)
                                                    @foreach($subcat as $sub)
                                                        <option value="{{ $sub->id }}">{{ $sub->subunit_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="item_name" class="form-label">Item Name</label>
                                                <input type="text" id="item_name" class="form-control" name="item_name" required>
                                            </div>
                                            <script>
                                                function makeCode(){
                                                    var e = document.getElementById("subunit");                                                    
                                                    var currentY = <?php echo time().rand(1,10); ?>;
                                                    var name = e.options[e.selectedIndex].text;
                                                    var prefix =  name.slice(0, 3).toUpperCase()
                                                    document.getElementById('item_code').value = prefix + currentY;
                                                }
                                               
                                            </script>
                                            <div class="mb-3">
                                                <label for="item_code" class="form-label">Item code</label>
                                                <input type="text" id="item_code" class="form-control" name="item_code" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="cost_price" class="form-label">Cost price</label>
                                                <input type="text" id="cost_price" class="form-control" name="cost_price" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inv_uom_id" class="form-label">UOM</label>
                                                <select class="form-select myselect" id="inv_uom_id" name="inv_uom_id" required>
                                                    <option value="">Select</option>
                                                    @if(count($uoms)>0)
                                                    @foreach($uoms as $uom)
                                                        <option value="{{ $uom->id }}">{{ $uom->uom_name}}</option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                            <div class="input-group">
                                            <label for="">Expires</label>? &nbsp 
                                            &nbsp<input type="checkbox" id="switch1" name="expires" checked data-switch="bool"/>
                                            <label for="switch1" data-on-label="True" data-off-label="False"></label>
                                            </div>
                                            {{-- <div class="mb-3">
                                                <label  class="form-label">Supplier</label>
                                                <select class="form-select myselect" id="inv_supplier_id" name="inv_supplier_id">
                                                    <option value="">Select Supplier</option>
                                                    @if(count($suppliers)>0)
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->sup_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div> --}}

                                        </div>
                                        <!-- end col -->

                                        <div class="col-lg-6">
                                            <div>
                                                <h4 class="header-title mb-3 text-center"> Item Details</h4>
                                            </div>
                                            <hr>


                                            <div class="mb-3">
                                                <label for="max_qty" class="form-label">Max Qty</label>
                                                <input class="form-control" id="max_qty" type="text" name="max_qty" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="min_qty" class="form-label">Min Qty</label>
                                                <input class="form-control" id="min_qty" type="text" name="min_qty" required>
                                            </div>


                                            {{-- <div class="mb-3" >
                                                <label for="inv_store_id" class="form-label">Store location</label>
                                                <select class="form-select myselect" id="inv_store_id" name="inv_store_id" required>
                                                    <option value="">Select store</option>
                                                    @if(count($stores)>0)
                                                    @foreach($stores as $store)
                                                        <option value="{{ $store->id }}">{{ $store->store_name.' '.$store->store_location}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div> --}}
                                            <div class="mb-3">
                                                <label  class="form-label">Supplier</label>
                                                <select class="form-select myselect" id="inv_supplier_id" name="inv_supplier_id">
                                                    <option value="">Select Supplier</option>
                                                    @if(count($suppliers)>0)
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->sup_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description on Purchase transactions</label>
                                                <textarea class="form-control" name="description" required>

                                                </textarea>
                                            </div>
                                  
                                            <div class="mb-3">
                                                <label for="date_added" class="form-label">As of</label>
                                                <input class="form-control" id="date_added" type="date" name="date_added" required>
                                            </div>
                                            <div class="d-grid mb-3 text-center">

                                    </div>
                                        </div> <!-- end col -->
                                        <button class="btn btn-primary" type="submit"> ADD ITEM</button>
                                    </div>
                                    <!-- end row-->


                            </div><!-- end card body-->
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div><!--end of row-->
        </form>
    </div>
    @endsection
