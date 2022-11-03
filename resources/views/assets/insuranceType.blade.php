<x-asset-layout>
    <!-- start page title -->
    <x-page-title>
        Insurance Types
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> Insurance Types</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="addStation.html" class="btn btn-success mb-2 me-1"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Type</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Insurance Type</th>
                                        <th>Description</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $key => $type)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $type->type }}</td>
                                            <td>{{ $type->description }}</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-pencil" data-bs-toggle="modal"
                                                        data-bs-target="#editType{{ $type->id }}"></i></a>
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-delete"></i></a>
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

    <!-- ADD NEW INSURANCE TYPE Modal -->
    @include('assets.insuranceModal')
    <!-- EDIT INSURANCE TYPE Modal -->
    @foreach ($types as $key => $type)
        <div class="modal fade" id="editType{{ $type->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Insurance Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('insurancetypes.update', [$type->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="insuranceType" class="form-label">Insurance Type</label>
                                        <input type="text" id="insuranceType" class="form-control"
                                            value="{{ $type->type }}" name="type">
                                    </div>
                                    <div class="mb-3">
                                        <label for="insuranceType" class="form-label">Description</label>
                                        <textarea type="text" id="insuranceType" class="form-control" name="description">{{ $type->description }}</textarea>
                                    </div>
                                </div> <!-- end col -->

                            </div>
                            <!-- end row-->
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>

                        </form>

                    </div>

                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-asset-layout>
