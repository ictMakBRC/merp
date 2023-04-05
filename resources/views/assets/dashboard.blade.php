<x-asset-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->
    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="uil-gold text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ count($assets) }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Assets</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $departmentCount }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Departments</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>

                                    <h3><span>{{ $userCount }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Users</p>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="uil-question-circle text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $issueCount }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Issues</p>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> Recently Added Assets</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="{{ route('asset.create') }}"
                                    class="btn btn-success mb-2 me-1">Add Asset</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datableButtons" class="table table-striped w-100 ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Barcode</th>
                                    <th>Location</th>
                                    <th>Department</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assets as $key => $asset)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $asset->asset_name }}</td>
                                        <td>{{ $asset->category->category_name }}</td>
                                        <td>{{ $asset->subcategory->subcategory_name }}</td>
                                        <td>{{ $asset->brand }}</td>
                                        <td>{{ $asset->model }}</td>
                                        <td>{{ $asset->barcode }}</td>
                                        <td>{{ $asset->station->station_name }}</td>
                                        <td>{{ $asset->department->department_name }}</td>
                                        <td>
                                            @if ($asset->user != null)
                                                {{ $asset->user->name }}
                                            @else
                                                {{ __('Not Applicable') }}
                                            @endif
                                        </td>
                                        <td>{{ $asset->status }}</td>
                                        <td class="table-action">
                                            <a href="{{ route('asset.show', [$asset->id]) }}" class="action-icon"> <i
                                                    class="mdi mdi-eye"></i></a>

                                            <a href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</x-asset-layout>
