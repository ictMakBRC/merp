
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'New stock')
@section('content')
<div class="container-fluid">

    <!-- start quote -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="{{url('inventory/stockLevels')}}">Stock</a></li>
                          <li class="breadcrumb-item active">New Stock</li>

                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end quote -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
               <form method="POST" action="{{ url('inventory/add-stock') }}">
                  @csrf
                   <div class="row mb-2 mt-3">
                       <input type="hidden" class="form-control" name="stock_code"  readonly value="{{ $code }}">
                    <div class="col-sm-4">
                            <div class="text-sm">
                            <label>Item</label>
                            <select class="form-control myselect" name="inv_items_id" id="item" required>
                                <option value="">Select item</option>
                                @foreach($items as $item)
                                    <option value="{{$item->item_id}}">{{$item->item_name.'  ('.$item->uom_name.') '.$item->department_name}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div><!-- end col-->

                        <div class="col-sm-2">
                            <div class="text-sm">
                                <label>Cost price</label>
                                <input type="text" class="form-control" name="unit_cost" id="icostprice" required>
                            </div>
                        </div>


                        <div class="col-sm-2">
                            <div class="text-sm">
                                <label>Department</label>
                                <select id='departmentid'  class="form-control" name='department_id'>

                                 </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-sm">
                            <label>Supplier</label>
                            <select class="form-control myselect" id="supplier" name="inv_supplier_id">

                                @if(count($suppliers)>0)
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->sup_name}}</option>
                                @endforeach
                                @endif
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-2" >
                            <label for="inv_store_id">Store</label>
                            <select class="form-select myselect" id="inv_store_id" name="inv_store_id" required>
                                <option value="">Select store</option>
                                @if(count($stores)>0)
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}">{{ $store->store_name.' '.$store->store_location}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                   </div>
                   <script>
                    $(document).ready(function(){
                    $('#item').change(function() {

                        var itemID = $(this).val();
                        $("#departmentid").empty();

                        if (itemID) {
                            $.ajax({
                                type: "GET",
                                url: "{{ url('inventory/getItem') }}?item_id=" + itemID,
                                success: function(response) {

                                    var len = 0;
                         if(response['data'] != null){
                           len = response['data'].length;
                         }

                         if(len > 0){
                           // Read data and create <option >
                           for(var i=0; i<len; i++){

                             var dptid = response['data'][i].dptid;
                             var dptname = response['data'][i].dptname;
                            var costp =  response['data'][i].cost;
                            var expires =  response['data'][i].expires;
                             var option = "<option value='"+dptid+"'>"+dptname+"</option>";

                             var supid = response['data'][i].supid;
                             var supname = response['data'][i].suppliername;

                             var optionsup = "<option selected value='"+supid+"'>"+supname+"</option>";

                             $("#departmentid").append(option);
                             $("#supplier").append(optionsup);

                             document.getElementById('icostprice').value =costp;
                             document.getElementById('expires').value =expires;
                             
                           }
                         }
                                }
                            });
                        } else {

                            $("#departmentid").empty();
                            $("#icostprice").empty();
                            $("#expires").empty();

                        }
                    });
                });
                </script>

                   <div class="row mb-2 mt-3">
                        <div class="col-sm-2">
                            <div class="text-sm">
                                <label>Quantity</label>
                                <input type="number" class="form-control" onchange="exp()" required name="stock_qty">
                            </div>
                        </div><!-- end col-->
                        <div class="col-sm-2">
                            <div class="text-sm">
                                <label>Batch No.</label>
                                <input type="text" class="form-control" id="batch_no" name="batch_no">
                            </div>
                        </div><!-- end col-->
                        <div class="col-sm-1">
                            <div class="text-sm">
                                <label>Expires</label>
                                <input type="text" onchange="exp()" readonly value="off" class="form-control" id="expires" name="expires">
                            </div>
                        </div><!-- end col-->
                        
                        <div class="col-sm-3">
                            <div class="text-sm">
                                @php($Date = date("Y-m-d"))
                                <label>Expiry date</label>
                                <input type="date" class="form-control" min="{{date('Y-m-d', strtotime($Date. ' + 15 days'))}}" id="expiry_date" name="expiry_date" >
                            </div>
                        </div>
                        <div class="col-sm-2">

                            <div class="text-sm">
                                <label>As of</label>
                                <input type="date" class="form-control" value="{{date("Y-m-d")}}" name="date_added" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-sm-end pt-2">
                                <button type="submit" class="btn btn-primary mb-2 me-1">Add item</button>
                            </div>
                        </div><!-- end col-->
                     </div>
                     <script>
                            function exp(){
                          var exp = document.getElementById('expires').value
                          if(exp =='on'){                            
                            document.getElementById("expiry_date").setAttribute("required", "required");
                            document.getElementById("batch_no").setAttribute("required", "required");
                          }
                          else{
                            document.getElementById("expiry_date").removeAttribute("required");
                            document.getElementById("batch_no").removeAttribute("required");
                          }
                          }
                        </script>
                    </form>
                </div>
            <div class="card-body">
                <form method="POST" action="{{ url('inventory/save-stock') }}">
                    @csrf
                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Item name</th>
                                    <th>Belongs to</th>
                                    <th>UOM</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Total Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($values)>0)
                                @php($i=1)
                                @foreach($values as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->item_name}}<input type="hidden" name="item[]" required value="{{$value->dptitemid}}"></td>
                                    <td>{{ $value->department_name}}</td>
                                    <td>{{ $value->uom_name}}</td>
                                    <td>{{ $value->stock_qty}} <input type="hidden" name="quantity[]" value="{{$value->stock_qty}}"></td>
                                    <td>{{ $value->unit_cost}}</td>
                                    <td>{{ $value->unit_cost*$value->stock_qty}} <input type="hidden" name="amount" value="{{ $value->unit_cost*$value->stock_qty}} "></td>
                                    <td> <a onclick="return confirm('Are you sure you want to delete?');" href="{{ url('inventory/delete-stockitem/'.$value->stock_id) }}"  data-toggle="tooltip" title="Delete!" class="action-icon"> <i class="mdi mdi-delete"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <p class="text-end mt-2">Total Amount: <strong><span id="totalamt"></span></strong></p>
                    </div> <!-- end preview-->
                    <input type="hidden" class="form-control" name="stockcode"  readonly value="{{ $code }}">
                    <input type="hidden" class="form-control" name="stktotalamt" id="stktotalamt" readonly>
                    <div class="row mt-3">
                        <div class="col-sm-3 mt-1">
                            <div class="input-group">
                            <span class="input-group-text">LPO</span>
                            <input type="text" name="lpo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-1">
                            <div class="input-group">
                                <span class="input-group-text">GRN</span>
                            <input type="text" name="grn" class="form-control"  required>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-1">
                            <div class="input-group">
                                <span class="input-group-text">Delivery No</span>
                            <input type="text" name="delivery_no" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="text-sm-end col-sm-3">
                            <button type="submit" id="saveStk" disabled class="btn btn-primary mb-2 me-1 mt-1 text-sm-end">Save stock</button>
                        </div>
                    </div>
                   
                </div> <!-- end tab-content-->
             </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script type="text/javascript">

    window.sumInputs = function() {
        var inputs = document.getElementsByName('amount'),

            sum = 0;

        for(var i=0; i<inputs.length; i++) {
            var ip = inputs[i];

            if (ip.name && ip.name.indexOf("total") < 0) {
                sum += parseFloat(ip.value) || 0;
            }

        }
        var ked = sum;
      var num = 'UGX: ' + ked.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    document.getElementById('totalamt').innerHTML = num;
    document.getElementById('stktotalamt').value = sum;
    }
    sumInputs();
    var numval = document.getElementById('stktotalamt').value-0;
    if(numval > 0) { 
        //btn.setAttribute('disabled', 'disabled');
        document.getElementById("saveStk").disabled = false; 
    }
    else{
        document.getElementById("saveStk").disabled = true; 
        //btn.removeAttribute("disabled");
    }
    </script>
@endsection
