<!-- ADD SUBCATEGORY Modal -->

<div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add SubCategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="POST" action="{{ route('subcategories.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="mainCategory" class="form-label">Category</label>
                                <select class="form-select" id="mainCategory" name="asset_category_id">
                                    <option value='' selected>select category</option>
                                    @foreach ($categories as $category)
                                        <option value='{{ $category->id }}'>{{ $category->category_name }}</option>
                                    @endforeach
                                    <option value='N/A'>N/A</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subCategory" class="form-label">SubCategory</label>
                                <input type="text" id="subCategory" class="form-control" name="subcategory_name"
                                    required>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->
                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-success" type="submit"> Create Subcategory</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
