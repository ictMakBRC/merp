<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="An enterprise resource planning application For MakBRC" name="description">
    <meta content="MERP" name="MakBRC">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/'.$facilityInfo->logo) }}">
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <div class="card-header pt-2 pb-1 text-center bg-primar">
                            <a href="{{ route('login') }}" class="text-white">
                                <span><img src="{{ asset('assets/images/merp-logo.png') }}" alt=""
                                        height="40"></span>
                            </a>
                        </div>
                        <div class="card-body">

                            {{ $slot }}

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer-->
    <footer class="footer footer-alt">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © {{ $facilityInfo->facility_name }}
                </div>

            </div>
        </div>
    </footer>

    <!-- bundle -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

</html>
