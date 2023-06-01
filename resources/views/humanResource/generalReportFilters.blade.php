<x-hr-layout>
    <x-page-title>
        Advanced Reports
    </x-page-title>
    <!-- end row-->
    <div class="row mx-auto">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('employees.filter') }}" method="POST">
                        @csrf
                        <h4 class="text-info">Advanced Employee Filter </h4>
                        {{-- <hr> --}}
                        <div class="row mx-auto">
                            <div class="mb-3 col-md-12">
                                <label for="report_title" class="form-label">Report Title</label>
                                <input type="text" id="report_title" class="form-control text-uppercase"
                                    name="report_title" onkeyup="this.value = this.value.toUpperCase();"
                                    value="{{ old('report_title', '') }}" required placeholder="Enter Report Title">
                            </div>
                            <hr>
                            <div class="mb-3 col-md-3 ">
                                <label for="department_id" class="form-label">Department</label>
                                <select class="form-select select2" data-toggle="select2" id="department_id"
                                    name="department_id">
                                    <option value="0" selected>All</option>
                                    @if (count($departments) > 0)
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select select2" data-toggle="select2" id="gender" name="gender">
                                    <option value="0" selected>All</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="work_type" class="form-label">Work Type</label>
                                <select class="form-select select2" data-toggle="select2" id="work_type"
                                    name="work_type" required>
                                    <option selected value="0">All</option>
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

                            <div class="mb-3 col-md-2">
                                <label for="duty_station" class="form-label">Duty Station</label>
                                <select class="form-select select2" data-toggle="select2" id="duty_station"
                                    name="station_id">
                                    <option selected value="0">All</option>
                                    @foreach ($stations as $station)
                                        <option value='{{ $station->id }}'>{{ $station->station_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="position" class="form-label">Designation / Position</label>
                                <select class="form-select select2" data-toggle="select2" id="position"
                                    name="position">
                                    <option selected value="0">All</option>
                                    @foreach ($designations as $designation)
                                        <option value='{{ $designation->id }}'>{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="join_date1" class="form-label">From Join Date</label>
                                <input type="date" id="join_date1" class="form-control" name="join_date1"
                                    value="{{ old('join_date1', '') }}">
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="join_date2" class="form-label">To Join Date</label>
                                <input type="date" id="join_date2" class="form-control" name="join_date2"
                                    value="{{ old('join_date2', '') }}">
                            </div>

                            <div class="mb-3 col-md-2">
                                <label for="status1" class="form-label">Status</label>
                                <select class="form-select select2" data-toggle="select2" id="status1" name="status">
                                    <option value='Active' selected>Active</option>
                                    <option value="0">All</option>
                                    <option value='Suspended'>Suspended</option>
                                    <option value='Terminated'>Terminated</option>
                                    <option value='Resigned'>Resigned</option>
                                    <option value='Retired'>Retired</option>
                                    <option value='Contract Expired'>Contract Expired</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="nationality" class="form-label">Nationality</label>
                                <select class="form-select select2" data-toggle="select2" id="nationality"
                                    name="nationality">
                                    <option value="0" selected>All</option>
                                    @include('humanResource.layouts.countries')
                                </select>
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="religious_affiliation" class="form-label">Religion</label>
                                <input type="text" id="religious_affiliation" name="religious_affiliation"
                                    class="form-control">
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="civil_status" class="form-label">Civil_status</label>
                                <select class="form-select select2" data-toggle="select2" id="civil_status"
                                    name="civil_status">
                                    <option value="0" selected>All</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Windowed">Windowed</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-2">
                                <label for="birthday1" class="form-label">From DoB</label>
                                <input type="date" id="birthday1" class="form-control" name="birthday1"
                                    value="{{ old('birthday1', '') }}">

                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="birthday2" class="form-label">To DoB</label>
                                <input type="date" id="birthday2" class="form-control" name="birthday2"
                                    value="{{ old('birthday2', '') }}">

                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="birth_place" class="form-label">Place of Birth</label>
                                <input type="text" id="birth_place" class="form-control text-uppercase"
                                    name="birth_place" onkeyup="this.value = this.value.toUpperCase();"
                                    value="{{ old('birth_place', '') }}">
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="blood_type" class="form-label">Blood Type</label>
                                <select class="form-select select2" data-toggle="select2" id="blood_type"
                                    name="blood_type">
                                    <option value="0">All</option>
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
                            <div class="mb-3 col-md-1">
                                <label for="prefix" class="form-label">Title</label>
                                <select class="form-select select2" data-toggle="select2" id="prefix"
                                    name="prefix">
                                    <option value="0">All</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Miss.">Miss.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Eng.">Eng.</option>
                                    <option value="Prof.">Prof.</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" class="form-control text-uppercase"
                                    name="address" onkeyup="this.value = this.value.toUpperCase();"
                                    value="{{ old('address', '') }}">
                            </div>
                            <hr>
                        </div>
                        <div class="mt-2 row mx-auto">
                            <div class="col-md-8">
                                {{-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exportCheck" name="exportCheck">
                                    <label class="form-check-label text-success" for="exportCheck">Export to Excel</label>
                                </div> --}}
                            </div>
                            <div class="col-md-4 text-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</x-hr-layout>
