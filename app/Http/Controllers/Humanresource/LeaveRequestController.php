<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\Leave;
use App\Models\Humanresource\LeaveRequest;
use App\Notifications\LeaveRequestNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yearStart = Carbon::now();
        $yearStart->month = 01;
        $yearStart->day = 01;
        $myjuniorsList = [];

        $myjuniors = Employee::select('id')->where(['status' => 'Active', 'reporting_to' => Auth::user()->employee_id])->get();
        foreach ($myjuniors as $junior) {
            array_push($myjuniorsList, $junior->id);
        }

        if (Auth::user()->hasRole(['HrUser'])) {
            $leaverequests = LeaveRequest::with('employee', 'employee.department:id,department_name', 'leave:id,name,duration,notice_days', 'approver:id,prefix,surname,other_name,first_name')
            ->where('employee_id', Auth::user()->employee_id)->where('start_date', '>=', $yearStart)->latest()->get();
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $leaverequests = LeaveRequest::with(['employee', 'employee.department', 'leave:id,name,duration,notice_days', 'approver:id,prefix,surname,other_name,first_name'])
            ->whereIn('employee_id', $myjuniorsList)->where('start_date', '>=', $yearStart)->where('delegatee_status', 'Accepted')->latest()->get();
        } elseif (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $leaverequests = LeaveRequest::with('employee', 'employee.department:id,department_name', 'leave:id,name,duration,notice_days', 'approver:id,prefix,surname,other_name,first_name')
            ->where('start_date', '>=', $yearStart)
            ->where(['status' => 'Approved', 'confirmation' => 'Confirmed'])->latest()->get();
        }

        $employee = Employee::findOrFail(Auth::user()->employee_id);
        $parentDept = Department::select('parent_department')->where('id', Auth::user()->employee->department_id??'')->get();

        if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin', 'HrSupervisor'])) {
            $deptEmployees = Employee::select('id', 'prefix', 'surname', 'other_name', 'first_name')->where('id', '!=', $employee->id)->where('department_id', Auth::user()->employee->department_id??'')
            ->orWhere('department_id', $parentDept[0]->parent_department)->get();
        } else {
            $deptEmployees = Employee::select('id', 'prefix', 'surname', 'other_name', 'first_name')->where('department_id', Auth::user()->employee->department_id??'')
            ->where('id', '!=', Auth::user()->employee->id)->get();
        }

        if ($employee->gender == 'Male') {
            $leaveTypes = Leave::where('status', 'Active')->where('name', '!=', 'Maternity')->get();
        } else {
            $leaveTypes = Leave::where('status', 'Active')->where('name', '!=', 'Paternity')->get();
        }

        return view('humanResource.leaveRequests', compact('leaveTypes', 'leaverequests', 'deptEmployees'));
    }

    public function availableCredits($id)
    {
        // $joinYear=Carbon::createFromFormat('Y-m-d', Auth::user()->employee->join_date)->year;
        $availableCredits = Leave::select('duration', 'notice_days')->where('id', $id)->get();

        return response()->json(['duration' => $availableCredits[0]->duration, 'notice_days' => $availableCredits[0]->notice_days]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'leave_id' => 'required|integer',
            'length' => 'required|integer',
            'delegated_to' => 'required|integer',
            'reason' => 'required|string',
            'duties_delegated' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'required|string',
        ]);

        $leaveType = Leave::findOrFail($request->leave_id);
        $leaveDuration = Carbon::createFromFormat('Y-m-d', $request->start_date)->diffInDays(Carbon::createFromFormat('Y-m-d', $request->end_date));
        $noticeDuration = Carbon::today()->diffInDays(Carbon::createFromFormat('Y-m-d', $request->start_date));
        $runningLeaveCheck = LeaveRequest::leaveRequestCheck()->first();

        if ($runningLeaveCheck) {
            return response()->json(['status' => 'error', 'message' => 'There is an already a running leave please!']);
        }

        if ($leaveDuration > $leaveType->duration) {
            return response()->json(['status' => 'error', 'message' => 'Number of days on leave should not exceed Available Credits']);
        }

        if ($noticeDuration < $leaveType->notice_days || $noticeDuration != $leaveType->notice_days) {
            return response()->json(['status' => 'error', 'message' => 'You must submit the request in '.$leaveType->notice_days.' day(s) before the start date of your Leave please']);
        }

        $leaveRequest = new LeaveRequest();
        $leaveRequest->employee_id = Auth::user()->employee_id;
        $leaveRequest->emp_id = Auth::user()->emp_id;
        $leaveRequest->department_id = Auth::user()->employee->department_id??'';
        $leaveRequest->leave_id = $request->leave_id;
        $leaveRequest->start_date = $request->start_date;
        $leaveRequest->end_date = $request->end_date;
        $leaveRequest->length = $request->length;
        $leaveRequest->reason = $request->reason;
        $leaveRequest->delegated_to = $request->delegated_to;
        $leaveRequest->duties_delegated = $request->duties_delegated;
        $leaveRequest->status = 'Pending';
        $leaveRequest->save();

        $associatedEmployee = Employee::findOrFail(Auth::user()->employee_id);
        $delegatee = Employee::findOrFail($request->delegated_to);

        $greeting = 'Hello'.' '.$delegatee->fullName;
        $body = $associatedEmployee->fullName.'
         Has submitted a leave request ('.$leaveType->name.') effective '
         .$request->start_date.' to '.$request->end_date.' and delegated the duties to you. Please Login to Acknowledge the request.';

        $details = [
            'greeting' => $greeting,
            'body' => $body,
        ];

        $delegatee->notify(new LeaveRequestNotification($details));

        return response()->json(['status' => 'success', 'message' => 'Leave Request Successfully Subitted!']);
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
            $leaverequests = LeaveRequest::with('employee', 'employee.department:id,department_name', 'leave:id,name,duration,notice_days', 'approver:id,prefix,surname,other_name,first_name')
            ->where('employee_id', $id)->latest()->get();

            $employee = Employee::findOrFail(Auth::user()->employee_id);
            $parentDept = Department::select('parent_department')->where('id', Auth::user()->employee->department_id??'')->get();

            if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin', 'HrSupervisor'])) {
                $deptEmployees = Employee::select('id', 'prefix', 'surname', 'other_name', 'first_name')->where('id', '!=', $employee->id)->where('department_id', Auth::user()->employee->department_id??'')
                ->orWhere('department_id', $parentDept[0]->parent_department)->get();
            } else {
                $deptEmployees = Employee::select('id', 'prefix', 'surname', 'other_name', 'first_name')->where('department_id', Auth::user()->employee->department_id??'')
                ->where('id', '!=', Auth::user()->employee->id)->get();
            }

            if ($employee->gender == 'Male') {
                $leaveTypes = Leave::where('status', 'Active')->where('name', '!=', 'Maternity')->get();
            } else {
                $leaveTypes = Leave::where('status', 'Active')->where('name', '!=', 'Paternity')->get();
            }

            return view('humanResource.leaveRequests', compact('leaveTypes', 'leaverequests', 'deptEmployees'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    public function asDelegatee($id)
    {
        if (Auth::user()->employee_id == $id) {
            $leaverequests = LeaveRequest::with('employee', 'employee.department:id,department_name', 'leave:id,name,duration,notice_days', 'approver:id,prefix,surname,other_name,first_name')
            ->where('delegated_to', $id)->latest()->get();

            $employee = Employee::findOrFail(Auth::user()->employee_id);
            $parentDept = Department::select('parent_department')->where('id', Auth::user()->employee->department_id??'')->get();

            if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
                $deptEmployees = Employee::select('id', 'prefix', 'surname', 'other_name', 'first_name')->where('id', '!=', $employee->id)->where('department_id', Auth::user()->employee->department_id??'')
                ->orWhere('department_id', $parentDept[0]->parent_department)->get();
            } else {
                $deptEmployees = Employee::select('id', 'prefix', 'surname', 'other_name', 'first_name')->where('department_id', Auth::user()->employee->department_id??'')
                ->where('id', '!=', Auth::user()->employee->id)->get();
            }

            if ($employee->gender == 'Male') {
                $leaveTypes = Leave::where('status', 'Active')->where('name', '!=', 'Maternity')->get();
            } else {
                $leaveTypes = Leave::where('status', 'Active')->where('name', '!=', 'Paternity')->get();
            }

            return view('humanResource.leaveRequests', compact('leaveTypes', 'leaverequests', 'deptEmployees'));
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
    public function departmentRequests($id)
    {
        $yearStart = Carbon::now();
        $yearStart->month = 01;
        $yearStart->day = 01;
        $myjuniorsList = [];

        $myjuniors = Employee::select('id')->where('reporting_to', $id)->get();
        foreach ($myjuniors as $junior) {
            array_push($myjuniorsList, $junior->id);
        }

        $leaverequests = LeaveRequest::with(['employee', 'employee.department', 'leave:id,name,duration,notice_days', 'approver:id,prefix,surname,other_name,first_name'])
        ->whereIn('employee_id', $myjuniorsList)->where('start_date', '>=', $yearStart)->where('delegatee_status', 'Accepted')->latest()->get();

        $employee = Employee::findOrFail(Auth::user()->employee_id);
        $parentDept = Department::select('parent_department')->where('id', Auth::user()->employee->department_id??'')->get();

        if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $deptEmployees = Employee::select('id', 'prefix', 'surname', 'other_name', 'first_name')->where('id', '!=', $employee->id)->where('department_id', Auth::user()->employee->department_id??'')
        ->orWhere('department_id', $parentDept[0]->parent_department)->get();
        }

        if ($employee->gender == 'Male') {
            $leaveTypes = Leave::where('status', 'Active')->where('name', '!=', 'Maternity')->get();
        } else {
            $leaveTypes = Leave::where('status', 'Active')->where('name', '!=', 'Paternity')->get();
        }

        return view('humanResource.deptleaveRequests', compact('leaveTypes', 'leaverequests', 'deptEmployees'));
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
        $leaveRequest = LeaveRequest::findOrFail($id);
        $associatedEmployee = Employee::findOrFail($leaveRequest->employee_id);
        $delegatee = Employee::findOrFail($leaveRequest->delegated_to);
        $supervisor = Employee::findOrFail($associatedEmployee->reporting_to);
        $leaveType = Leave::findOrFail($leaveRequest->leave_id);
        // return $delegatee;
        if ($request->delegatee_status == 'Accepted') {
            $request->validate([
                'delegatee_status' => 'required|string',
            ]);

            $leaveRequest->delegatee_status = $request->delegatee_status;
            $leaveRequest->delegatee_comment = null;
            $leaveRequest->update();

            $greeting = 'Hello'.' '.$associatedEmployee->fullName;
            $body = $delegatee->fullName.'
            Has Accepted to take up your duties as a delegatee effective '
            .$leaveRequest->start_date.' to '.$leaveRequest->end_date.' as you take up your ('.$leaveType->name.') Leave';

            $greeting2 = 'Hello'.' '.$supervisor->fullName;
            $body2 = $associatedEmployee->fullName.'
            Has requested for ('.$leaveType->name.') Leave effective '
            .$leaveRequest->start_date.' to '.$leaveRequest->end_date.' and the request is pending your approval please.';

            $details = [
                'greeting' => $greeting,
                'body' => $body,
            ];

            $details2 = [
                'greeting' => $greeting2,
                'body' => $body2,
            ];

            $associatedEmployee->notify(new LeaveRequestNotification($details));
            $supervisor->notify(new LeaveRequestNotification($details2));

            return redirect()->back()->with('success', 'You Have Successfully accepted the duties delegated');
        } elseif ($request->delegatee_status == 'Declined') {
            $request->validate([

                'delegatee_status' => 'required|string',
                'delegatee_comment' => 'required|string',

            ]);

            $leaveRequest->delegatee_status = $request->delegatee_status;
            $leaveRequest->delegatee_comment = $request->delegatee_comment;
            $leaveRequest->update();

            $greeting = 'Hello'.' '.$associatedEmployee->fullName;
            $body = $delegatee->fullName.'
            your Delegatee for your '.$leaveType->name.' leave request effective '
            .$leaveRequest->start_date.' to '.$leaveRequest->end_date.', has declined the duties delegated. Please Login to reschedule your leave';

            $details = [
                'greeting' => $greeting,
                'body' => $body,
            ];

            $associatedEmployee->notify(new LeaveRequestNotification($details));

            return redirect()->back()->with('success', 'You Have Declined the duties delegated');
        } elseif ($request->status == 'Approved') {
            $request->validate([

                'status' => 'required|string',
                'comment' => 'required|string',
            ]);

            $leaveRequest->approved_by = Auth::user()->employee_id;
            $leaveRequest->comment = $request->comment;
            $leaveRequest->status = $request->status;
            $leaveRequest->update();

            $greeting = 'Hello'.' '.$associatedEmployee->fullName;
            $body = $supervisor->fullName.'
            your Supervisor Has approved your '.$leaveType->name.' leave request effective '
            .$leaveRequest->start_date.' to '.$leaveRequest->end_date.', Please Login to confirm or reschedule your leave';

            $details = [
                'greeting' => $greeting,
                'body' => $body,
            ];

            $associatedEmployee->notify(new LeaveRequestNotification($details));

            return redirect()->back()->with('success', 'You Have Successfully Approved the Leave Request!');
        } elseif ($request->status == 'Declined') {
            $request->validate([

                'status' => 'required|string',
                'comment' => 'required|string',
            ]);

            $leaveRequest->approved_by = Auth::user()->employee_id;
            $leaveRequest->comment = $request->comment;
            $leaveRequest->status = $request->status;
            $leaveRequest->update();

            $greeting = 'Hello'.' '.$associatedEmployee->fullName;
            $body = $supervisor->fullName.'
            Approver for your '.$leaveType->name.' leave request effective '
            .$leaveRequest->start_date.' to '.$leaveRequest->end_date.', has declined your request. Please Login to reschedule your leave';

            $details = [
                'greeting' => $greeting,
                'body' => $body,
            ];

            $associatedEmployee->notify(new LeaveRequestNotification($details));

            return redirect()->back()->with('success', 'You Have Declined the Leave Request!');
        } elseif ($request->confirmation == 'Confirmed') {
            $request->validate([
                'confirmation' => 'required|string',
            ]);

            $leaveRequest->confirmation = $request->confirmation;
            $leaveRequest->update();

            return redirect()->back()->with('success', 'You Have Confirmed the Leave Request!');
        } elseif ($request->reschedule == 'rescheduling') {
            $request->validate([
                'leave_id' => 'required|integer',
                'length' => 'required|integer',
                'delegated_to' => 'required|integer',
                'reason' => 'required|string',
                'duties_delegated' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'reason' => 'required|string',
            ]);

            $leaveType = Leave::findOrFail($request->leave_id);
            $leaveDuration = Carbon::createFromFormat('Y-m-d', $request->start_date)->diffInDays(Carbon::createFromFormat('Y-m-d', $request->end_date));

            if ($leaveDuration > $leaveType->duration) {
                return redirect()->back()->with('error', 'Number of days on leave should not exceed Available Credits!');
            }

            // $delegatee = Employee::findOrFail($request->delegated_to);
            $leaveRequest->leave_id = $request->leave_id;
            $leaveRequest->start_date = $request->start_date;
            $leaveRequest->end_date = $request->end_date;
            $leaveRequest->length = $request->length;
            $leaveRequest->reason = $request->reason;
            $leaveRequest->delegated_to = $request->delegated_to;
            $leaveRequest->duties_delegated = $request->duties_delegated;
            $leaveRequest->status = 'Pending';
            $leaveRequest->confirmation = null;
            $leaveRequest->comment = '';
            $leaveRequest->approved_by = null;
            $leaveRequest->accepted_by = null;
            $leaveRequest->delegatee_status = null;
            $leaveRequest->delegatee_comment = null;

            $leaveRequest->update();

            $greeting = 'Hello'.' '.$delegatee->fullName;
            $body = $associatedEmployee->fullName.'
            Has submitted a leave request ('.$leaveType->name.') effective '
            .$request->start_date.' to '.$request->end_date.' and delegated the duties to you. Please Login to Acknowledge the request.';

            $details = [
                'greeting' => $greeting,
                'body' => $body,
            ];
            // Notification::send($delegatee, new LeaveRequestNotification($details));
            $delegatee->notify(new LeaveRequestNotification($details));

            return redirect()->back()->with('success', 'Leave Request successfully rescheduled!');
        } else {
            $leaveRequest->accepted_by = $request->accepted_by;
            $hrApprover = Employee::findOrFail($request->accepted_by);
            $leaveRequest->update();

            $greeting = 'Hello'.' '.$associatedEmployee->fullName;
            $body = $hrApprover->fullName.'
            the HRM accepted your ('.$leaveType->name.') Leave effective '
            .$leaveRequest->start_date.' to '.$leaveRequest->end_date.', Please go have your Leave and God Bless you.';

            $details = [
                'greeting' => $greeting,
                'body' => $body,
            ];

            $associatedEmployee->notify(new LeaveRequestNotification($details));

            return redirect()->back()->with('success', 'You Have accepted the Leave Request!');
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
        $leaveRequest = LeaveRequest::findOrFail($id);
        if ($leaveRequest->status === 'Pending') {
            $leaveRequest->delete();

            return redirect()->back()->with('success', 'Leave Request successfully deleted!');
        } else {
            return redirect()->back()->with('success', 'Oops! You can not delete Leave Request!');
        }
    }
}
