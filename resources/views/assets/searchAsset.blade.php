<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    {{-- <title>MERP|| Asset Management</title> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="An enterprise resource planning application For MakBRC" name="description">
    <meta content="MERP" name="MakBRC">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MERP') }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">

</head>

<body class="loading" data-layout="topnav"
    data-layout-config='{"layoutBoxed":false,"darkMode":false,"showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom topnav-navbar">
                    <div class="container-fluid">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                                    id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="account-user-avatar">
                                        <img src="{{ asset('storage/images/profile/' . auth()->user()->avatar) }}"
                                            alt="user-image" class="rounded-circle">
                                    </span>
                                    <span>
                                        <span class="account-user-name">{{ auth()->user()->name }}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                                    aria-labelledby="topbar-userdrop">
                                    <!-- item-->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="dropdown-item notify-item">
                                            <i class="mdi mdi-logout me-1"></i>
                                            <span>Logout</span>
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end Topbar -->
            </div>
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Back to
                                            Dashboard</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card widget-inline">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-sm-12 col-xl-12">
                                        <div class="input-group p-3">
                                            <input type="text" class="form-control" placeholder="Search..."
                                                id="search" name="search">

                                            {{-- <button class="input-group-text  btn-success" type="submit">Search</button> --}}
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                            </div>
                        </div> <!-- end card-box-->
                    </div> <!-- end col-->
                </div>
                <!-- end row-->
                <div class="row">
                    <div class="col-12">
                        <table id="" class="table table-striped table-centered mb-0 w-100 nowrap">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Barcode</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- end col-->
                </div>
            </div>
            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Makerere Biomedical Research Centre
                        </div>

                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
    </div>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- end row-->

    <script>
        $(document).ready(function() {

            fetch_asset_data();

            function fetch_asset_data(query = '') {
                $.ajax({
                    url: "{{ route('asset_search.action') }}",
                    method: 'GET',
                    data: {
                        query: query
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('keyup', '#search', function() {
                var query = $(this).val();
                fetch_asset_data(query);
            });
        });
    </script>
</body>

</html>
