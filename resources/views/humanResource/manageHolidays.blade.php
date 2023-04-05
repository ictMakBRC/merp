<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Holidays
                    <x-slot:buttons>
                        <a type="button" href="#" class="btn btn-success mb-2 me-1"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Holiday</a>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table border-bottom border-primary mb-0 w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Details</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($holidays as $key => $holiday)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $holiday->title }}</td>
                                            <td>{{ $holiday->holiday_type }}</td>
                                            <td>{{ $holiday->details }}</td>
                                            <td>{{ date('d-m-Y', strtotime($holiday->start_date)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($holiday->end_date)) }}</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-pencil" data-bs-toggle="modal"
                                                        data-bs-target="#editHoliday{{ $holiday->id }}"></i></a>
                                                {{-- <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-delete"></i></a> --}}
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
    <!-- ADD NEW holiday Modal -->
    @include('humanResource.holidayModal')
    <!-- UPDATE  holiday Modal -->
    @foreach ($holidays as $key => $holiday)
        <div class="modal fade" id="editHoliday{{ $holiday->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update holiday</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('holidays.update', [$holiday->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="holidayName" class="form-label">Holiday Name</label>
                                        <input type="text" id="holidayName" class="form-control" name="title"
                                            value="{{ $holiday->title }}" required>
                                    </div>
                                </div> <!-- end col -->
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="holiday_type" required>
                                        <option selected value="{{ $holiday->holiday_type }}">
                                            {{ $holiday->holiday_type }}</option>
                                        <option value='Public Holiday'>Public Holiday</option>
                                        <option value='Company Holiday'>Company Holiday</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" id="startDate" class="form-control" name="start_date"
                                        value="{{ $holiday->start_date }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" id="endDate" class="form-control" name="end_date"
                                        value="{{ $holiday->end_date }}">
                                </div>
                                <div class="mb-3">
                                    <label for="details" class="form-label">Details</label>
                                    <textarea class="form-control" id="details" rows="3" name="details">{{ $holiday->details }}</textarea>
                                </div>
                            </div>
                            <!-- end row-->
                            {{-- <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit">Update Holiday</button>
                            </div> --}}
                            @include('layouts.inc.form-submit')
                        </form>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-hr-layout>
