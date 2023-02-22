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
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">
    <style type="text/css">
        @media print {
            body * {
                visibility: hidden;
            }

            #barcodeContainer,
            #barcodeContainer * {
                visibility: visible;
            }

            #barcodeContainer {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
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
                    <div class="col-9">
                        <div class="page-title-box">
                            <div class="page-title-left pt-3">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Back to
                                            Dashboard</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class=" d-grid mb-1 text-center pt-3">
                            <button class="btn btn-success" onclick="window.print();"> PRINT</button>
                        </div>
                    </div>

                </div>
                <!-- end quote -->
                <div class="row" id="barcodeContainer">

                    <!-- Barcodes go here -->

                </div>
            </div>
            <!-- end row-->
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
    <script src="{{ asset('js/JsBarcode.all.min.js') }}"></script>
    <!-- end row-->

    <script>
        $(document).ready(function() {

            let barcodes = @json($barcodes);
            for (let barcode of barcodes) {
                let outPut = '<div class="col-md-3">' +
                    '<div class="card border-primary border">' +
                    '<div class="card-body text-center">' +
                    '<h5 class="card-title text-primary">' + barcode.asset_name + '</h5>' +
                    `<svg id="barcodee${barcode.id}"></svg>` +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $('#barcodeContainer').append(outPut);

                JsBarcode("#barcodee" + barcode.id, barcode.barcode, {
                    format: 'code128',
                    displayValue: true,
                    lineColor: "#24292e",
                    width: 1.5,
                    height: 30,
                    fontSize: 15
                });
            }
        });
    </script>

</body>

</html>
