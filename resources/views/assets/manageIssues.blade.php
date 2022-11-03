<x-asset-layout>
    <x-page-title>
        Current Issues
    </x-page-title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> Current Issues</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="{{ route('issues.create') }}"
                                    class="btn btn-success mb-2 me-1">Add Issue</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">

                    <div class="tab-content">
                        <div class="table responsive" id="scroll-horizontal-preview">
                            <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Reference</th>
                                        <th>Subject</th>
                                        <th>Asset</th>
                                        <th>Source Department</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($issues as $key => $issue)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $issue->reference }}</td>
                                            <td>{{ $issue->subject }}</td>
                                            <td>{{ $issue->asset->asset_name }}</td>
                                            <td>{{ $issue->sourcedept->department_name }}</td>
                                            <td style="color: red">{{ $issue->issue_status }}</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye" data-bs-toggle="modal"
                                                        data-bs-target="#viewIssue{{ $issue->id }}"></i></a>
                                                <a href="{{ route('issues.edit', [$issue->id]) }}" class="action-icon">
                                                    <i class="mdi mdi-pencil"></i></a>
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

    @foreach ($issues as $key => $issue)
        <div class="modal fade" id="viewIssue{{ $issue->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title" id="bs-example-modal-lg">Issue Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <div class='row'>
                            <div class="col-sm-6">
                                <p><strong>Reference No:</strong> {{ $issue->reference }}</p>
                                <hr>
                                <p><strong>Submitted By:</strong> {{ $issue->createdby->name }}</p>
                                <hr>
                                <p><strong>Submitted:</strong> {{ $issue->created_at->diffForHumans() }}</p>
                                <hr>
                                <p><strong>Status:</strong> {{ $issue->issue_status }}</p>
                                <hr>
                                <p><strong>Subject:</strong> {{ $issue->subject }}</p>
                                <hr>
                                <p><strong>IssueType:</strong> {{ $issue->issue_type }}</p>

                            </div>
                            <div class="col-sm-6">
                                <p><strong>Asset Name:</strong> {{ $issue->asset->asset_name }}</p>
                                <hr>
                                <p><strong>Asset Barcode:</strong> {{ $issue->asset->barcode }}</p>
                                <hr>
                                <p><strong>Issue Priority:</strong> {{ $issue->priority }}</p>
                                <hr>
                                <p><strong>Station:</strong> {{ $issue->station->station_name }}</p>
                                <hr>
                                <p><strong>Source Department:</strong> {{ $issue->sourcedept->department_name }}</p>
                                <hr>
                                <p><strong>Destination Department:</strong>
                                    {{ $issue->destinationdept->department_name }}</p>

                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <h5>Issue Description</h5>
                        </div>
                        <hr>
                        <p>{{ $issue->description }}</p>
                        <hr>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" class="btn btn-success">Mark as Resolved</button>
                    </div>

                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-asset-layout>
