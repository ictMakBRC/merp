<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New holiday</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="POST" action="{{ route('holidays.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="holidayName" class="form-label">Holiday Name</label>
                                <input type="text" id="holidayName" class="form-control" name="title"
                                    value="{{ old('title', '') }}" required>
                            </div>
                        </div> <!-- end col -->
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="holiday_type" required>
                                <option selected value="">Select</option>
                                <option value='Public Holiday'>Public Holiday</option>
                                <option value='Company Holiday'>Company Holiday</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" id="startDate" class="form-control" name="start_date"
                                value="{{ old('start_date', '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" id="endDate" class="form-control" name="end_date"
                                value="{{ old('end_date', '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control" id="details" rows="3" name="details">{{ old('details', '') }}</textarea>
                        </div>
                    </div>
                    <!-- end row-->
                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-success" type="submit"> Add Holiday</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
