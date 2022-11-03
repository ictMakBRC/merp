<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\EmployeeWarning;
use App\Notifications\WarningNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class WarningsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $warnings = EmployeeWarning::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->latest()->get();

            return view('humanResource.manageWarnings', compact('warnings'));
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $warnings = EmployeeWarning::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where('department_id', Auth::user()->employee->department_id)->latest()->get();

            return view('humanResource.manageWarnings', compact('warnings'));
        } elseif (Auth::user()->hasRole(['HrUser'])) {
            $warnings = EmployeeWarning::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->where('employee_id', Auth::user()->employee_id)->latest()->get();

            return view('humanResource.manageWarnings', compact('warnings'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    public function download(Request $request, $id, $emp_id)
    {
        $letter = EmployeeWarning::findOrFail($id);
        $file = storage_path('app/').$letter->letter;

        // $headers = ['Content-Type: application/pdf'];

        if (file_exists($file)) {
            return \Response::download($file);
        } else {
            echo 'File not found.';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole(['HrAdmin'])) {
            $employees = Employee::select('id', 'prefix', 'surname', 'first_name', 'other_name')->where('status', 'Active')->get();

            return view('humanResource.createWarning', compact('employees'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
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
            'employee_id' => 'required|integer',
            'reason' => 'required|string|max:100',
        ]);

        $emp_id = Employee::select('emp_id', 'department_id')->where('id', $request->employee_id)->get();

        $employeeWarning = new EmployeeWarning();
        $warningPath = '';

        if ($request->hasFile('letter')) {
            $warningName = 'WarningLetter'.date('YmdHis').$emp_id[0]->emp_id.'.'.$request->file('letter')->extension();
            $warningPath = $request->file('letter')->storeAs('warning_files', $warningName);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Please Include the warning Letter!']);
        }
        $employeeWarning->employee_id = $request->employee_id;
        $employeeWarning->emp_id = $emp_id[0]->emp_id;
        $employeeWarning->department_id = $emp_id[0]->department_id;
        $employeeWarning->reason = $request->reason;
        $employeeWarning->letter = $warningPath;
        $employeeWarning->save();

        $associatedEmployee = Employee::findOrFail($request->employee_id);
        $greeting = 'Hello'.' '.$associatedEmployee->surname.' '.$associatedEmployee->first_name;
        $body = 'You have been issued a warning for ('.$request->reason.'). Please find attachment letter about this matter or login to the system to download the letter please.';

        $details = [
            'greeting' => $greeting,
            'body' => $body,
            'path' => $warningPath,
        ];

        Notification::send($associatedEmployee, new WarningNotification($details));

        return response()->json(['status' => 'success', 'message' => 'Warning Successfully Submitted!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//Passing employee_id instead of warning id
    {
        if (Auth::user()->employee_id == $id) {
            $warnings = EmployeeWarning::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->where('employee_id', $id)->latest()->get();

            return view('humanResource.manageWarnings', compact('warnings'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
