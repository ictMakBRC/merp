<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo_sm_dark.png') }}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('users.index') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('facilityInformation.index') }}" aria-expanded="false"
                    aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-building"></i>
                    <span>Facility Profile</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarStaff" aria-expanded="false" aria-controls="sidebarEcommerce"
                    class="side-nav-link">
                    <i class="uil-cog"></i>
                    <span>Roles and Permission</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarStaff">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('user-roles.index') }}">User Roles</a>
                        </li>

                        <li>
                            <a href="{{ route('user-permissions.index') }}">User Permissions</a>
                        </li>
                        <li>
                            <a href="{{ route('user-roles-assignment.index') }}">Roles Assignment</a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('laratrust.roles.index') }}">Roles</a>
                        </li>
                        <li>
                            <a href="{{ route('laratrust.permissions.index') }}">Permissions</a>
                        </li>
                        <li>
                            <a href="{{ route('laratrust.roles-assignment.index') }}">Assignment</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarVendors" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-left-indent-alt"></i>
                    <span>User logs</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarVendors">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('logs') }}">Activity Logs</a>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
