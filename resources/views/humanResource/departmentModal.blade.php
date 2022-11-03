<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New
                    @if (Route::is('projects.view'))
                        Project
                    @else
                        Department/Project
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="POST" action="{{ route('hrdepartments.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="parent_deparment" class="form-label">Parent Department</label>
                            <select class="form-select" id="parent_deparment" name="parent_department">
                                @if (Route::is('projects.view'))
                                    <option value="">None</option>
                                @else
                                    <option selected value="">Select</option>
                                    <option value="">None</option>
                                    @foreach ($departments as $key => $department)
                                        <option value='{{ $department->id }}'>{{ $department->department_name }}
                                        </option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="departmentName" class="form-label">
                                @if (Route::is('projects.view'))
                                    Project Name
                                @else
                                    Department/Project/Unit Name
                                @endif
                            </label>
                            <input type="text" id="departmentName" class="form-control" name="department_name"
                                value="{{ old('department_name', '') }}">
                            <input type="text" id="autonumber" hidden class="form-control" name="autonumber"
                                value="100">
                        </div> <!-- end col -->

                        <div class="mb-3 col-md-4">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type">
                                @if (Route::is('projects.view'))
                                    <option value='Project'>Project</option>
                                @else
                                    <option selected value="">Select</option>
                                    <option value='Department'>Department</option>
                                    <option value='Unit'>Unit</option>
                                    <option value='Sub-Unit'>Sub-Unit</option>
                                    <option value='Laboratory'>Laboratory</option>
                                    <option value='Project'>Project</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="prefix" class="form-label">
                                Prefix
                            </label>
                            <input type="text" id="prefix" class="form-control" name="prefix"
                                value="{{ old('prefix', '') }}">
                        </div>
                        <div class="mb-3 col-md-4">
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
                        <button class="btn btn-success" type="submit"> Create Department</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
