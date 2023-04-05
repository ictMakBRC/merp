<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home | MERP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="An enterprise resource planning application For MakBRC" name="description">
    <meta content="MERP" name="MAKBRC">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/'.$facilityInfo->logo) }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="loading d-flex flex-column min-vh-100" data-layout-config='{"darkMode":{!! Auth::user()->color_scheme === 'true' ? Auth::user()->color_scheme : 'false' !!}}'>
    {{-- <body class="loading" data-layout-config='{"leftSideBarTheme":"{!! Auth::user()->left_sidebar_theme ? Auth::user()->left_sidebar_theme : 'light' !!}","layoutBoxed":false, "leftSidebarCondensed":{!!Auth::user()->left_sidebar_compact === 'condensed' ? 'true' : 'false' !!}, "leftSidebarScrollable":{!! Auth::user()->left_sidebar_compact === 'scrollable' ? 'true' : 'false' !!},"darkMode":{!! Auth::user()->color_scheme === 'true' ? Auth::user()->color_scheme : 'false' !!}, "showRightSidebarOnStart": true}'> --}}
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg py-lg-3 navbar-light">
        <div class="container border-bottom border-primary">

            <!-- logo -->
            <a href="index.html" class="navbar-brand me-lg-5">
                <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" class="logo-dark" height="18">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- menus -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <!-- left menu -->
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link active" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    @if (Auth::user()->hasRole(['SuperAdmin']))
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link" href="{{ route('password.confirm') }}">Manage</a>
                        {{-- <a class="nav-link" href="{{route('laratrust.roles-assignment.index')}}">Manage</a> --}}
                    </li>
                    @endif
                   
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link" href="{{ route('user.account') }}">My Account</a>
                    </li>
                </ul>

                <!-- right menu -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" target="_blank" class="av-link d-lg-none"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                <i class="uil-sign-out-alt me-2"></i> {{ __('Logout') }}
                            </a>
                        </form>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" target="_blank"
                                class="btn btn-sm btn-light btn-rounded d-none d-lg-inline-flex"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                <i class="uil-sign-out-alt me-2"></i> {{ __('Logout') }}
                            </a>
                        </form>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    @include('layouts.messages')

    <!-- START SERVICES -->
    <section class="py-2 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-primary">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/hr.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">Human Resource</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Recruitment, Compensation and Employee relations.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50" style="margin-top: 5px;">
                                                    <a href="{{ route('humanresource.dashboard') }}"
                                                    class="btn btn-sm btn-light btn-rounded" >
                                                    <i class="mdi dripicons-enter me-1"></i> Proceed Here..</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->
                
                
                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-warning">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/assets.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">Assets Management</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Identification, Acquisition, Maintenance and Disposal.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50" style="margin-top: 5px;">
                                                    {{-- <a href="#"
                                                    class="btn btn-sm btn-light btn-rounded not_activ" >
                                                    <i class="mdi dripicons-enter me-1"></i> Proceed Here..</a> --}}
                                                    <a href="{{ route('asset.index') }}"
                                                    class="btn btn-sm btn-light btn-rounded" >
                                                    <i class="mdi dripicons-enter me-1"></i> Proceed Here..</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->

                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-danger">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/inventory.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">Inventory & Logistics</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Forecasting, Acquisition, Consumption, and Tracking.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50"  style="margin-top: 5px;">
                                                    <a href="#"
                                                    class="btn btn-sm btn-light btn-rounded not_active" >
                                                    <i class="mdi dripicons-enter me-1"></i> Proceed Here..</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->
            </div> <!-- end row-->

            

            <div class="row">
                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-dark">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/finance.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">Finance & Accounting</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Budgeting, Accounting, Invoicing, and Requisition.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50" style="margin-top: 5px;">
                                                    <button type="button" class="btn btn-sm btn-light btn-rounded">
                                                        <i class="mdi dripicons-enter me-1"></i> Proceed Here..
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->
                
                
                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-success">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/procurement.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">Procurement</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Planning, Identification, Selection, and Aquisition.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50"  style="margin-top: 5px;">
                                                    <button type="button" class="btn btn-sm btn-light btn-rounded">
                                                        <i class="mdi dripicons-enter me-1"></i> Proceed Here..
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->

                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-info">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/documents.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">Document Control</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Reports, SoPs, Policies, Notices, and Templates.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50"  style="margin-top: 5px;">
                                                    <button type="button" class="btn btn-sm btn-light btn-rounded">
                                                        <i class="mdi dripicons-enter me-1"></i> Proceed Here..
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->
            </div> <!-- end row-->

            <div class="row">
                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-info">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/timesheets.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">Staff Timesheets</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Track employee work hours, leaves, and accruals.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50"  style="margin-top: 5px;">
                                                    <button type="button" class="btn btn-sm btn-light btn-rounded">
                                                        <i class="mdi dripicons-enter me-1"></i> Proceed Here..
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->
                
                
                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-secondary">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/monitoring.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">Internal Monitoring</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Monitoring and Evaluation, Projects progress tracking.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50" style="margin-top: 5px;">
                                                    <button type="button" class="btn btn-sm btn-light btn-rounded">
                                                        <i class="mdi dripicons-enter me-1"></i> Proceed Here..
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->

                <div class="col-sm-4">
                    <!-- Profile -->
                    <div class="card bg-primary">
                        <div class="card-body profile-user-box" style="padding-top: 3px; padding-bottom: 3px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-lg">
                                                <img src="{{ asset('images/kpi.jpg') }}" alt="" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <h4 class="mt-1 mb-1 text-white">KPI Dashboard</h4>

                                                <ul class="mb-0 list-inline text-light">
                                                    <li class="list-inline-item me-3">
                                                        <!-- <h5 class="mb-1">HRM Module</h5>-->
                                                        <p class="mb-0 font-13 text-white">Tracking KPIs, summaries and aggrigates.</p>
                                                    </li>
                                                </ul>
                                                <p class="font-13 text-white-50" style="margin-top: 5px;">
                                                    <button type="button" class="btn btn-sm btn-light btn-rounded">
                                                        <i class="mdi dripicons-enter me-1"></i> Proceed Here..
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-body/ profile-user-box-->
                    </div><!--end profile/ card -->
                </div> <!-- end col-->
            </div> <!-- end row-->

            {{-- <div class="row">
                <div class="col-lg-4">

                    <div class="text-center p-1">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-users-alt text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">HUMAN RESOURCE MANAGEMENT</h4>
                        <p class="text-muted mt-2 mb-0">Full employee profiling including biodata, payroll details,
                            education/training records, Contract details, performance evaluation, and leave of office
                            among others.
                        </p>
                        <a href="{{ route('humanresource.dashboard') }}"
                            class="btn btn-success mt-4 mb-2 btn-rounded">Continue</a>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="text-center p-1">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-layer-group text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">ASSETS MANAGEMENT</h4>
                        <p class="text-muted mt-2 mb-0">Record and keep track of all valuable organisation’s assets such
                            as computers, servers, laptops, freezers, fridges, benches, laboratory equipment, etc and
                            their respective conditions, maintenance logs and life expectancies.
                        </p>
                        <a href="#" class="btn btn-success mt-4 mb-2 btn-rounded not_active">Continue</a>
                        <!--<a href="{{ route('asset.index') }}" class="btn btn-success mt-4 mb-2 btn-rounded">Continue</a>-->
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="text-center p-1">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil  uil-calculator-alt text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">INVENTORY MANAGEMENT</h4>
                        <p class="text-muted mt-2 mb-0">Organize and maintain the stock of laboratory supplies and
                            materials in the store, maintaining appropriate stock levels allowing users of consumables
                            (labs) to directly make requests to the store managers.
                        </p>
                         <a href="{{route('inventory')}}" class="btn btn-success mt-4 mb-2 btn-rounded">Continue</a>
                        <!--<a class="btn btn-success mt-4 mb-2 btn-rounded">Continue</a>-->
                    </div>
                </div>
            </div> --}}

        </div>

        </div>
    </section>

    <!-- END SERVICES -->

    @include('layouts.footer')

    @if (auth()->user()->declaration != 1)
        <!-- /Declaration Modal -->
        <div id="info-alert-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-information h1 text-info"></i>
                            <h4 class="mt-2">Declaration!</h4>
                            <hr>
                            <p class="mt-3">I <strong
                                    class="text-danger">{{ auth()->user()->employee->fullName }}</strong> hereby state
                                that the information i will be providing to <strong class="text-success">Makerere
                                    University Biomedical Research Center</strong> using this System is truthful and
                                that <strong class="text-success">Makerere University Biomedical Research
                                    Center</strong> reserves the right to check the authenticity of the information
                                provided. <strong class="text-success">Makerere University Biomedical Research
                                    Center</strong> shall not be held liable for any wrong information provided by
                                <strong class="text-danger">{{ auth()->user()->employee->fullName }}</strong> and
                                which is used as such.</p>
                            <form method="POST" action="{{ route('users.update', Auth::id()) }}">
                                @method('PUT')
                                @csrf
                                <input type="number" hidden id="declaration" class="form-control"
                                    name="declaration" value='1' required>
                                <button type="submit" class="btn btn-outline-success mb-2 me-1">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /end of Declaration Modal -->
    @endif


    <!-- bundle -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#info-alert-modal').modal('show');
            $('.not_active').click(function(e) {
                swal('Info', 'Oops! Module not yet active', 'info');
            });

        });
    </script>

</body>

</html>
