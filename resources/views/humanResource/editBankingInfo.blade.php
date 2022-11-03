@if (!$bankinginformation->isEmpty())
    <div class="table-responsive">
        <table class="table border-bottom border-primary mb-0 w-100">
            <thead>
                <tr>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>Account Name</th>
                    <th>Currency</th>
                    <th>Account Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($bankinginformation as $bankinginfo)
                <tr>
                    <td>
                        {{ $bankinginfo->bank_name }}
                    </td>
                    <td>
                        {{ $bankinginfo->branch }}

                    </td>
                    <td>
                        {{ $bankinginfo->account_name }}

                    </td>
                    <td>
                        {{ $bankinginfo->currency }}

                    </td>
                    <td>
                        {{ $bankinginfo->account_number }}
                    </td>
                    <td class="table-action text-center d-flex">
                        <a type="button" href="#" class="btn btn-xs btn-outline-success mb-2 me-1"
                            data-bs-toggle="modal" data-bs-target="#editBankingInfo{{ $bankinginfo->id }}"><i
                                class="mdi mdi-pencil"></i></a>
                        <form action="{{ route('bankingInformation.destroy', $bankinginfo->id) }}" method="POST"
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
        No Banking Information
    </x-not-available-alert>

@endif
@include('humanResource.editBankingInfoModal')
