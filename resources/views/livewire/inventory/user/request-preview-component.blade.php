<div>
    <div class="container-fluid">

        <!-- start quote -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ asset('inventory/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ asset('inventory/requests') }}">Requests</a></li>
                            <li class="breadcrumb-item active">Request Items</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Request</h4>
                </div>
            </div>
        </div>
        <!-- end quote -->



        <div class="row">


            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="text-center">

                                    <img src="{{ asset('assets/images/makbrcheader.png') }}" alt="" width="80%">
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        <section class="invoice">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="page-header text-center">
                                        <i class="fas fa-globe"></i> MERP INVENTORY REQUEST

                                    </h2>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->

                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    Request From
                                    <address>
                                        <strong class="text-success">{{ $requesters->dname }}</strong><br>
                                        <strong>Date submitted: </strong>{{ $requesters->requestdate }}<br>
                                        <strong>Request type: </strong>{{ $requesters->type }}
                                        @if (count($borrowers) > 0)
                                            @foreach ($borrowers as $borrower)
                                                @if ($borrower->bdname != '')
                                                    (<strong>Borrower: </strong>{{ $borrower->bdname }})
                                                @endif
                                            @endforeach
                                        @endif
                                    </address>
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col text-end">
                                    <b>Request State: </b>
                                    @if ($requesters->state == 'Not signed')
                                        <span class="badge badge-info-lighten float-center">Pending</span>
                                    @elseif($requesters->state == 'signed')
                                        <span class="badge badge-primary-lighten float-center">Approved</span>
                                    @elseif($requesters->state == 'Rejected')
                                        <span class="badge badge-danger-lighten float-center">Rejected</span>
                                    @elseif($requesters->state == 'Approved')
                                        <span class="badge badge-success-lighten float-center">Processed</span>
                                    @endif
                                    <br>
                                    <b>Approved by: </b>{{ $requesters->uname }}<br>
                                    <br>


                                    <b>Requested By: </b>{{ $requestby->name }}<br>

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <h4 class="header-title text-center mb-3">Items from request #{{ $code }}</h4>
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Item name</th>
                                                <th>Description</th>
                                                <th>UOM</th>
                                                <th class="text-end">Quantity Requested</th>
                                                <th class="text-end">Quantity Received</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($values) > 0)
                                                @php($i = 1)
                                                @foreach ($values as $value)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $value->item_name }}</td>
                                                        <td>{{ $value->description }}</td>
                                                        <td>{{ $value->uom_name }} </td>
                                                        <td class="text-end">{{ $value->request_qty }} <input
                                                                type="hidden" name="count"
                                                                value="{{ $value->request_qty }}"></td>
                                                        <td class="text-end">{{ $value->qty_given }} <input type="hidden"
                                                                name="countiveng" value="{{ $value->qty_given }}"></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>
                                    <p class="text-end pr-4">Total items requested: <strong><span
                                                id="totalcount"></span></strong></p>
                                    <p class="text-end">Total items given: <strong><span id="totalgiven"></span></strong>
                                    </p>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            @if (count($inventAdmin) > 0)
                                @foreach ($inventAdmin as $clerk)
                                    @if ($clerk->inventoryclerk_id != '')
                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-md-4">
                                                <p class="lead">Processed by: <strong>{{ $clerk->name }}</strong></p>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-4">
                                                <p class="lead text-small">Date processed:
                                                    <strong>{{ $clerk->date_approved }}</strong></p>

                                            </div>
                                            <div class="col-md-4">
                                                @if ($requesters->state == 'Approved' && $requestby->name == auth()->user()->name && $requesters->acknowledged_by == '')
                                                    <button class="btn btn-default" data-bs-toggle="modal"
                                                        data-bs-target="#acknowledge"><i class="mdi mdi-check"></i>
                                                        Acknowledge</button>
                                                @elseif($requesters->state == 'Approved' && $requesters->acknowledged_by == '')
                                                    <span class="badge badge-warning-lighten float-center">Not
                                                        Acknowledged</span>
                                                @elseif($requesters->state == 'Approved' && $requesters->acknowledged_by != '')
                                                    <span
                                                        class="badge badge-success-lighten float-center">Acknowledged</span>
                                                @endif
                                                <button class="btn btn-default"><i class="mdi mdi-printer-check"></i>
                                                    Print</button>

                                            </div>

                                            <!-- /.col -->
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <!-- /.row -->
                        </section>
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
    </div>
    </div>
    <!-- ADD NEW Category Modal -->
    <div class="modal fade" id="acknowledge" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Acknowledgement:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{ url('inventory/request/acknowledge') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" required value="{{ $code }}" name="code">
                                <div class="mb-3">
                                    <label for="CategoryName" class="form-label"> I {{ $requestby->name }} Agree that i
                                        have Received the following Items below:</label>
                                    @if (count($values) > 0)
                                        @php($i = 1)
                                        @foreach ($values as $value)
                                            <tr>
                                                <td>{{ $i++ }}).</td>
                                                <td class="text-end">{{ $value->qty_given }} </td>
                                                <td>{{ $value->uom_name }} </td>
                                                <td>of {{ $value->item_name }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                                                    <textarea name="approve" id="" class="form-control d-none" readonly>@php($i = 1)@foreach ($values as $value)
                                {{ $i++ }}) {{ $value->qty_given }}({{ $value->uom_name }}) {{ $value->item_name }}(s)
                                @endforeach
                                </textarea>
                                </div>

                            </div> <!-- end col -->

                        </div>
                        <!-- end row-->
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit">Agree</button>
                        </div>

                    </form>

                </div>

            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
    <script type="text/javascript">
        window.sumInputs = function() {
            var inputs = document.getElementsByName('count'),

                sum = 0;

            for (var i = 0; i < inputs.length; i++) {
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
        if (sum == 0) {
            document.getElementById("nxtbtn").setAttribute("disabled", "disabled");
            document.getElementById("cancelbtn").setAttribute("disabled", "disabled");
        } else {
            document.getElementById("nxtbtn").disabled = false;
            document.getElementById("cancelbtn").disabled = false;
        }
    </script>

    <script type="text/javascript">
        window.sumInputs2 = function() {
            var inputs = document.getElementsByName('countiveng'),

                sum = 0;

            for (var i = 0; i < inputs.length; i++) {
                var ip = inputs[i];

                if (ip.name && ip.name.indexOf("total") < 0) {
                    sum += parseFloat(ip.value) || 0;
                }

            }


            var ked = sum;
            var num = ked.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            document.getElementById('totalgiven').innerHTML = num;
            // document.getElementById('stktotalamt').value = sum;
        }
        sumInputs2();
    </script>
</div>
