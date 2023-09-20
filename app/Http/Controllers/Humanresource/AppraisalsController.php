<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\EmployeeAppraisal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AppraisalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['HrUser'])) {
            $appraisals = EmployeeAppraisal::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where('employee_id', Auth::user()->employee_id)->latest()->get();
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $appraisals = EmployeeAppraisal::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where('department_id', Auth::user()->employee->department_id??'')->latest()->get();
        } elseif (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $appraisals = EmployeeAppraisal::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->latest()->get();
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('humanResource.manageAppraisals', compact('appraisals'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('apparaisalform')) {
            $formName = 'AppraisalFormTemplate'.'.'.$request->file('apparaisalform')->extension();
            $formPath = $request->file('apparaisalform')->storeAs('appraisalform_templates', $formName);

            return redirect()->back()->with('success', 'Template successfully Uploaded!');
        } else {
            return redirect()->back()->with('error', 'Please Include the Appraisal Form Template!');
        }
    }

    public function downloadForm(Request $request, $emp_id)
    {
        $file = storage_path('app/appraisal_files/AppraisalFormTemplate.docx');

        // $headers = ['Content-Type: application/pdf'];

        if (file_exists($file)) {
            return \Response::download($file, $emp_id.'AppraisalForm.docx');
        } else {
            echo 'File not found.';
        }
    }

    public function download(Request $request, $id)
    {
        $appraisal = EmployeeAppraisal::findOrFail($id);
        $file = storage_path('app/').$appraisal->appraisal_file;

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
        if (Auth::user()->hasRole(['HrSupervisor', 'HrAdmin'])) {
            $employees = Employee::select('id', 'prefix', 'surname', 'first_name', 'other_name')->where(['department_id' => Auth::user()->employee?->department_id, 'status' => 'Active'])->latest()->get();

            return view('humanResource.uploadAppraisal', compact('employees'));
        } else {
            $employees = collect([]);
            return view('humanResource.uploadAppraisal', compact('employees'));
            
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
        ]);

        $emp_id = Employee::select('emp_id', 'department_id')->where('id', $request->employee_id)->get();

        $employeeAppraisal = new EmployeeAppraisal();
        $appraisalPath = '';

        if ($request->hasFile('appraisal_file')) {
            $appraisalName = $emp_id[0]->emp_id.'Appraisal'.date('YmdHis').'.'.$request->file('appraisal_file')->extension();
            $appraisalPath = $request->file('appraisal_file')->storeAs('appraisal_files', $appraisalName);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Oops! Please include the appraisal file!']);
        }

        $employeeAppraisal->employee_id = $request->employee_id;
        $employeeAppraisal->emp_id = $emp_id[0]->emp_id;
        $employeeAppraisal->department_id = $emp_id[0]->department_id;
        $employeeAppraisal->start_date = $request->start_date;
        $employeeAppraisal->end_date = $request->end_date;
        $employeeAppraisal->appraisal_file = $appraisalPath;

        if ($employeeAppraisal->save()) {
            return response()->json(['status' => 'success', 'message' => 'Appraisal Successfully Submitted!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Oops! something went wrong, record could not be saved']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//Passing employee_id instead of appraisal id
    {
        if (Auth::user()->employee_id == $id) {
            $appraisals = EmployeeAppraisal::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where('employee_id', $id)->latest()->get();

            return view('humanResource.manageAppraisals', compact('appraisals'));
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
