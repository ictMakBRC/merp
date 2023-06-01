<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Resignations
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-0">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">Employee Resignations</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="{{ route('resignations.create') }}"
                                    class="btn btn-success mb-2 me-1">New Resignation</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive" id="scroll-horizontal-preview">
                        <table id="datableButtons" class="table border-bottom border-primary mb-0 w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Emp_No</th>
                                    <th>Name</th>
                                    <th>Dept</th>
                                    <th>Designation</th>
                                    <th>Subject</th>
                                    <th>Submitted on</th>
                                    <th>Handover Date</th>
                                    <th>Letter</th>
                                    <th>Status</th>
                                    @if (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-create'))
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resignations as $key => $resignation)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $resignation->emp_id }}</td>
                                        <td>{{ $resignation->employee->fullName }}</td>
                                        <td>{{ $resignation->employee->department->department_name }}</td>
                                        <td>{{ $resignation->employee->designation->name }}</td>
                                        <td>{{ $resignation->subject }}</td>
                                        <td>{{ date('d-m-Y', strtotime($resignation->created_at)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($resignation->hand_over_date)) }}</td>
                                        <td class="table-action">
                                            <a href="{{ route('resignation.download', ['emp_id' => $resignation->emp_id, 'id' => $resignation->id]) }}"
                                                class="btn btn-outline-success"><i class=" uil-download-alt"></i></a>
                                        </td>
                                        @if ($resignation->status == 'Pending')
                                            <td><span class="badge bg-info">Pending</span></td>
                                        @elseif($resignation->status == 'Accepted')
                                            <td><span class="badge bg-success">Accepted</span></td>
                                        @else
                                            <td><span class="badge bg-danger">Declined</span></td>
                                        @endif
                                        @if (Auth::user()->hasRole(['HrAdmin', 'HrUser']))
                                            @if ($resignation->status == 'Pending' &&
                                                Auth::user()->hasRole(['HrAdmin']) &&
                                                Auth::user()->isAbleTo('employee-create') &&
                                                $resignation->employee_id != Auth::user()->employee_id)
                                                <td class="d-flex">
                                                    <a type="button" href="#"
                                                        class="btn btn-outline-success mb-2 me-1" data-bs-toggle="modal"
                                                        data-bs-target="#accept{{ $resignation->id }}">Accept</a>
                                                    <a type="button" href="#"
                                                        class="btn btn-outline-danger mb-2 me-1" data-bs-toggle="modal"
                                                        data-bs-target="#decline{{ $resignation->id }}">Decline</a>
                                                </td>
                                            @elseif($resignation->status != 'Pending')
                                                <td class="d-flex">
                                                    <a type="button" href="#"
                                                        class="btn btn-outline-info mb-2 me-1" data-bs-toggle="modal"
                                                        data-bs-target="#comment{{ $resignation->id }}"><i
                                                            class="mdi mdi-eye"></i></a>

                                                    @if ($resignation->status == 'Declined' &&
                                                        Auth::user()->hasRole(['HrAdmin']) &&
                                                        Auth::user()->isAbleTo('employee-create') &&
                                                        $resignation->employee_id != Auth::user()->employee_id)
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-success mb-2 me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#accept{{ $resignation->id }}">Accept</a>
                                                </td>
                                            @endif
                                        @endif
                                @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end preview-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    <!-- REASON FOR ACCEPTING MODAL -->
    @foreach ($resignations as $key => $resignation)
        <div class="modal fade" id="accept{{ $resignation->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Acceptance Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('resignations.update', $resignation->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" hidden id="status" class="form-control" name="status"
                                        value='Accepted' required>
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea class="form-control" id="comment" rows="3" name="comment">{{ old('comment', '') }}</textarea>
                                    </div>
                                    <input type="text" id="approved_by" hidden class="form-control"
                                        value="{{ Auth::user()->employee_id }}" name="approved_by">
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
    <!-- REASON FOR DECLINE MODAL -->
    @foreach ($resignations as $key => $resignation)
        <div class="modal fade" id="decline{{ $resignation->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Rejection Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('resignations.update', $resignation->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" hidden id="status" class="form-control" name="status"
                                        value='Declined' required>
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea class="form-control" id="comment" rows="3" name="comment">{{ old('comment', '') }}</textarea>
                                    </div>
                                    <input type="text" id="approved_by" hidden class="form-control"
                                        value="{{ Auth::user()->employee_id }}" name="approved_by">
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
    @foreach ($resignations as $key => $resignation)
        <div class="modal fade" id="comment{{ $resignation->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                            <p>{{ $resignation->comment }}</p>
                            <hr>
                            @if ($resignation->approver != null)
                                <p style="text-align: right">
                                    <strong>
                                        @if ($resignation->status == 'Approved')
                                            Approved By:
                                        @else
                                            Declined By:
                                        @endif
                                    </strong>
                                    {{ $resignation->approver->fullName . '(' . date('d-m-Y', strtotime($resignation->updated_at)) . ')' }}
                                </p>
                            @endif

                        </div>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-hr-layout>
