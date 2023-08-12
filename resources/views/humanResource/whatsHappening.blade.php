<div class="card ribbon-box">
    <div class="card-body">
        <div class="ribbon ribbon-danger float-end"><i class="mdi mdi-email-alert-outline me-1"></i>Updates</div>
        <h5 class="text-primary float-start mt-0">Here is what's Happening...</h5>

        <div class="ribbon-content" data-simplebar data-simplebar-primary style="max-height: 500px;">
            @if (!$notices->isEmpty())
                <div class="timeline-alt pb-0">
                    <div class="timeline-item">
                        <i class="uil-volume-up bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="#" class="text-info fw-bold mb-1 d-block">Special Notice<span
                                    class="spinner-grow spinner-grow-sm text-success" role="status"
                                    aria-hidden="true"></span></a>

                            @foreach ($notices as $notice)
                            
                                    <div class="card ribbon-box">
                                        <div class="card-body">
                                            <h6 class="text-info float-end mt-0">Posted By <strong
                                                    class="text-success">{{ $notice->employee->fullName . ' ' }}</strong>{{ $notice->created_at->diffForHumans() }}
                                            </h6>
                                            <div class="ribbon-content">
                                                {{ $notice->notice }}
                                            </div>
                                            <div class="text-end no-print">
                                                @if ($notice->created_by == auth()->user()?->employee?->id)
                                                    <form action="{{ route('notices.destroy', $notice->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ trans('Are you sure you want to delete this notice?') }}');">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-xs btn-outline-danger"><i
                                                                class="mdi mdi-delete"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div> <!-- end card-body -->
                                    </div> <!-- end card-->
                               
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if (!$contracts->isEmpty())
                <div class="timeline-alt pb-0">
                    <div class="timeline-item">
                        <i class="uil-file-contract-dollar bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="#" class="text-info fw-bold mb-1 d-block">Official Contracts<span
                                    class="spinner-grow spinner-grow-sm text-success" role="status"
                                    aria-hidden="true"></span></a>
                            <a href="{{ route('officialContracts.index') }}"
                                class="text-success btn btn-sm btn-link float-end">Take
                                Action
                                <i class="mdi  mdi-arrow-right-bold ms-1"></i>
                            </a>
                            <h4 class="header-title mt-1 mb-3"><span class="text-danger">
                                    Expiring
                                    Soon</span></h4>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <tbody>
                                        @foreach ($contracts as $contract)
                                            <tr>
                                                <td>
                                                    <h5 class="font-14 my-1 fw-normal">
                                                        {{ $contract->emp_id . ' ' . $contract->prefix . ' ' . $contract->surname . ' ' . $contract->first_name . ' ' . $contract->other_name }}
                                                    </h5>
                                                    <span
                                                        class="text-muted font-13">{{ $contract->department_name }}</span>
                                                </td>
                                                <td>
                                                    <h5 class="font-14 my-1 fw-normal">
                                                        {{ $contract->contract_name }}</h5>
                                                    <span class="text-muted font-13">{{ $contract->end_date }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-danger">Expires</span>
                                                    {{ $contract->days_to_expire > 0 ? 'In ' . $contract->days_to_expire . ' Day(s)' : ' Today' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div>
                    </div>
                </div>
            @endif
            @if (!$holidays->isEmpty())
                <div class="timeline-alt pb-0">
                    <div class="timeline-item">
                        <i class="uil-schedule bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="#" class="text-info fw-bold mb-1 d-block">Holidays<span
                                    class="spinner-grow spinner-grow-sm text-success" role="status"
                                    aria-hidden="true"></span></a>
                            @forelse ($holidays as $holiday)
                                <div class="alert alert-info" role="alert">
                                    <strong>{{ $holiday->holiday_type }} ---></strong> Tomorrow
                                    {{ date('d-m-Y', strtotime($holiday->start_date)) }} is
                                    <strong>{{ $holiday->title }}</strong> Please Enjoy!
                                </div>
                            @empty
                                <div></div>
                            @endforelse

                        </div>
                    </div>
                </div>
            @endif

            @if (!$birthdays->isEmpty())
                <div class="timeline-alt pb-0">
                    <div class="timeline-item">
                        <i class="mdi mdi-cake bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="#" class="text-info fw-bold mb-1 d-block">Birthdays<span
                                    class="spinner-grow spinner-grow-sm text-success" role="status"
                                    aria-hidden="true"></span></a>
                            @foreach ($birthdays as $birthday)
                                <div class="alert alert-info" role="alert">
                                    <div class="notify-icon">
                                        <img class="me-3 rounded-circle"
                                            src="{{ asset('storage/' . $birthday->photo) }}" width="40"
                                            alt="photo">
                                        <span class="notify-details">Today is {{ $birthday->fullName }}'s
                                            Birthday</span>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Let them know you are thinking about them</small>
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif
            @if ($educationInfoCount == 0)
                <div class="timeline-alt pb-0">
                    <div class="timeline-item">
                        <i class=" uil-book-open bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="{{ route('employees.create') }}" class="text-info fw-bold mb-1 d-block">Education<span
                                    class="spinner-grow spinner-grow-sm text-success" role="status"
                                    aria-hidden="true"></span></a>
                            <div class="alert alert-info" role="alert">
                                You do not have any <strong>Education Background information</strong> Recorded yet!
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($bankingInfoCount == 0)
                <div class="timeline-alt pb-0">
                    <div class="timeline-item">
                        <i class="uil-usd-square bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="{{ route('employees.create') }}" class="text-info fw-bold mb-1 d-block">Banking Info<span
                                    class="spinner-grow spinner-grow-sm text-success" role="status"
                                    aria-hidden="true"></span></a>
                            <div class="alert alert-info" role="alert">
                                You do not have any <strong>Banking information</strong> Recorded yet!
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($familyBackgroundCount == 0)
                <div class="timeline-alt pb-0">
                    <div class="timeline-item">
                        <i class="uil-users-alt bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="{{ route('employees.create') }}" class="text-info fw-bold mb-1 d-block">Family Background<span
                                    class="spinner-grow spinner-grow-sm text-success" role="status"
                                    aria-hidden="true"></span></a>
                            <div class="alert alert-info" role="alert">
                                You do not have any <strong>Family Background information</strong> Recorded yet!
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($emergencyContactCount == 0)
                <div class="timeline-alt pb-0">
                    <div class="timeline-item">
                        <i class="uil-outgoing-call bg-info-lighten text-info timeline-icon"></i>
                        <div class="timeline-item-info">
                            <a href="{{ route('employees.create') }}" class="text-info fw-bold mb-1 d-block">Emergency Contact<span
                                    class="spinner-grow spinner-grow-sm text-success" role="status"
                                    aria-hidden="true"></span></a>
                            <div class="alert alert-info" role="alert">
                                You do not have any <strong>Emergency Contact information</strong> Recorded yet!
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($workExperienceCount == 0)
            <div class="timeline-alt pb-0">
                <div class="timeline-item">
                    <i class="uil-award bg-info-lighten text-info timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="{{ route('employees.create') }}" class="text-info fw-bold mb-1 d-block">Work Experience<span
                                class="spinner-grow spinner-grow-sm text-success" role="status"
                                aria-hidden="true"></span></a>
                        <div class="alert alert-info" role="alert">
                            You do not have any <strong>Work Experience information</strong> Recorded yet!
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div> <!-- end card-body -->
</div> <!-- end card-->
