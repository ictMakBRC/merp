<x-hr-layout>
    <x-page-title>
        Dashboard
    </x-page-title>
    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <p class="text-muted font-15 mb-0">Employees</p>
                                    <h3><span><i class="uil-users-alt"></i>{{ $employeeCount }}</span></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i
                                                class="mdi mdi-arrow-up-bold"></i>Active</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">

                                    <p class="text-muted font-15 mb-0">Departments</p>
                                    <h3><span><i class="uil-table"></i>{{ $departmentCount }}</span></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i
                                                class="mdi mdi-arrow-up-bold"></i>Active</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">

                                    <p class="text-muted font-15 mb-0">Projects</p>
                                    <h3><span><i class="uil-file-medical-alt"></i>{{ $projectsCount }}</span></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i
                                                class="mdi mdi-arrow-up-bold"></i>Active</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <p class="text-muted font-15 mb-0">Labs</p>
                                    <h3><span><i class="uil-medical-square"></i>{{ $labCount }}</span></h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i
                                                class="mdi mdi-arrow-up-bold"></i>Active</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    <div class="row">
        <div class="col-xl-4 col-lg-4">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body text-center">
                            <h5 class="text-muted fw-normal mt-0" title="in last 30 days">Expired Contracts</h5>
                            <h3 class="text-danger mt-3 mb-3">{{ $expiredCount }}<i
                                    class="uil-file-contract-dollar"></i></h3>
                            <a href="{{ route('officialContracts.index') }}"
                                class="text-success btn btn-sm btn-link float-end">Take Action
                                <i class="mdi  mdi-arrow-right-bold ms-1"></i>
                            </a>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body text-center">
                            <h5 class="text-muted fw-normal mt-0" title="Pending Acceptance">Leave Requests</h5>
                            <h3 class="text-primary mt-3 mb-3">{{ $leaveCount }}<i class="uil-schedule"></i></h3>
                            <a href="{{ route('leaveRequests.index') }}"
                                class="text-success btn btn-sm btn-link float-end">Take Action
                                <i class="mdi  mdi-arrow-right-bold ms-1"></i>
                            </a>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body text-center">
                            <h5 class="text-muted fw-normal mt-0" title="Last 30 days">Appraisals</h5>
                            <h3 class="text-primary mt-3 mb-3">{{ $appraisalCount }}<i
                                    class="uil-comment-alt-question"></i></h3>
                            <a href="{{ route('appraisals.index') }}"
                                class="text-success btn btn-sm btn-link float-end">Take Action
                                <i class="mdi  mdi-arrow-right-bold ms-1"></i>
                            </a>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body text-center">

                            <h5 class="text-muted fw-normal mt-0" title="Pending Resolution">Grievances</h5>
                            <h3 class="text-danger mt-3 mb-3">{{ $grievanceCount }}<i class="uil-angry"></i></h3>
                            <a href="{{ route('grievances.index') }}"
                                class="text-success btn btn-sm btn-link float-end">Take Action
                                <i class="mdi  mdi-arrow-right-bold ms-1"></i>
                            </a>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body text-center">
                            {{-- <div class="float-end">
                                <i class="mdi mdi-currency-usd widget-icon"></i>
                            </div> --}}
                            <h5 class="text-muted fw-normal mt-0" title="Pending Acceptance">Resignations</h5>
                            <h3 class="text-danger mt-3 mb-3">{{ $resignationCount }}<i class="uil-sign-out-alt"></i>
                            </h3>
                            <a href="{{ route('resignations.index') }}"
                                class="text-success btn btn-sm btn-link float-end">Take Action
                                <i class="mdi  mdi-arrow-right-bold ms-1"></i>
                            </a>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-lg-6">
                    <div class="card widget-flat">
                        <div class="card-body text-center">
                            {{-- <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div> --}}
                            <h5 class="text-muted fw-normal mt-0" title="New Uploads in last 30 days">Exit Interviews
                            </h5>
                            <h3 class="text-primary mt-3 mb-3">{{ $exitInterviewCount }}<i
                                    class="uil-comment-alt-question"></i></h3>
                            <a href="{{ route('exitInterviews.index') }}"
                                class="text-success btn btn-sm btn-link float-end">Take Action
                                <i class="mdi  mdi-arrow-right-bold ms-1"></i>
                            </a>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

        </div> <!-- end col -->

        <div class="col-xl-8 col-lg-8">
            <x-updates>
            </x-updates>
            {{-- @include('humanResource.whatsHappening') --}}
          
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</x-hr-layout>
