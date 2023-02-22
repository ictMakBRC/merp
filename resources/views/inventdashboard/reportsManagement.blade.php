@extends('inventdashboard.layouts.tableLayout')
@section('title', 'Reports')
@section('content')
        <div class="container-fluid">

            <!-- start quote -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{url('inventory/dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>

                            </ol>
                        </div>

                    </div>
                </div>
            </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-4">

                        <ul class="nav nav-pills bg-nav-pills  mb-3 list-group">
                            <li class="nav-item">
                                <a href="#stockstatus" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Stock Status</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#supply" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
                                    <i class="mdi mdi-home-variant d-md-none d-block">Items report</i>
                                    <span class="d-none d-md-block">Items</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#demand" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                    <i class="mdi mdi-account-circle d-md-none d-block">Demand</i>
                                    <span class="d-none d-md-block">Demand</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#unit" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Department/Unit</span>
                                </a>
                            </li>
                        </ul>
                      </div>
                      <div class="col-8">
                        <div class="tab-content" id="nav-tabContent">
                            @include('inventdashboard.reports.stockStatus')
                            {{-- @include('inventdashboard.reports.supplyDemand')
                            @include('inventdashboard.reports.Demand') --}}
                     </div>
                      </div>
                    </div>
                </div>
        </div>
@endsection
