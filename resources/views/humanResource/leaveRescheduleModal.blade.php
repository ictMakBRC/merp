<!-- EDIT request Modal -->
@foreach ($leaverequests as $key => $request)
    <div class="modal fade" id="leaveReschedule{{ $request->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Leave request Reschedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('leaveRequests.update', $request->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="row col-md-12">
                                <div class="mb-3 col-md-6">
                                    <label for="leavetype" class="form-label">Leave Type</label>
                                    <select class="form-select" id="leavetype" name="leave_id" required>
                                        <option selected value="{{ $request->leave->id }}">{{ $request->leave->name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="credits{{ $request->id }}" class="form-label">Credits Available</label>
                                    <input type="number" id="credits{{ $request->id }}" class="form-control"
                                        name="available_credits" value="{{ $request->leave->duration }}" readonly>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="notice_days{{ $request->id }}" class="form-label">Days of
                                        Notice</label>
                                    <input type="number" id="notice_days{{ $request->id }}" class="form-control"
                                        name="notice_days" value="{{ $request->leave->notice_days }}" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="row col-md-12">
                                <div class="mb-3 col-md-3">
                                    <label for="startDate{{ $request->id }}" class="form-label">From</label>
                                    <input type="date" id="startDate{{ $request->id }}" class="form-control"
                                        name="start_date" value="{{ $request->start_date }}">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="endDate{{ $request->id }}" class="form-label">To</label>
                                    <input type="date" id="endDate{{ $request->id }}" class="form-control"
                                        name="end_date" value="{{ $request->end_date }}">
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label for="length{{ $request->id }}" class="form-label">Days</label>
                                    <input type="number" id="length{{ $request->id }}" class="form-control"
                                        name="length" required value="{{ $request->length }}" readonly>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="delegated_to{{ $request->id }}" class="form-label">Duties Delegated
                                        to</label>
                                    <select class="form-select" id="delegated_to{{ $request->id }}"
                                        name="delegated_to" required>
                                        @if ($request->delegatedto != null)
                                            <option selected value="{{ $request->delegatedto->id }}">
                                                {{ $request->delegatedto->fullName }}</option>
                                        @endif
                                        @foreach ($deptEmployees as $deptEmployee)
                                            <option value='{{ $deptEmployee->id }}'>{{ $deptEmployee->fullName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="mb-3 col-md-6">
                                    <label for="reason{{ $request->id }}" class="form-label">Reason For Leave</label>
                                    <textarea class="form-control" id="reason{{ $request->id }}" rows="5" name="reason">{{ $request->reason }}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="duties_delegated{{ $request->id }}" class="form-label">Duties
                                        Delegated</label>
                                    <textarea class="form-control" id="duties_delegated{{ $request->id }}" rows="5" name="duties_delegated">{{ $request->duties_delegated }}</textarea>
                                </div>
                            </div>
                        </div>
                        <input type="text" hidden id="reschedule{{ $request->id }}" class="form-control"
                            name="reschedule" value='rescheduling' required>
                        <!-- end row-->
                        {{-- <div class="d-grid mb-0 text-center">
                            <button class="btn btn-success" type="submit" id="submitBtn{{ $request->id }}">Submit</button>
                        </div> --}}
                        @include('layouts.inc.form-submit')
                    </form>
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
@endforeach
