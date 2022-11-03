<x-asset-layout>
    <!-- start page title -->
    <x-page-title>
        Asset Details
    </x-page-title>

    <div class="tab-content">

        <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
            <li class="nav-item">
                <a href="#summary" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Summary</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#history" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Assignment History</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#maintenanceHistory" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Maintenance History</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#update" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Update/Edit</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="summary">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-2 font-13"><strong>Asset Name :</strong> <span
                                class="ms-2">{{ $asset->asset_name }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Category :</strong><span
                                class="ms-2">{{ $asset->category->category_name }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Subcategory :</strong> <span
                                class="ms-2 ">{{ $asset->subcategory->subcategory_name }}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Brand :</strong> <span
                                class="ms-2">{{ $asset->brand }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Model :</strong> <span
                                class="ms-2">{{ $asset->model }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Serial No :</strong><span
                                class="ms-2">{{ $asset->serial_number }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Barcode No :</strong><span
                                class="ms-2">{{ $asset->barcode }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Label:</strong> <span
                                class="ms-2 ">{{ $asset->engraved_label }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Condition :</strong> <span
                                class="ms-2">{{ $asset->condition }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Status :</strong> <span
                                class="ms-2">{{ $asset->status }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Assigned To :</strong><span class="ms-2">
                                @if ($asset->user != null)
                                    {{ $asset->user->name }}
                                @else
                                    {{ __('Not Applicable') }}
                                @endif
                            </span></p>
                        <p class="text-muted mb-2 font-13"><strong>Location :</strong> <span
                                class="ms-2 ">{{ $asset->station->station_name }}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Department/Lab :</strong> <span
                                class="ms-2">{{ $asset->department->department_name }}</span></p>

                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-2 font-13"><strong>Vendor/Supplier :</strong><span
                                class="ms-2">{{ $asset->vendor->vendor_name }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Purchase Price :</strong> <span
                                class="ms-2 ">{{ $asset->purchase_price }}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Purchase Date :</strong> <span
                                class="ms-2">{{ $asset->purchase_date }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Purchase Order Number :</strong><span
                                class="ms-2">{{ $asset->purchase_order_number }}
                            </span></p>
                        <p class="text-muted mb-2 font-13"><strong>Warranty End :</strong> <span
                                class="ms-2 ">{{ $asset->warranty_end }}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Depreciation Method :</strong> <span
                                class="ms-2">{{ $asset->depreciation_method }}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Depreciation Rate :</strong> <span
                                class="ms-2">{{ $asset->depreciation_rate }}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Expected Useful Years :</strong> <span
                                class="ms-2">{{ $asset->expected_useful_years }}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Insurance Company :</strong> <span class="ms-2">
                                @if ($asset->insurer != null)
                                    {{ $asset->insurer->vendor_name }}
                                @else
                                    {{ __('Not Available') }}
                                @endif
                            </span>
                        </p>
                        <p class="text-muted mb-1 font-13"><strong>Insurance Type :</strong> <span class="ms-2">
                                @if ($asset->insurancetype != null)
                                    {{ $asset->insurancetype->type }}
                                @else
                                    {{ __('Not Available') }}
                                @endif
                            </span></p>
                        <p class="text-muted mb-1 font-13"><strong>Insurance End :</strong> <span
                                class="ms-2">{{ $asset->insurance_end }}</span></p>
                        <p class="text-muted mb-1 font-13"><strong>Remarks/Comment :</strong> <span
                                class="ms-2">{{ $asset->remarks }}</span></p>
                    </div>
                </div>
            </div>
            <div class="tab-pane show" id="history">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-0">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <div class="text-sm-end mt-3">
                                            <h4 class="header-title mb-3  text-center">{{ $asset->asset_name }}
                                                Assignment History</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                                        <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Date Assigned</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($assignments as $assignment)
                                                    @foreach ($assignment->assignmenthistory as $key => $history)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                @if ($history->fromuser != null)
                                                                    {{ $history->fromuser->name }}
                                                                @else
                                                                    {{ __('Assets Manager') }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($history->touser != null)
                                                                    {{ $history->touser->name }}
                                                                @else
                                                                    {{ __('Assets Manager') }}
                                                                @endif
                                                            </td>
                                                            <td class="table-action">{{ $history->created_at }}</td>

                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> <!-- end preview-->
                                </div> <!-- end tab-content-->
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
            </div>

            <div class="tab-pane show" id="maintenanceHistory">

                @foreach ($maintenancehistory as $maintenance)
                    @if ($maintenance->maintenanceinfo->isNotEmpty())
                        @foreach ($maintenance->maintenanceinfo as $key => $data)
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header pt-2">
                                            <div class="row mb-2">
                                                <div class="col-sm-4">
                                                    <h5>Issue info</h5>
                                                    <hr>
                                                    <p><strong>Issue Ref:</strong> {{ $data->issue_ref }}</p>
                                                    <p><strong>Submitted By:</strong>
                                                        {{ $data->issue->createdby->name }}</p>
                                                    <p><strong>Submitted on:</strong> {{ $data->issue->created_at }}
                                                    </p>
                                                    <p><strong>Source Dept:</strong>
                                                        {{ $data->issue->sourcedept->department_name }}</p>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h5>Issue Description</h5>
                                                    <hr>
                                                    <p>{{ $data->issue->description }}</p>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Maintenance Description</th>
                                                        <th scope="col">Recommendations</th>
                                                        <th scope="col">Other Information</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $data->description }}</td>
                                                        <td>{{ $data->recommendation }}</td>
                                                        <td>
                                                            <p><strong>Source:</strong> {{ $data->type }}</p>
                                                            <p><strong>Authorised By:</strong>
                                                                {{ $data->authorisedby->name }}</p>
                                                            <p><strong>Maintained By:</strong>
                                                                @if ($data->externalvendor != null)
                                                                    {{ $data->externalvendor->vendor_name }}
                                                                @else
                                                                    {{ $data->internalvendor->name }}
                                                                @endif
                                                            </p>
                                                            <p><strong>Maintenance date:</strong>
                                                                {{ $data->maintenance_date }}</p>
                                                            <p><strong>Next Maintenance:</strong>
                                                                {{ $data->next_maintenance }}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center pt-5">
                            <h2>No Maintenance Data Avalaible</h2>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="tab-pane show" id="update">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('asset.update', [$asset->id]) }}"
                                    id="assetForm">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div>
                                            <h4 class="header-title mb-3 text- text-center"> Update
                                                [--{{ $asset->asset_name }}--] Information</h4>
                                        </div>
                                        <hr>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="assetName" class="form-label">Asset Name</label>
                                                <input type="text" id="assetName" class="form-control"
                                                    name="asset_name" value="{{ $asset->asset_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="category" name="asset_category_id">
                                                    <option value="{{ $asset->category->id }}" selected>
                                                        {{ $asset->category->category_name }}</option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->id == $asset->category->id)
                                                            @continue;
                                                        @endif
                                                        <option value='{{ $category->id }}'>
                                                            {{ $category->category_name }}</option>
                                                    @endforeach
                                                    <option value=''>N/A</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="subCategory" class="form-label">Subcategory</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="subCategory" name="asset_subcategory_id">
                                                    <option value="{{ $asset->subcategory->id }}" selected>
                                                        {{ $asset->subcategory->subcategory_name }}</option>
                                                    @foreach ($subcats as $subcat)
                                                        <optgroup label="{{ $subcat->category_name }}">
                                                            @foreach ($subcat->subcategories as $subcategory)
                                                                @if ($subcategory->id == $asset->subcategory->id)
                                                                    @continue;
                                                                @endif
                                                                <option value='{{ $subcategory->id }}'>
                                                                    {{ $subcategory->subcategory_name }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                    <optgroup label="{{ __('Not Applicable') }}">
                                                        <option value=''>N/A</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="brand" class="form-label">Brand</label>
                                                <input type="text" id="brand" class="form-control"
                                                    name="brand" value="{{ $asset->brand }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="model" class="form-label">Model</label>
                                                <input type="text" id="model" class="form-control"
                                                    name="model" value="{{ $asset->model }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="serialNumber" class="form-label">Serial Number</label>
                                                <input type="text" id="serialNumber" class="form-control"
                                                    placeholder="Enter N/A if not Present" name="serial_number"
                                                    value="{{ $asset->serial_number }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="barcode" class="form-label">Barcode</label>
                                                <input type="text" id="barcode" class="form-control"
                                                    placeholder="Focus to Auto-Generate" name="barcode"
                                                    value="{{ $asset->barcode }}" readonly>
                                                <svg id="barcodee" style="display: none" id=""></svg>
                                            </div>
                                            <div class="mb-3">
                                                <label for="engravedLabel" class="form-label">Engraved Label</label>
                                                <input type="text" id="engravedLabel" class="form-control"
                                                    name="engraved_label"
                                                    placeholder="Enter N/A if not Engraved/Labelled"
                                                    value="{{ $asset->engraved_label }}">
                                            </div>
                                            <div>
                                                <h4 class="header-title mb-3 text-center"> Asset Details</h4>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <label for="assetStatus" class="form-label">Status</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="assetStatus" name="status">
                                                    <option value="{{ $asset->status }}" selected>
                                                        {{ $asset->status }}</option>
                                                    <option value='In stock'>In stock</option>
                                                    <option value='Checked Out'>Checked Out</option>
                                                    <option value='Archived'>Archived</option>
                                                    <option value='Disposed of'>Disposed of</option>
                                                    <option value='Out for repair/maintenance'>Out for
                                                        repair/maintenance</option>
                                                    <option value=''>N/A</option>
                                                </select>
                                            </div>
                                            <div class="mb-3" id="checkedOut" style="display: none">
                                                <label for="checkedOutTo" class="form-label">Checked out to</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="checkedOutTo" name="user_id">
                                                    @if ($asset->user != null)
                                                        <option value="{{ $asset->user->id }}" selected>
                                                            {{ $asset->user->name }}</option>
                                                    @else
                                                        <option value=''>None</option>
                                                    @endif

                                                    @foreach ($users as $user)
                                                        {{-- @if ($asset->user == null || $user->id == $asset->user->id)
                                                    @continue;
                                                    @endif --}}
                                                        <option value='{{ $user->id }}'>{{ $user->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="location" class="form-label">Location</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="location" name="station_id">
                                                    <option value="{{ $asset->station->id }}" selected>
                                                        {{ $asset->station->station_name }}</option>
                                                    @foreach ($stations as $station)
                                                        @if ($station->id == $asset->station->id)
                                                            @continue;
                                                        @endif
                                                        <option value='{{ $station->id }}'>
                                                            {{ $station->station_name }}</option>
                                                    @endforeach
                                                    <option value=''>None</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="departmentOrLab"
                                                    class="form-label">Department/lab/Project/Unit</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="departmentOrLab" name="department_id">
                                                    <option value="{{ $asset->department->id }}" selected>
                                                        {{ $asset->department->department_name }}</option>
                                                    @foreach ($departments as $department)
                                                        @if ($department->id == $asset->department->id)
                                                            @continue;
                                                        @endif
                                                        <option value='{{ $department->id }}'>
                                                            {{ $department->department_name }}</option>
                                                    @endforeach
                                                    <option>none</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="condition" class="form-label">Condition</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="condition" name="condition">
                                                    <option value="{{ $asset->condition }}" selected>
                                                        {{ $asset->condition }}</option>
                                                    <option value='New'>New</option>
                                                    <option value='Good'>Good</option>
                                                    <option value='Fair'>Fair</option>
                                                    <option value='Bad'>Bad</option>
                                                    <option value=''>N/A</option>
                                                </select>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="vendor" class="form-label">Vendor/Supplier</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="vendor" name="vendor_id">
                                                    <option value="{{ $asset->vendor->id }}" selected>
                                                        {{ $asset->vendor->vendor_name }}</option>
                                                    @foreach ($vendors as $vendor)
                                                        @if ($vendor->id == $asset->vendor->id)
                                                            @continue;
                                                        @endif
                                                        <option value='{{ $vendor->id }}'>
                                                            {{ $vendor->vendor_name }}</option>
                                                    @endforeach
                                                    <option value=''>N/A</option>
                                                </select>
                                            </div>
                                            <div>
                                                <h4 class="header-title mb-3 text-center"> Purchasing Details</h4>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                <label for="purchasePrice" class="form-label">Purchase Price</label>
                                                <input class="form-control" id="purchasePrice" type="text"
                                                    name="purchase_price" value="{{ $asset->purchase_price }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="purchaseDate" class="form-label">Purchase Date</label>
                                                <input class="form-control" id="purchaseDate" type="date"
                                                    name="purchase_date" value="{{ $asset->purchase_date }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="purchaseOrderNumber" class="form-label">Purchase Order
                                                    Number</label>
                                                <input class="form-control" id="purchaseOrderNumber" type="text"
                                                    name="purchase_order_number"
                                                    value="{{ $asset->purchase_order_number }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="warrantyEnd" class="form-label">Warranty End</label>
                                                <input class="form-control" id="warrantyEnd" type="date"
                                                    name="warranty_end" value="{{ $asset->warranty_end }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="depreciationMethod" class="form-label">Depreciation
                                                    Method</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="depreciationMethod" name="depreciation_method">
                                                    <option value="{{ $asset->depreciation_method }}" selected>
                                                        {{ $asset->depreciation_method }}</option>
                                                    <option value='Straight line method'>Straight line method</option>
                                                    <option value='educing balance method'>Reducing balance method
                                                    </option>
                                                    <option value='No Depreciating'>No Depreciating</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="depreciationRate" class="form-label">Rate of
                                                    Depreciation(%)</label>
                                                <input class="form-control" id="depreciationRate" type="number"
                                                    name="depreciation_rate" value="{{ $asset->depreciation_rate }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="usefulYears" class="form-label">Expected Useful
                                                    Years</label>
                                                <input class="form-control" id="usefulYears" type="number"
                                                    name="expected_useful_years"
                                                    value="{{ $asset->expected_useful_years }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="insuranceCompany" class="form-label">Insurance
                                                    Company</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="insuranceCompany" name="insurance_company">
                                                    @if ($asset->insurer != null)
                                                        <option value="{{ $asset->insurer->id }} "selected>
                                                            {{ $asset->insurer->vendor_name }}</option>
                                                    @else
                                                        <option value='' selected>Select Insurer</option>
                                                    @endif

                                                    @foreach ($vendors as $vendor)
                                                        {{-- @if ($vendor->id == $asset->insurer->id)
                                                    @continue;
                                                    @endif --}}
                                                        <option value='{{ $vendor->id }}'>
                                                            {{ $vendor->vendor_name }}</option>
                                                    @endforeach
                                                    <option value=''>N/A</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="insuranceType" class="form-label">Insurance Type</label>
                                                <select class="form-select select2" data-toggle="select2"
                                                    id="insuranceType" name="insurance_type">
                                                    @if ($asset->insureancetype != null)
                                                        <option value="{{ $asset->insurancetype->id }}" selected>
                                                            {{ $asset->insurancetype->type }}</option>
                                                    @else
                                                        <option value='' selected>Select Type</option>
                                                    @endif

                                                    @foreach ($insurancetypes as $insurancetype)
                                                        {{-- @if ($insurancetype->id == $asset->insurancetype->id)
                                                    @continue;
                                                    @endif --}}
                                                        <option value='{{ $insurancetype->id }}'>
                                                            {{ $insurancetype->type }}</option>
                                                    @endforeach
                                                    <option value=''>N/A</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="insuranceEnd" class="form-label">Insurance End</label>
                                                <input class="form-control" id="insuranceEnd" type="date"
                                                    name="insurance_end" value="{{ $asset->insurance_end }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="remarks" class="form-label">Remarks/Comment</label>
                                                <textarea class="form-control" id="remarks" rows="5" name="remarks">{{ $asset->remarks }}</textarea>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row-->
                                    <div class="d-grid mb-0 text-center">
                                        <button class="btn btn-success" type="submit" id="submitButton"
                                            onclick="this.innerHTML='Processing please wait.....';"> Update
                                            Asset</button>
                                    </div>
                                </form>
                            </div><!-- end card body-->
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!--end of row-->
            </div>
        </div>

    </div> <!-- end tab-content-->

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                assignedUser = `<option value="" selected>None</option>`;

                if ($('#assetStatus').val() == 'Checked Out') {
                    $('#checkedOut').show(1000);
                }

                $('#assetStatus').change(function() {
                    if ($(this).val() == 'Checked Out') {
                        $('#checkedOut').show(1000);
                    } else {
                        $('#checkedOutTo').prepend(assignedUser);
                        $('#checkedOut').hide(2000);
                    }
                });


            });
        </script>
    @endpush
</x-asset-layout>
