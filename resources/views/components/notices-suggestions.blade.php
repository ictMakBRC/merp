<li class="dropdown notification-list d-none d-sm-inline-block">
    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false">
        <i class="dripicons-view-apps noti-icon"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

        <div class="p-2">
            <div class="row g-0">
                <div class="col-12">
                    <a class="dropdown-icon-item" href="#" data-bs-toggle="modal" data-bs-target="#suggestion">
                        <i class="uil-edit me-1 font-24 text-success"></i>
                        <span>Suggest</span>
                    </a>
                </div>
                @if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin', 'HrSupervisor']))
                    <div class="col-12">
                        <a class="dropdown-icon-item" href="#" data-bs-toggle="modal" data-bs-target="#notice">
                            <i class="uil-volume-up me-1 font-24 text-success"></i>
                            <span>Notify</span>
                        </a>
                    </div>
                @endif
                @php
                    $mySuggestionsCount = 0;
                    $deptSuggestionsCount = 0;
                    foreach ($suggestions as $suggestion) {
                        if ($suggestion->source_dept === Auth::user()->employee->department_id) {
                            $deptSuggestionsCount++;
                        }
                        if ($suggestion->created_by === auth()->user()->id) {
                            $mySuggestionsCount++;
                        }
                    }
                    
                @endphp
                <div class="col-12">
                    <a class="dropdown-icon-item" href="#" data-bs-toggle="modal" data-bs-target="#suggestionBox">
                        <i class="uil-mailbox me-1 font-24 text-success"></i>
                        <span>Suggestion Box (<strong class="text-danger">
                                @if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin']))
                                    {{ $suggestions->count() }}
                                @elseif(Auth::user()->hasRole(['HrSupervisor']))
                                    {{ $deptSuggestionsCount }}
                                @elseif(Auth::user()->hasRole(['HrUser']))
                                    {{ $mySuggestionsCount }}
                                @endif
                            </strong>)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</li>
