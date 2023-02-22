<!-- EDIT request Modal -->
<div class="modal fade" id="newRequest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Leave request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="POST" id="leaveForm">
                    @csrf
                    <div class="row">
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-6">
                                <label for="leavetype" class="form-label">Leave Type</label>
                                <select class="form-select" id="leavetype" name="leave_id" required>
                                    <option selected value="">Select</option>
                                    @foreach ($leaveTypes as $leaveType)
                                        <option value='{{ $leaveType->id }}'>{{ $leaveType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="credits" class="form-label">Credits Available</label>
                                <input type="number" id="credits" class="form-control" name="available_credits"
                                    readonly>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="notice_days" class="form-label">Days of Notice</label>
                                <input type="number" id="notice_days" class="form-control" name="notice_days" readonly>
                            </div>

                        </div> <!-- end col -->
                    </div>
                    <div class="row">
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-3">
                                <label for="startDate" class="form-label">From</label>
                                <input type="date" id="startDate" class="form-control" name="start_date">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="endDate" class="form-label">To</label>
                                <input type="date" id="endDate" class="form-control" name="end_date">
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="length" class="form-label">Days</label>
                                <input type="number" id="length" class="form-control" name="length" required
                                    readonly>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="delegated_to" class="form-label">Duties Delegated to</label>
                                <select class="form-select" id="delegated_to" name="delegated_to" required>
                                    <option selected value="">Select</option>
                                    @foreach ($deptEmployees as $deptEmployee)
                                        <option value='{{ $deptEmployee->id }}'>{{ $deptEmployee->fullName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-5">
                                <label for="reason" class="form-label">Reason For Leave</label>
                                <textarea class="form-control" id="reason" rows="5" name="reason"></textarea>
                            </div>
                            <div class="mb-3 col-md-7">
                                <label for="duties_delegated" class="form-label">Duties Delegated</label>
                                <textarea class="form-control" id="duties_delegated" rows="5" name="duties_delegated"></textarea>
                            </div>

                        </div>
                    </div>
                    <!-- end row-->
                    {{-- <div class="d-grid mb-0 text-center">
                        <button class="btn btn-success" type="submit" id="submitBtn">Submit</button>
                    </div> --}}
                    @include('layouts.inc.form-submit')
                </form>
            </div>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
