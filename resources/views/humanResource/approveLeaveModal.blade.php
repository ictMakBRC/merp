@foreach ($leaverequests as $key => $request)
    <div class="modal fade" id="approve{{ $request->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Approval Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('leaveRequests.update', $request->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" hidden id="status3" class="form-control" name="status"
                                    value='Approved' required>
                                <div class="mb-3">
                                    <label for="comment3" class="form-label">Comment</label>
                                    <textarea class="form-control" id="comment3" rows="3" name="comment">{{ old('comment', '') }}</textarea>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                        {{-- <div class="d-grid mb-0 text-center">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div> --}}
                    </form>
                    @include('layouts.inc.form-submit')
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
@endforeach
