<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Departments
                    <x-slot:buttons>
                        <a type="button" href="#" class="btn btn-success mb-2 me-1"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Department</a>
                    </x-slot>
                </x-card-header>
                
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table border-bottom border-primary mb-0 w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Department Name</th>
                                        <th>Type</th>
                                        <th>Parent</th>
                                        <th>Prefix</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $key => $department)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $department->department_name }}</td>
                                            <td>{{ $department->type }}</td>
                                            @if ($department->Parent != null)
                                                <td>{{ $department->parent->department_name }}</td>
                                            @else
                                                <td>N/A</td>
                                            @endif
                                            <td>{{ $department->prefix }}</td>
                                            <td>{{ $department->description }}</td>
                                            @if ($department->status == 'Inactive')
                                                <td><span class="badge bg-danger">Inactive</span></td>
                                            @else
                                                <td><span class="badge bg-success">Active</span></td>
                                            @endif
                                            <td>{{ date('d-m-Y', strtotime($department->created_at)) }}</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-pencil" data-bs-toggle="modal"
                                                        data-bs-target="#editDept{{ $department->id }}"></i></a>
                                                {{-- <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a> --}}
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
    <!-- ADD NEW DEPARTMENT Modal -->
    @include('humanResource.departmentModal')
    <!-- UPDATE  DEPARTMENT Modal -->
    @foreach ($departments as $key => $department)
        <div class="modal fade" id="editDept{{ $department->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('hrdepartments.update', [$department->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="row ">
                                    <div class="mb-3 col-md-8">
                                        <label for="departmentName" class="form-label">Department Name</label>
                                        <input type="text" id="departmentName" class="form-control"
                                            value="{{ $department->department_name }}" name="department_name">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="parent_dept" class="form-label">Parent Department</label>
                                        <select class="form-select" id="parent_dept" name="parent_department">

                                            @if ($department->Parent != null)
                                                <option selected value="{{ $department->parent->id }}">
                                                    {{ $department->parent->department_name }}</option>
                                            @else
                                                <option selected value="">none</option>
                                            @endif
                                            @foreach ($parents as $key => $parent)
                                                <option value='{{ $parent->id }}'>{{ $parent->department_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="type" class="form-label">Type</label>
                                        <select class="form-select" id="type" name="type">
                                            <option selected value="{{ $department->type }}">{{ $department->type }}
                                            </option>
                                            <option value='Department'>Department</option>
                                            <option value='Unit'>Unit</option>
                                            <option value='Sub-Unit'>Sub-Unit</option>
                                            <option value='Laboratory'>Laboratory</option>
                                            <option value='Project'>Project</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="prefix" class="form-label">
                                            Prefix
                                        </label>
                                        <input type="text" id="prefix" class="form-control" name="prefix"
                                            value="{{ $department->prefix }}" readonly>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="is_active" class="form-label">Status</label>
                                        <select class="form-select" id="is_active" name="status">
                                            <option selected value="{{ $department->status }}">
                                                {{ $department->status }}</option>
                                            <option value='Active'>Active</option>
                                            <option value='Inactive'>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" rows="3" name="description">{{ $department->description }}</textarea>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
                            {{-- <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit">Update Department</button>
                            </div> --}}
                            @include('layouts.inc.form-submit')
                        </form>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-hr-layout>
