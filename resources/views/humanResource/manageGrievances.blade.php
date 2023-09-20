<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Grievances
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">Employee Grievances</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="{{ route('grievances.create') }}"
                                    class="btn btn-success mb-2 me-1">New Grievance</a>
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
                                        <th>Employee</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Grievance Type</th>
                                        <th>Description</th>
                                        <th>Date Submitted</th>
                                        <th>Support File</th>
                                        <th>Status</th>
                                        @if (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-create'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grievances as $key => $grievance)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $grievance->emp_id }}</td>
                                            <td>{{ $grievance->employee->fullName }}</td>
                                            <td>{{ $grievance->employee->department->department_name??'N/A' }}</td>
                                            <td>{{ $grievance->employee->designation->name??'N/A' }}</td>
                                            <td>{{ $grievance->grievance_type }}</td>
                                            <td class="table-action">
                                                <a type="button" href="#" class="btn btn-outline-info mb-2 me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#viewGrievance{{ $grievance->id }}"><i
                                                        class="mdi mdi-eye"></i></a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($grievance->created_at)) }}</td>
                                            <td class="table-action">
                                                @if ($grievance->support_file != null)
                                                    <a href="{{ route('grievance.download', ['emp_id' => $grievance->emp_id, 'id' => $grievance->id]) }}"
                                                        class="btn btn-outline-success"><i
                                                            class=" uil-download-alt"></i></a>
                                                @else
                                                    {{ __('N/A') }}
                                                @endif
                                            </td>
                                            @if ($grievance->status == 'Pending')
                                                <td><span class="badge bg-info">Pending</span></td>
                                            @else
                                                <td><span class="badge bg-success">Resolved</span></td>
                                            @endif
                                            @if ($grievance->status == 'Pending' &&
                                                Auth::user()->hasRole(['HrAdmin']) &&
                                                Auth::user()->isAbleTo('employee-create') &&
                                                $grievance->employee_id != Auth::user()->employee_id)
                                                <td class="d-flex">
                                                    <a type="button" href="#"
                                                        class="btn btn-outline-success mb-2 me-1" data-bs-toggle="modal"
                                                        data-bs-target="#resolved{{ $grievance->id }}">Mark as
                                                        Resolved</a>
                                                </td>
                                            @elseif($grievance->status == 'Pending' && Auth::user()->hasRole(['HrSupervisor']))
                                                <td class="d-flex">
                                                    <a type="button" href="#"
                                                        class="btn btn-outline-success mb-2 me-1" data-bs-toggle="modal"
                                                        data-bs-target="#resolved{{ $grievance->id }}">Mark as
                                                        Resolved</a>
                                                </td>
                                            @elseif(($grievance->status == 'Resolved' && Auth::user()->hasRole(['HrAdmin', 'HrSupervisor'])) ||
                                                $grievance->employee_id == Auth::user()->employee_id)
                                                <td class="d-flex">
                                                    <a type="button" href="#"
                                                        class="btn btn-outline-info mb-2 me-1" data-bs-toggle="modal"
                                                        data-bs-target="#comment{{ $grievance->id }}"><i
                                                            class="mdi mdi-eye">Comment</i></a>
                                                </td>
                                            @endif
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
    <!-- REASON FOR DECLINE MODAL -->
    @foreach ($grievances as $key => $grievance)
        <div class="modal fade" id="resolved{{ $grievance->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Comment About Resolution</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('grievances.update', $grievance->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" hidden id="status" class="form-control" name="status"
                                        value='Resolved' required>
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea class="form-control" id="comment" rows="3" name="comment">{{ old('comment', '') }}</textarea>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit">Submit Comment</button>
                            </div>
                        </form>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
    <!-- VIEW COMMENT MODAL -->
    @foreach ($grievances as $key => $grievance)
        <div class="modal fade" id="comment{{ $grievance->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                            <p>{{ $grievance->comment }}</p>

                            <hr>
                            {{-- <h5 class="alert-heading">From Human Resource</h5> --}}
                        </div>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
    @foreach ($grievances as $key => $grievance)
        <div class="modal fade" id="viewGrievance{{ $grievance->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Description</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                            <p>{{ $grievance->description }}</p>

                            <hr>
                            {{-- <h5 class="alert-heading">From Human Resource</h5> --}}
                        </div>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-hr-layout>
