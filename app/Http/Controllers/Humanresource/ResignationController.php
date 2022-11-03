<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Resignation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ResignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['HrUser'])) {
            $resignations = Resignation::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name', 'approver:id,prefix,surname,other_name,first_name')
            ->where('employee_id', Auth::user()->employee_id)->latest()->get();
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $resignations = Resignation::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name', 'approver:id,prefix,surname,other_name,first_name')
            ->where(['department_id' => Auth::user()->employee->department_id, 'status' => 'Accepted'])->latest()->get();
        } elseif (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $resignations = Resignation::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name', 'approver:id,prefix,surname,other_name,first_name')->latest()->get();
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('humanResource.manageResignations', compact('resignations'));
    }

    public function download(Request $request, $id, $emp_id)
    {
        $resignationLetter = Resignation::findOrFail($id);
        $file = storage_path('app/').$resignationLetter->letter;

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
        if (Auth::user()->hasRole(['HrSupervisor', 'HrAdmin', 'HrUser', 'SuperAdmin'])) {
            return view('humanResource.createResignation');
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

            'subject' => 'required|string|max:100',
            'hand_over_date' => 'required|date',
        ]);

        $resignationCheck = Resignation::where('employee_id', Auth::user()->employee->id)->first();
        if ($resignationCheck) {
            return response()->json(['status' => 'error', 'message' => 'Resignation Already exists']);
        }

        $currentDate = Carbon::now();
        $handoverDate = Carbon::createFromFormat('Y-m-d', $request->hand_over_date);

        if ($currentDate->diffInDays($handoverDate) >= 30) { //check if resignation has a 30 days notice
            $resignation = new Resignation();
            $resignationPath = '';

            if ($request->hasFile('letter')) {
                $resignationName = 'Resignation'.date('YmdHis').auth()->user()->emp_id.'.'.$request->file('letter')->extension();
                $resignationPath = $request->file('letter')->storeAs('resignation_files', $resignationName);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Please Include the Resignation Letter!']);
            }
            $resignation->employee_id = auth()->user()->employee_id;
            $resignation->emp_id = auth()->user()->emp_id;
            $resignation->department_id = auth()->user()->employee->department_id;
            $resignation->subject = $request->subject;
            $resignation->hand_over_date = $request->hand_over_date;
            $resignation->letter = $resignationPath;
            $resignation->status = 'Pending';

            if ($resignation->save()) {
                return response()->json(['status' => 'success', 'message' => 'Resignation Successfully Submitted!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Oops! something went wrong, record could not be saved']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Resignation Notice must be submitted at least 30 days before Handover date!']);
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
            $resignations = Resignation::with('employee', 'employee.designation:id,name', 'employee.department:id,department_name', 'approver:id,prefix,surname,other_name,first_name')->where('employee_id', $id)->latest()->get();

            return view('humanResource.manageResignations', compact('resignations'));
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
    public function update(Request $request, Resignation $resignation)
    {
        $request->validate([

            'status' => 'required|string',
            'comment' => 'required|string',
            'approved_by' => 'required|string',
        ]);
        $resignation->update($request->all());
        if ($request->status == 'Accepted') {
            return redirect()->back()->with('success', 'You have Accepted the Resignation!');
        } else {
            return redirect()->back()->with('success', 'You have Declined the Resignation!');
        }
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
