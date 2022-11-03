<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="16">
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
                <a href="{{ route('asset.index') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarAssets" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-gold"></i>
                    <span> Assets</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarAssets">
                    <ul class="side-nav-second-level">

                        <li>
                            <a href="{{ route('asset.create') }}">Add Asset</a>
                        </li>

                        <li>
                            <a href="{{ route('asset_search.show') }}">Search Asset</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarIssues" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-question-circle"></i>
                    <span> Issues</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarIssues">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('issues.create') }}">Report Issue</a>
                        </li>
                        <li>
                            <a href="{{ route('issues.index') }}">Active Issues</a>
                        </li>
                        <li>
                            <a href="#">All Issues</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#maintenance" aria-expanded="false" aria-controls="sidebarEcommerce"
                    class="side-nav-link">
                    <i class="uil-cog"></i>
                    <span>Maintenance</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="maintenance">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('maintenance.create') }}">New Info</a>
                        </li>
                        <li>
                            <a href="{{ route('maintenance.index') }}">Maintenance Info</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false"
                    aria-controls="sidebarMultiLevel" class="side-nav-link">
                    <i class="uil-folder-plus"></i>
                    <span> Manage </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMultiLevel">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#categories" aria-expanded="false"
                                aria-controls="sidebarSecondLevel">
                                <span>Manage Categories </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="categories">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{ route('categories.index') }}">Categories</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#vendors" aria-expanded="false"
                                aria-controls="sidebarSecondLevel">
                                <span>Manage Vendors</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="vendors">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{ route('vendors.index') }}">Manage Vendors</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#locations" aria-expanded="false"
                                aria-controls="sidebarSecondLevel">
                                <span>Manage Locations</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="locations">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{ route('stations.index') }}">Stations</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('departments.index') }}">Departments</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#insurance" aria-expanded="false"
                                aria-controls="sidebarSecondLevel">
                                <span>Manage Insurance</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="insurance">
                                <ul class="side-nav-third-level">
                                    <li>
                                    <li>
                                        <a href="{{ route('insurancetypes.index') }}">Insurance Information</a>
                                    </li>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    </li>
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="sidebarEcommerce"
            class="side-nav-link">
            <i class="uil-file-alt"></i>
            <span>Reports</span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="reports">
            <ul class="side-nav-second-level">
                <li>
                    <a href="{{ route('barcodes.show') }}">Generate Barcodes</a>
                </li>
                <li>
                    <a href="{{ route('asset.export') }}">Export All Assets</a>
                </li>
                <li>
                    <a href="#">Out For Maintenance</a>
                </li>
                <li>
                    <a href="#">Disposed of</a>
                </li>
                <li>
                    <a href="#">Archived</a>
                </li>
                <li>
                    <a href="#">Assignment History</a>
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
