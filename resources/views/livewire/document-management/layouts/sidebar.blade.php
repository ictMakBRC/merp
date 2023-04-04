<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            {{-- <img src="{{asset('assets/images/logo.png')}}" alt="" height="16"> --}}
        </span>
        <span class="logo-sm">
            {{-- <img src="{{asset('assets/images/logo_sm.png')}}" alt="" height="16"> --}}
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{asset('assets/images/logo_sm_dark.png')}}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>
            <li class="side-nav-item">
                <a href="{{route('document.dashboard')}}" class="side-nav-link">
                <i class="uil-home-alt"></i>
                    <span>Dashboard </span>
                </a>
            </li>

          
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#invreq" aria-expanded="false" aria-controls="invreq" class="side-nav-link">
                    <i class="uil-file-info-alt"></i>
                    <span>Documents</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="invreq">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('document.request')}}">New Request</a>
                        </li>
                        {{-- <li>
                            <a href="{{url('inventory/inv/requests/viewed')}}">Signed</a>
                        </li> --}}

                    </ul>
                </div>
                <li class="side-nav-item">
                    <a href="{{route('document.categories')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                        <span>Categories </span>
                    </a>
                </li>
            </li>

        </ul>

        <!-- Help Box -->

        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
