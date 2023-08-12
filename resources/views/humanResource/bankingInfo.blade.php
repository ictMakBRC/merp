<form  method="POST" action="{{route('bankingInformation.store')}}" id="bankingFormb">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="employee_id" class="form-label">Employee</label>
            <select class="form-select select2" data-toggle="select2" id="employee_id" name="employee_id" required>
                @if (Auth::user()->hasRole(['HrSupervisor', 'SuperAdmin', 'HrUser']))
                    <option value='{{ Auth::user()?->employee?->status==='Active'?Auth::user()->employee_id:'' }}'>{{ Auth::user()?->employee?->status==='Active'?Auth::user()?->employee?->fullName:'Select' }}</option>
                @else
                    <option selected value="">Select</option>
                    @foreach ($employees as $employee)
                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="bank_name" class="form-label">Bank Name</label>
            <input type="text" id="bank_name" class="form-control" name="bank_name" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="branch" class="form-label">Branch</label>
            <input name="branch" type="text" id="branch" class="form-control" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="account_name" class="form-label">Account Name</label>
            <input name="account_name" type="text" id="account_name" class="form-control" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="account_number" class="form-label">Account Number</label>
            <input name="account_number" type="text" id="account_number" class="form-control" required>
        </div>        
        <div class="mb-3 col-md-2">
            <label for="currency" class="form-label">Currency</label>
            <select class="form-select select2" data-toggle="select2" id="currency" name="currency" required>
                <option selected value="">Select</option>
                <option value="UGX">UGX</option>
                <option value="USD">USD</option>
                <option value="GBP">GBP</option>
                <option value="EUR">EUR</option>
            </select>
        </div>
        <div class="mb-3 col-md-2">
            <label for="is_default" class="form-label">Default Account</label>
            <select class="form-select" id="is_default" name="is_default" required>              
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4 text-end pt-1">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>
</form>
