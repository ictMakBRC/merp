<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Leave;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['HrAdmin'])) {
            $leaves = Leave::latest()->get();

            return view('humanResource.manageLeaves', compact('leaves'));
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
            'name' => 'required', 'string', 'max:255',
            'carriable' => 'required', 'string',
            'is_payable' => 'required', 'string',
            'given_to' => 'required', 'string',
            'status' => 'required', 'string',
            'notice_days' => 'required', 'integer',
            'duration' => 'required', 'integer',
        ]);

        Leave::create($request->all());

        return redirect()->back()->with('success', 'Leave Successfully Created !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $leave = Leave::findOrFail($id);
        $request->validate([
            'name' => 'required', 'string', 'max:255',
            'carriable' => 'required', 'string',
            'is_payable' => 'required', 'string',
            'given_to' => 'required', 'string',
            'status' => 'required', 'string',
            'notice_days' => 'required', 'integer',
            'duration' => 'required', 'integer',
        ]);

        $leave->update($request->all());

        return redirect()->back()->with('success', 'Leave Successfully Updated !!');
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
