<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Employee Exit Interviews
                    <x-slot:buttons>

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
                                        <th>Employee</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Date Submitted</th>
                                        <th>Interview File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exitInterviews as $key => $exitInterview)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $exitInterview->emp_id }}</td>
                                            <td>{{ $exitInterview->employee->fullName }}</td>
                                            <td>{{ $exitInterview->employee->department->department_name }}</td>
                                            <td>{{ $exitInterview->employee->designation->name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($exitInterview->created_at)) }}</td>
                                            <td class="table-action">
                                                <a href="{{ route('exitInterviews.download', ['id' => $exitInterview->id]) }}"
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
