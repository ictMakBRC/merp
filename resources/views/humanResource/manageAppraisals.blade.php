<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Appraisals
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-0">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">Employee Appraisals</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="{{ route('appraisals.create') }}"
                                    class="btn btn-success mb-2 me-1">New Appraisal</a>
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
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Period</th>
                                        <th>Submitted On</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appraisals as $key => $appraisal)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $appraisal->emp_id }}</td>
                                            <td>{{ $appraisal->employee->fullName }}</td>
                                            <td>{{ $appraisal->employee->department->department_name??'N/A' }}</td>
                                            <td>{{ $appraisal->employee->designation->name??'N/A' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($appraisal->start_date)) . ' To ' . date('d-m-Y', strtotime($appraisal->end_date)) }}
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($appraisal->created_at)) }}</td>
                                            <td class="table-action">
                                                <a href="{{ route('appraisals.download', ['id' => $appraisal->id]) }}"
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
