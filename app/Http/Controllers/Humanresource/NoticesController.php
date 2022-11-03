<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\Notice;
use App\Notifications\SendNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NoticesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'notice' => 'required|string',
            'audience' => 'required|integer',
            'send_email' => 'required|string',
            'expires_on' => 'required|date',
        ]);

        Notice::create([
            'notice' => $request->notice,
            'audience' => $request->audience,
            'expires_on' => $request->expires_on,
            'created_by' => Auth::user()->employee->id,
        ]);

        if ($request->send_email === 'Yes') {
            if ($request->audience === '0') {
                $allEmployees = Employee::where('status', 'Active')->get();
                Notification::send($allEmployees, new SendNotice(Auth::user()->employee->fullName, Auth::user()->employee->email, $request->notice));
            } else {
                $deptEmployees = Employee::where(['status' => 'Active', 'department_id' => $request->audience])->get();
                Notification::send($deptEmployees, new SendNotice(Auth::user()->employee->fullName, Auth::user()->employee->email, $request->notice));
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Notice Successfully Sent!']);
        // return redirect()->back()->with('success', 'Notice Successfully Sent!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notice::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Notice Successfully deleted!');
    }
}
