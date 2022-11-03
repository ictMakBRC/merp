<x-asset-layout>
    <!-- start page title -->
    <x-page-title>
        Add Asset
    </x-page-title>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('asset.store') }}" id="maintenanceForm">
                        @csrf
                        <div class="row">
                            <div>
                                <h4 class="header-title mb-3 text- text-center"> General Asset Information</h4>
                            </div>
                            <hr>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="assetName" class="form-label">Asset Name</label>
                                    <input type="text" id="assetName" class="form-control" name="asset_name"
                                        value="{{ old('asset_name', '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select select2" data-toggle="select2" id="category"
                                        name="asset_category_id">
                                        <option selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value='{{ $category->id }}'>{{ $category->category_name }}</option>
                                        @endforeach
                                        <option value=''>N/A</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="subCategory" class="form-label">Subcategory</label>
                                    <select class="form-select select2" data-toggle="select2" id="subCategory"
                                        name="asset_subcategory_id">
                                        <option selected>Select subcategory</option>
                                        @foreach ($subcats as $subcat)
                                            <optgroup label="{{ $subcat->category_name }}">
                                                @foreach ($subcat->subcategories as $subcategory)
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
                                    <input type="text" id="brand" class="form-control" name="brand"
                                        value="{{ old('brand', '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" id="model" class="form-control" name="model"
                                        value="{{ old('model', '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="serialNumber" class="form-label">Serial Number</label>
                                    <input type="text" id="serialNumber" class="form-control"
                                        placeholder="Enter N/A if not Present" name="serial_number"
                                        value="{{ old('serial_number', '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="barcode" class="form-label">Barcode</label>
                                    <input type="text" id="barcode" onfocus="generateBarcode()"
                                        class="form-control" placeholder="Focus to Auto-Generate" name="barcode"
                                        value="{{ old('barcode', '') }}">
                                    <svg id="barcodee" style="display: none"></svg>
                                </div>
                                <div class="mb-3">
                                    <label for="engravedLabel" class="form-label">Engraved Label</label>
                                    <input type="text" id="engravedLabel" class="form-control" name="engraved_label"
                                        placeholder="Enter N/A if not Engraved/Labelled"
                                        value="{{ old('engraved_label', '') }}">
                                </div>
                                <div>
                                    <h4 class="header-title mb-3 text-center"> Asset Details</h4>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="assetStatus" class="form-label">Status</label>
                                    <select class="form-select select2" data-toggle="select2" id="assetStatus"
                                        name="status">
                                        <option selected>Select status</option>
                                        <option value='Checked Out'>Checked Out</option>
                                        <option value='In stock'>In stock</option>
                                        <option value='Archived'>Archived</option>
                                        <option value='Disposed of'>Disposed of</option>
                                        <option value='Out for repair/maintenance'>Out for repair/maintenance</option>
                                        <option value=''>N/A</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="checkedOut" style="display: none">
                                    <label for="checkedOutTo" class="form-label">Checked out to</label>
                                    <select class="form-select select2" data-toggle="select2" id="checkedOutTo"
                                        name="user_id">
                                        <option selected value="">Select user</option>
                                        @foreach ($users as $user)
                                            <option value='{{ $user->id }}'>{{ $user->name }}</option>
                                        @endforeach
                                        <option value=''>None</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <select class="form-select select2" data-toggle="select2" id="location"
                                        name="station_id">
                                        <option selected>Select location</option>
                                        @foreach ($stations as $station)
                                            <option value='{{ $station->id }}'>{{ $station->station_name }}</option>
                                        @endforeach
                                        <option value=''>None</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="departmentOrLab"
                                        class="form-label">Department/lab/Project/Unit</label>
                                    <select class="form-select select2" data-toggle="select2" id="departmentOrLab"
                                        name="department_id">
                                        <option selected value="">Select unit</option>
                                        @foreach ($departments as $department)
                                            <option value='{{ $department->id }}'>{{ $department->department_name }}
                                            </option>
                                        @endforeach
                                        <option value=''>none</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="condition" class="form-label">Condition</label>
                                    <select class="form-select select2" data-toggle="select2" id="condition"
                                        name="condition">
                                        <option selected value="">Select condition</option>
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
                                    <select class="form-select select2" data-toggle="select2" id="vendor"
                                        name="vendor_id">
                                        <option selected value="">Select vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value='{{ $vendor->id }}'>{{ $vendor->vendor_name }}</option>
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
                                        name="purchase_price" value="{{ old('purchase_price', '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="purchaseDate" class="form-label">Purchase Date</label>
                                    <input class="form-control" id="purchaseDate" type="date"
                                        name="purchase_date" value="{{ old('purchase_date', '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="purchaseOrderNumber" class="form-label">Purchase Order Number</label>
                                    <input class="form-control" id="purchaseOrderNumber" type="text"
                                        name="purchase_order_number" value="{{ old('purchase_order_number', '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="warrantyEnd" class="form-label">Warranty End</label>
                                    <input class="form-control" id="warrantyEnd" type="date" name="warranty_end"
                                        value="{{ old('warranty_end', '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="depreciationMethod" class="form-label">Depreciation Method</label>
                                    <select class="form-select select2" data-toggle="select2" id="depreciationMethod"
                                        name="depreciation_method">
                                        <option selected value="">Select method</option>
                                        <option value='Straight line method'>Straight line method</option>
                                        <option value='educing balance method'>Reducing balance method</option>
                                        <option value='No Depreciating'>No Depreciating</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="depreciationRate" class="form-label">Rate of Depreciation(%)</label>
                                    <input class="form-control" id="depreciationRate" type="number"
                                        name="depreciation_rate" value="{{ old('depreciation_rate', '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="usefulYears" class="form-label">Expected Useful Years</label>
                                    <input class="form-control" id="usefulYears" type="number"
                                        name="expected_useful_years" value="{{ old('expected_useful_years', '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="insuranceCompany" class="form-label">Insurance Company</label>
                                    <select class="form-select select2" data-toggle="select2" id="insuranceCompany"
                                        name="insurance_company">
                                        <option selected value="">Select company</option>
                                        @foreach ($vendors as $vendor)
                                            <option value='{{ $vendor->id }}'>{{ $vendor->vendor_name }}</option>
                                        @endforeach
                                        <option value=''>N/A</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="insuranceType" class="form-label">Insurance Type</label>
                                    <select class="form-select select2" data-toggle="select2" id="insuranceType"
                                        name="insurance_type">
                                        <option selected value="">Select type</option>
                                        @foreach ($insurancetypes as $nsurancetype)
                                            <option value='{{ $nsurancetype->id }}'>{{ $nsurancetype->type }}
                                            </option>
                                        @endforeach
                                        <option value=''>N/A</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="insuranceEnd" class="form-label">Insurance End</label>
                                    <input class="form-control" id="insuranceEnd" type="date"
                                        name="insurance_end" value="{{ old('insurance_end', '') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Remarks/Comment</label>
                                    <textarea class="form-control" id="remarks" rows="5" name="remarks">{{ old('remarks', '') }}</textarea>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-success" type="submit" id="submitButton"> ADD ASSET</button>
                        </div>
                    </form>
                </div><!-- end card body-->
            </div><!-- end card -->
        </div> <!-- end col -->
    </div>
    <!--end of row-->

    @push('scripts')
        <script type="text/javascript">
            function generateBarcode() {
                var date = new Date();
                var barcodeNumber = ''.concat(date.getFullYear(), date.getMonth() + 1, date.getDate(), date.getHours(), date
                    .getMinutes(), date.getSeconds());
                var barcodeInput = document.getElementById("barcode");
                barcodeInput.value = barcodeNumber.split("").reverse().join("");
                JsBarcode("#barcodee", barcodeInput.value, {
                    format: 'code128',
                    displayValue: true,
                    lineColor: "#24292e",
                    width: 2,
                    height: 30,
                    fontSize: 15
                });
            }

            $('#assetStatus').change(function(e) {
                if ($(this).val() == 'Checked Out') {
                    $('#checkedOut').show(1000);
                    $('#checkedOutTo').attr("required", "required");
                } else {
                    $('#checkedOutTo').removeAttr("required")

                    $('#checkedOut').hide(2000);
                }
            });
        </script>
    @endpush
</x-asset-layout>
