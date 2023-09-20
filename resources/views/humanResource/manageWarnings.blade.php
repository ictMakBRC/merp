<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Warnings
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-0">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">Employee Warnings</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                @if (Auth::user()->hasRole(['HrAdmin']))
                                    <a type="button" href="{{ route('warnings.create') }}"
                                        class="btn btn-success mb-2 me-1">New Warning</a>
                                @endif
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
                                            <td>{{ $warning->employee->department->department_name??'N/A' }}</td>
                                            <td>{{ $warning->employee->designation->name??'N/A' }}</td>
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
