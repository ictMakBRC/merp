@if (!$familybackgrounds->isEmpty())
    <div class="table-responsive">
        <table class="table border-bottom border-primary mb-0 w-100">
            <thead>
                <tr>

                    <th>Member</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Occupation</th>
                    <th>Employer</th>
                    <th>Employer Address</th>
                    <th>Employer Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($familybackgrounds as $familybackground)
                <tr>
                    <td>
                        {{ $familybackground->member_type }}

                    </td>
                    <td>
                        {{ $familybackground->first_name . ' ' . $familybackground->middle_name . ' ' . $familybackground->last_name }}
                    </td>
                    <td>
                        {{ $familybackground->address }}

                    </td>
                    <td>
                        {{ $familybackground->contact }}
                    </td>
                    <td>
                        {{ $familybackground->occupation }}
                    </td>
                    <td>
                        {{ $familybackground->employer }}
                    </td>
                    <td>
                        {{ $familybackground->employer_address }}
                    </td>
                    <td>
                        {{ $familybackground->employer_contact }}
                    </td>
                    <td class="d-flex">
                        <a type="button" href="#" class="btn btn-xs btn-outline-success mb-2 me-1"
                            data-bs-toggle="modal" data-bs-target="#editInfo{{ $familybackground->id }}"><i
                                class="mdi mdi-pencil"></i></a>
                        <form action="{{ route('familyBackground.destroy', $familybackground->id) }}" method="POST"
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
        No Family Background Information
    </x-not-available-alert>
@endif
@include('humanResource.editFamilyInfoModal')
