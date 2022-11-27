@extends('inventdashboard.layouts.formLayout')
@section('title', 'New Item')
@section('content')
     <!-- Start Content-->
     <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{asset('inventory/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{asset('inventory/Items')}}">Items</a></li>
                            <li class="breadcrumb-item active">Edit Item</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Item</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        @foreach($values as $value)

        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{url('assets/images/items.jpg')}}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0 mt-2">{{$value->item_name}}</h4>
                        <p class="text-muted font-14">{{ $value->subunit_name}}</p>


                        <div class="text-start mt-3">
                            <h4 class="font-13 text-uppercase">About Item :</h4>
                            <p class="text-muted font-13 mb-3">
                                {{ $value->description}}
                            </p>
                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{$value->item_name}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>UOM :</strong> <span class="ms-2">{{ $value->uom_name}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Store :</strong> <span class="ms-2">{{ $value->store_name}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Supplier :</strong> <span class="ms-2">{{ $value->sup_name}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Min Stock :</strong> <span class="ms-2">{{ $value->min_qty}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Max Stock :</strong> <span class="ms-2">{{ $value->max_qty}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Cost Price :</strong> <span class="ms-2">{{ $value->cost_price}}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Sub Category :</strong> <span class="ms-2 ">{{ $value->subunit_name}}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Department/Category :</strong><span class="ms-2">{{ $value->name}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Date Added :</strong> <span class="ms-2">{{ $value->date_added}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Date captured :</strong> <span class="ms-2">{{ $value->created_at}}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Last updated :</strong> <span class="ms-2">{{ $value->updated_at}}</span></p>

                            @if($value->is_active==1)
                                            <span class="badge badge-success-lighten float-center">Active</span>
                                            @php($satate='Active' AND $Stvalue=1)
                                            @elseif($value->is_active==0)
                                            <span class="badge badge-danger-lighten float-center">InActive</span>
                                            @php($satate='InActive' AND $Stvalue=0)
                                            @endif
                             </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->



            </div> <!-- end col-->

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="header-title mb-3 text-center">Edit Item Details</h4>
                        </div>
                        <div class="tab-content">
                            <div  class="tab-pane show active" id="settings">
                                <form method="POST" action="{{ url('inventory/update-item/'.$value->id) }}">
                                    @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-lg-6">

                                                                    <hr>
                                                                    <div class="mb-3">
                                                                        <label for="item_name" class="form-label">Item Name</label>
                                                                        <input type="text" id="item_name" value="{{$value->item_name}}" class="form-control" name="item_name" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="category" class="form-label">Category</label>
                                                                        <select id="unit" class="form-control myselect" name="department_id" required>
                                                                            <option value="{{ $value->department_id}}" selected>{{ $value->name}}</option>

                                                                            @foreach($units as $unit)
                                                                            <option value="{{ $unit->id }}">{{ $unit->name}}</option>
                                                                        @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="subCategory" class="form-label">Subcategory</label>
                                                                        <select name="inv_subunit_id" id="subunit" class="form-control myselect">
                                                                            <option value="{{ $value->inv_subunit_id}}" selected>{{ $value->subunit_name}}</option>
                                                                        </select>
                                                                    </div>

                                                                    <script>
                                                                        $(document).ready(function(){
                                                                        $('#unit').change(function() {

                                                                            var unitID = $(this).val();

                                                                            if (unitID) {

                                                                                $.ajax({
                                                                                    type: "GET",
                                                                                    url: "{{ url('inventory/getSubUnits') }}?unit_id=" + unitID,
                                                                                    success: function(res) {

                                                                                        if (res) {

                                                                                            $("#subunit").empty();
                                                                                            $("#subunit").append('<option>Select subcategory</option>');
                                                                                            $.each(res, function(key, value) {
                                                                                                $("#subunit").append('<option value="' + key + '">' + value +
                                                                                                    '</option>');
                                                                                            });

                                                                                        } else {

                                                                                            $("#subunit").empty();
                                                                                        }
                                                                                    }
                                                                                });
                                                                            } else {

                                                                                $("#subunit").empty();

                                                                            }
                                                                        });
                                                                    });
                                                                    </script>



                                                                    <div class="mb-3">
                                                                        <label for="cost_price" class="form-label">Cost price</label>
                                                                        <input type="text" id="cost_price" value="{{ $value->cost_price}}" class="form-control" name="cost_price" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="inv_uom_id" class="form-label">UOM</label>
                                                                        <select class="form-select myselect" id="inv_uom_id" name="inv_uom_id" required>
                                                                            <option value="{{ $value->inv_uom_id}}">{{ $value->uom_name}}</option>
                                                                            @if(count($uoms)>0)
                                                                            @foreach($uoms as $uom)
                                                                                <option value="{{ $uom->id }}">{{ $uom->uom_name}}</option>
                                                                            @endforeach
                                                                            @endif

                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label  class="form-label">Supplier</label>
                                                                        <select class="form-select myselect" id="inv_supplier_id" name="inv_supplier_id" required>
                                                                            <option value="{{ $value->inv_supplier_id}}">{{ $value->sup_name}}</option>
                                                                            @if(count($suppliers)>0)
                                                                            @foreach($suppliers as $supplier)
                                                                                <option value="{{ $supplier->id }}">{{ $supplier->sup_name}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                </div> <!-- end col -->

                                                                <div class="col-lg-6">

                                                                    <hr>


                                                                    <div class="mb-3">
                                                                        <label for="max_qty" class="form-label">Max Qty</label>
                                                                        <input class="form-control" id="max_qty" type="text" value="{{ $value->max_qty}}" name="max_qty" required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="min_qty" class="form-label">Min Qty</label>
                                                                        <input class="form-control" id="min_qty" type="text" name="min_qty" value="{{ $value->min_qty}}" required>
                                                                    </div>


                                                                    <div class="mb-3" >
                                                                        <label for="inv_store_id" class="form-label">Store location</label>
                                                                        <select class="form-select myselect" id="inv_store_id" name="inv_store_id" required>
                                                                            <option value="{{ $value->inv_store_id}}">{{ $value->store_name.' '.$value->store_location}}</option>
                                                                            @if(count($stores)>0)
                                                                            @foreach($stores as $store)
                                                                                <option value="{{ $store->id }}">{{ $store->store_name.' '.$store->store_location}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="description" class="form-label">Description on Purchase transactions</label>
                                                                        <textarea class="form-control" name="description" required>{{ $value->description}}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="date_added" class="form-label">As of</label>
                                                                        <input class="form-control" id="date_added" type="date" value="{{ $value->date_added}}" name="date_added" required readonly>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="isActive" class="form-label">State</label>
                                                                        <select class="form-control" id="isActive" name="isActive" required>
                                                                            <option value="{{$Stvalue}}">{{$satate}}</option>
                                                                            <option value="1">Active</option>
                                                                            <option value="0">InActive</option>
                                                                        </select>
                                                                    </div>

                                                                </div> <!-- end col -->
                                                            </div>
                                                            <!-- end row-->
                                                            <div class="d-grid mb-3 text-center">
                                                                <button class="btn btn-primary" type="submit">UPDATE ITEM</button>
                                                            </div>
                                                        </form>
                                                    </div><!-- end card body-->
                                                </div><!-- end card -->
                                            </div> <!-- end col -->
                                        </div><!--end of row-->
                                </form>
                            </div>
                            <!-- end settings content-->

                        </div> <!-- end tab-content -->
                    </div> <!-- end card body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row-->
        @endforeach
    </div>
    <!-- container -->
    @endsection
