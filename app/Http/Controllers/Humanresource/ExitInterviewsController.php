<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\ExitInterview;
use App\Models\Humanresource\Resignation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ExitInterviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['HrUser'])) {
            $exitInterviews = ExitInterview::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where('employee_id', Auth::user()->employee_id)->latest()->get();
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $exitInterviews = ExitInterview::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where(['department_id' => Auth::user()->employee->department_id])->latest()->get();
        } elseif (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $exitInterviews = ExitInterview::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->latest()->get();
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('humanResource.manageExitInterviews', compact('exitInterviews'));
    }

    public function uploadTemplate(Request $request)
    {
        if ($request->hasFile('template_file')) {
            $formName = 'ExitInterviewTemplate'.'.'.$request->file('template_file')->extension();
            $formPath = $request->file('template_file')->storeAs('exitInterview_templates', $formName);

            return redirect()->back()->with('success', 'Template successfully Uploaded!');
        } else {
            return redirect()->back()->with('error', 'Please Include the interview Form Template!');
        }
    }

    public function downloadTemplate(Request $request, $emp_id)
    {
        $file = storage_path('app/exitInterview_templates/ExitInterviewTemplate.docx');

        // $headers = ['Content-Type: application/pdf'];

        if (file_exists($file)) {
            return \Response::download($file, $emp_id.'ExitInterview.docx');
        } else {
            echo 'File not found.';
        }
    }

    public function download(Request $request, $id)
    {
        $exitInterview = ExitInterview::findOrFail($id);
        $file = storage_path('app/').$exitInterview->interview_file;

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
        if (Auth::user()->hasRole(['HrAdmin', 'HrSupervisor', 'HrUser', 'SuperAdmin'])) {
            return view('humanResource.uploadExitInterview');
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
        $resignationCheck = Resignation::where('employee_id', Auth::user()->employee->id)->first();
        if (! $resignationCheck) {
            return response()->json(['status' => 'error', 'message' => 'You can not proceed with this action because No Resignation Record is available ']);
        }

        $interviewCheck = ExitInterview::where('employee_id', Auth::user()->employee->id)->first();
        if ($interviewCheck) {
            return response()->json(['status' => 'error', 'message' => 'ExitInterview Already exists']);
        }

        $exitInterview = new ExitInterview();
        $interviewPath = '';

        if ($request->hasFile('interview_file')) {
            $interviewName = auth()->user()->emp_id.'ExitInterview'.date('YmdHis').'.'.$request->file('interview_file')->extension();
            $interviewPath = $request->file('interview_file')->storeAs('exitInterview_files', $interviewName);
        } else {
            return redirect()->back()->with('error', 'Please Include the interview file!');
        }
        $exitInterview->employee_id = auth()->user()->employee_id;
        $exitInterview->emp_id = auth()->user()->emp_id;
        $exitInterview->department_id = auth()->user()->employee->department_id;
        $exitInterview->interview_file = $interviewPath;

        if ($exitInterview->save()) {
            return response()->json(['status' => 'success', 'message' => 'Exit Interview Successfully Submitted!']);
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
    public function show($id)
    {
        if (Auth::user()->employee_id == $id) {
            $exitInterviews = ExitInterview::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->where('employee_id', $id)->latest()->get();

            return view('humanResource.manageExitInterviews', compact('exitInterviews'));
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
