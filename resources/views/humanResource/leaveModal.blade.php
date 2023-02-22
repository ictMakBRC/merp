<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Leave Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="POST" action="{{ route('leaves.store') }}">
                    @csrf
                    <div class="row">
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-4">
                                <label for="leaveName" class="form-label">Type</label>
                                <input type="text" id="leaveName" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="duration" class="form-label">Days</label>
                                <input type="number" id="duration" class="form-control" name="duration" required>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="carry_forward" class="form-label">Carry Foward</label>
                                <select class="form-select" id="carry_forward" name="carriable" required>
                                    <option selected value="">Select</option>
                                    <option value='No'>No</option>
                                    <option value='Yes'>Yes</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="is_payable" class="form-label">Paid?</label>
                                <select class="form-select" id="is_payable" name="is_payable" required>
                                    <option selected value="">Select</option>
                                    <option value='Yes'>Yes</option>
                                    <option value='No'>No</option>
                                </select>
                            </div>

                        </div> <!-- end col -->
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-3">
                                <label for="payment_type" class="form-label">Payment Type</label>
                                <select class="form-select" id="payment_type" name="payment_type" required>
                                    <option selected value="">Select</option>
                                    <option value='Full Pay'>Full Pay</option>
                                    <option value='Half Pay'>Half Pay</option>
                                    <option value='Quarter Pay'>Quarter Pay</option>
                                    <option value='No Pay'>No Pay</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="given_to" class="form-label">Given To</label>
                                <select class="form-select" id="given_to" name="given_to" required>
                                    <option selected value="">Select</option>
                                    <option value='All'>All</option>
                                    <option value='Male'>Male</option>
                                    <option value='Female'>Female</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="notice_days" class="form-label">Notice Days</label>
                                <input type="number" id="notice_days" class="form-control" name="notice_days" required>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="status2" class="form-label">Status</label>
                                <select class="form-select" id="status2" name="status" required>
                                    <option selected value="">Select</option>
                                    <option value='Active'>Active</option>
                                    <option value='Inactive'>Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="details" class="form-label">Details</label>
                                <textarea class="form-control" id="details" rows="5" name="details"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->
                    {{-- <div class="d-grid mb-0 text-center">
                        <button class="btn btn-success" type="submit"> Add leave</button>
                    </div> --}}
                </form>
                @include('layouts.inc.form-submit')
            </div>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
