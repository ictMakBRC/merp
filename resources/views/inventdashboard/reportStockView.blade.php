
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'view request')
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
                                            <li class="breadcrumb-item"><a href="{{asset('inventory/requests')}}">Reports</a></li>
                                            <li class="breadcrumb-item active">Stock Reports</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Stock Level Report</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end quote -->



                        <div class="row">


                            <div class="col-xl-12">
                                <div class="">
                                                <div class="card-body">
                                                <div class="row">
                                                <div class="col-12 mb-4">
                                                <div class="text-center">

                                                    <img src="{{asset('assets/images/makbrcheader.png')}}" alt="" width="80%">
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
                                                <i class="fas fa-globe"></i> MERP INVENTORY STOCK STATUS REPORT <br>
                                                @if($dpt != 'All'){
                                                   {{$dpt}}
                                                }
                                                @endif

                                                </h2>
                                                </div>
                                                <!-- /.col -->
                                                </div>
                                                <!-- info row -->
                                                <div class="row invoice-info">
                                                <div class="col-sm-4 invoice-col">
                                                <address>
                                                <strong>Department: </strong>{{$dpt}}<br>
                                                </address>
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4 invoice-col">
                                                    <address>
                                                    <strong>Sub Units: </strong>{{$sub}}<br>
                                                    </address>
                                                    </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4 invoice-col">
                                                    <address>
                                                    <strong>Items: </strong>{{$item}}<br>
                                                    </address>
                                                    </div>
                                                <!-- /.col -->
                                                </div>
                                                <!-- /.row -->

                                                <!-- Table row -->
                                                <div class="row">
                                                <h4 class="header-title text-center mb-3">Items</h4>
                                                <div class="col-12 table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Item name</th>
                                                            <th class="{{$disp}}">Department</th>
                                                            <th class="{{$subDis}}">Sub Department</th>
                                                            <th>Description</th>
                                                            <th >UOM</th>
                                                            <th class="text-end">Quantity Available</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($values)>0)
                                                        @php($i=1)
                                                        @foreach($values as $value)
                                                        <tr>
                                                            <td>{{$i++}}</td>
                                                            <td>{{$value->item_name}}</td>
                                                            <td class="{{$disp}}">{{ $value->name}}</td>
                                                            <td class="{{$subDis}}">{{ $value->subunit_name}}</td>
                                                            <td>{{ $value->description}}</td>
                                                            <td>{{ $value->uom_name}}</td>
                                                            <td class="text-end">{{ $value->qty_left}}</td>

                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>

                                                </table>

                                                </div>
                                                <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                                <div class="row">
                                                <!-- accepted payments column -->
                                                <div class="col-4">
                                                <p >Processed by: <strong>{{auth()->user()->name}}</strong></p>
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-4">
                                                <p >Date processed: <strong>{{date('Y-m-d')}}</strong></p>

                                                </div>
                                                <div class="col-2">
                                                <button onclick="window.print();"  class="btn btn-default"><i class="mdi mdi-printer-check"></i> Print</button>

                                                </div>

                                                <!-- /.col -->
                                                </div>

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

            @endsection



        <!-- demo app -->

        <!-- end demo js-->
