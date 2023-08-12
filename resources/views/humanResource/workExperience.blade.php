<form method="POST" enctype="multipart/form-data" id="experienceForm">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="emp-idd" class="form-label">Employee</label>
            <select class="form-select select2" data-toggle="select2" id="emp-idd" name="employee_id" required>
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
        <div class="mb-3 col-md-3">
            <label for="date1" class="form-label">From</label>
            <input type="date" id="date1" class="form-control" name="start_date"required>
        </div>
        <div class="mb-3 col-md-3">
            <label for="date2" class="form-label">To</label>
            <input type="date" id="date2" class="form-control" name="end_date"required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="company" class="form-label">Company/Organisation/Office</label>
            <input type="text" id="company" class="form-control" name="company" required>
        </div>
        <div class="mb-3 col-md-6">
            <label for="position_held" class="form-label">Position Held</label>
            <input type="text" id="position_held" class="form-control" name="position_held" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="employment_type" class="form-label">Employment Type</label>
            <select class="form-select select2" data-toggle="select2" id="employment_type" name="employment_type"
                required>
                <option selected value="">Select</option>
                <option value='Part Time'>Part Time</option>
                <option value='Full Time'>Full Time</option>
                <option value='Probation'>Probation</option>
                <option value='Contract'>Contract</option>
                <option value='Commission'>Commission</option>
                <option value='Volunteer'>Volunteer</option>
                <option value='Intern'>Intern</option>
                <option value='Trainee'>Trainee</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="monthly_salary" class="form-label">Monthly Salary/Wage</label>
            <input type="text" id="monthly_salary" class="form-control" name="monthly_salary">
        </div>
        <div class="mb-3 col-md-4">
            <label for="service_length" class="form-label">Length Of Service</label>
            <input type="text" id="service_length" class="form-control" name="service_length">
        </div>
        <div class="mb-3 col-md-12">
            <label for="job-description" class="form-label">Key Responsibilities</label>
            <textarea type="text" id="job-description" rows="4" class="form-control" name="job_description" placeholder="List Key Responsibilities"></textarea>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4 text-end pt-1">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>
</form>
