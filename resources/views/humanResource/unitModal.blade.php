<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="POST" action="{{ route('hrunits.store') }}">
                    @csrf
                    <div class="row">
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-6">
                                <label for="department_id" class="form-label">Department/Project</label>
                                <select class="form-select" id="department_id" name="department_id">
                                    <option selected value="">Select</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="unitName" class="form-label">
                                    Unit Name</label>
                                <input type="text" id="unitName" class="form-control" name="unit_name"
                                    value="{{ old('unit_name', '') }}">
                            </div>
                        </div> <!-- end col -->
                        <div class="mb-3 col-md-6">
                            <label for="belongs_to" class="form-label">Belongs to</label>
                            <select class="form-select" id="belongs_to" name="belongs_to">
                                <option value=''>Select</option>
                                <option value='Department'>Department</option>
                                <option selected value="Project">Project</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="is_active" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="status">
                                <option selected value="">Select</option>
                                <option value='Active'>Active</option>
                                <option value='Inactive'>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description">{{ old('description', '') }}</textarea>
                        </div>
                    </div>
                    <!-- end row-->
                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-success" type="submit"> Create unit</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
