
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'Department users')
@section('content')
 <!-- Start Content-->
 <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Departments</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
                <h4 class="page-title">Projects Calendar</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- start projects-->
                <div class="col-xxl-3 col-lg-4">
                    <div class="pe-xl-3">
                        <h5 class="mt-0 mb-3">All Departments</h5>
                        <!-- start search box -->
                        <div class="app-search">
                            <form>
                                <div class="mb-2 position-relative">
                                    <input type="text" class="form-control" placeholder="search by name...">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                </div>
                            </form>
                        </div>
                        <!-- end search box -->

                        <div class="row">
                            <div class="col">
                                <div data-simplebar="" style="max-height: 535px;">
                                 @if(count($departments)>0)
                                    @foreach($departments as $valueUnite)

                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="d-flex mt-1 px-2 py-2">
                                            <div class="avatar-sm d-table">
                                                <span class="avatar-title bg-info-lighten rounded-circle text-danger">
                                                    <i class='uil uil-gold font-24'></i>
                                                </span>
                                            </div>
                                            <div class="ms-2">
                                                <h5 class="mt-0 mb-0">
                                                    {{$valueUnite->name}}
                                                    <span class="badge badge-danger-lighten ms-1">Active</span>
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted">
                                                    ID: {{$valueUnite->id}}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end projects -->

                <!-- gantt view -->
                <div class="col-xxl-9 mt-4 mt-xl-0 col-lg-8">
                    <div class="ps-xl-3">
                        <div class="row">
                            <div class="col text-sm-end">
                                <a href="javascript: void(0);"  data-bs-toggle="modal" data-bs-target="#newPair" class="btn btn-success btn-sm mb-2">Add Department User</a>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col mt-3">
                                <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>User</th>
                                            <th>Department</th>
                                            <th>Role</th>
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
                                            <td>{{$value->uname}}</td>
                                            <td>{{ $value->dname}}</td>
                                            <td>@if($value->role==1)
                                                Requester
                                                @php($satate='Active')
                                                @elseif($value->role==2)
                                                Approver
                                                @php($satate='InActive')
                                                @endif
                                            </td>
                                            <td>{{ $value->created_at}}</td>
                                            <td>
                                                <a  onclick="return confirm('Are you sure you want to delete?');" href="{{ url('inventory/delete-stock/'.$value->duser_id) }}"  data-toggle="tooltip" title="Delete!" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                <a  href="{{ url('inventory/receiveStock/'.$value->duser_id) }}"  data-toggle="tooltip" title="Edit!" class="action-icon"> <i class="uil-edit"></i></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end gantt view -->
            </div>
        </div>
    </div>

</div> <!-- container -->
 <!-- ADD NEW Category Modal -->
 <div class="modal fade" id="newPair" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New department user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form action="{{ url('inventory/addDepartmentUsers') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <select class="form-control select2"  name="department_id" required>
                                    <option value="">Select a Department</option>
                                    @if(count($departments)>0)
                                @foreach($departments as $valueUnit)
                                    <option value="{{ $valueUnit->id }}">{{ $valueUnit->department_name}}</option>
                                @endforeach
                                @endif

                                  </select>
                            </div>

                            <div class="mb-3">
                                <select class="form-control select2"  name="user_id" required>
                                    <option value="">Select a User</option>
                                    @if(count($users)>0)
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name}}</option>
                                @endforeach
                                @endif

                                  </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control select2"  name="role" required>
                                    <option value="">Select a role</option>
                                    <option value="1">Requester</option>
                                    <option value="2">Approver</option>
                                  </select>
                            </div>


                        </div> <!-- end col -->

                    </div>
                    <!-- end row-->
                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>

                </form>

            </div>

        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
@endsection
