
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'New request')
@section('content')
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->


                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start quote -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{asset('inventory/')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{asset('inventory/requests')}}">Requests</a></li>
                                            <li class="breadcrumb-item active">Request Items</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">New Request</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end quote -->



                        <div class="row">


                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title mb-3"> Make a new request</h4>
                                        <div id="progressbarwizard">
                                            <div id="rootwizard">
                                                <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                                    <li class="nav-item" data-target-form="#accountForm">
                                                        <a href="#first" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-account-circle me-1"></i>
                                                            <span class="d-none d-sm-inline">Requester Details</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item active" data-target-form="#profileForm">
                                                        <a href="#second" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
                                                            <i class="mdi mdi-face-profile me-1"></i>
                                                            <span class="d-none d-sm-inline">Request Items</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" data-target-form="#otherForm">
                                                        <a href="#third" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                                            <span class="d-none d-sm-inline">Finish</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content mb-0 b-0">

                                                    <div class="tab-pane" id="first">
                                                        <form id="accountForm" method="post" action="#" class="form-horizontal">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="userName3">Requester name</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" id="userName3" readonly name="userName3" value="{{ Auth::user()->name }}" required="">
                                                                            <input type="hidden" class="form-control" id="userId" readonly name="userId" value="{{ Auth::user()->id }}" required="">
                                                                        </div>
                                                                    </div>
                                                                    @if(count($requesters)>0)
                                                                    @foreach($requesters as $requester)
                                                                    <div class="row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="userName3">Approver name</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" id="userName3" readonly name="userName3" value="{{ $requester->uname }}" required="">

                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="userName3">Requester Department</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" id="userName3" readonly name="userName3" value="{{ $requester->dname }}" required="">
                                                                         </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="userName3">Request Type</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" id="userName3" readonly name="userName3" value="{{ $requester->type}}" required="">
                                                                         </div>
                                                                    </div>


                                                                    @endforeach
                                                                    @else
                                                                    <script type="text/javascript">
                                                                     window.location = "{{ url('inventory/request/new') }}";
                                                                    </script>
                                                                    @endif
                                                                </div> <!-- end col -->
                                                            </div> <!-- end row -->
                                                        </form>
                                                    </div>

                                                    <div class="tab-pane show active" id="second">
                                                        <div class="row">

                                                            <div class="col-12">
                                                                <div class="card">
                                                                    @foreach($requesters as $requester)
                                                                    <div class="card-header pt-0">

                                                                   <form method="POST" action="{{ url('inventory/request/additem') }}"  name="myForm"  class="needs-validation"  onsubmit="return validateForm()">
                                                                      @csrf
                                                                      @endforeach
                                                                       <div class="row mb-2 mt-3">

                                                                           <input type="hidden" class="form-control" name="inv_requests_id"  readonly value="{{ $requester->requestid }}">

                                                                           <input type="hidden" class="form-control" name="request_code"  readonly value="{{ $code }}">
                                                                        <div class="col-sm-5">
                                                                                <div class="text-sm">
                                                                                <label>Item</label>
                                                                                <select class="form-control myselect" name="inv_items_id" id="item" required>
                                                                                    <option value="">Select item</option>
                                                                                    @foreach($items as $item)
                                                                                        <option value="{{$item->item_id}}">{{$item->item_name.'  ('.$item->uom_name.')'}}</option>
                                                                                        @endforeach
                                                                                </select>
                                                                                <input type="hidden" readonly  class="form-control" name="inv_item_id" id="inv_item_id" required>
                                                                                </div>
                                                                            </div><!-- end col-->
                                                                            <div class="col-sm-2">
                                                                                <div class="text-sm">
                                                                                    <label>Qyantity Left</label>
                                                                                    <input type="text" readonly value="0" class="form-control" name="qty_left" id="qtyleft" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-3">
                                                                                <div class="text-sm">
                                                                                    <label>Quantity required</label>
                                                                                    <input type="number" min="1"  class="form-control" required name="request_qty">
                                                                                </div>
                                                                            </div><!-- end col-->

                                                                            <div class="col-sm-2">
                                                                                <div class="text-sm-end pt-2">
                                                                                    <button type="submit" class="btn btn-primary mb-2 me-1">Add item</button>
                                                                                </div>
                                                                            </div><!-- end col-->


                                                                       </div>
                                                                    </form>
                                                                    <script>
                                                                        $(document).ready(function(){
                                                                        $('#item').change(function() {

                                                                            var itemID = $(this).val();


                                                                            if (itemID) {
                                                                                $.ajax({
                                                                                    type: "GET",
                                                                                    url: "{{ url('inventory/getRequestItem') }}?item_id=" + itemID,
                                                                                    success: function(response) {

                                                                                        var len = 0;
                                                                             if(response['itemData'] != null){
                                                                               len = response['itemData'].length;
                                                                             }

                                                                             if(len > 0){
                                                                               // Read data and create <option >
                                                                               for(var i=0; i<len; i++){
                                                                                var qtyleft =  response['itemData'][i].qtyleft;
                                                                                var item =  response['itemData'][i].item;
                                                                                var qtyheld =  response['itemData1'][i].qtyheld;
                                                                                var qtyavailable=qtyleft-qtyheld;

                                                                                 document.getElementById('qtyleft').value = qtyavailable;
                                                                                 document.getElementById('inv_item_id').value = item;
                                                                               }
                                                                             }
                                                                                    }
                                                                                });
                                                                            } else {

                                                                                $("#qtyleft").val = 0;

                                                                            }
                                                                        });
                                                                    });
                                                                    </script>
                                                                    </div>
                                                                <div class="card-body">
                                                                    <form method="POST" action="{{ url('inventory/request/delete') }}">
                                                                        @csrf
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane show active" id="scroll-horizontal-preview">
                                                                            <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No.</th>
                                                                                        <th>Item name</th>
                                                                                        <th>Description</th>
                                                                                        <th>UOM</th>
                                                                                        <th>Quantity</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @if(count($values)>0)
                                                                                    @php($i=1)
                                                                                    @php($display="block")
                                                                                    @foreach($values as $value)
                                                                                    <tr>
                                                                                        <td>{{$i++}}</td>
                                                                                        <td>{{$value->item_name}}<input type="hidden" name="item[]" value="{{$value->item}}"></td>
                                                                                        <td>{{ $value->description}}</td>
                                                                                        <td>{{ $value->uom_name}}</td>
                                                                                        <td>{{ $value->request_qty}} <input type="hidden" id="totaltqty" name="quantity[]" value="{{$value->request_qty}}"></td>
                                                                                        {{-- <td> <a onclick="return confirm('Are you sure you want to delete?');" href="{{ url('inventory/request/delete-item/?id='.$value->ritem_id.'&qty='.$value->request_qty) }}"  data-toggle="tooltip" title="Delete!" class="action-icon"> <i class="mdi mdi-delete"></i></a></td> --}}
                                                                                        <td> <a onclick="return confirm('Are you sure you want to delete?');" href="{{ url('inventory/request/delete-item/'.$value->ritem_id.'/'.$value->request_qty.'/'.$value->item) }}"  data-toggle="tooltip" title="Delete!" class="action-icon"> <i class="mdi mdi-delete"></i></a></td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                    @else  @php($display="none")
                                                                                    @endif
                                                                                </tbody>
                                                                            </table>

                                                                        </div> <!-- end preview-->
                                                                        <input type="hidden" class="form-control" name="requestcode"  readonly value="{{ $code }}">

                                                                        <div class="text-sm-end mt-3">
                                                                        <button onclick="return confirm('Are you sure you want to delete the entire request with its details?');" type="submit" id="cancelbtn"  data-toggle="tooltip" title="Delete request!" class="btn btn-danger mb-2 me-1 text-sm-end"> <i class="mdi mdi-cancel"> Cancel request</i></button>
                                                                        </div>
                                                                    </div> <!-- end tab-content-->
                                                                 </form>
                                                                </div> <!-- end card body-->
                                                            </div> <!-- end card -->
                                                          </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="third">
                                                        <form id="otherForm" method="post" action="#" class="form-horizontal"></form>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="text-center">
                                                                        <h2 class="mt-0">
                                                                            <i class="mdi mdi-check-all"></i>
                                                                        </h2>

                                                            <div class="row justify-content-center">
                                                                <div class="col-lg-7 col-md-10 col-sm-11">

                                                                    <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                                                                        <div class="horizontal-steps-content">
                                                                            <div class="step-item current">
                                                                                <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/09/2021 07:24 PM">Placed order</span>
                                                                            </div>
                                                                            <div class="step-item">
                                                                                <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="21/09/2021 11:32 AM">Request Approved</span>
                                                                            </div>
                                                                            <div class="step-item">
                                                                                <span>Confirm request</span>
                                                                            </div>

                                                                        </div>

                                                                        <div class="process-line" style="width: 33%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                        <!-- end row -->
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h4 class="header-title mb-3">Items from Order #{{$code}}</h4>

                                                                            <div class="table-responsive">
                                                                                <table class="table mb-0">
                                                                                    <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>No.</th>
                                                                                        <th>Item name</th>
                                                                                        <th>Description</th>
                                                                                        <th>UOM</th>
                                                                                        <th>Quantity</th>
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
                                                                                            <td>{{ $value->uom_name}} </td>
                                                                                            <td>{{ $value->request_qty}} <input type="hidden" name="count" value="{{$value->request_qty}}"></td>
                                                                                        </tr>
                                                                                        @endforeach
                                                                                        @endif
                                                                                    </tbody>
                                                                                </table>
                                                                                <p class="text-end mt-2">Total items: <strong><span id="totalcount"></span></strong></p>
                                                                            </div>
                                                                            <!-- end table-responsive -->

                                                                        </div>
                                                                    </div>
                                                                </div> <!-- end col -->

                                                                <div class="col-lg-4">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h4 class="header-title mb-3">Requester Summary</h4>

                                                                            <div class="table-responsive">
                                                                                <table class="table mb-0">
                                                                                    @foreach($requesters as $requester)
                                                                                    <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Department</th>
                                                                                        <th>{{$requester->dname}}</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Request type :</th>
                                                                                        <td>{{ $requester->type}}</td>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                    <tr>
                                                                                        <th>To be pproved by :</th>
                                                                                        <td>{{ $requester->uname}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Date requested: </th>
                                                                                        <td>{{ $requester->requestdate}}</td>
                                                                                    </tr>

                                                                                    </tbody>
                                                                                    @endforeach
                                                                                    @if(count($borrowers)>0)
                                                                                    @foreach($borrowers as $borrower)
                                                                                    @if($borrower->bdname != ""){
                                                                                    <tr>
                                                                                        <th>Borrower:</th>
                                                                                        <th>{{$borrower->bdname}}</th>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @endforeach
                                                                                    @endif
                                                                                </table>
                                                                            </div>
                                                                            <!-- end table-responsive -->

                                                                        </div>
                                                                    </div>
                                                                </div> <!-- end col -->
                                                            </div>
                        <!-- end row -->
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h4 class="header-title mb-3">Requested by</h4>

                                                                            <h5>{{ Auth::user()->name }}</h5>

                                                                            <address class="mb-0 font-14 address-lg">
                                                                                {{ Auth::user()->email }}<br>

                                                                            </address>

                                                                        </div>
                                                                    </div>
                                                                </div> <!-- end col -->



                                                                <div class="col-lg-6">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h4 class="header-title mb-3">Action</h4>

                                                                            <div class="">
                                                                                <a style="display: {{$display}}" onclick="return confirm('Are you sure you want to confirm this request? No more changes will be made after this action!!');" href="{{ url('inventory/request/confirm/'.$code) }}"  data-toggle="tooltip" title="confirm request!" class="btn btn-info">  Confirm request</i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- end col -->
                                                            </div>
                        <!-- end row -->
                                                                    </div>
                                                                </div>
                                                                <!-- end col -->
                                                            </div>
                                                            <!-- end row -->
                                                        </form>
                                                    </div>

                                                    <ul class="list-inline wizard mb-0">
                                                        <li class="previous list-inline-item"><a href="#" class="btn btn-info">Previous</a>
                                                        </li>
                                                        <li class="next list-inline-item float-end"><a href="#" style="display: {{$display}}" id="nxtbtn" class="btn btn-info">Next</a></li>
                                                    </ul>

                                                </div> <!-- tab-content -->
                                            </div> <!-- end #rootwizard-->
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->
                    <script src="{{url('assets/js/pages/demo.form-wizard.js')}}"></script>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
            <script type="text/javascript">

                window.sumInputs = function() {
                    var inputs = document.getElementsByName('count'),

                        sum = 0;

                    for(var i=0; i<inputs.length; i++) {
                        var ip = inputs[i];

                        if (ip.name && ip.name.indexOf("total") < 0) {
                            sum += parseFloat(ip.value) || 0;
                        }

                    }


                    var ked = sum;
                  var num = ked.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                document.getElementById('totalcount').innerHTML = num;
                // document.getElementById('stktotalamt').value = sum;
                }
                sumInputs();
                if (sum==0) {
                    document.getElementById("nxtbtn").setAttribute("disabled", "disabled");
                    document.getElementById("cancelbtn").setAttribute("disabled", "disabled");
                } else {
                    document.getElementById("nxtbtn").disabled = false;
                    document.getElementById("cancelbtn").disabled = false;
                }



                </script>
                <script>

                    function validateForm() {
                    var x = document.forms["myForm"]["request_qty"].value-0;
                    var y = document.forms["myForm"]["qtyleft"].value-0;
                    var stm = 'Quantity on hand is: ' +y+ ' and  quantity required is: ' +x;
                  if (x > y) {

                    swal('Warning','Stock Quantity missing, ' + stm + '!', 'error');
                    return false;
                  }
                  else if (y > x) {
                    return true;
                  }

                    else if (x === y){

                    swal('Warning', 'No more stock quantity will left for this item!', 'warning');
                    return true;
                  }

                  else if (z =="") {
                   swal('Error', 'Values null!', 'warning');
                    return false;
                  }

                }
                </script>
            @endsection



        <!-- demo app -->

        <!-- end demo js-->
