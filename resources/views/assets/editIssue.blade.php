<x-asset-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body  ">
                    <form method="POST" action="{{ route('issues.update', [$assetIssue->id]) }}">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div>
                                <h4 class="header-title mb-3 text- text-center"> Edit Issue</h4>
                            </div>
                            <hr>
                            <div class="col-md-6 ">
                                <div class="mb-3">
                                    <label for="reference" class="form-label">Issue Number</label>
                                    <input type="text" id="reference" class="form-control" name="reference"
                                        value="{{ $assetIssue->reference }}" required readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="subject" class="form-label">Issue Name(Subject)</label>
                                    <input type="text" id="subject" class="form-control" name="subject"
                                        value="{{ $assetIssue->subject }}" required>
                                </div>
                                <div class="mb-3 ">
                                    <label for="issue_type" class="form-label">Type</label>
                                    <select class="form-select select2" data-toggle="select2" id="issue_type"
                                        name="issue_type" required>
                                        <option value="{{ $assetIssue->issue_type }}" selected>
                                            {{ $assetIssue->issue_type }}</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Improvement">Improvement</option>
                                        <option value="Repair">Repair</option>
                                        <option value="Servicing">Servicing</option>
                                        <option value="Fixing">Fixing</option>
                                        <option value="Upgrade">Upgrade</option>
                                        <option value="New Feature">New Feature</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="asset_id" class="form-label">Asset</label>
                                    <select class="form-select select2" data-toggle="select2" id="asset_id"
                                        name="asset_id" required>
                                        <option value="{{ $assetIssue->asset->id }}" Selected>
                                            {{ $assetIssue->asset->asset_name }}</option>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->asset_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Priority</label>
                                    <select class="form-select select2" data-toggle="select2" id="priority"
                                        name="priority" required>
                                        <option value="{{ $assetIssue->priority }}" Selected>
                                            {{ $assetIssue->priority }}</option>
                                        <option value="Low">Low</option>
                                        <option value="Normal">Normal</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Issue Description</label>
                                    <textarea class="form-control" id="description" rows="5" name="description" required>{{ $assetIssue->description }}</textarea>
                                </div>

                            </div> <!-- end col -->
                            <div class="col-md-6 ">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <select class="form-select select2" data-toggle="select2" id="location"
                                        name="station_id" required readonly>
                                        <option value="{{ $assetIssue->station->id }}" Selected>
                                            {{ $assetIssue->station->station_name }}</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="source_dept" class="form-label">Source Department</label>
                                    <select class="form-select select2" data-toggle="select2" id="source_dept"
                                        name="source_dept" required readonly>
                                        <option value="{{ $assetIssue->sourcedept->id }}" Selected>
                                            {{ $assetIssue->sourcedept->department_name }}</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="destination_dept" class="form-label">Destination Department</label>
                                    <select class="form-select select2" data-toggle="select2" id="destination_dept"
                                        name="destination_dept" required>
                                        <option value="{{ $assetIssue->destinationdept->id }}" Selected>
                                            {{ $assetIssue->destinationdept->department_name }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Resolution Deadline</label>
                                    <input class="form-control" id="deadline" type="date" name="deadline"
                                        value="{{ $assetIssue->deadline }}">
                                </div>
                                <div class="mb-3" id="reasonDiv" style="display: none">
                                    <label for="reason" class="form-label">Reason for Change(Quote dates in your
                                        reason)</label>
                                    <textarea class="form-control" id="reason" rows="5" name="reason">{{ $assetIssue->reason }}</textarea>
                                </div>

                            </div> <!-- end col -->

                        </div>
                        <!-- end row-->
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-success" type="submit"> Submit Issue</button>
                        </div>
                    </form>
                </div><!-- end card body-->
            </div><!-- end card -->
        </div> <!-- end col -->
    </div>
    <!--end of row-->

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                let deadlineDate = $('#deadline').val();
                let nextDeadlineDate;
                $('#asset_id').change(function() {
                    var id = $(this).val();
                    var url = "{{ route('asset.detail', ':id') }}";
                    url = url.replace(':id', id);
                    // console.log(url);
                    let responseData;
                    let locationElement;
                    let SourceElement;
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "json",
                        success: function(response) {
                            responseData = response[0];
                            locationElement =
                                `<option value="${responseData.station_id}" selected>${responseData.station_name}</option>`;
                            SourceElement =
                                `<option value="${responseData.department_id}" selected>${responseData.department_name}</option>`;
                            $('#location').empty();
                            $('#source_dept').empty();
                            $('#location').append(locationElement);
                            $('#source_dept').append(SourceElement);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        }
                    })
                });

                $('#deadline').change(function(e) {
                    nextDeadlineDate = $(this).val();

                    if (nextDeadlineDate != deadlineDate) {
                        $('#reasonDiv').show(1000);
                        $('#reason').attr("required", "required");
                    } else {
                        $('#reason').removeAttr("required")

                        $('#reasonDiv').hide(2000);
                    }
                });
            });
        </script>
    @endpush

</x-asset-layout>
