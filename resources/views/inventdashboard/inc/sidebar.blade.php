<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light p-2">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" width="50%">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" width="50%">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" width="40%">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/merp-logo.png') }}" alt="" width="40%">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            @role('InvAdmin')

            <li class="side-nav-item">
                <a href="{{route('inventory')}}" class="side-nav-link">
                <i class="uil-home-alt"></i>
                    <span>Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Manage</li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#items" aria-expanded="false" aria-controls="items" class="side-nav-link">
                    <i class="uil-gold"></i>
                    <span>Items</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="items">
                    <ul class="side-nav-second-level">
                        <li>
                            <a  href="{{url('inventory/newItem')}}">New Item</a>
                        </li>
                        <li>
                            <a href="{{route('invItems')}}">Item List</a>
                        </li>
                        <li>
                            <a href="{{route('dptItems')}}">Department Items</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock" class="side-nav-link">
                    <i class="uil-graph-bar"></i>
                    <span>Stock</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="stock">
                    <ul class="side-nav-second-level">
                        <li>
                            <a  href="{{url('inventory/stockLevels')}}">Stock levels</a>
                        </li>
                        <li>
                            <a  href="{{route('StockEntries')}}">Stock Entries</a>
                        </li>
                        <li>
                            <a href="{{route('receiveStock','SC'.date('y').mt_rand(100, 999).time())}}">New stock card</a>
                        </li>
                        <li>
                            <a href="{{url('inventory/stock/unsettled')}}">Borrowed</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="{{route('stores')}}" class="side-nav-link">
                    <i class="uil-store-alt"></i>
                    <span>Stores</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('invSuppliers')}}" class="side-nav-link">
                    <i class="uil-truck-loading"></i>
                    <span>Suppliers</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories" class="side-nav-link">
                    <i class="uil-folder-plus"></i>
                    <span>Departments</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="categories">
                    <ul class="side-nav-second-level">
                        {{-- <li>
                            <a href="{{url('inventory/categories')}}">Departments</a>
                        </li> --}}
                        <li>
                            <a href="{{route('invcategories')}}">Categories</a>
                        </li>
                        <li>
                            <a href="{{url('inventory/department/users')}}">Department users</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{route('invuom')}}" class="side-nav-link">
                    <i class="uil-balance-scale"f></i>
                    <span>Units Of measurements</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#invreq" aria-expanded="false" aria-controls="invreq" class="side-nav-link">
                    <i class="uil-file-info-alt"></i>
                    <span>Requests</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="invreq">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('inventory/inv/requests')}}">Pending</a>
                        </li>
                        <li>
                            <a href="{{url('inventory/inv/requests/viewed')}}">Viewed</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{url('inventory/inv/reports')}}" class="side-nav-link">
                    <i class="uil-file"></i>
                    <span>Reports</span>
                </a>
            </li>
            @endrole
{{-- ====================================USER ROUTES======================= --}}
            @role('InvUser')
            @if (session()->has('department')) 
                <li class="side-nav-item">{{ Session::get('department_name') }}</li>
                <li class="side-nav-item">
                    <a href="{{route('inv_user.dashboard')}}" class="side-nav-link">
                        <i class="uil-file"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{url('inventory/manage/reports')}}" class="side-nav-link">
                        <i class="uil-file"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#stock" aria-expanded="false" aria-controls="stock" class="side-nav-link">
                        <i class="uil-graph-bar"></i>
                        <span>Stock</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="side-nav-second-level">
                            <li>
                                <a  href="{{route('inv_user.stockCard')}}">Stock levels</a>
                            </li>
                            <li>
                                <a href="{{route('inv_user.stockHistory')}}">Stock history</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#managerequests" aria-expanded="false" aria-controls="makerequests" class="side-nav-link">
                        <i class="uil-shopping-trolley"></i>
                        <span>Manage requests</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="managerequests">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="{{route('inv_user.requests')}}">My Requests</a>
                            </li>
                            <li>
                                <a href="{{route('inv_user.requestNew','RQ-'.rand(1,99).time())}}">New request</a>
                            </li>
                       
    
                        </ul>
                    </div>
                </li>
                @permission('inventory-approve')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#myapprovels" aria-expanded="false" aria-controls="approvels" class="side-nav-link">
                        <i class="uil-folder-plus"></i>
                        <span>Request Approvals</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="myapprovels">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="{{url('inventory/requests/approvels/pending')}}">Pending approvals</a>
                            </li>
                            <li>
                                <a href="{{url('inventory/requests/approvels/approved')}}">Approved requests</a>
                            </li>
                        </ul>
                    </div>
                </li>           
                @endpermission
            <li class="side-nav-item d-none">
                <a data-bs-toggle="collapse" href="#makerequests" aria-expanded="false" aria-controls="makerequests" class="side-nav-link">
                    <i class="uil-shopping-trolley"></i>
                    <span>Make requests</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="makerequests">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('inventory/request/new')}}">Internal request</a>
                        </li>
                        <li>
                            <a href="{{url('inventory/request/lend')}}">External request</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="side-nav-item d-none">
                <a data-bs-toggle="collapse" href="#myrequests" aria-expanded="false" aria-controls="myrequests" class="side-nav-link">
                    <i class="uil-folder-minus"></i>
                    <span>My requests</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="myrequests">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('inventory/requests/draft')}}">Draft requests</a>
                        </li>
                        <li>
                            <a href="{{url('inventory/requests/submitted')}}">Submitted requests</a>
                        </li>

                    </ul>
                </div>
            </li>
            @permission('inventory-approve')
            <li class="side-nav-item d-none">
                <a data-bs-toggle="collapse" href="#approvels" aria-expanded="false" aria-controls="approvels" class="side-nav-link">
                    <i class="uil-folder-plus"></i>
                    <span>My Approvals</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="approvels">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('inventory/requests/approvels/pending')}}">Pending approvals</a>
                        </li>
                        <li>
                            <a href="{{url('inventory/requests/approvels/approved')}}">Approved requests</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item d-none">
                <a href="{{url('inventory/manage/reports')}}" class="side-nav-link">
                    <i class="uil-file"></i>
                    <span>Manage</span>
                </a>
            </li>           
            @endpermission
            @endrole

            @endif
        </ul>

        <!-- Help Box -->

        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
