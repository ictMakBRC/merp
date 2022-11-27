
@extends('inventdashboard.layouts.formLayout')
@section('title', 'New stock')
@section('content')
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->


                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{asset('inventory/')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{asset('inventory/requests')}}">Department</a></li>
                                            <li class="breadcrumb-item active">Stock details</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Check Stock</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">


                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title mb-3">Manage</h4>
                                        <div id="progressbarwizard">
                                            <div id="rootwizard">
                                                <ul class="nav nav-pills nav-justified form-wizard-header mb-3">                                                   
                                                    <li class="nav-item" data-target-form="#otherForm">
                                                        <a disabled data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                                            <span class=" d-sm-inline">Select A Department</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content mb-0 b-0">

                                                    <div class="tab-pane show active" id="first">

                                                        <form method="POST" class="form-horizontal" action="{{ url('inventory/manage/find')}}">
                                                                @csrf
                                                            <div class="row">
                                                                <div class="col-12">                                                                   
                                                                    <div class="row mb-3">
                                                                        <label class="col-md-3 col-form-label" for="password3">Deparment/Project/Category</label>
                                                                        <div class="col-md-7">
                                                                            <select id="unit" class="form-control myselect" name="department_id" required>
                                                                                <option value="" selected disabled>Select Category</option>

                                                                                @foreach($units as $unit)
                                                                                <option value="{{ $unit->id }}">{{$unit->department_name}}</option>
                                                                            @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <button type="submit" class="btn btn-success">Check</button>
                                                                        </div>
                                                                    </div>                                  </div> <!-- end col -->
                                                            </div> <!-- end row -->          
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
