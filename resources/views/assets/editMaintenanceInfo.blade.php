<x-asset-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('maintenance.update', [$maintenance->id]) }}">
                                        @method('PUT')
                                        @csrf
                                        <div>
                                            <h4 class="header-title mb-3 text- text-center"> Edit Maintenance
                                                Information</h4>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">


                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type</label>
                                                    <select class="form-select select2" data-toggle="select2"
                                                        id="type" name="type" onchange="toggleType();">
                                                        <option value='{{ $maintenance->type }}' selected>
                                                            {{ $maintenance->type }}</option>
                                                        <option value='external'>External</option>
                                                        <option value="internal">Internal</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="issue_ref" class="form-label">Issue Reference</label>
                                                    <select class="form-select select2" data-toggle="select2"
                                                        id="issue_ref" name="issue_ref">
                                                        <option value="{{ $maintenance->issue_ref }}" selected>
                                                            {{ $maintenance->issue_ref }}</option>
                                                        {{-- @foreach ($issues as $issue)
                                                        <option value='{{$issue->reference}}'>{{$issue->reference}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div> <!-- end col -->
                                            @if ($maintenance->type == 'internal')
                                                @php
                                                    $companyShow='none';
                                                    $userShow='block';
                                                @endphp
                                            @endif
                                            @if ($maintenance->type == 'external')
                                                @php
                                                    $companyShow='block';
                                                    $userShow='none';
                                                @endphp
                                            @endif
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="authorisedBy" class="form-label">Authorised By</label>
                                                    <select class="form-select select2" data-toggle="select2"
                                                        id="authorisedBy" name="authorised_by">
                                                        <option value="{{ $maintenance->authorisedby->id }}" selected>
                                                            {{ $maintenance->authorisedby->name }}</option>
                                                        @foreach ($users as $user)
                                                            <option value='{{ $user->id }}'>{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3" style="display:{{ $userShow }}"
                                                    id="internalVendor">
                                                    <label for="internal_vendor" class="form-label">Maintained
                                                        by(Person)</label>
                                                    <select class="form-select select2" data-toggle="select2"
                                                        id="internal_vendor" name="internal_vendor">
                                                        @if (isset($maintenance->externalvendor))
                                                            <option value="NULL" selected></option>
                                                        @else
                                                            <option value="{{ $maintenance->internalvendor->id }}"
                                                                selected>{{ $maintenance->internalvendor->name }}
                                                            </option>
                                                            @foreach ($users as $user)
                                                                <option value='{{ $user->id }}'>
                                                                    {{ $user->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="mb-3" style="display:{{ $companyShow }}"
                                                    id="externalVendor">
                                                    <label for="vendor" class="form-label">Maintained
                                                        by(Company)</label>
                                                    <select class="form-select select2" data-toggle="select2"
                                                        id="vendor" name="vendor">
                                                        @if (isset($maintenance->internalvendor))
                                                            <option value="NULL" selected></option>
                                                        @else
                                                            <option value="{{ $maintenance->externalvendor->id }}"
                                                                selected>
                                                                {{ $maintenance->externalvendor->vendor_name }}
                                                            </option>
                                                            @foreach ($vendors as $vendor)
                                                                <option value='{{ $vendor->id }}'>
                                                                    {{ $vendor->vendor_name }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Maintenance
                                                        Description</label>
                                                    <textarea class="form-control" id="description" rows="5" name="description">{{ $maintenance->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recommendations"
                                                        class="form-label">Recommendations</label>
                                                    <textarea class="form-control" id="recommendations" rows="5" name="recommendation">{{ $maintenance->recommendation }}</textarea>
                                                </div>
                                                <div class=" row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="maintenanceDate" class="form-label">Maintenance
                                                                Date</label>
                                                            <input class="form-control" id="maintenanceDate"
                                                                type="date" name="maintenance_date"
                                                                value="{{ $maintenance->maintenance_date }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nextDate" class="form-label">Next
                                                                Maintenance</label>
                                                            <input class="form-control" id="nextDate" type="date"
                                                                name="next_maintenance"
                                                                value="{{ $maintenance->next_maintenance }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                        </div>
                                        <!-- end row-->
                                        <div class="d-grid mb-0 text-center">
                                            <button class="btn btn-success" type="submit"
                                                onclick="this.innerHTML='Updating please wait.....';"> Update
                                                Information</button>
                                        </div>
                                    </form>
                                </div><!-- end card body-->
                            </div><!-- end card -->
                        </div> <!-- end col -->
                    </div>
                    <!--end of row-->
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
