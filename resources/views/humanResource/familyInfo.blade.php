<form method="POST" id="familyBackground">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="employeeId" class="form-label">Employee</label>
            <select class="form-select select2" data-toggle="select2" id="employeeId" name="employee_id" required>
                @if (Auth::user()->hasRole(['HrSupervisor', 'SuperAdmin', 'HrUser']))
                    <option value='{{ Auth::user()->employee->status==='Active'?Auth::user()->employee_id:'' }}'>{{ Auth::user()->employee->status==='Active'?Auth::user()->employee->fullName:'Select' }}</option>
                @else
                    <option selected value="">Select</option>
                    @foreach ($employees as $employee)
                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="member_type" class="form-label">Member Type</label>
            <select class="form-select select2" data-toggle="select2" id="member_type" name="member_type" required>
                <option selected value="">Select</option>
                <option value='Spouse'>Spouse</option>
                <option value='Father'>Father</option>
                <option value='Mother'>Mother</option>
                <option value='Brother'>Brother</option>
                <option value='Sister'>Sister</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" id="surname" class="form-control" name="surname" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="first_name" class="form-label">First Name</label>
            <input name="first_name" type="text" id="first_name" class="form-control" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input name="middle_name" type="text" id="middle_name" class="form-control">
        </div>
        <div class="mb-3 col-md-4">
            <label for="address" class="form-label">Address</label>
            <input name="address" type="text" id="address" class="form-control">
        </div>
        <div class="mb-3 col-md-4">
            <label for="contact" class="form-label">Contact</label>
            <input name="contact" type="text" id="contact" class="form-control">
        </div>
        <div class="mb-3 col-md-4">
            <label for="occupation" class="form-label">Occupation</label>
            <input name="occupation" type="text" id="occupation" class="form-control">
        </div>
        <div class="mb-3 col-md-4">
            <label for="employer" class="form-label">Employer/Business Name</label>
            <input name="employer" type="text" id="employer" class="form-control">
        </div>
        <div class="mb-3 col-md-4">
            <label for="employer_contact" class="form-label">Employer/Business Contact</label>
            <input name="employer_contact" type="text" id="employer_contact" class="form-control">
        </div>
        <div class="mb-3 col-md-4">
            <label for="employer_address" class="form-label">Employer/Business Address</label>
            <input name="employer_address" type="text" id="employer_address" class="form-control">
        </div>
    </div>
    @include('layouts.inc.form-submit')
</form>

<div class="row pt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header pt-0">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="text-sm-end mt-3">
                            <h4 class="header-title mb-3  text-center">Add Employee Children/Dependants</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" id="dependantInfo">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="emp-id" class="form-label">Employee</label>
                            <select class="form-select select2" data-toggle="select2" id="emp-id"
                                name="employee_id" required>
                                @if (Auth::user()->hasRole(['HrSupervisor', 'SuperAdmin', 'HrUser']))
                                    <option value='{{ Auth::user()->employee_id }}'>
                                        {{ Auth::user()->employee->fullName }}
                                    </option>
                                @else
                                    <option selected value="">Select</option>
                                    @foreach ($employees as $employee)
                                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-3 col-md-5">
                            <label for="child_name" class="form-label">Name of Child</label>
                            <input type="text" id="child_name" class="form-control" name="child_name" required>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" id="birth_date" class="form-control" name="birth_date"required>
                        </div>
                    </div>
                    @include('layouts.inc.form-submit')
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
