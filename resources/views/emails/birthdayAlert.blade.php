<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- App css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card border-success border">
                        <div class="card-body p-4">
                            <div class="text-center">
                                {{-- <h1 class="text-error">4<i class="mdi mdi-emoticon-sad"></i>4</h1> --}}
                                <h4 class="text-uppercase text-danger mt-3">Happy BirthDay {{ $user }}</h4>
                                <p class="text-muted mt-3">
                                    {{$wishes}}
                                </p>

                                {{-- <img src="https://www.funimada.com/assets/images/cards/big/bday-458.gif" height="100" width="100"> --}}

                                <img src="https://i.pinimg.com/originals/46/11/87/46118741ef0a40d03f03732880db1d13.gif"
                                    height="200" width="200">
                                <br>


                                <hr>
                                FROM: <h4 class="text-uppercase text-success">The MakBRC Fraternity</h4>
                                {{-- <p>If you're having trouble clicking the "Click to Login" button, copy and paste the URL below into your web browser:<a href="https://merp.co.ug">https://merp.co.ug</a></p> --}}
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> © {{ $facilityInfo?->facility_name }}
    </footer>

    <!-- bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

</body>

</html>
