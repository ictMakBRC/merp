<form method="POST" enctype="multipart/form-data" id="officialContractForm">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="employee1" class="form-label">Employee</label>
            <select class="form-select select2" data-toggle="select2" id="employee1" name="employee_id" required>
                <option selected value="">Select</option>
                @foreach ($employees as $employee)
                    <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-5">
            <label for="contract_name" class="form-label">Contract Name</label>
            <input type="text" id="contract_name" class="form-control" name="contract_name" required
                value="{{ old('contract_name', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="gsalary" class="form-label">Gross Salary(UGX)</label>
            <input type="number" id="gsalary" class="form-control" name="gross_salary" required
                value="{{ old('gross_salary', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="date7" class="form-label">From</label>
            <input type="date" id="date1" class="form-control" name="start_date" required
                value="{{ old('start_date', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="date8" class="form-label">To</label>
            <input type="date" id="date2" class="form-control" name="end_date" required
                value="{{ old('end_date', '') }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="contract_file1" class="form-label">Contract</label>
            <input type="file" id="contract_file1" class="form-control" name="contract_file" accept=".pdf" required>
        </div>
    </div>
    @include('layouts.inc.form-submit')
</form>
