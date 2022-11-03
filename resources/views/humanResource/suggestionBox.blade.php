<div class="modal fade" id="suggestionBox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suggestion Box</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <div data-simplebar data-simplebar-primary style="max-height: 250px;">
                    @forelse ($suggestions as $suggestion)
                        @if (Auth::user()->hasRole(['HrAdmin|SuperAdmin']) ||
                            ((Auth::user()->hasRole(['HrSupervisor']) &&
                                $suggestion->source_dept === auth()->user()->employee->department_id) ||
                                $suggestion->created_by === auth()->user()->id) ||
                            (Auth::user()->hasRole(['HrUser']) && $suggestion->created_by === auth()->user()->id))
                            <div class="card ribbon-box">
                                <div class="card-body">
                                    <div class="ribbon ribbon-info float-start"><i class="uil-edit me-1"></i> Suggestion
                                    </div>
                                    <h5 class="text-info float-end mt-0">{{ $suggestion->created_at->diffForHumans() }}
                                    </h5>
                                    <div class="ribbon-content">
                                        {{ $suggestion->suggestion }}
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        @endif
                    @empty
                        <x-not-available-alert>
                            No Suggestions yet
                        </x-not-available-alert>
                    @endforelse

                </div>
            </div>
            <div class="modal-footer">
                <a type="button" href="{{ route('suggestions.index') }}" class="btn btn-success me-1">View All</a>
                {{-- <button type="button" class="btn btn-success">View All</button> --}}
                <a type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</a>
            </div> <!-- end modal footer -->
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->
