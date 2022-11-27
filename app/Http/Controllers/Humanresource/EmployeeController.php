<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Humanresource\BankingInformation;
use App\Models\Humanresource\Child;
use App\Models\Humanresource\Designation;
use App\Models\Humanresource\DesignationHistory;
use App\Models\Humanresource\EducationBackground;
use App\Models\Humanresource\EmergencyContact;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\EmployeeAppraisal;
use App\Models\Humanresource\ExitInterview;
use App\Models\Humanresource\FamilyBackground;
use App\Models\Humanresource\Grievance;
use App\Models\Humanresource\LeaveRequest;
use App\Models\Humanresource\OfficialContract;
use App\Models\Humanresource\ProjectContract;
use App\Models\Humanresource\Resignation;
use App\Models\Humanresource\TrainingProgram;
use App\Models\Humanresource\WorkExperience;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childDepartments = [];

        $level1_children = Department::select('id')->where('parent_department', Auth::user()->employee->department_id)->get();
        if (! $level1_children->isEmpty()) {
            foreach ($level1_children as $level1_child) {
                array_push($childDepartments, $level1_child->id);
            }
        }

        $level2_children = Department::select('id')->whereIn('parent_department', $childDepartments)->get();
        if (! $level2_children->isEmpty()) {
            foreach ($level2_children as $level2_child) {
                array_push($childDepartments, $level2_child->id);
            }
        }

        $level3_children = Department::select('id')->whereIn('parent_department', $childDepartments)->get();

        if (! $level3_children->isEmpty()) {
            foreach ($level3_children as $level3_child) {
                array_push($childDepartments, $level3_child->id);
            }
        }
        // return $childDepartments;
        // return $level2_children;

        if (Auth::user()->hasRole(['HrSupervisor'])) {
            $employees = Employee::with(['department:id,department_name', 'designation:id,name'])->where('status', 'Active')
            ->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->latest()->get();

            return view('humanResource.employeesList', compact('employees'));
        } elseif (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $employees = Employee::with(['department:id,department_name', 'designation:id,name'])->where('status', 'Active')->latest()->get();

            return view('humanResource.employeesList', compact('employees'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('status', 'Active')->latest()->get();
        $designations = Designation::where('status', 'Active')->latest()->get();
        $stations = Station::latest()->where('status', 'Active')->latest()->get();
        $projects = Department::where('type', 'Project')->where('status', 'Active')->latest()->get();
        $departments = Department::where('type', 'Department')->orWhere('type', 'Unit')->orWhere('type', 'Laboratory')->latest()->get();

        return view('humanResource.createEmployee', compact('designations', 'stations', 'departments', 'employees', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'emp_id'=>'required|string|unique:employees',
            'prefix' => 'required|string',
            'surname' => 'required|string|max:40',
            'first_name' => 'required|string|max:40',
            'gender' => 'required|string|max:6',
            'nationality' => 'required|string',
            'birthday' => 'date|required',
            // 'civil_status' => 'required|string',
            // 'address' => 'string|required',
            'email' => 'required|string|email|max:255|unique:employees',
            // 'alt_email' => 'string|email|max:255|unique:employees',
            // 'contact' => 'string|required',
            'designation_id' => 'integer|required',
            'work_type' => 'string|required',
            'join_date' => 'date|required',
        ]);

        $employee = new Employee();
        $photoPath = '';
        $signaturePath = '';
        $alphabets = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        $emp_number = '';

        if ($request->hasFile('photo') && $request->hasFile('signature')) {
            $request->validate(['photo' => 'image|max:70|dimensions:max_width=160,max_height=160']);
            $photoName = date('YmdHis').$request->emp_id.'.'.$request->file('photo')->extension();
            $signatureName = date('YmdHis').$request->emp_id.'.'.$request->file('signature')->extension();
            $photoPath = $request->file('photo')->storeAs('photos', $photoName, 'public');
            $signaturePath = $request->file('signature')->storeAs('signatures', $signatureName, 'public');
        } elseif ($request->hasFile('photo')) {
            $request->validate(['photo' => 'image|max:70|dimensions:max_width=160,max_height=160']);
            $photoName = date('YmdHis').$request->emp_id.'.'.$request->file('photo')->extension();
            $photoPath = $request->file('photo')->storeAs('photos', $photoName, 'public');
            $signaturePath = null;
        } elseif ($request->hasFile('signature')) {
            $signatureName = date('YmdHis').$request->emp_id.'.'.$request->file('signature')->extension();
            $signaturePath = $request->file('signature')->storeAs('signatures', $signatureName, 'public');
            $photoPath = null;
        } else {
            $photoPath = null;
            $signaturePath = null;
        }
        $age = Carbon::createFromFormat('Y-m-d', $request->birthday)->diffInYears(Carbon::today());

        $randomAlphabetIndex = mt_rand(0, strlen($alphabets) - 1);
        $randomAlphabet = $alphabets[$randomAlphabetIndex];

        $latestEmpNo = Employee::select('emp_id')->orderBy('id', 'desc')->first();

        if ($latestEmpNo) {
            $emp_number = 'BRC'.((int) filter_var($latestEmpNo->emp_id, FILTER_SANITIZE_NUMBER_INT) + 1).$randomAlphabet;
        } else {
            $emp_number = 'BRC10000'.$randomAlphabet;
        }

        //return $emp_number;
        // $day=Carbon::today()->day;
        // $month=Carbon::today()->month;
        // $next_date=Carbon::today()->addDays(30)->format('Y-m-d');
        // $prev_date=Carbon::today()->subDays(30)->format('Y-m-d');

        $employee->emp_id = $emp_number;
        $employee->nin_number = $request->nin_number;
        $employee->prefix = $request->prefix;
        $employee->surname = $request->surname;
        $employee->other_name = $request->other_name;
        $employee->first_name = $request->first_name;
        $employee->gender = $request->gender;
        $employee->nationality = $request->nationality;
        $employee->birthday = $request->birthday;
        $employee->age = $age;
        $employee->birth_place = $request->birth_place;
        $employee->religious_affiliation = $request->religious_affiliation;
        $employee->height = $request->height;
        $employee->weight = $request->weight;
        $employee->blood_type = $request->blood_type;
        $employee->civil_status = $request->civil_status;
        $employee->address = $request->address;
        $employee->email = $request->email;
        $employee->alt_email = $request->alt_email;
        $employee->contact = $request->contact;
        $employee->alt_contact = $request->alt_contact;
        $employee->designation_id = $request->designation_id;
        $employee->station_id = $request->station_id;
        $employee->department_id = $request->department_id;
        $employee->department_unit_id = $request->department_unit_id;
        $employee->reporting_to = $request->reporting_to;
        $employee->work_type = $request->work_type;
        $employee->join_date = $request->join_date;
        $employee->status = 'Active';
        $employee->tin_number = $request->tin_number;
        $employee->nssf_number = $request->nssf_number;
        $employee->photo = $photoPath;
        $employee->signature = $signaturePath;

        $employee->save();

        return redirect()->back()->with('success', $request->surname.' '.$request->first_name.' Record created and Employee Number ['.$emp_number.'] successfully assigned');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin']) || Auth::user()->hasRole(['HrUser']) && Auth::user()->employee_id == $employee->id || Auth::user()->hasRole(['HrSupervisor']) && Auth::user()->employee->department_id == $employee->department_id) {
            $employee->load('station:id,station_name', 'department:id,department_name', 'designation:id,name', 'departmentunit:id,department_name')->get();
            $reportingTo = Employee::select('prefix', 'surname', 'other_name', 'first_name')->where('id', $employee->reporting_to)->get();
            $awards = EducationBackground::where('employee_id', $employee->id)->latest()->get();
            $experiences = WorkExperience::where('employee_id', $employee->id)->latest()->get();
            $trainings = TrainingProgram::where('employee_id', $employee->id)->latest()->get();
            $children = Child::where('employee_id', $employee->id)->latest()->get();
            $designationHistories = DesignationHistory::with('department:id,department_name', 'station:id,station_name', 'position_one:id,name', 'position_two:id,name', 'reports_to:id,prefix,surname,other_name,first_name', 'contract')->where(['employee_id' => $employee->id])->latest()->get();
            $bankinginformation = BankingInformation::where('employee_id', $employee->id)->latest()->get();
            $officialcontracts = OfficialContract::where(['employee_id' => $employee->id, 'status' => 'Running'])->latest()->get();
            $projectcontracts = ProjectContract::with('project:id,department_name', 'position:id,name')->where(['employee_id' => $employee->id, 'status' => 'Running'])->latest()->get();
            $familybackgrounds = FamilyBackground::where('employee_id', $employee->id)->latest()->get();
            $emergencycontacts = EmergencyContact::where('employee_id', $employee->id)->latest()->get();

            return view('humanResource.employeeView', compact('employee', 'reportingTo', 'awards', 'experiences', 'trainings', 'projectcontracts', 'officialcontracts', 'bankinginformation', 'familybackgrounds', 'children', 'emergencycontacts', 'designationHistories'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    public function dashboard()
    {
        $today = Carbon::today()->addDays(1)->format('Y-m-d');
        $day = Carbon::today()->day;
        $month = Carbon::today()->month;
        $next_date = Carbon::today()->addDays(30)->format('Y-m-d');
        $prev_date = Carbon::today()->subDays(30)->format('Y-m-d');

        $labCount = Department::where(['status' => 'active', 'type' => 'Laboratory'])->count();

        if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $leaveCount = LeaveRequest::where(['status' => 'Approved', 'confirmation' => 'Confirmed', 'accepted_by' => null])->count();
            $grievanceCount = Grievance::where('status', 'Pending')->count();
            $resignationCount = Resignation::where('status', 'Pending')->count();
            $exitInterviewCount = ExitInterview::whereBetween('created_at', [$prev_date, $today])->count();
            $appraisalCount = EmployeeAppraisal::whereBetween('created_at', [$prev_date, $today])->count();
            $departmentCount = Department::where(['status' => 'active', 'type' => 'Unit'])->count();
            $projectsCount = Department::where(['status' => 'active', 'type' => 'Project'])->count();
            $employeeCount = Employee::where('status', 'active')->count();
            $expiredCount = OfficialContract::where('status', 'Expired')->whereBetween('end_date', [$prev_date, $today])->count();

            return view('humanResource.dashboard', compact(
                'employeeCount', 'expiredCount',
                'departmentCount', 'projectsCount',
                'grievanceCount', 'labCount',
                'leaveCount', 'exitInterviewCount',
                'appraisalCount', 'resignationCount'));
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $childDepartments = [];

            $level1_children = Department::select('id')->where('parent_department', Auth::user()->employee->department_id)->get();

            if (! $level1_children->isEmpty()) {
                foreach ($level1_children as $level1_child) {
                    array_push($childDepartments, $level1_child->id);
                }
            }

            $level2_children = Department::select('id')->whereIn('parent_department', $childDepartments)->get();

            if (! $level2_children->isEmpty()) {
                foreach ($level2_children as $level2_child) {
                    array_push($childDepartments, $level2_child->id);
                }
            }

            $level3_children = Department::select('id')->whereIn('parent_department', $childDepartments)->get();

            if (! $level3_children->isEmpty()) {
                foreach ($level3_children as $level3_child) {
                    array_push($childDepartments, $level3_child->id);
                }
            }

            $leaveCount = LeaveRequest::where(['status' => 'Approved', 'confirmation' => 'Confirmed'])
            ->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->count();
            $grievanceCount = Grievance::where('status', 'Pending')
            ->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->count();
            $resignationCount = Resignation::where('status', 'Pending')
            ->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->count();
            $exitInterviewCount = ExitInterview::whereBetween('created_at', [$prev_date, $today])
            ->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->count();
            $appraisalCount = EmployeeAppraisal::whereBetween('created_at', [$prev_date, $today])
            ->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->count();
            $departmentCount = Department::where(['status' => 'active', 'type' => 'Unit'])->count();
            $projectsCount = Department::where(['status' => 'active', 'type' => 'Project'])->count();
            $employeeCount = Employee::where('status', 'active')
            ->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->count();
            $expiredCount = OfficialContract::where('status', 'Expired')->whereBetween('end_date', [$prev_date, $today])
            ->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->count();

            return view('humanResource.dashboard', compact(
                'employeeCount', 'expiredCount',
                'departmentCount', 'projectsCount', 'grievanceCount',
                'leaveCount', 'labCount', 'exitInterviewCount',
                'appraisalCount', 'resignationCount'));
        } elseif (Auth::user()->hasRole(['HrUser'])) {
            $employee = Employee::with('station:id,station_name', 'department:id,department_name', 'designation:id,name', 'departmentunit:id,department_name')->where('id', Auth::user()->employee->id)->first();
            $reportingTo = Employee::select('prefix', 'surname', 'other_name', 'first_name')->where('id', $employee->reporting_to)->first();

            return view('humanResource.hruserdashboard', compact('employee', 'reportingTo'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $read_only = false;
        if (Auth::user()->hasRole(['HrSupervisor', 'SuperAdmin', 'HrUser'])) {
            $read_only = true;
        }

        if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin']) || Auth::user()->hasRole(['HrUser']) && Auth::user()->employee_id == $employee->id || Auth::user()->hasRole(['HrSupervisor']) && Auth::user()->employee->department_id == $employee->department_id) {
            $employee->load('station:id,station_name', 'department:id,department_name', 'designation:id,name', 'departmentunit:id,department_name')->get();
            $reportingTo = Employee::select('id', 'prefix', 'surname', 'other_name', 'first_name')->where('id', $employee->reporting_to)->get();
            $awards = EducationBackground::where('employee_id', $employee->id)->latest()->get();
            $experiences = WorkExperience::where('employee_id', $employee->id)->latest()->get();
            $trainings = TrainingProgram::where('employee_id', $employee->id)->latest()->get();
            $bankinginformation = BankingInformation::where('employee_id', $employee->id)->latest()->get();
            $officialcontracts = OfficialContract::where('employee_id', $employee->id)->latest()->get();
            $projectcontracts = ProjectContract::with('project:id,department_name', 'position:id,name')->where('employee_id', $employee->id)->latest()->get();
            $familybackgrounds = FamilyBackground::where('employee_id', $employee->id)->latest()->get();
            $emergencycontacts = EmergencyContact::where('employee_id', $employee->id)->latest()->get();
            $employees = Employee::latest()->where('status', 'Active')->get();
            $designations = Designation::latest()->where('status', 'Active')->get();
            $stations = Station::latest()->where('status', 'Active')->get();
            $projects = Department::where('type', 'Project')->latest()->where('status', 'Active')->get();
            $departments = Department::where('type', 'Department')->orWhere('type', 'Unit')->orWhere('type', 'Laboratory')->latest()->get();

            return view('humanResource.editEmployee', compact('employee', 'reportingTo', 'awards', 'experiences', 'trainings', 'projectcontracts', 'officialcontracts', 'bankinginformation', 'familybackgrounds', 'emergencycontacts', 'designations', 'stations', 'departments', 'employees', 'projects', 'read_only'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'emp_id' => 'required|string',
            'prefix' => 'required|string',
            'surname' => 'required|string|max:40',
            'first_name' => 'required|string|max:40',
            'gender' => 'required|string|max:6',
            // 'nationality' => 'required|string',
            // 'birthday' => 'date|required',
            // 'civil_status' => 'required|string',
            // 'address' => 'string|required',
            'email' => 'required|string|email|max:255',
            // 'contact' => 'string|required',
            // 'designation_id' => 'integer|required',
            // 'work_type' => 'string|required',
            'status' => 'string|required',
            'join_date' => 'date|required',
        ]);
        //return $request;
        $storagePath1 = storage_path('app/public/').$employee->photo;
        $storagePath2 = storage_path('app/public/').$employee->signature;

        // $employee = new Employee();
        $photoPath = '';
        $signaturePath = '';

        if ($request->hasFile('photo') && $request->hasFile('signature')) {
            $request->validate(['photo' => 'image|max:70|dimensions:max_width=160,max_height=160']);
            $photoName = date('YmdHis').$request->emp_id.'.'.$request->file('photo')->extension();
            $signatureName = date('YmdHis').$request->emp_id.'.'.$request->file('signature')->extension();
            $photoPath = $request->file('photo')->storeAs('photos', $photoName, 'public');
            $signaturePath = $request->file('signature')->storeAs('signatures', $signatureName, 'public');
            if (file_exists($storagePath1) || file_exists($storagePath2)) {
                @unlink($storagePath1);
                @unlink($storagePath2);
            }
        } elseif ($request->hasFile('photo')) {
            $request->validate(['photo' => 'image|max:70|dimensions:max_width=160,max_height=160']);
            $photoName = date('YmdHis').$request->emp_id.'.'.$request->file('photo')->extension();
            $photoPath = $request->file('photo')->storeAs('photos', $photoName, 'public');
            $signaturePath = $employee->signature;

            if (file_exists($storagePath1)) {
                @unlink($storagePath1);
            }
        } elseif ($request->hasFile('signature')) {
            $signatureName = date('YmdHis').$request->emp_id.'.'.$request->file('signature')->extension();
            $signaturePath = $request->file('signature')->storeAs('signatures', $signatureName, 'public');
            $photoPath = $employee->photo;

            if (file_exists($storagePath2)) {
                @unlink($storagePath2);
            }
        } else {
            $photoPath = $employee->photo;
            $signaturePath = $employee->signature;
        }

        $employee->emp_id = $request->emp_id;
        $employee->nin_number = $request->nin_number;
        $employee->prefix = $request->prefix;
        $employee->surname = $request->surname;
        $employee->other_name = $request->other_name;
        $employee->first_name = $request->first_name;
        $employee->gender = $request->gender;
        $employee->nationality = $request->nationality;
        $employee->birthday = $request->birthday;
        $employee->age = $request->age;
        $employee->birth_place = $request->birth_place;
        $employee->religious_affiliation = $request->religious_affiliation;
        $employee->height = $request->height;
        $employee->weight = $request->weight;
        $employee->blood_type = $request->blood_type;
        $employee->civil_status = $request->civil_status;
        $employee->address = $request->address;
        $employee->email = $request->email;
        $employee->alt_email = $request->alt_email;
        $employee->contact = $request->contact;
        $employee->alt_contact = $request->alt_contact;
        $employee->designation_id = $request->designation_id;
        $employee->station_id = $request->station_id;
        $employee->department_id = $request->department_id;
        $employee->department_unit_id = $request->department_unit_id;
        $employee->reporting_to = $request->reporting_to;
        $employee->work_type = $request->work_type;
        $employee->join_date = $request->join_date;
        $employee->status = $request->status;
        $employee->tin_number = $request->tin_number;
        $employee->nssf_number = $request->nssf_number;
        $employee->photo = $photoPath;
        $employee->signature = $signaturePath;

        $employee->update();

        return redirect()->back()->with('success', 'Employee Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
