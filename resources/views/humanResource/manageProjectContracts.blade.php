<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Project Contracts
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> MakBRC Official Employee Projects Contracts
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table border-bottom border-primary mb-0 w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Emp_No</th>
                                        <th>Project</th>
                                        <th>Position</th>
                                        <th>FTE</th>
                                        <th>GP</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Status</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contracts as $key => $contract)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $contract->employee->fullName }}</td>
                                            <td>{{ $contract->employee->emp_id }}</td>
                                            <td>{{ $contract->project->department_name }}</td>
                                            <td>{{ $contract->position->name }}</td>
                                            <td>{{ $contract->fte ? $contract->fte : 'N/A' }}</td>
                                            <td>
                                                @if (Auth::user()->employee_id === $contract->employee_id ||
                                                    (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-manage')))
                                                    {{ number_format($contract->gross_salary, 2) }}({{$contract->currency}})
                                                @else
                                                    <i class="uil-padlock"></i>
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($contract->start_date)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($contract->end_date)) }}</td>
                                            @if ($contract->status == 'Expired')
                                                <td><span class="badge bg-danger">{{ $contract->status }}</span></td>
                                            @elseif($contract->status == 'Running')
                                                <td><span class="badge bg-success">{{ $contract->status }}</span></td>
                                            @elseif($contract->status == 'Terminated')
                                                <td><span class="badge bg-warning">{{ $contract->status }}</span></td>
                                            @endif
                                            <td class="table-action">
                                                @if (Auth::user()->employee_id === $contract->employee_id ||
                                                    (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-manage')))
                                                    <a href="{{ route('projectcontract.download', ['emp_id' => $contract->employee->emp_id . $contract->project->department_name, 'id' => $contract->id]) }}"
                                                        class="btn btn-outline-success"><i
                                                            class=" uil-download-alt"></i></a>
                                                @else
                                                    <i class="uil-padlock"></i>
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
