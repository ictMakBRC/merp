@if (!$awards->isEmpty())
    <div class="table-responsive">
        <table class="table border-bottom border-primary mb-0 w-100">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Institution</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Award</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($awards as $award)
                <tr>
                    <td>
                        {{ $award->level }}
                    </td>
                    <td>
                        {{ $award->school }}

                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($award->start_date)) }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($award->end_date)) }}
                    </td>
                    <td>
                        {{ $award->award }}
                    </td>
                    <td class="table-action text-center d-flex">
                        <a type="button" href="#" class="btn btn-xs btn-outline-success mb-2 me-1"
                            data-bs-toggle="modal" data-bs-target="#editAward{{ $award->id }}"><i
                                class="mdi mdi-pencil"></i></a>
                        <form action="{{ route('educationBackground.destroy', $award->id) }}" method="POST"
                            onsubmit="return confirm('{{ trans('Are you sure you want to delete this record?') }}');">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-xs btn-outline-danger"><i
                                    class="mdi mdi-delete"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div> <!-- end preview-->
@else
    <x-not-available-alert>
        No Education Information
    </x-not-available-alert>
@endif
@include('humanResource.editEducationInfoModal')
