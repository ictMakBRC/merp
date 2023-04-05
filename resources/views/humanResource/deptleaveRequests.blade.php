<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Leave Requests
                    <x-slot:buttons>
                        <a type="button" href="#" class="btn btn-success mb-2 me-1"
                        data-bs-toggle="modal" data-bs-target="#newRequest">Create Request</a>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table id="datableButtons" class="table table-striped mb-0 w-100 ">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Emp-No</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Type</th>
                                        <th>Req-Date</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        @if (Auth::user()->hasRole(['HrUser', 'HrSupervisor', 'HrAdmin']))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($leaverequests as $key => $request)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $request->emp_id }}</td>
                                            <td>{{ $request->employee->fullName }}</td>
                                            <td>{{ $request->employee->department->department_name }}</td>
                                            <td>{{ $request->leave->name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($request->created_at)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($request->start_date)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($request->end_date)) }}</td>
                                            <td>@php
                                                
                                                $dateOne = \Carbon\Carbon::createFromFormat('Y-m-d', $request->start_date);
                                                $dateTwo = \Carbon\Carbon::createFromFormat('Y-m-d', $request->end_date);
                                                
                                                if ($request->length >= 365) {
                                                    echo $dateOne->diffInYears($dateTwo) . ' ' . 'Year(s)';
                                                } elseif ($request->length <= 30) {
                                                    echo $dateOne->diffInDays($dateTwo) . ' ' . 'Day(s)';
                                                } elseif ($request->length >= 31 && $request->length < 365) {
                                                    echo $dateOne->diffInMonths($dateTwo) . ' ' . 'Month(s)';
                                                }
                                            @endphp

                                            </td>

                                            @if ($request->status == 'Approved' && $request->confirmation == 'Confirmed' && $request->accepted_by != null)
                                                <td><span
                                                        class="badge bg-success">Approved|<br>Confirmed|<br>Accepted</span>
                                                </td>
                                            @elseif($request->status == 'Approved' && $request->confirmation == 'Confirmed' && $request->accepted_by == null)
                                                <td><span class="badge bg-success">Approved|Confirmed|<br><span
                                                            class="badge bg-danger">Not yet Accepted</span></span></td>
                                            @elseif($request->status == 'Approved' && $request->confirmation != 'Confirmed')
                                                <td><span class="badge bg-success">Approved|<span
                                                            class="badge bg-danger">Not Confirmed</span></span></td>
                                            @elseif($request->status == 'Declined')
                                                <td><span class="badge bg-danger">Declined</span></td>
                                            @elseif($request->status == 'Pending' && $request->delegatee_status == 'Declined')
                                                <td><span class="badge bg-danger">Delegatee Declined</span></td>
                                            @elseif($request->status == 'Pending' && $request->delegatee_status == 'Accepted')
                                                <td><span class="badge bg-info">Delegatee Accepted</span></td>
                                            @elseif($request->status == 'Pending' && $request->delegatee_status == null)
                                                <td><span class="badge bg-info">Pending</span></td>
                                            @endif

                                            @if (Auth::user()->hasRole(['HrUser', 'HrAdmin', 'SuperAdmin']))
                                                <td class="d-flex">
                                                    @if ($request->status == 'Declined')
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-info mb-2 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#reason{{ $request->id }}"><i
                                                                class="mdi mdi-eye">Reason</i></a>
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-success mb-2 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#approve{{ $request->id }}"><i
                                                                class="uil-envelope-check"><span>Approve</span></i></a>
                                                    @elseif($request->status == 'Pending' && $request->delegatee_status == 'Accepted')
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-info mb-2 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#reason{{ $request->id }}"><i
                                                                class="mdi mdi-eye"><span>Reason</span></i></a>
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-success mb-2 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#approve{{ $request->id }}"><i
                                                                class="uil-envelope-check"><span>Approve</span></i></a>
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-danger mb-2 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#decline{{ $request->id }}"><i
                                                                class="uil-envelope-block"><span>Decline</span></i></a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    @include('humanResource.leaveRequestModal')
    @include('humanResource.leaveReasonModal')
    @include('humanResource.approveLeaveModal')
    @include('humanResource.declineLeaveModal')
    @include('humanResource.delegateedeclineLeaveModal')
    @include('humanResource.approverLeaveCommentModal')
    @include('humanResource.leaveRescheduleModal')

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#leavetype').change(function() {
                    var id = $(this).val();
                    var url = "{{ route('availablecredits', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "json",
                        success: function(response) {
                            if (!jQuery.isEmptyObject(response)) {
                                console.log(response);
                                $('#credits').val(response.duration);
                                $('#notice_days').val(response.notice_days);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        }
                    })
                });

                $('#endDate').change(function() {
                    let start_date = (new Date($('#startDate').val())).getTime();
                    let end_date = (new Date($('#endDate').val())).getTime();
                    let currentDate = (new Date()).getTime();
                    let noticeCheck = Math.abs((start_date - currentDate) / (1000 * 3600 * 24));
                    console.log(noticeCheck);
                    if (end_date > start_date) {
                        console.log(noticeCheck);
                        if (noticeCheck >= $('#notice_days').val()) {
                            $('#submitBtn').prop('disabled', false);
                            let difference = (end_date - start_date) / (1000 * 3600 * 24);
                            let daysInput = $('#length');
                            daysInput.val(difference);

                            if (difference > $('#credits').val()) {

                                $('#submitBtn').prop('disabled', true);
                                alert('Number of days on leave should not exceed Available Credits!');
                            } else {
                                $('#submitBtn').prop('disabled', false);
                            }
                        } else {
                            $('#submitBtn').prop('disabled', true);
                            alert('Check Leave notice period and Try again please!!')
                        }
                    } else {
                        $('#submitBtn').prop('disabled', true);
                        alert('Negative Days/Backward Dating Not Allowed Please!')
                    }
                })
                @foreach ($leaverequests as $key => $request)
                    $('#endDate{{ $request->id }}').change(function() {
                        let start_date = (new Date($('#startDate{{ $request->id }}').val())).getTime();
                        let end_date = (new Date($('#endDate{{ $request->id }}').val())).getTime();
                        let currentDate = (new Date()).getTime();
                        let noticeCheck = Math.abs((start_date - currentDate) / (1000 * 3600 * 24));
                        console.log(noticeCheck);
                        if (end_date > start_date) {
                            console.log(noticeCheck);
                            if (noticeCheck >= $('#notice_days{{ $request->id }}').val()) {
                                $('#submitBtn{{ $request->id }}').prop('disabled', false);
                                let difference = (end_date - start_date) / (1000 * 3600 * 24);
                                let daysInput = $('#length{{ $request->id }}');
                                daysInput.val(difference);

                                if (difference > $('#credits{{ $request->id }}').val()) {

                                    $('#submitBtn{{ $request->id }}').prop('disabled', true);
                                    alert('Number of days on leave should not exceed Available Credits!');
                                } else {
                                    $('#submitBtn{{ $request->id }}').prop('disabled', false);
                                }
                            } else {
                                $('#submitBtn{{ $request->id }}').prop('disabled', true);
                                alert('Check Leave notice period and Try again please!!')
                            }
                        } else {
                            $('#submitBtn{{ $request->id }}').prop('disabled', true);
                            alert('Negative Days/Backward Dating Not Allowed Please!')
                        }
                    })
                @endforeach
            });
        </script>
    @endpush
</x-hr-layout>
