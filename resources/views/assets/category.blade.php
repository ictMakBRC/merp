<x-asset-layout>
    <!-- start page title -->
    <x-page-title>
        Manage Categories
    </x-page-title>
    <!-- end page title -->

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> Manage Asset Categories</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <button type="button" class="btn btn-success mb-2 me-1" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop3">New Category</button>

                                <button type="button" class="btn btn-success mb-2 me-1" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop4">New Subcategory</button>

                            </div>

                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">

                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="datableButtons" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>SubCategory</th>
                                    <th>Category</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $key => $subcat)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $subcat->subcategory_name }}</td>
                                        <td>{{ $subcat->category->category_name }}</td>

                                        <td class="table-action">
                                            <a href="javascript: void(0);" class="action-icon"> <i
                                                    class="mdi mdi-pencil" data-bs-toggle="modal"
                                                    data-bs-target="#editCat{{ $subcat->category->id }}"></i>Cat</a>
                                            <a href="javascript: void(0);" class="action-icon"> <i
                                                    class="mdi mdi-pencil" data-bs-toggle="modal"
                                                    data-bs-target="#editSubcat{{ $subcat->id }}"></i>Sub</a>
                                            <a href="javascript: void(0);" class="action-icon"> <i
                                                    class="mdi mdi-delete"></i>Cat</a>
                                            <a href="javascript: void(0);" class="action-icon"> <i
                                                    class="mdi mdi-delete"></i>Sub</a>
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
    <!-- ADD NEW CATEGORY Modal -->
    @include('assets.categoryModal')
    <!-- ADD SUBCATEGORY Modal -->
    @include('assets.subcategoryModal')

    @foreach ($subcategories as $key => $subcat)
        <!-- UPDATE CATEGORY Modal -->
        <div class="modal fade" id="editCat{{ $subcat->category->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('categories.update', [$subcat->category->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="assetCategoryName" class="form-label">Asset Category Name</label>
                                        <input type="text" id="assetCategoryName" class="form-control"
                                            value="{{ $subcat->category->category_name }}" name="category_name"
                                            required>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit"> Update Category</button>
                            </div>
                        </form>
                    </div>

                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
    @foreach ($subcategories as $key => $subcat)
        <!-- UPDATE SUBCATEGORY Modal -->
        <div class="modal fade" id="editSubcat{{ $subcat->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit SubCategory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('subcategories.update', [$subcat->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="mainCategory" class="form-label">Category</label>
                                        <select class="form-select " id="mainCategory" name="category_id">
                                            <option value="{{ $subcat->category->id }}" selected>
                                                {{ $subcat->category->category_name }}</option>
                                            @foreach ($categories as $category)
                                                @if ($category->category_name != $subcat->category->category_name)
                                                    <option value='{{ $category->id }}'>
                                                        {{ $category->category_name }}</option>
                                                @endif
                                            @endforeach
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subCategory" class="form-label">SubCategory</label>
                                        <input type="text" id="subCategory" class="form-control"
                                            value="{{ $subcat->subcategory_name }}" name="subcategory_name" required>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit"> Update Subcategory</button>
                            </div>
                        </form>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
    <!-- end row-->
</x-asset-layout>
