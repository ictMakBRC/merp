<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\Grievance;
use App\Notifications\GrievanceNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class GrievanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myjuniorsList = [];

        $myjuniors = Employee::select('id')->where('reporting_to', Auth::user()->employee_id)->get();

        foreach ($myjuniors as $junior) {
            array_push($myjuniorsList, $junior->id);
        }

        if (Auth::user()->hasRole(['HrUser'])) {
            $grievances = Grievance::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where('employee_id', Auth::user()->employee_id)->latest()->get();
        } elseif (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $grievances = Grievance::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->where('addressee', '!=', 'Supervisor')->latest()->get();
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $grievances = Grievance::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->where('addressee', '!=', 'Administration')->whereIn('employee_id', $myjuniorsList)->latest()->get();
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('humanResource.manageGrievances', compact('grievances'));
    }

    public function download(Request $request, $id, $emp_id)
    {
        $support_file = Grievance::findOrFail($id);
        $file = storage_path('app/').$support_file->support_file;

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
            return view('humanResource.createGrievance');
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

            'grievance_type' => 'required|string|max:50',
            'addressee' => 'required',
            'description' => 'required',
        ]);

        $grievance = new Grievance();
        $grievancePath = '';

        if ($request->hasFile('support_file')) {
            $grievanceName = 'Grievance'.date('YmdHis').auth()->user()->emp_id.'.'.$request->file('support_file')->extension();
            $grievancePath = $request->file('support_file')->storeAs('grievance_files', $grievanceName);
        } else {
            $grievancePath = null;
        }
        $grievance->employee_id = auth()->user()->employee_id;
        $grievance->emp_id = auth()->user()->emp_id;
        $grievance->department_id = auth()->user()->employee->department_id;
        $grievance->grievance_type = $request->grievance_type;
        $grievance->description = $request->description;
        $grievance->addressee = $request->addressee;
        $grievance->support_file = $grievancePath;
        $grievance->status = 'Pending';

        if ($grievance->save()) {
            return response()->json(['status' => 'success', 'message' => 'Grievance Successfully Submitted!']);
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
            $grievances = Grievance::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->where('employee_id', $id)->latest()->get();

            return view('humanResource.manageGrievances', compact('grievances'));
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
    public function update(Request $request, Grievance $grievance)
    {
        $request->validate([

            'status' => 'required|string',
            'comment' => 'required|string',
        ]);

        $grievance->update($request->all());

        $associatedEmployee = Employee::findOrFail($grievance->employee_id);
        $greeting = 'Hello'.' '.$associatedEmployee->surname.' '.$associatedEmployee->first_name;
        $body = 'Your Grievance of type ('.$grievance->grievance_type.') that you earlier submitted on '.$grievance->created_at.' has been discussed and resolved';

        $details = [
            'greeting' => $greeting,
            'body' => $body,
        ];
        Notification::send($associatedEmployee, new GrievanceNotification($details));

        return redirect()->back()->with('success', 'Grievance marked as Resolved!');
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
