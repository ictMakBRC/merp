<form method="POST" enctype="multipart/form-data" id="educationInfo">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="employee-ID" class="form-label">Employee</label>
            <select class="form-select select2" data-toggle="select2" id="employee-ID" name="employee_id" required>
                @if (Auth::user()->hasRole(['HrSupervisor', 'SuperAdmin', 'HrUser']))
                    <option value='{{ Auth::user()->employee->status==='Active'?Auth::user()->employee_id:'' }}'>{{ Auth::user()->employee->status==='Active'?Auth::user()->employee->fullName:'Select' }}</option>
                @else
                    <option selected value="">Select</option>
                    @foreach ($employees as $employee)
                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="level" class="form-label">Education Level</label>
            <select class="form-select select2" data-toggle="select2" id="level" name="level" required>
                <option selected value="">Select</option>
                <option value='Primary'>Primary</option>
                <option value='O-level'>Ordinary Level</option>
                <option value='A-level'>Advanced/High School</option>
                <option value='College'>College Level</option>
                <option value='Vocation'>Vocational Level</option>
                <option value='Graduate'>Graduate</option>
                <option value='Post Graduate'>Post Graduate</option>
                <option value='Doctorate'>Doctorate</option>
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label for="school" class="form-label">School/College/Institute/University</label>
            <input type="text" id="school" class="form-control" name="school" required>
        </div>
        <div class="mb-3 col-md-3">
            <label for="start_date" class="form-label">From</label>
            <input type="date" id="start_date" class="form-control" name="start_date">
        </div>
        <div class="mb-3 col-md-3">
            <label for="end_date" class="form-label">To</label>
            <input type="date" id="end_date" class="form-control" name="end_date">
        </div>
        <div class="mb-3 col-md-6">
            <label for="award" class="form-label">Degree/Honor/Diploma/Certicate/Award</label>
            <input type="text" id="award" class="form-control" name="award"required>
        </div>
        <div class="mb-3 col-md-6">
            <label for="award_document" class="form-label">Award Document</label>
            <input type="file" id="award_document" class="form-control" name="award_document" accept=".pdf">
        </div>
    </div>
    @include('layouts.inc.form-submit')
</form>
