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
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> Current Maintenance Information</h4>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="{{ route('maintenance.create') }}"
                                    class="btn btn-success mb-2 me-1">New Info</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">

                    <div class="tab-content">
                        <div class="table-responsive" id="scroll-horizontal-preview">
                            <table id="datableButtons" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Asset</th>
                                        <th>Issue Reference</th>
                                        <th>Issue Subject</th>
                                        <th>Maintained By</th>
                                        <th>Authorised By</th>
                                        <th>Maintenance Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($maintenanceInfo as $key => $info)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $info->issue->asset->asset_name }}</td>
                                            <td>{{ $info->issue_ref }}</td>
                                            <td>{{ $info->issue->subject }}</td>
                                            @if (empty($info->externalvendor))
                                                <td>{{ $info->internalvendor->name }}</td>
                                            @else
                                                <td>{{ $info->externalvendor->vendor_name }}</td>
                                            @endif
                                            <td>{{ $info->authorisedby->name }}</td>
                                            <td>{{ $info->maintenance_date }}</td>
                                            {{-- <td style="color: red">{{$issue->issue_status}}</td> --}}
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye" data-bs-toggle="modal"
                                                        data-bs-target="#viewInfo{{ $info->id }}"></i></a>
                                                <a href="{{ route('maintenance.edit', [$info->id]) }}"
                                                    class="action-icon"> <i class="mdi mdi-pencil"></i></a>
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
    {{-- @include('assets.vendorModal') --}}

    @foreach ($maintenanceInfo as $key => $info)
        <div class="modal fade" id="viewInfo{{ $info->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title" id="bs-example-modal-lg">Asset Maintenance Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <div class='row'>
                            <div class="col-sm-6">

                                <p><strong>Reference No:</strong> {{ $info->issue_ref }}</p>
                                <hr>
                                <p><strong>Asset Name:</strong> {{ $info->issue->asset->asset_name }}</p>

                                <p><strong>Source Department:</strong> {{ $info->issue->sourcedept->department_name }}
                                </p>
                                <hr>
                                <p><strong>Submitted by:</strong> {{ $info->issue->createdby->name }}</p>
                                <hr>
                                <p><strong>Authorised by:</strong> {{ $info->authorisedby->name }}</p>
                                <hr>

                            </div>

                            <div class="col-sm-6">

                                <p><strong>Asset Barcode:</strong> {{ $info->issue->asset->barcode }}</p>
                                <hr>
                                <p><strong>Maintenance Source:</strong> {{ $info->type }}</p>
                                <hr>
                                @if (empty($info->externalvendor))
                                    <p><strong>Maintained By:</strong> {{ $info->internalvendor->name }}</p>
                                    <hr>
                                @else
                                    <p><strong>Maintained By:</strong> {{ $info->externalvendor->vendor_name }}</p>
                                    <hr>
                                @endif
                                <p><strong>Maintenance Date:</strong> {{ $info->maintenance_date }}</p>
                                <hr>
                                <p><strong>Next Maintenance:</strong> {{ $info->next_maintenance }}</p>
                                <hr>

                            </div>
                        </div>

                        <div class="text-center">
                            <h5>Issue Description</h5>
                        </div>
                        <hr>
                        <p>{{ $info->issue->description }}</p>
                        <hr>
                        <div class="text-center">
                            <h5>Maintenance Description</h5>
                        </div>
                        <hr>
                        <p>{{ $info->description }}</p>
                        <hr>
                        <div class="text-center">
                            <h5>Recommendations</h5>
                        </div>
                        <hr>
                        <p>{{ $info->recommendation }}</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-success">Mark as Resolved</button> --}}
                    </div>

                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-asset-layout>
