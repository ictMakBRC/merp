<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    All Employees
                    <x-slot:buttons>
                        @if (Auth::user()->isAbleTo('employee-create'))
                                <a href="{{ route('employees.create') }}" class="btn btn-success mb-2 me-1"><i class="mdi mdi-plus me-1"></i>New</a>
                            @endif
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table id="datableButtons" class="table {!! Auth::user()->color_scheme === 'true' ? '' : 'table-striped' !!} mb-0 w-100 ">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Emp-No</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Work Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $key => $employee)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $employee->emp_id }}</td>
                                            <td>{{ $employee->fullName }}</td>
                                            <td>{{ $employee->gender }}</td>
                                            <td>{{ $employee->contact }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->designation ? $employee->designation->name : 'N/A' }}</td>
                                            <td>{{ $employee->department ? $employee->department->department_name : 'N/A' }}
                                            </td>
                                            <td>{{ $employee->work_type }}</td>
                                            @if ($employee->status != 'Active')
                                                <td><span class="badge bg-danger">{{ $employee->status }}</span></td>
                                            @else
                                                <td><span class="badge bg-success">Active</span></td>
                                            @endif
                                            <td class="table-action">
                                                <a href="{{ route('employees.show', $employee->id) }}"
                                                    class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                @if (Auth::user()->isAbleTo('employee-create'))
                                                    <a href="{{ route('employees.edit', [$employee->id]) }}"
                                                        class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                    {{-- <a  onclick="return confirm('Are you sure you want to delete?');" href="{{route('employees.destroy',[$employee->id])}}" class="action-icon"> <i class="mdi mdi-delete"></i></a> --}}
                                                @endif
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
</x-hr-layout>
