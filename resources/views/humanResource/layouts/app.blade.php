<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="An enterprise resource planning application For MakBRC" name="description">
    <meta content="MERP" name="MakBRC">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MERP') }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/' . $facilityInfo->logo) }}">
    <!-- third party css -->
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/vendor/buttons.bootstrap5.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/vendor/select.bootstrap5.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/izitoast/css/iziToast.min.css') }}" rel="stylesheet" type="text/css">
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">
    @livewireStyles
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"{!! Auth::user()->left_sidebar_theme ? Auth::user()->left_sidebar_theme : 'light' !!}","layoutBoxed":false, "leftSidebarCondensed":{!! Auth::user()->left_sidebar_compact === 'condensed' ? 'true' : 'false' !!}, "leftSidebarScrollable":{!! Auth::user()->left_sidebar_compact === 'scrollable' ? 'true' : 'false' !!},"darkMode":{!! Auth::user()->color_scheme === 'true' ? Auth::user()->color_scheme : 'false' !!}, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        @include('humanResource.layouts.navigation')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @include('humanResource.layouts.topbar')
                {{-- @include('layouts.messages') --}}

                <!-- Start Content-->
                <div class="container-fluid ">
                    {{ $slot }}
                </div>


            </div> <!-- content -->

            @include('humanResource.suggestion')
            @include('humanResource.suggestionBox')
            @if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin', 'HrSupervisor']))
                @include('humanResource.notice')
            @endif

            @include('layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    @include('layouts.settings')
    <!-- bundle -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    {{-- <script src="{{asset('js/JsBarcode.all.min.js')}}"></script> --}}


    <!-- third party js -->
    {{-- <script src="{{asset('assets/js/vendor/Chart.bundle.min.js')}}"></script> --}}
    <!-- third party js ends -->

    <!-- demo app -->
    {{-- <script src="{{ asset('assets/js/pages/demo.dashboard.js') }}"></script> --}}
    <!-- end demo js-->
    <!-- third party js -->
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/izitoast/js/iziToast.min.js') }}"></script>
    <!-- demo app -->
    {{-- <script src="{{ asset('assets/js/pages/demo.datatable-init.js') }}"></script> --}}

    <script>
         window.addEventListener('swal:modal', event => { 
                swal({
                  title: event.detail.message,
                  text: event.detail.text,
                  icon: event.detail.type,
                });
            });
        $(function() {
            $("#datableButtons").DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#datableButtons_wrapper .col-md-6:eq(0)');

            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            @if (Session::has('success'))
                iziToast.success({
                    title: 'Success!',
                    message: "{{ session('success') }}",
                    timeout: 10000,
                    position: 'topRight'
                });
            @endif

            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    iziToast.error({
                        title: 'Error!',
                        message: '{{ $error }}',
                        timeout: 10000,
                        position: 'topRight'
                    });
                @endforeach
            @endif

            @if (Session::has('error'))
                iziToast.error({
                    title: 'Error!',
                    message: "{{ session('error') }}",
                    timeout: 10000,
                    position: 'topRight'
                });
            @endif

            @if (Session::has('fail'))
                iziToast.error({
                    title: 'Error!',
                    message: "{{ session('fail') }}",
                    timeout: 10000,
                    position: 'topRight'
                });
            @endif
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //AJAX FOR STORING NOTICE
            $('#noticeForm').submit(function(e) {

                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('notices.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        
                        iziToast.success({
                            title: 'Good!',
                            message: response.message,
                            timeout: 10000,
                            position: 'topRight'
                        });
                        $('#notice').modal('toggle');
                        setTimeout(function () {
                        location.reload(true);
                      }, 2000);
                    },
                    error: function(response) {

                        if (Object.keys(response.responseJSON.errors).length !== 0) {
                            $('#notice_validation_message').text(response.responseJSON.errors
                                .notice ? response.responseJSON.errors.notice[0] : '');
                            $('#audience_validation_message').text(response.responseJSON.errors
                                .audience ? response.responseJSON.errors.audience[0] : '');
                            $('#expires_validation_message').text(response.responseJSON.errors
                                .expires_on ? response.responseJSON.errors.expires_on[0] :
                                '');

                        } else {
                            swal('Error', 'Oops! Something went wrong', 'error');
                        }
                    }
                });

            });

            $('#suggestionForm').submit(function(e) {

                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('suggestions.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {

                        iziToast.success({
                            title: 'Good!',
                            message: response.message,
                            position: 'topRight'
                        });

                    },
                    error: function(response) {
                        swal('Error', response.responseJSON.message, 'error');
                    }
                });
            });

        });
    </script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
