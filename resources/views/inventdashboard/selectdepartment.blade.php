
@extends('inventdashboard.layouts.formLayout')
@section('title', 'New stock')
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
                                            <li class="breadcrumb-item active">Request details</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Requester details</h4>
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
                                                            <span class="d-none d-sm-inline">Rquester Details</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" data-target-form="#profileForm">
                                                        <a disabled data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-face-profile me-1"></i>
                                                            <span class="d-none d-sm-inline">Request details</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" data-target-form="#otherForm">
                                                        <a disabled data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                                            <span class="d-none d-sm-inline">Finish</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content mb-0 b-0">

                                                    <div class="tab-pane" id="first">

                                                            <form method="POST" class="form-horizontal" action="{{ url('inventory/request/details')}}">
                                                                @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="userName3">Requester name</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control" id="userName3" readonly name="userName3" value="{{ Auth::user()->name }}" required="">
                                                                            <input type="hidden" class="form-control" id="userId" readonly name="user_id" value="{{ Auth::user()->id }}" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="password3">Deparment/Project/Category</label>
                                                                        <div class="col-md-9">
                                                                            <select id="unit" class="form-control myselect" name="department_id" required>
                                                                                <option value="" selected disabled>Select Category</option>

                                                                                @foreach($units as $unit)
                                                                                <option value="{{ $unit->id }}">{{ $unit->department_name}}</option>
                                                                            @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="approver"  class="col-md-3 col-form-label">Approver</label>
                                                                        <div class="col-md-9">
                                                                        <select name="approver_id" id="approver" required class="form-control myselect"></select>
                                                                        </div>
                                                                    </div>

                                                                         <script>
                                                $(document).ready(function(){
                                                $('#unit').change(function() {

                                                    var unitID = $(this).val();

                                                    if (unitID) {

                                                        $.ajax({
                                                            type: "GET",
                                                            url: "{{ url('inventory/getApprover') }}?unit_id=" + unitID,
                                                            success: function(res) {

                                                                if (res) {

                                                                    $("#approver").empty();
                                                                    $("#approver").append('<option value="">Select approver</option>');
                                                                    $.each(res, function(key, value) {
                                                                        $("#approver").append('<option value="' + key + '">' + value +
                                                                            '</option>');
                                                                    });

                                                                } else {

                                                                    $("#approver").empty();
                                                                }
                                                            }
                                                        });
                                                    } else {

                                                        $("#approver").empty();

                                                    }
                                                });
                                            });
                                            </script>
<input type="hidden" value="R{{mt_rand(1000, 9999).time()}}" name="request_code">
{{--
                                                                    <div class="row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="confirm3">Request type</label>
                                                                        <div class="col-md-9">
                                                                            <select class="form-control" name="requesttype" required>
                                                                                <option value="Internal" selected >Internal</option>
                                                                                <option value="External" >External</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> --}}
                                                                </div> <!-- end col -->
                                                            </div> <!-- end row -->
                                                            <ul class="list-inline wizard mb-0">

                                                                <li class="list-inline-item float-end"><button type="submit" class="btn btn-info">Next</button></li>
                                                            </ul>
                                                        </form>
                                                    </div>







                                                </div> <!-- tab-content -->
                                            </div> <!-- end #rootwizard-->
                                        </div>

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
            @endsection



        <!-- demo app -->

        <!-- end demo js-->
