<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Leave Types
                    <x-slot:buttons>
                        <a type="button" href="#" class="btn btn-success mb-2 me-1"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add leave</a>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table border-bottom border-primary mb-0 w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Duration</th>
                                        <th>Carriable Foward</th>
                                        <th>Is_Payable</th>
                                        <th>Payment Type</th>
                                        <th>Given To</th>
                                        <th>Days of Notice</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $key => $leave)
                                        <tr class="border-bottom border-primary">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $leave->name }}</td>
                                            <td>{{ $leave->duration }}</td>
                                            <td>{{ $leave->carriable }}</td>
                                            <td>{{ $leave->is_payable }}</td>
                                            <td>{{ $leave->payment_type }}</td>
                                            <td>{{ $leave->given_to }}</td>
                                            <td>{{ $leave->notice_days }}</td>
                                            <td>{{ $leave->details ? $leave->details : 'N/A' }}</td>
                                            @if ($leave->status == 'Inactive')
                                                <td><span class="badge bg-danger">Inactive</span></td>
                                            @else
                                                <td><span class="badge bg-success">Active</span></td>
                                            @endif
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-pencil" data-bs-toggle="modal"
                                                        data-bs-target="#editleave{{ $leave->id }}"></i></a>
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
    <!-- ADD NEW leave Modal -->
    @include('humanResource.leaveModal')
    <!-- UPDATE  leave Modal -->
    @foreach ($leaves as $key => $leave)
        <div class="modal fade" id="editleave{{ $leave->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update leave</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('leaves.update', [$leave->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="row col-md-12">
                                    <div class="mb-3 col-md-4">
                                        <label for="leaveName" class="form-label">Type</label>
                                        <input type="text" id="leaveName" class="form-control" name="name"
                                            value="{{ $leave->name }}" required>
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="duration" class="form-label">Days</label>
                                        <input type="number" id="duration" class="form-control" name="duration"
                                            value="{{ $leave->duration }}" required>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="carry_forward" class="form-label">Carry Foward</label>
                                        <select class="form-select" id="carry_forward" name="carriable">
                                            <option selected value="{{ $leave->carriable }}">{{ $leave->carriable }}
                                            </option>
                                            <option value='No'>No</option>
                                            <option value='Yes'>Yes</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="is_payable" class="form-label">Paid?</label>
                                        <select class="form-select" id="is_payable" name="is_payable" required>
                                            <option selected value="{{ $leave->is_payable }}">{{ $leave->is_payable }}
                                            </option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                        </select>
                                    </div>

                                </div> <!-- end col -->
                                <div class="row col-md-12">
                                    <div class="mb-3 col-md-3">
                                        <label for="payment_type" class="form-label">Payment Type</label>
                                        <select class="form-select" id="payment_type" name="payment_type">
                                            <option selected value="{{ $leave->payment_type }}">
                                                {{ $leave->payment_type }}</option>
                                            <option value='Full Pay'>Full Pay</option>
                                            <option value='Half Pay'>Half Pay</option>
                                            <option value='Quarter Pay'>Quarter Pay</option>
                                            <option value='No Pay'>No Pay</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="given_to" class="form-label">Given To</label>
                                        <select class="form-select" id="given_to" name="given_to" required>
                                            <option selected value="{{ $leave->given_to }}">{{ $leave->given_to }}
                                            </option>
                                            <option value='All'>All</option>
                                            <option value='Male'>Male</option>
                                            <option value='Female'>Female</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="notice_days" class="form-label">Notice Days</label>
                                        <input type="number" id="notice_days" class="form-control"
                                            name="notice_days" value="{{ $leave->notice_days }}" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="status2" class="form-label">Status</label>
                                        <select class="form-select" id="status2" name="status" required>
                                            <option selected value="{{ $leave->status }}">{{ $leave->status }}
                                            </option>
                                            <option value='Active'>Active</option>
                                            <option value='Inactive'>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="details" class="form-label">Details</label>
                                        <textarea class="form-control" id="details" rows="5" name="details">{{ $leave->details }}</textarea>
                                    </div>

                                </div>

                            </div>
                            <!-- end row-->
                            {{-- <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit">Update leave</button>
                            </div> --}}
                            @include('layouts.inc.form-submit')
                        </form>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-hr-layout>
