<form method="POST" enctype="multipart/form-data" id="projectContractForm">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="empl-ID" class="form-label">Employee</label>
            <select class="form-select select2" data-toggle="select2" id="empl-ID" name="employee_id" required>
                <option selected value="">Select</option>
                @foreach ($employees as $employee)
                    <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="project_id" class="form-label">Project</label>
            <select class="form-select select2" data-toggle="select2" id="project_id" name="project_id" required>
                <option selected value="">Select</option>
                @foreach ($projects as $project)
                    <option value='{{ $project->id }}'>{{ $project->department_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="position_id" class="form-label">Position</label>
            <select class="form-select select2" data-toggle="select2" id="position_id" name="position_id" required>
                <option selected value="">Select</option>
                @foreach ($designations as $designation)
                    <option value='{{ $designation->id }}'>{{ $designation->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-5">
            <label for="contract_name1" class="form-label">Contract Name</label>
            <input type="text" id="contract_name1" class="form-control" name="contract_name"required
                value="{{ old('contract_name', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="g-salary" class="form-label">Gross Salary(UGX)</label>
            <input type="number" step="0.02" id="g-salary" class="form-control" name="gross_salary" required
                value="{{ old('gross_salary', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="date5" class="form-label">From</label>
            <input type="date" id="date1" class="form-control" name="start_date" required
                value="{{ old('start_date', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="date6" class="form-label">To</label>
            <input type="date" id="date2" class="form-control" name="end_date" required
                value="{{ old('end_date', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="fte" class="form-label">FTE</label>
            <input type="number" step="0.02" id="fte" class="form-control" name="fte" required
                value="{{ old('fte', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="contract_file" class="form-label">Contract</label>
            <input type="file" id="contract_file" class="form-control" name="contract_file" accept=".pdf" required>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4 text-end pt-1">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>
</form>
