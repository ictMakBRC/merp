@foreach ($leaverequests as $key => $request)
    <div class="modal fade" id="reason{{ $request->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reason For leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <div class="alert alert-info" role="alert">
                        <p><strong>Reason:</strong><br>{{ $request->reason }}</p>
                        <hr>
                        <p><strong>Duties Delegated to:</strong><br>
                            @if ($request->delegatedto != null)
                                {{ $request->delegatedto->fullName . ' -->' . 'Starting on:' . '(' . date('d-m-Y', strtotime($request->start_date)) . ')' }}
                            @endif
                        </p>
                        <hr>
                        <p><strong>Duties delegated:</strong><br>{{ $request->duties_delegated }}</p>
                        <hr>
                        <p style="text-align: right"><strong>Yours Sincerely:</strong>
                            {{ $request->employee->fullName }}</p>
                    </div>
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
@endforeach
