<x-hr-layout>

    <x-report-layout>

        <x-slot:pagetitle>
            Suggestion Box
            </x-slot>
            <x-slot:reporttitle>
                Employee Suggestions
                </x-slot>

                <div class="row border border-primary mx-auto">
                    <div class="col-lg-12">
                        @forelse ($suggestions as $suggestion)
                            @if (Auth::user()->hasRole(['HrAdmin|SuperAdmin']) ||
                                ((Auth::user()->hasRole(['HrSupervisor']) &&
                                    $suggestion->source_dept === auth()->user()->employee->department_id) ||
                                    $suggestion->created_by === auth()->user()->id) ||
                                (Auth::user()->hasRole(['HrUser']) && $suggestion->created_by === auth()->user()->id))
                                <div class="ribbon-box mt-2">

                                    <div class="ribbon ribbon-info float-end no-print"><i
                                            class="uil-edit me-1 no-print"></i> Suggestion
                                    </div>
                                    <h5 class="text-info float-start mt-0">
                                        {{ date('d-m-Y', strtotime($suggestion->created_at)) }}</h5>
                                    <div class="ribbon-content">
                                        <p>{{ $suggestion->suggestion }}</p>
                                        
                                        <div class="text-end no-print">
                                            @if ($suggestion->created_by === auth()->user()->id)
                                            <form action="{{ route('suggestions.destroy', $suggestion->id) }}" method="POST"
                                                onsubmit="return confirm('{{ trans('Are you sure you want to delete this suggestion?') }}');">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-outline-danger"><i
                                                        class="mdi mdi-delete"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                      
                                    </div>
                                </div> <!-- end card-->
                                <hr>
                            @endif
                        @empty
                            <x-not-available-alert>
                                No Suggestions yet
                            </x-not-available-alert>
                        @endforelse

                    </div>
                </div>

                <div class="text-sm-center mt-3">
                    <button class="btn btn-success" id="noprint1" onclick="window.print();"> PRINT</button>
                </div>

    </x-report-layout>
</x-hr-layout>
