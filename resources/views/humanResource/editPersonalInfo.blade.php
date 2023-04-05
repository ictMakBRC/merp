<form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="row">
        <div class="mb-3 col-md-3">
            <label for="emp_id" class="form-label">Employee Number</label>
            <input type="text" id="emp_id" class="form-control" name="emp_id" required
                value="{{ $employee->emp_id }}" readonly>
        </div>
        <div class="mb-3 col-md-3">
            <label for="nin_number" class="form-label">NIN Number</label>
            <input type="text" id="nin_number" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="nin_number" value="{{ $employee->nin_number }}"
                size="14">
        </div>
        <div class="mb-3 col-md-3">
            <label for="status1" class="form-label">Status</label>
            <select class="form-select select2" data-toggle="select2" id="status1" name="status" required>
                <option value="{{ $employee->status }}" selected>{{ $employee->status }}</option>
                @if ($read_only===false && Auth::user()->employee->id != $employee->id)
                    <option value='Active'>Active</option>
                    <option value='Suspended'>Suspended</option>
                    <option value='Terminated'>Terminated</option>
                    <option value='Resigned'>Resigned</option>
                    <option value='Retired'>Retired</option>
                    <option value='Contract Expired'>Contract Expired</option>
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-3">
            <label for="prefix" class="form-label">Prefix</label>
            <select class="form-select select2" data-toggle="select2" id="prefix" name="prefix">
                <option value="{{ $employee->prefix }}" selected>{{ $employee->prefix }}</option>
                <option value="Mr.">Mr.</option>
                <option value="Ms.">Ms.</option>
                <option value="Miss.">Miss.</option>
                <option value="Dr.">Dr.</option>
                <option value="Eng.">Eng.</option>
                <option value="Prof.">Prof.</option>
            </select>
        </div>

        <div class="mb-3 col-md-4">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" id="surname" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="surname" required
                value="{{ $employee->surname }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" id="first_name" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="first_name" required
                value="{{ $employee->first_name }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="other_name" class="form-label">Other Name</label>
            <input type="text" id="other_name" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="other_name" value="{{ $employee->other_name }}">
        </div>

        <div class="mb-3 col-md-4">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select select2" data-toggle="select2" id="gender" name="gender" required>
                <option selected value="{{ $employee->gender }}">{{ $employee->gender }}</option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="nationality" class="form-label">Nationality</label>
            <select class="form-select select2" data-toggle="select2" id="nationality" name="nationality" required>
                <option selected value="{{ $employee->nationality }}">{{ $employee->nationality }}</option>
                @include('humanResource.layouts.countries')
            </select>
        </div>

        <div class="mb-3 col-md-4">
            <label for="birthday" class="form-label">Date of Birth</label>
            <input type="date" id="birthday" class="form-control" name="birthday" required
                value="{{ $employee->birthday }}">
            <input type="number" id="age" class="form-control" name="age" value="{{ $employee->age }}"
                hidden>
        </div>
        <div class="mb-3 col-md-4">
            <label for="birth_place" class="form-label">Place of Birth</label>
            <input type="text" id="birth_place" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="birth_place" required
                value="{{ $employee->birth_place }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="religious-affiliation" class="form-label">Religious Affiliation</label>
            <input type="text" id="religious-affiliation" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="religious_affiliation"
                value="{{ $employee->religious_affiliation }}">
        </div>
        <div class="mb-3 col-md-2">
            <label for="height" class="form-label">Height</label>
            <input type="text" id="height" class="form-control" name="height" placeholder="In cm"
                value="{{ $employee->height }}">
        </div>
        <div class="mb-3 col-md-2">
            <label for="weight" class="form-label">Weight</label>
            <input type="text" id="weight" class="form-control" name="weight" placeholder="In Kg"
                value="{{ $employee->weight }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="blood_type" class="form-label">Blood Type</label>
            <select class="form-select select2" data-toggle="select2" id="blood_type" name="blood_type">
                <option value="{{ $employee->blood_type ? $employee->blood_type : '' }}" selected>
                    {{ $employee->blood_type ? $employee->blood_type : 'Select' }}</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="civil_status" class="form-label">Civil Status</label>
            <select class="form-select select2" data-toggle="select2" id="civil_status" name="civil_status">
                <option selected value="{{ $employee->civil_status }}">{{ $employee->civil_status }}</option>
                <option value='Single'>Single</option>
                <option value='Married'>Married</option>
                <option value='Widowed'>Widowed</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="address"
                value="{{ $employee->address }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" class="form-control" name="email" required
                value="{{ $employee->email }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="alt_email" class="form-label">Alternative Email</label>
            <input type="email" id="alt_email" class="form-control" name="alt_email"
                value="{{ $employee->alt_email }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="contact" class="form-label">Telephone Number</label>
            <input type="text" id="contact" class="form-control text-uppercase" name="contact" required
                value="{{ $employee->contact }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="alt_contact" class="form-label">Alternative Contact</label>
            <input type="text" id="alt_contact" class="form-control text-uppercase" name="alt_contact"
                value="{{ $employee->alt_contact }}">
        </div>

        <div class="mb-3 col-md-4">
            <label for="designation" class="form-label">Designation / Position</label>
            <select class="form-select select2" data-toggle="select2" id="designation" name="designation_id">
                <option selected value="{{ $employee->designation?$employee->designation->id:'' }}">{{ $employee->designation ? $employee->designation->name : 'Select' }}</option>
                @if ($read_only===false && $employee->id!= Auth::user()->employee->id)
                    @foreach ($designations as $designation)
                        <option value='{{ $designation->id }}'>{{ $designation->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3 col-md-4">
            <label for="duty_station" class="form-label">Duty Station</label>
            <select class="form-select select2" data-toggle="select2" id="duty_station" name="station_id">
                <option selected value="{{ $employee->station?$employee->station->id:'' }}">{{ $employee->station ? $employee->station->station_name : 'Select' }}</option>
                
                @if ($read_only===false && $employee->id!= Auth::user()->employee->id)
                    @foreach ($stations as $station)
                        <option value='{{ $station->id }}'>{{ $station->station_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="user_department" class="form-label">Department</label>
            <select class="form-select select2" data-toggle="select2" id="user_department" name="department_id">
                <option selected value="{{ $employee->department?$employee->department->id:'' }}">{{ $employee->department ? $employee->department->department_name : 'Select' }}</option>
                @if ($read_only===false && $employee->id!= Auth::user()->employee->id)
                    @foreach ($departments as $department)
                        <option value='{{ $department->id }}'>{{ $department->department_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="department_unit_id" class="form-label">Unit/Sub-unit</label>
            <select class="form-select select2" data-toggle="select2" id="department_unit_id"
                name="department_unit_id">

                @if ($employee->departmentunit)
                    <option selected value="{{ $employee->departmentunit->id }}">
                        {{ $employee->departmentunit->department_name }}</option>
                @endif
                <option value="">None</option>

            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="reporting_to" class="form-label">Reporting to</label>
            <select class="form-select select2" data-toggle="select2" id="reporting_to" name="reporting_to">
                @if ($reportingTo->isEmpty())
                    <option selected value="">N/A</option>
                @else
                    @foreach ($reportingTo as $reportsto)
                        <option selected value="{{ $reportsto->id }}">{{ $reportsto->fullName }}</option>
                    @endforeach
                @endif
                @if ($read_only===false && $employee->id!= Auth::user()->employee->id)
                    @foreach ($employees as $employee)
                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="work_type" class="form-label">Work Type</label>
            <select class="form-select select2" data-toggle="select2" id="work_type" name="work_type">
                <option selected value="{{ $employee->work_type }}">{{ $employee->work_type }}</option>
                @if ($read_only===false && $employee->id!= Auth::user()->employee->id)
                    {{-- @if (Auth::user()->employee->id != $employee->id) --}}
                    <option value='Part Time'>Part Time</option>
                    <option value='Full Time'>Full Time</option>
                    <option value='Probation'>Probation</option>
                    <option value='Contract'>Contract</option>
                    <option value='Commission'>Commission</option>
                    <option value='Volunteer'>Volunteer</option>
                    <option value='Intern'>Intern</option>
                    <option value='Trainee'>Trainee</option>
                    {{-- @endif --}}
                @endif

            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="join_date" class="form-label">Join Date</label>
            <input type="date" id="join_date" class="form-control" name="join_date" required
                value="{{ $employee->join_date }}" readonly>
        </div>
        <div class="mb-3 col-md-4">
            <label for="tin_number" class="form-label">TIN Number</label>
            <input type="number" id="tin_number" class="form-control text-uppercase" name="tin_number"
                value="{{ $employee->tin_number }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="nssf_number" class="form-label">NSSF No</label>
            <input type="text" id="nssf_number" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="nssf_number"
                value="{{ $employee->nssf_number }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="photo" class="form-label">Photo (Passport Size)</label>
            <input type="file" id="photo" class="form-control" name="photo" accept=".jpg,.jpeg,.png">
        </div>
        <div class="mb-3 col-md-4">
            <label for="signature" class="form-label">Signature</label>
            <input type="file" id="signature" class="form-control" name="signature" accept=".jpg,.jpeg,.png">
        </div>
        {{-- <div class="col-md-8"></div>
        <div class="col-md-4 text-end pt-1">
            <button class="btn btn-success" type="submit">Update</button>
        </div> --}}
    </div>
    @include('layouts.inc.form-submit')
</form>
