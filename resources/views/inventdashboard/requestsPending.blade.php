
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'Requests')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="{{url('inventory/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Request List</li>

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
My requests

            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">

                         <table class="table table-centered w-100 dt-responsive nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Request code</th>
                                    <th>Type</th>
                                    <th>Department/Project</th>
                                    <th>Approver</th>
                                    <th>State</th>
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
                                    <td>{{$value->request_code}}</td>
                                    <td>{{ $value->request_type}}</td>
                                    <td>{{ $value->dname}}</td>
                                    <td>{{ $value->uname}}</td>
                                    <td>
                                        @if($value->request_state=='Not signed')
                                            <span class="badge badge-info-lighten float-center">Pending</span>
                                            @elseif($value->request_state=='signed')
                                            <span class="badge badge-success-lighten float-center">Approved</span>
                                            @elseif($value->request_state=='Rejected')
                                            <span class="badge badge-danger-lighten float-center">Rejected</span>
                                            @elseif($value->request_state=='Approved')
                                            <span class="badge badge-success-lighten float-center">Processed</span>
                                            @endif

                                    </td>
                                    <td>{{ $value->requestdate}}</td>

                                    <td class="table-action">
                                        <a href="{{ url('inventory/request/view/'.$value->request_code) }}" class="action-icon"> <i class="mdi mdi-eye" ></i></a>
                                        <a style="display: {{$sign}}" href="{{ url('inventory/request/approve/'.$value->request_code) }}" class="action-icon"> <i class="mdi mdi-fingerprint"></i></a>
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
<!-- end row-->

</div> <!-- container -->
@endsection
