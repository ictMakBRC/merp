
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'Stock documents')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="{{url('inventory/stockLevels')}}">Stock</a></li>
                          <li class="breadcrumb-item active">Stock documents</li>

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

                        </div>
                    </div><!-- end col-->
                </div>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Created By</th>
                                    <th>Stock code</th>
                                    <th>No. of items</th>
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
                                    <td>{{$value->name}}</td>
                                    <td>{{ $value->stock_code}}</td>
                                    <td>{{ $value->totalAmt}}</td>
                                    <td>{{ $value->date_added}}</td>
                                    <td>
                                        <a style="{{$delete}}" onclick="return confirm('Are you sure you want to delete?');" href="{{ url('inventory/delete-stock/'.$value->stock_code) }}"  data-toggle="tooltip" title="Delete!" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        <a style="{{$edit}}" href="{{ url('inventory/receiveStock/'.$value->stock_code) }}"  data-toggle="tooltip" title="Edit!" class="action-icon"> <i class="uil-edit"></i></a>
                                        <a style="{{$view}}" href="{{ url('inventory/view-stock/'.$value->stock_code) }}"  data-toggle="tooltip" title="View!" class="action-icon"> <i class="mdi mdi-eye"></i></a>

                                    </td>
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
