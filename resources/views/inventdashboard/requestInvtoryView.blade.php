
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'view request| Pending')
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
                                        <h4 class="page-title">Request</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end quote -->



                            <div class="row">
                            <form method="POST" action="{{ url('inventory/request/updateInventoryRequest') }}">
                                    @csrf

                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
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
                                                                <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="21/09/2021 11:32 AM">Approve request</span>
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
                                                                        <th>Qty Requested</th>
                                                                        <th>Qty given</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if(count($values)>0)
                                                                        @php($i=1)
                                                                        @foreach($values as $value)
                                                                        <tr>
                                                                            <td>{{$i++}}</td>
                                                                            <td>{{$value->item_name}}<input type="hidden" name="item[]" value="{{$value->item}}"><input type="hidden" name="invitem[]" value="{{$value->invItem}}"></td>
                                                                            <td>{{ $value->description}}</td>
                                                                            <td>{{ $value->uom_name}} <input type="hidden" name="borrower_id[]" value="{{$value->borrower}}"></td>
                                                                            <td>{{ $value->request_qty}} <input type="hidden" name="count" value="{{$value->request_qty}}"></td>
                                                                            <td> <input class="inputedit" type="number" min="1"  required name="quantity[]" min="1" max="{{$value->request_qty}}" value="{{$value->request_qty}}"></td>
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

                                                                    <tr>
                                                                        <th>Department</th>
                                                                        <th>{{$requester->dname}}</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Date Submitted: </th>
                                                                        <td>{{ $requester->requestdate}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Request type :</td>
                                                                        <td>{{ $requester->type}}</td>
                                                                        <input type="hidden" value="{{ $requester->type}}" id="request_type" required name="request_type">
                                                                    </tr>

                                                                    <tbody>

                                                                    <tr>
                                                                        <th>To be pproved by :</th>
                                                                        <td>{{ $requester->uname}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @foreach($requestby as $reqby)

                                                                    <tr>
                                                                        <th>Requested by: </th>
                                                                        <td>{{ $reqby->name}}</td>
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
                                                            <h4 class="header-title mb-3">Your Details Details</h4>

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
                                                                <input type="hidden" readonly name="isactive" id="isactive">
                                                                <input type="hidden" readonly name="itemstate" id="itemstate">
                                                                <input type="hidden" name="code" readonly value="{{$code}}" >
                                                            <div class="wrapperb">
                                                                <input type="radio" name="approve" value="Approved" id="option-1" required onchange="mycomment()">
                                                                <input type="radio" name="approve" value="rejected" id="option-2" required onchange="mycomment()">
                                                                <label for="option-1" class="option option-1">
                                                                    <div class="dot"></div>
                                                                    <span>Approve</span>
                                                                    </label>
                                                                <label for="option-2" class="option option-2">
                                                                    <div class="dot"></div>
                                                                    <span>Reject</span>
                                                                </label>
                                                            </div>
                                                            <div style="display: none" id="comdiv" class="form-floating mt-3">
                                                                <textarea class="form-control" name="comments" id="comments" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                                                                <label for="floatingTextarea">Comments</label>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary mt-3">Save</button>

                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                            <style>
                                                    .wrapperb{
                                                display: inline-flex;
                                                background: #fff;
                                                height: 100px;
                                                width: 400px;
                                                align-items: center;
                                                justify-content: space-evenly;
                                                border-radius: 5px;
                                                padding: 20px 15px;
                                                box-shadow: 5px 5px 30px rgba(0,0,0,0.2);

                                                }
                                                .wrapperb .option{
                                                background: #fff;
                                                height: 100%;
                                                width: 100%;
                                                display: flex;
                                                align-items: center;
                                                justify-content: space-evenly;
                                                margin: 0 10px;
                                                border-radius: 5px;
                                                cursor: pointer;
                                                padding: 0 10px;
                                                border: 2px solid lightgrey;
                                                transition: all 0.3s ease;
                                                }
                                                .wrapperb .option .dot{
                                                height: 20px;
                                                width: 20px;
                                                background: #d9d9d9;
                                                border-radius: 50%;
                                                position: relative;
                                                }
                                                .wrapperb .option .dot::before{
                                                position: absolute;
                                                content: "";
                                                top: 4px;
                                                left: 4px;
                                                width: 12px;
                                                height: 12px;
                                                background: #0069d9;
                                                border-radius: 50%;
                                                opacity: 0;
                                                transform: scale(1.5);
                                                transition: all 0.3s ease;
                                                }
                                                input[type="radio"]{
                                                display: none;
                                                }
                                                #option-1:checked:checked ~ .option-1{
                                                border-color: #0069d9;
                                                background: #02ad44;
                                                }

                                                #option-2:checked:checked ~ .option-2{
                                                border-color: #0069d9;
                                                background: #d90016;
                                                }
                                                #option-1:checked:checked ~ .option-1 .dot,
                                                #option-2:checked:checked ~ .option-2 .dot{
                                                background: #fff;
                                                }
                                                #option-1:checked:checked ~ .option-1 .dot::before,
                                                #option-2:checked:checked ~ .option-2 .dot::before{
                                                opacity: 1;
                                                transform: scale(1);
                                                }
                                                .wrapperb .option span{
                                                font-size: 20px;
                                                color: #808080;
                                                }
                                                #option-1:checked:checked ~ .option-1 span,
                                                #option-2:checked:checked ~ .option-2 span{
                                                color: #fff;

                                                }
                                                .inputedit {
                                                border: 1px solid;
                                                border-radius: 12px;
                                                border-color: rgb(236, 255, 245);
                                                font-size: 1rem;
                                                margin: 0.25rem;
                                                max-width: 83px;
                                                padding: 0.2rem;
                                                transition: background-color 0.5s ease-out;
                                                }
                                            </style>
                                            <script type="text/javascript">
                                                function mycomment()
                                                {
                                                //   var x = document.getElementById('option-2');
                                                //   var x = document.getElementById('option-1');
                                                if(document.getElementById('option-2').checked)
                                                {
                                                document.getElementById('comdiv').style.display='block';
                                                document.getElementById("comments").setAttribute("required", "required");
                                                document.getElementById('comments').value="";
                                                document.getElementById('isactive').value="0";
                                                document.getElementById('itemstate').value="open";
                                                }
                                                else
                                                {
                                                document.getElementById('comdiv').style.display='none';
                                                document.getElementById("comments").removeAttribute("required");
                                                document.getElementById('comments').value="Confirmed stock out";
                                                document.getElementById('itemstate').value="closed";
                                                document.getElementById('isactive').value="1";
                                                }
                                                }
                                            </script>

                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end col -->
                                                                                </div>
                                                                                <!-- end row -->

                                                                    </div> <!-- tab-content -->

                                                                </div> <!-- end #rootwizard-->
                                                            </div>

                                                        </div> <!-- end card-body -->
                                                    </div> <!-- end card-->
                                                </div> <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                        </div>
                                        </div> <!-- container -->


                                        </div>
                        </form>
                            </div>

                    </div>
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
            @endsection



        <!-- demo app -->

        <!-- end demo js-->
