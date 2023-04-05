<x-asset-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> Vendor List</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="addAsset.html" class="btn btn-success mb-2 me-1"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Vendor</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">

                    <div class="tab-content">
                        <div class="table responsive" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Email</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $key => $vendor)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $vendor->vendor_name }}</td>
                                            <td>{{ $vendor->address }}</td>
                                            <td>{{ $vendor->contact }}</td>
                                            <td>{{ $vendor->email }}</td>

                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-pencil" data-bs-toggle="modal"
                                                        data-bs-target="#editVendor{{ $vendor->id }}"></i></a>
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
    @include('assets.vendorModal')
    <!-- Edit VENDOR Modal -->
    @foreach ($vendors as $key => $vendor)
        <div class="modal fade" id="editVendor{{ $vendor->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Vendor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('vendors.update', [$vendor->id]) }}">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-md-12">


                                    <div class="mb-3">
                                        <label for="vendorName" class="form-label">Name</label>
                                        <input type="text" id="vendorName" class="form-control" name="vendor_name"
                                            value="{{ $vendor->vendor_name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="vendorAddress" class="form-label">Address</label>
                                        <input type="text" id="vendorAddress" class="form-control" name="address"
                                            value="{{ $vendor->address }}">
                                    </div>
                                    <input type="text" id="belongsTo" hidden value='assets' class="form-control"
                                        value="{{ $vendor->belongs_to }}" name="belongs_to">
                                    <div class="mb-3">
                                        <label for="vendorContact" class="form-label">Contact</label>
                                        <input type="text" id="vendorContact" class="form-control" name="contact"
                                            value="{{ $vendor->contact }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="vendorEmail" class="form-label">Email</label>
                                        <input type="email" id="vendorEmail" class="form-control" name="email"
                                            value="{{ $vendor->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea type="text" id="vendorComment" class="form-control" name="comment">{{ $vendor->comment }}</textarea>
                                    </div>

                                </div> <!-- end col -->

                            </div>
                            <!-- end row-->
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit"> Save Changes</button>
                            </div>

                        </form>

                    </div>

                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-asset-layout>
