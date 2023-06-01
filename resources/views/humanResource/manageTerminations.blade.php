<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Terminations
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-0">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">Employee Terminations</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                @if (Auth::user()->hasRole(['HrAdmin']))
                                    <a type="button" href="{{ route('terminations.create') }}"
                                        class="btn btn-success mb-2 me-1">New termination</a>
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
                                        <th>Submitted on</th>
                                        <th>Effective</th>
                                        <th>Letter</th>
                                        {{-- <th>Status</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($terminations as $key => $termination)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $termination->emp_id }}</td>
                                            <td>{{ $termination->employee->fullName }}</td>
                                            <td>{{ $termination->employee->department->department_name }}</td>
                                            <td>{{ $termination->employee->designation->name }}</td>
                                            <td>{{ $termination->reason }}</td>
                                            <td>{{ date('d-m-Y', strtotime($termination->created_at)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($termination->termination_date)) }}</td>
                                            <td class="table-action">
                                                <a href="{{ route('termination.download', ['emp_id' => $termination->emp_id, 'id' => $termination->id]) }}"
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
