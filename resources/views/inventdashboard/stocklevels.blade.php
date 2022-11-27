
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'Items')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="{{url('inventory/Items')}}">Items</a></li>
                          <li class="breadcrumb-item active">Stock levels</li>

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
                    <div class="col-sm-4">
                        <div class="text-sm-end mt-3">
                           <h4 class="header-title mb-3  text-center"> Stock levels</h4>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        
                        <div class="text-sm-end mt-3">

                            @role('InvAdmin')
                            <div class="dropdown btn-group">
                                <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Stock Documents
                                </button>

                                <div class="dropdown-menu dropdown-menu-animated">
                                    <a  href="{{url('inventory/receiveStock/S'.mt_rand(1000, 9999).time())}}"  class="dropdown-item">New stock</a>
                                    <a class="dropdown-item" href="{{url('inventory/confirmedStock')}}">Confirmed stock</a>
                                    <a class="dropdown-item" href="{{url('inventory/unconfirmedStock')}}">Unconfirmed stock</a>
                                </div>
                            </div>
                            @endrole
                            @role('InvUser')
                            @if (session()->has('department')) 
                            <a class="btn btn-info" href="{{url('inventory/manage/stockHistory')}}">Stock History</a>
                            @endif
                            @endrole

                        </div>
                    </div><!-- end col-->
                </div>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="scroll-horizontal-datatable" class="table w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Item name</th>
                                    <th>Brand</th>
                                    <th>Belongs to</th>
                                    <th>Category</th>
                                    <th>UOM</th>
                                    <th>Quantity left</th>
                                    <th>Qty Borrowed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($values)>0)
                                @php($i=1)
                                @foreach($values as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->item_name}}</td>
                                    <td>{{$value->brand}}</td>
                                    <td>{{ $value->department_name}}</td>
                                    <td>{{ $value->subunit_name}}</td>
                                    <td>{{ $value->uom_name}}</td>
                                    <td class="text-end">{{ $value->qty_left}}</td>
                                    <td class="text-end">{{ $value->qty_held}}</td>                                
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- end preview-->


                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
