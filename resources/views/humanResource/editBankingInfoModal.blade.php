@foreach ($bankinginformation as $bankinginfo)
    <div class="modal fade" id="editBankingInfo{{ $bankinginfo->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Banking Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{ route('bankingInformation.update', $bankinginfo->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" id="bank_name" class="form-control" name="bank_name"
                                    value="{{ $bankinginfo->bank_name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="branch" class="form-label">Branch</label>
                                <input name="branch" type="text" id="branch" class="form-control"
                                    value="{{ $bankinginfo->branch }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="account_name" class="form-label">Account Name</label>
                                <input name="account_name" type="text" id="account_name" class="form-control"
                                    value="{{ $bankinginfo->account_name }}" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="currency" class="form-label">Currency</label>
                                <select class="form-select" id="currency" name="currency" required>
                                    <option selected value="{{ $bankinginfo->currency }}">{{ $bankinginfo->currency }}
                                    </option>
                                    <option value="UGX">UGX</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input name="account_number" type="text" id="account_number" class="form-control"
                                    value="{{ $bankinginfo->account_number }}" required>
                            </div>
                            {{-- <div class="col-md-8"></div>
                            <div class="col-md-4 text-end pt-1">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div> --}}
                        </div>
                        @include('layouts.inc.form-submit')
                    </form>
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
@endforeach
