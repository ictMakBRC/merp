<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Units
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> MakBRC Departmental Units</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="#" class="btn btn-success mb-2 me-1"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add unit</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">

                    <div class="tab-content">
                        <div class="table-responsive" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table border-bottom border-primary mb-0 w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Unit Name</th>
                                        <th>Belongs To</th>
                                        <th>Department/Project Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($units as $key => $unit)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $unit->unit_name }}</td>
                                            <td>{{ $unit->belongs_to }}</td>
                                            <td>{{ $unit->department->department_name }}</td>
                                            <td>{{ $unit->description }}</td>
                                            @if ($unit->status == 'Inactive')
                                                <td><span class="badge bg-danger">Inactive</span></td>
                                            @else
                                                <td><span class="badge bg-success">Active</span></td>
                                            @endif
                                            <td>{{ date('d-m-Y', strtotime($unit->created_at)) }}</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-pencil" data-bs-toggle="modal"
                                                        data-bs-target="#editUnit{{ $unit->id }}"></i></a>
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-delete"></i></a>
                                            </td>
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
    <!-- ADD NEW unit Modal -->
    @include('humanResource.unitModal')
    <!-- UPDATE  unit Modal -->
    @foreach ($units as $key => $unit)
        <div class="modal fade" id="editUnit{{ $unit->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Unit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('hrunits.update', [$unit->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="row col-md-12">
                                    <div class="mb-3 col-md-6">
                                        <label for="department_id" class="form-label">Department/Project</label>
                                        <select class="form-select" id="department_id" name="department_id">
                                            <option selected value="{{ $unit->department->id }}">
                                                {{ $unit->department->department_name }}</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="unitName" class="form-label">Unit Name</label>
                                        <input type="text" id="unitName" class="form-control" name="unit_name"
                                            value="{{ $unit->unit_name }}">
                                    </div>
                                </div> <!-- end col -->
                                <div class="mb-3 col-md-6">
                                    <label for="belongs_to" class="form-label">Belongs to</label>
                                    <select class="form-select" id="belongs_to" name="belongs_to">
                                        <option value='{{ $unit->belongs_to }}' selected>{{ $unit->belongs_to }}
                                        </option>
                                        <option value='Department'>Department</option>
                                        <option value="Project">Project</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select class="form-select" id="is_active" name="status">
                                        <option selected value="{{ $unit->status }}">{{ $unit->status }}</option>
                                        <option value='Active'>Active</option>
                                        <option value='Inactive'>Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3" name="description">{{ $unit->description }}</textarea>
                                </div>
                            </div>
                            <!-- end row-->
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit">Update unit</button>
                            </div>
                        </form>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-hr-layout>
