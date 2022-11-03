@if (!$awards->isEmpty())
    <div class="table-responsive">
        <table class="table border-bottom border-primary mb-0 w-100">
            <thead>
                <tr>
                    <th>Training</th>
                    <th>Organisation</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Length</th>
                    <th>Description</th>
                    <th>Certificate</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($trainings as $training)
                <tr>
                    <td>
                        {{ $training->training_name }}

                    </td>
                    <td>
                        {{ $training->organised_by }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($training->start_date)) }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($training->end_date)) }}
                    </td>
                    <td>
                        {{ $training->training_length }}
                    </td>
                    <td>
                        {{ $training->training_description }}
                    </td>
                    <td class="table-action text-center">
                        @if ($training->certificate != null)
                            <a href="{{ route('certificate.download', ['emp_id' => $employee->emp_id, 'id' => $training->id]) }}"
                                class="btn-outline-success"><i class="uil-download-alt"></i></a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="d-flex">
                        <a type="button" href="#" class="btn btn-xs btn-outline-success mb-2 me-1"
                            data-bs-toggle="modal" data-bs-target="#editTraining{{ $training->id }}"><i
                                class="mdi mdi-pencil"></i></a>
                        <form action="{{ route('trainingProgram.destroy', $training->id) }}" method="POST"
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
    No Training Information
</x-not-available-alert>
@endif
@include('humanResource.editTrainingInfoModal')
