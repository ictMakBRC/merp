<div class="leftside-menu">

     <!-- LOGO -->
     <a href="index.html" class="logo text-center p-3 logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" width="50%">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" width="50%">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center p-3 logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" width="50%">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" width="50%">
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
                <a data-bs-toggle="collapse" href="#documents" aria-expanded="false" aria-controls="invreq" class="side-nav-link">
                    <i class="uil-file-info-alt"></i>
                    <span>Document Requests</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="documents">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('document.request')}}">My Requests</a>
                        </li>
                        <li>
                            <a href="{{route('document.incoming')}}">Incoming requests</a>
                        </li>
                        <li>
                            <a href="{{route('document.documents')}}">Recent Documents</a>
                        </li>

                    </ul>
                </div>                
                <li class="side-nav-item">
                    <a href="{{route('document.categories')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                        <span>Document Categories </span>
                    </a>
                </li>
                <a data-bs-toggle="collapse" href="#resources" aria-expanded="false" aria-controls="invreq" class="side-nav-link">
                    <i class="uil-file-info-alt"></i>
                    <span>Documents Resources</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="resources">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('document.resources')}}">My Documents</a>
                        </li>
                        <li>
                            {{-- <a href="{{route('document.incoming')}}">Resource categories</a> --}}
                        </li>

                    </ul>
                </div>
            </li>

        </ul>

        <!-- Help Box -->

        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
