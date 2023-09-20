<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\Termination;
use App\Notifications\TerminationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TerminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['HrUser'])) {
            $terminations = Termination::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where('employee_id', Auth::user()->employee_id)->latest()->get();
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $terminations = Termination::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')
            ->where(['department_id' => Auth::user()->employee->department_id??''])->latest()->get();
        } elseif (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $terminations = Termination::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->latest()->get();
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('humanResource.manageTerminations', compact('terminations'));
    }

    public function download(Request $request, $id, $emp_id)
    {
        $letter = Termination::findOrFail($id);
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

            return view('humanResource.createTermination', compact('employees'));
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
            // 'notice_date'=>'required|date',
            'termination_date' => 'required|date',
        ]);

        $terminationCheck = Termination::where('employee_id', $request->employee_id)->first();
        if ($terminationCheck) {
            return response()->json(['status' => 'error', 'message' => 'Termination Already exists for this employee']);
        }

        $currentDate = Carbon::now();
        $terminationDate = Carbon::createFromFormat('Y-m-d', $request->termination_date);

        $emp_id = Employee::select('emp_id', 'department_id')->where('id', $request->employee_id)->get();

        $termination = new Termination();
        $terminationPath = '';

        //check if resignation has a 30 days notice
        if ($currentDate->diffInDays($terminationDate) >= 30) {
            if ($request->hasFile('letter')) {
                $terminationName = 'TerminationLetter'.date('YmdHis').$emp_id[0]->emp_id.'.'.$request->file('letter')->extension();
                $terminationPath = $request->file('letter')->storeAs('termination_files', $terminationName);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Please Include the Termination Letter!']);
            }
            $termination->employee_id = $request->employee_id;
            $termination->emp_id = $emp_id[0]->emp_id;
            $termination->department_id = $emp_id[0]->department_id;
            $termination->reason = $request->reason;
            $termination->termination_date = $request->termination_date;
            $termination->letter = $terminationPath;
            $termination->save();

            $associatedEmployee = Employee::findOrFail($request->employee_id);
            $greeting = 'Hello'.' '.$associatedEmployee->surname.' '.$associatedEmployee->first_name;
            $body = 'You have been issued a Termination for ('.$request->reason.'). Your termination will be effective '.$request->termination_date.'. Please find attachment letter about this matter or login to the system to download the letter please.';

            $details = [
                'greeting' => $greeting,
                'body' => $body,
                'path' => $terminationPath,
            ];

            Notification::send($associatedEmployee, new TerminationNotification($details));

            return response()->json(['status' => 'success', 'message' => 'Termination Successfully Submitted!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Termination notice must be submitted at least 30 days before Official Termination date!']);
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
            $terminations = Termination::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name')->where('employee_id', $id)->latest()->get();

            return view('humanResource.manageTerminations', compact('terminations'));
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
