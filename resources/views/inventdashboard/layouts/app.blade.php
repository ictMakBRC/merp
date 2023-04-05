<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <base href="{{ \URL::to('/')}}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

        <!-- third party css -->
        <link href="{{ asset('assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- third party css end -->
        <link href="{{ asset('assets/js/izitoast/css/iziToast.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">
        @livewireStyles
        @powerGridStyles
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
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
                    <!-- Start Content-->
                    <main>
                        @include("inventdashboard.inc.messages")
                        {{ $slot }}
                    </main>
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


        <!-- Right Sidebar -->


        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/js/sort.js') }}"></script>
        <script src="{{ asset('assets/js/izitoast/js/iziToast.min.js') }}"></script>
        <!-- third party js -->
        <script src="{{ asset('assets/js/sweetalert/sweetalert.min.js')}}"></script>
        
        <script type="text/javascript">
           $(document).ready(function() {
                $('.myselect').select2();
            });
            </script>
        <!-- third party js ends -->
        <script>
            $(function () {
              $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    
              $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
              });
            });
        </script>
          <script>
            window.addEventListener('alert', event => {
    
                if (event.detail.type == 'success') {
                    iziToast.success({
                        title: 'Success!',
                        message: `${event.detail.message}`,
                        timeout: 5000,
                        position: 'topRight'
                    });
                }
    
                if (event.detail.type == 'Error') {
                    iziToast.error({
                        title: 'Error!',
                        message: `${event.detail.message}`,
                        timeout: 5000,
                        position: 'topRight'
                    });
                }
    
                if (event.detail.type == 'warning') {
                    iziToast.warning({
                        title: 'Warning!',
                        message: `${event.detail.message}`,
                        timeout: 5000,
                        position: 'topRight'
                    });
                }
            });
    
            window.addEventListener('maximum-reached', event => {
                if (event.detail.type == 'warning') {
                    swal('Warning', `${event.detail.message}`, 'warning');
                }
            });
    
            window.addEventListener('cant-delete', event => {
                if (event.detail.type == 'warning') {
                    swal('Warning', `${event.detail.message}`, 'warning');
                }
            });
    
            window.addEventListener('mismatch', event => {
                if (event.detail.type == 'error') {
                    swal('Error', `${event.detail.message}`, 'error');
                }
            });
            
            window.addEventListener('not-found', event => {
                if (event.detail.type == 'error') {
                    swal('Not Found', `${event.detail.message}`, 'error');
                }
            });
            
            window.addEventListener('current-password-mismatch', event => {
                if (event.detail.type == 'error') {
                    swal('Error', `${event.detail.message}`, 'error');
                }
            });
    
            window.addEventListener('switch-theme', event => {
                $("html").attr("class", `${event.detail.theme}`)
            });
        </script>
        <script>
  
            window.addEventListener('swal:modal', event => { 
                swal({
                  title: event.detail.message,
                  text: event.detail.text,
                  icon: event.detail.type,
                });
            });
              
            window.addEventListener('swal:confirm', event => { 
                swal({
                  title: event.detail.message,
                  text: event.detail.text,
                  icon: event.detail.type,
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    window.livewire.emit('remove');
                  }
                  else{
                        window.livewire.emit('cancel');
                }
                });
            });

           
        </script>
        @stack('scripts')
        @livewireScripts
        @powerGridScripts
        <!-- demo app -->
        <script src="{{ asset('assets/js/pages/demo.dashboard-analytics.js') }}"></script>
        <!-- end demo js-->
    </body>

</html

