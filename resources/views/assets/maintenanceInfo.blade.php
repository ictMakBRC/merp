<x-asset-layout>
    <!-- start page title -->
    <x-page-title>
        Maintenance
    </x-page-title>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('maintenance.store') }}">
                        @csrf
                        <div class="row">
                            <div>
                                <h4 class="header-title mb-3 text- text-center"> New Maintenance Information</h4>
                            </div>
                            <hr>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select select2" data-toggle="select2" id="type"
                                        name="type" onchange="toggleType();">
                                        <option value='external'>External</option>
                                        <option value="internal">Internal</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="issue_ref" class="form-label">Issue Reference</label>
                                    <select class="form-select select2" data-toggle="select2" id="issue_ref"
                                        name="issue_ref" required>
                                        <option selected>Select reference</option>
                                        @foreach ($issues as $issue)
                                            <option value='{{ $issue->reference }}'>{{ $issue->reference }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="authorisedBy" class="form-label">Authorised By</label>
                                    <select class="form-select select2" data-toggle="select2" id="authorisedBy"
                                        name="authorised_by" required>
                                        <option selected>Select Authoriser</option>
                                        @foreach ($users as $user)
                                            <option value='{{ $user->id }}'>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3" style="display: none" id="internalVendor">
                                    <label for="internal_vendor" class="form-label">Maintained by(Person)</label>
                                    <select class="form-select select2" data-toggle="select2" id="internal_vendor"
                                        name="internal_vendor">
                                        <option value="NULL" selected>Select option</option>
                                        @foreach ($users as $user)
                                            <option value='{{ $user->id }}'>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3" id="externalVendor">
                                    <label for="vendor" class="form-label">Maintained by(Company)</label>
                                    <select class="form-select select2" data-toggle="select2" id="vendor"
                                        name="vendor">
                                        <option value="NULL" selected>Select vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value='{{ $vendor->id }}'>{{ $vendor->vendor_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- end row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Maintenance Description</label>
                                    <textarea class="form-control" id="description" rows="5" name="description" required>{{ old('description', '') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="recommendations" class="form-label">Recommendations</label>
                                    <textarea class="form-control" id="recommendations" rows="5" name="recommendation" required>{{ old('recommendation', '') }}</textarea>
                                </div>
                                <div class=" row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="maintenanceDate" class="form-label">Maintenance Date</label>
                                            <input class="form-control" id="maintenanceDate" type="date"
                                                name="maintenance_date" value="{{ old('maintenance_date') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nextDate" class="form-label">Next Maintenance</label>
                                            <input class="form-control" id="nextDate" type="date"
                                                name="next_maintenance" value="{{ old('next_maintenance') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                        </div>
                        <!-- end row-->
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-success" type="submit"> Save Information</button>
                        </div>
                    </form>
                </div><!-- end card body-->
            </div><!-- end card -->
        </div> <!-- end col -->
    </div>
    <!--end of row-->






    <script type="text/javascript">
        function toggleType() {
            var typeValue = document.getElementById("type").value;
            var internalVendor = document.getElementById("internalVendor");
            var externalVendor = document.getElementById("externalVendor");

            if (typeValue == 'internal') {

                internalVendor.style.display = 'block';
                externalVendor.style.display = 'none';

            } else if (typeValue == 'external') {

                externalVendor.style.display = 'block';
                internalVendor.style.display = 'none';

            } else {

                externalVendor.style.display = 'none';
                internalVendor.style.display = 'none';
            }

        }
    </script>
</x-asset-layout>
