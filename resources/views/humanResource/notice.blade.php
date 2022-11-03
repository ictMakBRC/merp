<div class="modal fade" id="notice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="POST" id="noticeForm">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="notice" class="form-label">Notice</label>
                            <textarea class="form-control" id="notice" rows="10" name="notice" required>{{ old('notice', '') }}</textarea>
                            <div class="text-danger" id="notice_validation_message">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="audience" class="form-label">Audience</label>
                            <select class="form-select" id="audience" name="audience" required>
                                <option selected value="">Select</option>
                                <option value="0">All</option>
                                @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                                
                            </select>
                            <div class="text-danger" id="audience_validation_message">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="send_email" class="form-label">Email Notice</label>
                            <select class="form-select" id="send_email" name="send_email" required >
                                <option selected value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="expires_on" class="form-label">
                                Expires On</label>
                            <input type="date" id="expires_on" class="form-control" name="expires_on"
                                value="{{ old('expires_on', '') }}" required>
                                <div class="text-danger" id="expires_validation_message">
                                </div>
                        </div>
                    </div>
                    <!-- end row-->
                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-success" type="submit"> Create Notice</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
