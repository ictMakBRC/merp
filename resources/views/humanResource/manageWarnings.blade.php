<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Employee Warnings
                    <x-slot:buttons>
                        @if (Auth::user()->hasRole(['HrAdmin']))
                        <a type="button" href="{{ route('warnings.create') }}"
                            class="btn btn-success mb-2 me-1">New Warning</a>
                    @endif
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table border-bottom border-primary mb-0 w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Emp_No</th>
                                        <th>Name</th>
                                        <th>Dept</th>
                                        <th>Designation</th>
                                        <th>Type</th>
                                        <th>Submitted On</th>
                                        <th>Letter</th>
                                        {{-- <th>Status</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($warnings as $key => $warning)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $warning->emp_id }}</td>
                                            <td>{{ $warning->employee->fullName }}</td>
                                            <td>{{ $warning->employee->department->department_name }}</td>
                                            <td>{{ $warning->employee->designation->name }}</td>
                                            <td>{{ $warning->reason }}</td>
                                            <td>{{ date('d-m-Y', strtotime($warning->created_at)) }}</td>
                                            <td class="table-action">
                                                <a href="{{ route('warning.download', ['emp_id' => $warning->emp_id, 'id' => $warning->id]) }}"
                                                    class="btn btn-outline-success"><i
                                                        class=" uil-download-alt"></i></a>
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
</x-hr-layout>
