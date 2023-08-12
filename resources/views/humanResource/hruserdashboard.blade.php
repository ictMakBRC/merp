<x-hr-layout>
    <x-page-title>
        Dashboard
    </x-page-title>

    <div class="row">
        <div class="col-xl-5 col-lg-5">
            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-danger float-end"><i class="mdi mdi-account me-1"></i>About Me</div>
                    <h5 class="text-primary float-start mt-0">Hello!</h5>
                    <div class="ribbon-content text-center ">
                        <img src="{{ asset('storage/' . Auth::user()?->employee?->photo) }}" alt="user-image"
                            class="rounded-circle avatar-lg img-thumbnail">
                        <h4 class="mb-0 mt-2">{{ $employee->fullName }}</h4>
                        <p class="text-muted font-14">
                            @if ($employee->designation == null)
                                N/A
                            @else
                                {{ $employee->designation->name }}
                            @endif
                        </p>
                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Emp-No :</strong> <span
                                    class="ms-2">{{ $employee->emp_id }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>NIN :</strong>
                                <span class="ms-2">
                                    @if ($employee->nin_number == null)
                                        N/A
                                    @else
                                        {{ $employee->nin_number }}
                                    @endif
                                </span>
                            </p>
                            <p class="text-muted mb-2 font-13"><strong>Nationality :</strong> <span class="ms-2 ">
                                    @if ($employee->citizenship == null)
                                        N/A
                                    @else
                                        {{ $employee->citizenship }}
                                    @endif
                                </span></p>
                            <p class="text-muted mb-1 font-13"><strong>DoB :</strong> <span class="ms-2">
                                    {{ date('d-m-Y', strtotime($employee->birthday)) }}<span>(Age:{{ $employee->empAge }})</span>
                                </span></p>
                            <p class="text-muted mb-1 font-13"><strong>Contact :</strong> <span class="ms-2">
                                    {{ $employee->contact }}{{ $employee->alt_contact ? ' / ' . $employee->alt_contact : '' }}
                                </span></p>
                            <p class="text-muted mb-1 font-13"><strong>Email :</strong> <span class="ms-2">
                                    {{ $employee->email }}{{ $employee->alt_email ? ' / ' . $employee->alt_email : '' }}
                                </span></p>
                            <p class="text-muted mb-1 font-13"><strong>Station :</strong> <span class="ms-2">
                                    @if ($employee->station == null)
                                        N/A
                                    @else
                                        {{ $employee->station->station_name }}
                                    @endif
                                </span></p>
                            <p class="text-muted mb-1 font-13"><strong>Department :</strong> <span class="ms-2">
                                    @if ($employee->department == null)
                                        N/A
                                    @else
                                        {{ $employee->department->department_name }}
                                    @endif
                                </span></p>
                            <p class="text-muted mb-1 font-13"><strong>Reporting to :</strong> <span class="ms-2">
                                    @if ($reportingTo)
                                        {{ $reportingTo->fullName }}
                                    @else
                                        N/A
                                    @endif
                                </span></p>
                            <p class="text-muted mb-1 font-13"><strong>Work Type :</strong> <span class="ms-2">
                                    {{ $employee->work_type }}
                                </span></p>
                            <p class="text-muted mb-1 font-13"><strong>Join-Date:</strong> <span class="ms-2">
                                    {{ date('d-m-Y', strtotime($employee->join_date)) }}
                                </span></p>
                        </div>
                        <a type="button" href="{{ route('employees.show', $employee->id) }}"
                            class="btn btn-success btn-sm mb-2">View All</a>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-xl-7 col-lg-7">
            <x-updates>
            </x-updates>
            {{-- @include('humanResource.whatsHappening') --}}
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</x-hr-layout>
