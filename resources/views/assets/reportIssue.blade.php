<x-asset-layout>
    <!-- start page title -->
    <x-page-title>
        Report Issue
    </x-page-title>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body  ">
                    <form method="POST" action="{{ route('issues.store') }}" id="issueForm">
                        @csrf
                        <div class="row">
                            <div>
                                <h4 class="header-title mb-3 text- text-center"> Report Issue</h4>
                            </div>
                            <hr>
                            <div class="col-md-6 ">
                                <div class="mb-3">
                                    <label for="reference" class="form-label">Issue Number</label>
                                    <input type="text" id="reference" class="form-control" name="reference"
                                        onfocus="generateRef();" required readonly placeholder="Focus to Auto-Generate">
                                </div>

                                <div class="mb-3">
                                    <label for="subject" class="form-label">Issue Name(Subject)</label>
                                    <input type="text" id="subject" class="form-control" name="subject" required
                                        value="{{ old('subject', '') }}">
                                </div>
                                <div class="mb-3 ">
                                    <label for="issue_type" class="form-label">Type</label>
                                    <select class="form-select select2" data-toggle="select2" id="issue_type"
                                        name="issue_type" required>
                                        <option selected>Select Issue Type</option>
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
                                        <option Selected>Select Asset</option>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->asset_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Priority</label>
                                    <select class="form-select select2" data-toggle="select2" id="priority"
                                        name="priority" required>
                                        <option value="Low">Low</option>
                                        <option value="Normal">Normal</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Resolution Deadline</label>
                                    <input class="form-control" id="deadline" type="date" name="deadline" required>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-md-6 ">


                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <select class="form-select select2" data-toggle="select2" id="location"
                                        name="station_id" required readonly>
                                        <option value=""></option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="source_dept" class="form-label">Source Department</label>
                                    <select class="form-select select2" data-toggle="select2" id="source_dept"
                                        name="source_dept" required readonly>
                                        <option value=""></option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="destination_dept" class="form-label">Destination Department</label>
                                    <select class="form-select select2" data-toggle="select2" id="destination_dept"
                                        name="destination_dept" required>
                                        <option selected>Select destination Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Issue Description</label>
                                    <textarea class="form-control" id="description" rows="9" name="description" required
                                        placeholder="Describe issue please">{{ old('brand', '') }}</textarea>
                                </div>
                            </div> <!-- end col -->

                        </div>
                        <!-- end row-->
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-success" type="submit"
                                onclick="this.innerHTML='Processing please wait.....';"> Submit Issue</button>
                        </div>
                    </form>
                </div><!-- end card body-->
            </div><!-- end card -->
        </div> <!-- end col -->
    </div>
    <!--end of row-->

    @push('scripts')
        <script type="text/javascript">
            function generateRef() {
                var date = new Date();
                var reference = ''.concat(date.getFullYear(), date.getMonth() + 1, date.getDate(), date.getHours(), date
                    .getMinutes(), date.getSeconds());
                var refInput = document.getElementById("reference");
                refInput.value = reference;
            }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
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
            });
        </script>
    @endpush

</x-asset-layout>
