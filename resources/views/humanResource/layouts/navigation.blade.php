<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
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
                <a href="{{ route('humanresource.dashboard') }}" aria-expanded="false" aria-controls="sidebarDashboards"
                    class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPersonalInfo" aria-expanded="false"
                    aria-controls="sidebarPersonalInfo" class="side-nav-link">
                    <i class="uil-user-square"></i>
                    <span>Personal Info</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPersonalInfo">
                    <ul class="side-nav-second-level">
                        @if (!Auth::user()->hasRole(['HrAdmin']))
                            <li>
                                <a href="{{ route('employees.create') }}">Capture Info</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('employees.show', Auth::user()->employee_id) }}">Personal Info</a>
                        </li>
                        <li>
                            <a href="{{ route('employees.edit', Auth::user()->employee_id) }}">Update Info</a>
                        </li>
                        <li>
                            <a href="{{ route('officialContracts.show', Auth::user()->employee_id) }}">Official
                                Contracts</a>
                        </li>
                        <li>
                            <a href="{{ route('projectContracts.show', Auth::user()->employee_id) }}">Project
                                Contracts</a>
                        </li>
                        @if (Auth::user()->hasRole(['HrAdmin', 'HrSupervisor', 'SuperAdmin']))
                            <li>
                                <a href="{{ route('leaveRequests.show', Auth::user()->employee_id) }}">My Leave
                                    Requests</a>
                            </li>
                            <li>
                                <a href="{{ route('appraisals.show', Auth::user()->employee_id) }}">My Appraisals</a>
                            </li>
                            <li>
                                <a href="{{ route('grievances.show', Auth::user()->employee_id) }}">My Grievances</a>
                            </li>
                            <li>
                                <a href="{{ route('warnings.show', Auth::user()->employee_id) }}">My Warnings</a>
                            </li>
                            <li>
                                <a href="{{ route('resignations.show', Auth::user()->employee_id) }}">My
                                    Resignation</a>
                            </li>

                            <li>
                                <a href="{{ route('terminations.show', Auth::user()->employee_id) }}">My
                                    Termination</a>
                            </li>
                            <li>
                                <a href="{{ route('exitInterviews.show', Auth::user()->employee_id) }}">My Exit
                                    Interview</a>
                            </li>
                        @endif
                        {{-- <li>
                            <a href="{{route('employees.create')}}">Leave Requests</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            @if (Auth::user()->hasRole(['SuperAdmin', 'HrAdmin', 'HrSupervisor']))
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarEmployees" aria-expanded="false"
                        aria-controls="sidebarEmployees" class="side-nav-link">
                        <i class="uil-users-alt"></i>
                        @if (Auth::user()->hasRole(['SuperAdmin', 'HrAdmin']))
                            <span>Employees</span>
                            <span class="menu-arrow"></span>
                        @else
                            <span>Dept Members</span>
                            <span class="menu-arrow"></span>
                        @endif
                    </a>
                    <div class="collapse" id="sidebarEmployees">
                        <ul class="side-nav-second-level">
                            @if (Auth::user()->hasRole(['HrAdmin']))
                                <li>
                                    <a href="{{ route('employees.create') }}">Capture Info</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('employees.index') }}">All Employees</a>
                            </li>

                            <li>
                                <a href="{{ route('officialContracts.index') }}">Official Contracts</a>
                            </li>
                            @if (Auth::user()->hasRole(['SuperAdmin', 'HrAdmin']))
                                <li>
                                    <a href="{{ route('projectContracts.index') }}">Project Contracts</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#performance" aria-expanded="false"
                    aria-controls="sidebarMPerformance" class="side-nav-link">
                    <i class="uil-award"></i>
                    <span>
                        @if (Auth::user()->hasRole(['HrSupervisor']))
                            Dept Performance
                        @else
                            Performance
                        @endif
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="performance">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#appraisal" aria-expanded="false"
                                aria-controls="sidebarAppraisals">
                                <span>Appraisal</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="appraisal">
                                <ul class="side-nav-third-level">
                                    @if (Auth::user()->hasRole(['HrAdmin']))
                                        <li>
                                            <a href="{{ route('appraisaltemplate.show') }}">Upload Template</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a
                                            href="{{ route('appraisalform.download', ['emp_id' => auth()->user()->emp_id]) }}">Download
                                            Template</a>
                                    </li>
                                    @if (Auth::user()->hasRole(['HrSupervisor']))
                                        <li>
                                            <a href="{{ route('appraisals.create') }}">Upload Appraisal</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasRole(['SuperAdmin', 'HrAdmin', 'HrSupervisor', 'HrUser']))
                                        @if (Auth::user()->hasRole(['HrUser']))
                                            <li>
                                                <a href="{{ route('appraisals.index') }}">My Appraisals</a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('appraisals.index') }}">All Appraisals</a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#warnings" aria-expanded="false"
                                aria-controls="sidebarWarnings">
                                <span>Warning</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="warnings">
                                <ul class="side-nav-third-level">
                                    @if (Auth::user()->hasRole(['HrAdmin']))
                                        <li>
                                            <a href="{{ route('warnings.create') }}">Create Warning</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasRole(['SuperAdmin', 'HrAdmin', 'HrSupervisor', 'HrUser']))
                                        @if (Auth::user()->hasRole(['HrUser']))
                                            <li>
                                                <a href="{{ route('warnings.index') }}">My Warnings</a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('warnings.index') }}">All Warnings</a>
                                            </li>
                                        @endif
                                    @endif

                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#resignations" aria-expanded="false"
                                aria-controls="sidebarResignations">
                                <span>Resignation</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="resignations">
                                <ul class="side-nav-third-level">
                                    @if (Auth::user()->hasRole(['SuperAdmin', 'HrAdmin', 'HrSupervisor', 'HrUser']))
                                        <li>
                                            <a href="{{ route('resignations.create') }}">Create Resignation</a>
                                        </li>
                                        @if (Auth::user()->hasRole(['HrUser']))
                                            <li>
                                                <a href="{{ route('resignations.index') }}">My Resignation</a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('resignations.index') }}">All Resignations</a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#terminations" aria-expanded="false"
                                aria-controls="sidebarTerminations">
                                <span>Termination</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="terminations">
                                <ul class="side-nav-third-level">
                                    @if (Auth::user()->hasRole(['HrAdmin']))
                                        <li>
                                            <a href="{{ route('terminations.create') }}">Create Termination</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasRole(['HrUser']))
                                        <li>
                                            <a href="{{ route('terminations.index') }}">My Termination</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('terminations.index') }}">All Terminations</a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#interview" aria-expanded="false"
                                aria-controls="sidebarInterviews">
                                <span>Exit Interview</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="interview">
                                <ul class="side-nav-third-level">
                                    @if (Auth::user()->hasRole(['HrAdmin']))
                                        <li>
                                            <a href="{{ route('interviewtemplate.show') }}">Upload Template</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a
                                            href="{{ route('interviewtemplate.download', ['emp_id' => auth()->user()->emp_id]) }}">Download
                                            Template</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('exitInterviews.create') }}">Upload Interview</a>
                                    </li>
                                    @if (Auth::user()->hasRole(['HrUser']))
                                        <li>
                                            <a href="{{ route('exitInterviews.index') }}">My Exit Interview</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('exitInterviews.index') }}">All Interviews</a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#leaves" aria-expanded="false" aria-controls="sidebarLeaves"
                    class="side-nav-link">
                    <i class="uil-calendar-alt"></i>
                    <span>Leaves</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="leaves">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('leaveRequests.index') }}">Leave Requests</a>
                        </li>
                        <li>
                        <li>
                            <a href="{{ route('as-delegatee', Auth::user()->employee_id) }}">As Delegatee</a>
                        </li>
                        {{-- <a href="{{route('leaveRequests.index')}}">Leave Requests</a> --}}
            </li>

            @if (Auth::user()->hasRole(['HrAdmin']))
                <li>
                    <a href="{{ route('dept.leaves', Auth::user()->employee_id) }}">Dept Requests</a>
                </li>
                <li>
                    <a href="{{ route('leaves.index') }}">Leave Settings</a>
                </li>
            @endif
        </ul>
    </div>
    </li>
    @if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin', 'HrUser', 'HrSupervisor']))
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#grievance" aria-expanded="false" aria-controls="sidebarGrievance"
                class="side-nav-link">
                <i class="uil-angry"></i>
                <span>Grievances</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="grievance">
                <ul class="side-nav-second-level">
                    @if (Auth::user()->hasRole(['HrUser']))
                        <li>
                            <a href="{{ route('grievances.create') }}">Create Grievance</a>
                        </li>
                        <li>
                            <a href="{{ route('grievances.index') }}">My Grievances</a>
                        </li>
                    @else
                        @if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin', 'HrSupervisor']))
                            <li>
                                <a href="{{ route('grievances.index') }}">All Grievances</a>
                            </li>
                        @endif
                    @endif

                </ul>
            </div>
        </li>
    @endif
    @if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin']))
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#manage" aria-expanded="false" aria-controls="sidebarManage"
                class="side-nav-link">
                <i class="uil-folder-plus"></i>
                <span>Manage</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="manage">
                <ul class="side-nav-second-level">
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#holidays" aria-expanded="false"
                            aria-controls="sidebarHolidays">
                            <span>Manage Holidays</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="holidays">
                            <ul class="side-nav-third-level">
                                <li>
                                    <a href="{{ route('holidays.index') }}">Holidays Settings</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#locations" aria-expanded="false"
                            aria-controls="sidebarLocations">
                            <span>Manage Stations/Depts</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="locations">
                            <ul class="side-nav-third-level">
                                <li>
                                    <a href="{{ route('hrstations.index') }}">Duty Stations</a>
                                </li>
                                <li>
                                    <a href="{{ route('hrdepartments.index') }}">Departments</a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('hrunits.index') }}">Units</a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#projects" aria-expanded="false"
                            aria-controls="sidebarProjects">
                            <span>Manage Projects</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="projects">
                            <ul class="side-nav-third-level">
                                <li>
                                    <a href="{{ route('projects.view') }}">Projects</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#designations" aria-expanded="false"
                            aria-controls="sidebarDesignation">
                            <span>Manage Designations </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="designations">
                            <ul class="side-nav-third-level">
                                <li>
                                    <a href="{{ route('designations.index') }}">Designations</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
    @endif
    @if (Auth::user()->hasRole(['HrSupervisor', 'HrAdmin', 'SuperAdmin']))
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="sidebarReports"
                class="side-nav-link">
                <i class="uil-file-alt"></i>
                <span>Reports</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="reports">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{ route('general-reports.create') }}">General Reports</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#payroll" aria-expanded="false" aria-controls="sidebarReports"
                class="side-nav-link">
                <i class="uil-file-alt"></i>
                <span>Payroll</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="payroll">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{ route('hr.viewPayroll') }}">Generate Official Payrolls</a>
                    </li>
                    <li>
                        <a href="{{ route('hr.viewOfficialPayroll') }}">Generate Project Payroll</a>
                    </li>
                </ul>
            </div>
        </li>
    @endif
    </ul>
    <!-- End Sidebar -->
    <div class="clearfix"></div>
</div>
<!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
