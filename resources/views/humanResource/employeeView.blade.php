<x-hr-layout>

    <x-report-layout>

        {{-- <x-slot:pagetitle>
            Employee Personal Data
            </x-slot> --}}
            <x-slot:reporttitle>
                Employee Bio/Personal Data Sheet
                </x-slot>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table-striped mb-0 w-100 table-bordered border-primary text-center">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="mb-0">
                                                <tr>
                                                    <td>
                                                        <label><strong>Full Name</strong></label>
                                                        <p>{{ $employee->fullName }}</p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Emp-No</strong></label>
                                                        <p>{{ $employee->emp_id }}</p>
                                                    </td>

                                                    <td>
                                                        <label><strong>NIN</strong></label>
                                                        <p>
                                                            @if ($employee->nin_number == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->nin_number }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label><strong>Gender</strong></label>
                                                        <p>{{ $employee->gender }}</p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Nationality</strong></label>
                                                        <p>
                                                            @if ($employee->nationality == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->nationality }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>DoB</strong></label>
                                                        <p>{{ date('d-m-Y', strtotime($employee->birthday)) }}<span>(Age:{{ $employee->empAge }})</span>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $employee->photo) }}" alt=""
                                                class="img-fluid thumb-nail">
                                            @if ($employee->status == 'Active')
                                                <p class="text-success"><strong>{{ $employee->status }}</strong></p>
                                            @else
                                                <p class="text-danger"><strong>{{ $employee->status }}</strong></p>
                                            @endif

                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table class="w-100 table-bordered border-primary mb-0">
                                                <tr>
                                                    <td>
                                                        <label><strong>Place of Birth</strong></label>
                                                        <p>
                                                            @if ($employee->birth_place == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->birth_place }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Religion</strong></label>
                                                        <p>
                                                            @if ($employee->religious_affiliation == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->religious_affiliation }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Height</strong></label>
                                                        <p>
                                                            @if ($employee->height == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->height }}cm
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Weight</strong></label>
                                                        <p>
                                                            @if ($employee->weight == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->weight }}Kg
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Blood Group</strong></label>
                                                        <p>
                                                            @if ($employee->blood_type == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->blood_type }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Civil Status</strong></label>
                                                        <p>{{ $employee->civil_status }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table class="table-responsive w-100 table-bordered border-primary mb-0">
                                                <tr>
                                                    <td>
                                                        <label><strong>Address</strong></label>
                                                        <p>{{ $employee->address }}</p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Email</strong></label>
                                                        <p>{{ $employee->email }}{{ $employee->alt_email ? ' / ' . $employee->alt_email : '' }}
                                                        </p>

                                                    </td>
                                                    <td>
                                                        <label><strong>Contract</strong></label>
                                                        <p>{{ $employee->contact }}{{ $employee->alt_contact ? ' / ' . $employee->alt_contact : '' }}
                                                        </p>

                                                    </td>
                                                    <td>
                                                        <label><strong>Designation</strong></label>
                                                        <p>
                                                            @if ($employee->designation == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->designation->name }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Duty Station</strong></label>
                                                        <p>
                                                            @if ($employee->station == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->station->station_name }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Department</strong></label>
                                                        <p>
                                                            @if ($employee->department == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->department->department_name }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table class="table-responsive table-bordered border-primary w-100 mb-0">
                                                <tr>
                                                    <td>
                                                        <label><strong>Unit</strong></label>
                                                        <p>
                                                            @if ($employee->departmentunit == null)
                                                                N/A
                                                            @else
                                                                {{ $employee->departmentunit->department_name }}
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Reports To</strong></label>
                                                        @if ($reportingTo->isEmpty())

                                                            <p>N/A</p>
                                                        @else
                                                            @foreach ($reportingTo as $reportsto)
                                                                <p>{{ $reportsto->fullName }}</p>
                                                            @endforeach
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <label><strong>Work Type</strong></label>
                                                        <p>{{ $employee->work_type }}</p>
                                                    </td>
                                                    <td>
                                                        <label><strong>Join Date</strong></label>
                                                        <p>{{ date('d-m-Y', strtotime($employee->join_date)) }}</p>
                                                    </td>
                                                    <td>
                                                        <label><strong>TIN</strong></label>
                                                        <p>
                                                            @if ($employee->tin_number)
                                                                {{ $employee->tin_number }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <label><strong>NSSF No</strong></label>
                                                        <p>
                                                            @if ($employee->tin_number)
                                                                {{ $employee->nssf_number }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                            </table>
                        </div> <!-- end preview-->
                    </div>
                </div>
                <!--EDUCATION BACKGROUND-->
                @if (!$awards->isEmpty())

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">EDUCATION BACKGROUND</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0 table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Institution</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Award</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    @foreach ($awards as $award)
                                        <tr>
                                            <td>
                                                {{ $award->level }}
                                            </td>
                                            <td>
                                                {{ $award->school }}

                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($award->start_date)) }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($award->end_date)) }}
                                            </td>
                                            <td>
                                                {{ $award->award }}
                                            </td>
                                            <td class="table-action text-center">
                                                @if ($award->award_document != null)
                                                    <a href="{{ route('award.download', ['emp_id' => $employee->emp_id, 'id' => $award->id, 'level' => $award->level]) }}"
                                                        class="btn-outline-success no-print"><i
                                                            class="uil-download-alt"></i></a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                @else
                    <div></div>
                @endif
                <!-- end EDUCATION BACKGROUND-->

                <!--EXPERIENCE BACKGROUND-->
                @if (!$experiences->isEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">WORK EXPERIENCE</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0 table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Organisation</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Position</th>
                                            <th>Emp-Type</th>
                                            <th>Responsibility</th>
                                        </tr>
                                    </thead>
                                    @foreach ($experiences as $experience)
                                        <tr>
                                            <td>
                                                {{ $experience->company }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($experience->start_date)) }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($experience->end_date)) }}
                                            </td>
                                            <td>
                                                {{ $experience->position_held }}

                                            </td>

                                            <td>
                                                {{ $experience->employment_type }}
                                            </td>
                                            <td>
                                                {{ $experience->job_description }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                @else
                    <div></div>
                @endif
                <!-- end WORK EXPERIENCE-->

                <!--TRAINING PROGRAMS-->
                @if (!$trainings->isEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">TRAINING PROGRAMS UNDERTAKEN</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0 table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Training</th>
                                            <th>Organisation</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Length</th>
                                            <th>Description</th>
                                            <th>Certificate</th>
                                        </tr>
                                    </thead>
                                    @foreach ($trainings as $training)
                                        <tr>
                                            <td>
                                                {{ $training->training_name }}

                                            </td>
                                            <td>
                                                {{ $training->organised_by }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($training->start_date)) }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($training->end_date)) }}
                                            </td>
                                            <td>
                                                {{ $training->training_length }}
                                            </td>
                                            <td>
                                                {{ $training->training_description }}
                                            </td>
                                            <td class="table-action text-center">
                                                @if ($training->certificate != null)
                                                    <a href="{{ route('certificate.download', ['emp_id' => $employee->emp_id, 'id' => $training->id]) }}"
                                                        class="btn-outline-success no-print"><i
                                                            class="uil-download-alt"></i></a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                @else
                    <div></div>
                @endif
                <!-- end TRAINING PROGRAMS-->

                <!--OFFICIAL CONTRACTS-->
                @if (!$officialcontracts->isEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">OFFICIAL CONTRACT</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0 table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Contract Name</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>G-Pay(UGX)</th>
                                            <th>Contract</th>
                                        </tr>
                                    </thead>
                                    @foreach ($officialcontracts as $Officialcontract)
                                        <tr>
                                            <td>
                                                {{ $Officialcontract->contract_name }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($Officialcontract->start_date)) }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($Officialcontract->end_date)) }}
                                            </td>
                                            <td>
                                                @if (Auth::user()->employee_id === $Officialcontract->employee_id ||
                                                    (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-manage')))
                                                    {{ number_format($Officialcontract->gross_salary, 2) }}
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            <td class="table-action text-center">
                                                @if (Auth::user()->employee_id === $Officialcontract->employee_id ||
                                                    (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-manage')))
                                                    @if ($Officialcontract->contract_file != null)
                                                        <a href="{{ route('officialcontract.download', ['emp_id' => $employee->emp_id, 'id' => $Officialcontract->id]) }}"
                                                            class="btn-outline-success no-print"><i
                                                                class="uil-download-alt"></i></a>
                                                    @else
                                                        N/A
                                                    @endif
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                @else
                    <div></div>
                @endif
                <!-- end OFFICIAL CONTRACTS-->

                <!--PROJECT CONTRACTS-->
                @if (!$projectcontracts->isEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">PROJECT CONTRACTS</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0 table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Contract Name</th>
                                            <th>Designation</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>FTE</th>
                                            <th>G-Pay(UGX)</th>
                                            <th>Contract</th>
                                        </tr>
                                    </thead>
                                    @foreach ($projectcontracts as $projectcontract)
                                        <tr>
                                            <td>
                                                {{ $projectcontract->project->department_name }}

                                            </td>
                                            <td>
                                                {{ $projectcontract->contract_name }}
                                            </td>
                                            <td>
                                                {{ $projectcontract->position->name }}

                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($projectcontract->start_date)) }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($projectcontract->end_date)) }}
                                            </td>
                                            <td>
                                                {{ $projectcontract->fte ? $projectcontract->fte : 'N/A' }}
                                            </td>
                                            <td>
                                                @if (Auth::user()->employee_id === $projectcontract->employee_id ||
                                                    (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-manage')))
                                                    {{ number_format($projectcontract->gross_salary, 2) }}
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            <td class="table-action text-center">
                                                @if (Auth::user()->employee_id === $projectcontract->employee_id ||
                                                    (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-manage')))
                                                    @if ($projectcontract->contract_file != null)
                                                        <a href="{{ route('projectcontract.download', ['emp_id' => $employee->emp_id . $projectcontract->project->department_name, 'id' => $projectcontract->id]) }}"
                                                            class="btn-outline-success no-print"><i
                                                                class="uil-download-alt"></i></a>
                                                    @else
                                                        N/A
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                @else
                    <div></div>
                @endif
                <!-- end PROJECT CONTRACTS-->

                <!--BANKING INFORMATION-->
                @if (!$bankinginformation->isEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">BANKING INFORMATION</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0  text-center">
                                    <thead>
                                        <tr>
                                            <th>Bank Name</th>
                                            <th>Branch</th>
                                            <th>Account Name</th>
                                            <th>Currency</th>
                                            <th>Acct Number</th>
                                        </tr>
                                    </thead>
                                    @foreach ($bankinginformation as $bankinginfo)
                                        <tr>
                                            <td>
                                                {{ $bankinginfo->bank_name }}

                                            </td>
                                            <td>
                                                @if ($bankinginfo->branch != null)
                                                    {{ $bankinginfo->branch }}
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            <td>
                                                {{ $bankinginfo->account_name }}
                                            </td>
                                            <td>
                                                {{ $bankinginfo->currency }}
                                            </td>
                                            <td>
                                                {{ $bankinginfo->account_number }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                @else
                    <div></div>
                @endif
                <!-- end BANKING INFORMATION-->

                <!--FAMILY BACKGROUND INFORMATION-->
                @if (!$familybackgrounds->isEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">FAMILY BACKGROUND</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0">
                                    <thead>
                                        <tr>

                                            <th>Member</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Occupation</th>
                                            <th>Employer</th>
                                            <th>Employer-Address</th>
                                            <th>Employer-Contact</th>
                                        </tr>
                                    </thead>
                                    @foreach ($familybackgrounds as $familybackground)
                                        <tr>
                                            <td>
                                                {{ $familybackground->member_type }}

                                            </td>
                                            <td>
                                                {{ $familybackground->surname . ' ' . $familybackground->middle_name . ' ' . $familybackground->first_name }}
                                            </td>
                                            <td>
                                                {{ $familybackground->address }}

                                            </td>
                                            <td>
                                                {{ $familybackground->contact }}
                                            </td>
                                            <td>
                                                {{ $familybackground->occupation }}
                                            </td>
                                            <td>
                                                {{ $familybackground->employer }}
                                            </td>
                                            <td>
                                                {{ $familybackground->employer_address }}
                                            </td>
                                            <td>
                                                {{ $familybackground->employer_contact }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (!$children->isEmpty())
                                        <tr class="text-center">
                                            <th colspan="8">EMPLOYEE CHILDREN / DEPENDANTS</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4">Child Name</th>
                                            <th colspan="4">Birth Date</th>
                                        </tr>
                                        @foreach ($children as $child)
                                            <tr>
                                                <td colspan="4">{{ $child->child_name }}</td>
                                                <td colspan="4">{{ date('d-m-Y', strtotime($child->birth_date)) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <div></div>
                                    @endif
                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                    <!-- end FAMILY BACKGROUND-->
                @else
                    <div></div>
                @endif
                <!--EMERGENCY CONTACT INFORMATION-->
                @if (!$emergencycontacts->isEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">EMERGENCY CONTACT INFORMATION</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0 table-striped text-center">
                                    <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th>Relationship</th>
                                            <th>Address</th>
                                            <th>Contract</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    @foreach ($emergencycontacts as $emergencycontact)
                                        <tr>
                                            <td>
                                                {{ $emergencycontact->contact_name }}

                                            </td>
                                            <td>
                                                {{ $emergencycontact->contact_relationship }}
                                            </td>
                                            <td>
                                                {{ $emergencycontact->contact_address }}

                                            </td>
                                            <td>
                                                {{ $emergencycontact->contact_phone }}
                                            </td>
                                            <td>
                                                {{ $emergencycontact->contact_email }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                    <!-- end EMERGENCY CONTACT INFORMATION-->
                @else
                    <div></div>
                @endif
                @if (!$designationHistories->isEmpty())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">EMPLOYMENT HISTORY</h4>
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table-responsive table-bordered border-primary w-100 mb-0 table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Stn</th>
                                            <th>Dept</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Supervisor</th>
                                            <th>Salary</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            {{-- <th>Contract</th> --}}
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    @foreach ($designationHistories as $designationHistory)
                                        <tr>
                                            <td>
                                                {{ $designationHistory->station->station_name }}

                                            </td>
                                            <td>
                                                {{ $designationHistory->department->department_name }}
                                            </td>
                                            <td>
                                                @if ($designationHistory->position_one != null)
                                                    {{ $designationHistory->position_one->name }}
                                                @else
                                                    {{ __('Recruitment') }}
                                                @endif

                                            </td>
                                            <td>
                                                {{ $designationHistory->position_two->name }}
                                            </td>
                                            <td>
                                                @if ($designationHistory->reports_to != null)
                                                    {{ $designationHistory->reports_to->fullName }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->employee_id === $designationHistory->employee_id ||
                                                    (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-manage')))
                                                    {{ number_format($designationHistory->contract->gross_salary, 2) }}
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($designationHistory->contract->start_date)) }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($designationHistory->contract->end_date)) }}
                                            </td>
                                            <td>

                                                {{ $designationHistory->contract->status }}
                                                @if (Auth::user()->employee_id === $designationHistory->employee_id ||
                                                    (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-manage')))
                                                    @if ($designationHistory->contract->contract_file != null)
                                                        <a href="{{ route('officialcontract.download', ['emp_id' => $employee->emp_id, 'id' => $designationHistory->contract->id]) }}"
                                                            class="btn-outline-success no-print"><i
                                                                class="uil-download-alt"></i></a>
                                                    @else
                                                        N/A
                                                    @endif
                                                @else
                                                    {{-- N/A --}}
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div> <!-- end preview-->
                        </div>
                    </div>
                    <!-- end EMERGENCY CONTACT INFORMATION-->
                @else
                    <div></div>
                @endif
                <div class="row">
                    <div class="col-lg-12" id="nobreak">
                        <div class="text-sm-end mt-3">
                            <h4 class="header-title mb-3  text-center">DECLARATION</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive  w-100 mb-0 {!! Auth::user()->color_scheme === 'true' ? '' : 'table-striped' !!} text-center">

                                <tr>
                                    <td colspan="2">

                                        I <strong>{{ $employee->fullName }}</strong>
                                        hereby state that the information provided to <strong>Makerere University
                                            Biomedical
                                            Research Center</strong> in this document is truthful and that
                                        <strong>Makerere University Biomedical
                                            Research Center</strong> reserves the right to check the authenticity of the
                                        information provided.
                                        <strong>Makerere University Biomedical Research Center</strong> shall not be
                                        held liable for any wrong
                                        information provided by the employee
                                        and which is used as such.


                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>SIGNATURE</strong></td>
                                    <td><img src="{{ asset('storage/' . $employee->signature) }}" alt=""
                                            class="img-fluid" style="height: 40px"></td>
                                </tr>
                                <tr>
                                    <td><strong>DATE</strong></td>
                                    <td>{{ date('d-m-Y', strtotime(\Carbon\Carbon::now())) }}</td>
                                </tr>

                            </table>
                        </div> <!-- end preview-->
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3 text-end" id="bcode">
                            <svg id="barcodee" style="display: none"></svg>
                        </div>
                    </div>
                </div>

                <div class="text-sm-center mt-3">
                    <button class="btn btn-success" id="noprint1" onclick="window.print();"> PRINT</button>
                </div>

    </x-report-layout>

    @push('scripts')
        <script src="{{ asset('js/JsBarcode.all.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#reportHeader").removeClass('table-bordered border-primary');
                JsBarcode("#barcodee", '{{ $employee->emp_id }}', {
                    format: 'code128',
                    displayValue: false,
                    lineColor: "#24292e",
                    width: 2,
                    height: 30,
                    fontSize: 15
                });

            });
        </script>
    @endpush
</x-hr-layout>
