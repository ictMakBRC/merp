<div class="modal fade" id="suggestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Suggestion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form method="post" id="suggestionForm" action="{{route('suggestions.store')}}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="suggestion" class="form-label">Suggestion</label>
                            <textarea class="form-control" id="suggestion" rows="5" name="suggestion">{{ old('suggestion', '') }}</textarea>
                            <div class="text-danger" id="suggestion_validation_message">
                            </div>
                        </div>
                    </div>
                    <!-- end row-->
                    <div class="d-grid mb-0 text-center">
                        <button class="btn btn-success" type="submit" data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
