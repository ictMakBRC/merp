@if (!$experiences->isEmpty())
    <div class="table-responsive">
        <table class="table border-bottom border-primary mb-0 w-100">
            <thead>
                <tr>
                    <th>Organisation</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Position</th>
                    <th>Work Type</th>
                    <th>Responsibility</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($experiences as $experience)
                <tr>
                    <td>
                        {{ $experience->company }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($experience->start_date)) }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($experience->end_date)) }}
                    </td>
                    <td>
                        {{ $experience->position_held }}

                    </td>

                    <td>
                        {{ $experience->employment_type }}
                    </td>
                    <td>
                        {{ $experience->job_description }}
                    </td>
                    <td class="d-flex">
                        <a type="button" href="#" class="btn btn-xs btn-outline-success mb-2 me-1"
                            data-bs-toggle="modal" data-bs-target="#editExp{{ $experience->id }}"><i
                                class="mdi mdi-pencil"></i></a>
                        <form action="{{ route('workExperience.destroy', $experience->id) }}" method="POST"
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
        No Work Experience Information
    </x-not-available-alert>
@endif
@include('humanResource.editWorkExperienceModal')
