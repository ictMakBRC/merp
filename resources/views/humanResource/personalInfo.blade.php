<form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" onsubmit="processingReq();">
    @csrf
    <div class="row">
        {{-- <div class="mb-3 col-md-4">
            <label for="emp_id" class="form-label">Employee Number<span class="text-danger">*</span></label>
            <input type="text" id="emp_id" class="form-control" name="emp_id" required value="{{ old('emp_id', '') }}" readonly>
        </div> --}}
        <div class="mb-3 col-md-4">
            <label for="nin_number" class="form-label">NIN Number</label>
            <input type="text" id="nin_number" class="form-control text-uppercase" name="nin_number"
                onkeyup="this.value = this.value.toUpperCase();" value="{{ old('nin_number', '') }}" size="14">
        </div>
        <div class="mb-3 col-md-4">
            <label for="prefix" class="form-label">Prefix<span class="text-danger">*</span></label>
            <select class="form-select select2" data-toggle="select2" id="prefix" name="prefix">
                <option value="Mr.">Mr.</option>
                <option value="Ms.">Ms.</option>
                <option value="Miss.">Miss.</option>
                <option value="Dr.">Dr.</option>
                <option value="Eng.">Eng.</option>
                <option value="Prof.">Prof.</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="surname" class="form-label">Surname<span class="text-danger">*</span></label>
            <input type="text" id="surname" class="form-control text-uppercase" name="surname"
                onkeyup="this.value = this.value.toUpperCase();" required value="{{ old('surname', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
            <input type="text" id="first_name" class="form-control text-uppercase" name="first_name"
                onkeyup="this.value = this.value.toUpperCase();" required value="{{ old('first_name', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="other_name" class="form-label">Other Name</label>
            <input type="text" id="other_name" class="form-control text-uppercase" name="other_name"
                onkeyup="this.value = this.value.toUpperCase();" value="{{ old('other_name', '') }}">
        </div>

        <div class="mb-3 col-md-4">
            <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
            <select class="form-select select2" data-toggle="select2" id="gender" name="gender" required>
                <option selected value="">Select</option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="nationality" class="form-label">Nationality<span class="text-danger">*</span></label>
            <select class="form-select select2" data-toggle="select2" id="nationality" name="nationality" required>
                <option selected value="">Select</option>
                @include('humanResource.layouts.countries')
            </select>
        </div>

        <div class="mb-3 col-md-4">
            <label for="birthday" class="form-label">Date of Birth<span class="text-danger">*</span></label>
            <input type="date" id="birthday" class="form-control" name="birthday" required
                value="{{ old('birthday', '') }}">

        </div>
        <div class="mb-3 col-md-4">
            <label for="birth_place" class="form-label">Place of Birth</label>
            <input type="text" id="birth_place" class="form-control text-uppercase" name="birth_place"
                onkeyup="this.value = this.value.toUpperCase();" value="{{ old('birth_place', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="religious-affiliation" class="form-label">Religious Affiliation</label>
            <input type="text" id="religious-affiliation" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="religious_affiliation"
                value="{{ old('religious_affiliation', '') }}">
        </div>
        <div class="mb-3 col-md-2">
            <label for="height" class="form-label">Height</label>
            <input type="text" id="height" class="form-control" name="height" placeholder="In cm"
                value="{{ old('height', '') }}">
        </div>
        <div class="mb-3 col-md-2">
            <label for="weight" class="form-label">Weight</label>
            <input type="text" id="weight" class="form-control" name="weight" placeholder="In Kg"
                value="{{ old('weight', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="blood_type" class="form-label">Blood Type</label>
            <select class="form-select select2" data-toggle="select2" id="blood_type" name="blood_type">
                <option value="">Select</option>
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
            <select class="form-select select2" data-toggle="select2" id="civil_status" name="civil_status"
             >
                <option selected value="">Select</option>
                <option value='Single'>Single</option>
                <option value='Married'>Married</option>
                <option value='Widowed'>Widowed</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" class="form-control text-uppercase" name="address"
                onkeyup="this.value = this.value.toUpperCase();"  value="{{ old('address', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
            <input type="email" id="email" class="form-control" name="email" required
                value="{{ old('email', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="alt_email" class="form-label">Alternative Email</label>
            <input type="email" id="alt_email" class="form-control" name="alt_email" 
                value="{{ old('alt_email', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="contact" class="form-label">Telephone Number<span class="text-danger">*</span></label>
            <input type="text" id="contact" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="contact" 
                value="{{ old('contact', '') }}" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="alt_contact" class="form-label">Alternative Contact</label>
            <input type="text" id="alt_contact" class="form-control text-uppercase" name="alt_contact" 
                value="{{ old('alt_contact', '') }}">
        </div>

        <div class="mb-3 col-md-4">
            <label for="designation" class="form-label">Designation / Position</label>
            <select class="form-select select2" data-toggle="select2" id="designation" name="designation_id"
                required>
                <option selected value="">Select</option>
                @foreach ($designations as $designation)
                    <option value='{{ $designation->id }}'>{{ $designation->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-4">
            <label for="duty_station" class="form-label">Duty Station<span class="text-danger">*</span></label>
            <select class="form-select select2" data-toggle="select2" id="duty_station" name="station_id">
                <option selected value="">Select</option>
                @foreach ($stations as $station)
                    <option value='{{ $station->id }}'>{{ $station->station_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="user_department" class="form-label">Department<span class="text-danger">*</span></label>
            <select class="form-select select2" data-toggle="select2" id="user_department" name="department_id"
                required>
                <option selected value="">Select</option>
                @foreach ($departments as $department)
                    <option value='{{ $department->id }}'>{{ $department->department_name }}</option>
                @endforeach

            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="department_unit_id" class="form-label">Unit/Sub-Unit</label>
            <select class="form-select select2" data-toggle="select2" id="department_unit_id"
                name="department_unit_id">
                <option selected value="">Select</option>
                <option value="">None</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="reporting_to" class="form-label">Reporting to</label>
            <select class="form-select select2" data-toggle="select2" id="reporting_to" name="reporting_to">
                <option selected value="">Select</option>
                @foreach ($employees as $employee)
                    <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="work_type" class="form-label">Work Type<span class="text-danger">*</span></label>
            <select class="form-select select2" data-toggle="select2" id="work_type" name="work_type" required>
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
            <label for="join_date" class="form-label">Join Date<span class="text-danger">*</span></label>
            <input type="date" id="join_date" class="form-control" name="join_date" required
                value="{{ old('join_date', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="tin_number" class="form-label">TIN Number</label>
            <input type="number" id="tin_number" class="form-control" name="tin_number"
                value="{{ old('tin_number', '') }}">
        </div>
        <div class="mb-3 col-md-4">
            <label for="nssf_number" class="form-label">NSSF No</label>
            <input type="text" id="nssf_number" class="form-control text-uppercase"
                onkeyup="this.value = this.value.toUpperCase();" name="nssf_number"
                value="{{ old('nssf_number', '') }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="photo" class="form-label">Photo (Passport Size)</label>
            <input type="file" id="photo" class="form-control" name="photo" accept=".jpg,.jpeg,.png">
        </div>
        <div class="mb-3 col-md-6">
            <label for="signature" class="form-label">Signature</label>
            <input type="file" id="signature" class="form-control" name="signature" accept=".jpg,.jpeg,.png">
        </div>

        {{-- <div class="col-md-8"></div>
        <div class="col-md-4 text-end pt-1">
            <button class="btn btn-success" type="submit">Save</button>
        </div> --}}
    </div>
    @include('layouts.inc.form-submit')
</form>

<script>
    function processingReq() {
        var x = document.getElementById("divMsg");
        var y = document.getElementById("txt");

        if (x.style.display === "none") {
            x.style.display = "block";
            document.getElementById("submitBtn").style.display = "none";
            y.style.display = "block";
        } else {
            x.style.display = "none";
            document.getElementById("btnSubmit").style.display = "block";
            y.style.display = "none";
        }
    }
</script>
