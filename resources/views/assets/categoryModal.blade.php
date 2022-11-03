<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="assetCategoryName" class="form-label">Asset Category Name</label>
                                <input type="text" id="assetCategoryName" class="form-control" name="category_name">
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->
                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-success" type="submit"> Create Category</button>
                    </div>
                </form>
            </div>

        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
