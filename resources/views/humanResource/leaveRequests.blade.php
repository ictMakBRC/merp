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
                            <table id="datableButtons" class="table border-bottom border-primary mb-0 w-100 ">
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
                                            @if (Auth::user()->hasRole(['HrUser', 'HrSupervisor', 'HrAdmin', 'SuperAdmin']))
                                                <td class="d-flex">
                                                    @if ($request->status == 'Approved' && $request->confirmation == 'Confirmed' && $request->accepted_by != null)
                                                        @if (Auth::user()->employee_id == $request->employee_id ||
                                                            Auth::user()->hasRole(['HrSupervisor', 'HrAdmin', 'SuperAdmin']) ||
                                                            Auth::user()->employee_id == $request->delegated_to)
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye">Reason</i></a>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#comment{{ $request->id }}"><i
                                                                    class="mdi mdi-eye">Comment</i></i></a>
                                                        @endif
                                                    @elseif($request->status == 'Approved' && $request->confirmation == 'Confirmed' && $request->accepted_by == null)
                                                        @if (Auth::user()->employee_id == $request->employee_id || Auth::user()->employee_id == $request->delegated_to)
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye">Reason</i></a>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#comment{{ $request->id }}"><i
                                                                    class="mdi mdi-eye">Comment</i></i></a>
                                                        @elseif (Auth::user()->hasRole(['HrAdmin']))
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye">Reason</i></a>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#comment{{ $request->id }}"><i
                                                                    class="mdi mdi-eye">Comment</i></i></a>
                                                            <form method="POST"
                                                                action="{{ route('leaveRequests.update', $request->id) }}">
                                                                @method('PUT')
                                                                @csrf
                                                                <input type="text" hidden id="accept"
                                                                    class="form-control" name="accepted_by"
                                                                    value='{{ auth()->user()->employee_id }}' required>
                                                                <button type="submit"
                                                                    class="btn btn-outline-success mb-2 me-1"><i
                                                                        class="uil-envelope-check"><span>Accept</span></i></button>
                                                            </form>
                                                        @elseif (Auth::user()->hasRole(['HrSupervisor']))
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Reason</span></i></a>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#comment{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Comment</span></i></a>
                                                        @endif
                                                    @elseif($request->status == 'Approved' && $request->confirmation != 'Confirmed')
                                                        @if (Auth::user()->employee_id == $request->employee_id)
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Reason</span></i></a>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#comment{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Comment</span></i></a>
                                                            <form method="POST"
                                                                action="{{ route('leaveRequests.update', $request->id) }}">
                                                                @method('PUT')
                                                                @csrf
                                                                <input type="text" hidden id="confirm"
                                                                    class="form-control" name="confirmation"
                                                                    value='Confirmed' required>
                                                                <button type="submit"
                                                                    class="btn btn-outline-primary mb-2 me-1"><i
                                                                        class="uil-envelope-check"><span>Confirm</span></i></button>
                                                            </form>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-primary mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#leaveReschedule{{ $request->id }}"><i
                                                                    class="uil-calendar-alt"><span>Reschedule</span></i></a>
                                                        @elseif (Auth::user()->hasRole(['HrSupervisor']))
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Reason</span></i></a>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#comment{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Comment</span></i></a>
                                                        @endif
                                                    @elseif($request->status == 'Declined')
                                                        @if (Auth::user()->employee_id == $request->employee_id)
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye">Reason</i></a>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#comment{{ $request->id }}"><i
                                                                    class="mdi mdi-eye">Comment</i></i></a>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-primary mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#leaveReschedule{{ $request->id }}"><i
                                                                    class="uil-calendar-alt"><span>Reschedule</span></i></a>
                                                        @elseif (Auth::user()->hasRole(['HrSupervisor']))
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
                                                        @endif
                                                    @elseif($request->status == 'Pending' && $request->delegatee_status == 'Accepted')
                                                        @if (Auth::user()->hasRole(['HrUser', 'SuperAdmin']))
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Reason</span></i></a>
                                                        @elseif (Auth::user()->hasRole(['HrSupervisor']))
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
                                                    @elseif($request->status == 'Pending' && $request->delegated_to == Auth::user()->employee_id)
                                                        @if ($request->delegatee_status == 'Declined')
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Reason</span></i></a>
                                                            <form method="POST"
                                                                action="{{ route('leaveRequests.update', $request->id) }}">
                                                                @method('PUT')
                                                                @csrf
                                                                <input type="text" hidden id="delegatee_status"
                                                                    class="form-control" name="delegatee_status"
                                                                    value='Accepted' required>
                                                                <button type="submit"
                                                                    class="btn btn-outline-success mb-2 me-1"><i
                                                                        class="uil-envelope-check"><span>Accept</span></i></button>
                                                            </form>
                                                        @elseif ($request->delegatee_status == null)
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-info mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reason{{ $request->id }}"><i
                                                                    class="mdi mdi-eye"><span>Reason</span></i></a>
                                                            <form method="POST"
                                                                action="{{ route('leaveRequests.update', $request->id) }}">
                                                                @method('PUT')
                                                                @csrf
                                                                <input type="text" hidden id="delegatee_status"
                                                                    class="form-control" name="delegatee_status"
                                                                    value='Accepted' required>
                                                                <button type="submit"
                                                                    class="btn btn-outline-success mb-2 me-1"><i
                                                                        class="uil-envelope-check"><span>Accept</span></i></button>
                                                            </form>
                                                            <a type="button" href="#"
                                                                class="btn btn-outline-danger mb-2 me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delegateedecline{{ $request->id }}"><i
                                                                    class="uil-envelope-block"><span>Decline</span></i></a>
                                                        @endif
                                                    @elseif($request->status == 'Pending' &&
                                                        $request->delegatee_status == 'Declined' &&
                                                        Auth::user()->employee_id == $request->employee_id)
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-info mb-2 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#comment{{ $request->id }}"><i
                                                                class="mdi mdi-eye">Comment</i></i></a>
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-primary mb-2 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#leaveReschedule{{ $request->id }}"><i
                                                                class="uil-calendar-alt"><span>Reschedule</span></i></a>
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
                //FETCH LEAVE TYPE DETAILS
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

                //CALCULATE LEAVE DAYS TO TAKE DURING INITIAL REQUEST
                $('#endDate').change(function() {
                    let start_date = (new Date($('#startDate').val())).getTime();
                    let end_date = (new Date($('#endDate').val())).getTime();
                    let difference = (end_date - start_date) / (1000 * 3600 * 24);
                    let daysInput = $('#length');
                    daysInput.val(difference);
                })

                //CALCULATE LEAVE DAYS TO TAKE DURING RESCHEDULING
                @foreach ($leaverequests as $key => $request)

                    $('#endDate{{ $request->id }}').change(function() {
                        let start_date = (new Date($('#startDate').val())).getTime();
                        let end_date = (new Date($('#endDate').val())).getTime();
                        let difference = (end_date - start_date) / (1000 * 3600 * 24);
                        let daysInput = $('#length');
                        daysInput.val(difference);
                    })
                @endforeach


                //STORE LEAVE REQUEST
                $('#leaveForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    swal({
                            title: 'Are you sure?',
                            text: 'No changes will be made to this request after submission to your delegatee!',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willConfirm) => {
                            if (willConfirm) {

                                $.ajax({
                                    type: 'POST',
                                    url: "{{ route('leaveRequests.store') }}",
                                    data: formData,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: (response) => {
                                        if (response.status === 'success') {
                                            iziToast.success({
                                                title: 'Good!',
                                                message: response.message,
                                                position: 'topRight'
                                            });
                                            $('#leaveForm').trigger('reset');
                                            $('#newRequest').modal('toggle');
                                        } else {
                                            swal('Error', `Oops! ${response.message}`, 'error');
                                            $('#newRequest').modal('toggle');
                                             setTimeout(function () {
                                                location.reload(true);
                                              }, 2000);
                                        }

                                    },
                                    error: function(response) {
                                        swal('Error', 'Oops! Something went wrong', 'error');

                                    }
                                });

                            } else {

                                return 0;
                            }
                        });
                });
            });
        </script>
    @endpush
</x-hr-layout>
