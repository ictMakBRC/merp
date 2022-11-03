@forelse ($leaverequests as $key => $request)
    <div class="modal fade" id="comment{{ $request->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Comment about Your leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <div class="alert alert-info" role="alert">
                        <p>{{ $request->comment ? $request->comment : $request->delegatee_comment }}</p>
                        <hr>
                        @if ($request->approver != null)
                            <p style="text-align: right">Supervisor:
                                {{ $request->approver->fullName . '(' . date('d-m-Y', strtotime($request->updated_at)) . ')' }}
                            </p>
                        @endif
                    </div>
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
@empty
@endforelse
