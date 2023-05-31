<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
        <!-- third party css -->
        <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css">
        @include("inventdashboard.layouts.inc.data-table-style")
        <!-- third party css end -->
        @push('styles')
       
        @endpush
        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        @include("inventdashboard.inc.sidebar")
             <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->

                    @include("inventdashboard.inc.topbar")
                    <!-- end Topbar -->
                    @include("inventdashboard.inc.messages")

                    <!-- Start Content-->
                    @yield('content')
                    <!-- container -->


                </div>
                <!-- content -->

                <!-- Footer Start -->
                  @include("inventdashboard.inc.footer")
                <!-- end Footer -->

            </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- bundle -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <!-- third party js -->
    <script src="{{ asset('assets/js/vendor/Chart.bundle.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/js/pages/demo.dashboard-projects.js') }}"></script>
    <!-- end demo js-->
    <!-- third party js -->
    @include("inventdashboard.layouts.inc.data-table-scripts")

    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert.min.js')}}"></script>
   @push('scripts')
       
   @endpush

<script type="text/javascript">
    $(document).ready(function() {
         $('.myselect').select2();
     });
     </script>

    <!-- end demo js-->
</body>
</html>
