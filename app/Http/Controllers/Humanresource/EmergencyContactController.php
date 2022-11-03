<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\EmergencyContact;
use Illuminate\Http\Request;

class EmergencyContactController extends Controller
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
            'employee_id' => 'required|integer',
            'contact_relationship' => 'required|string',
            'contact_name' => 'required|string',
            'contact_address' => 'required|string',
            'contact_phone' => 'required|string',
        ]);

        $contactCheck = EmergencyContact::where('employee_id', $request->employee_id)->first();
        if ($contactCheck) {
            return response()->json(['status' => 'error', 'message' => 'Emergency Contact Already exists']);
        }

        if (EmergencyContact::create($request->all())) {
            return response()->json(['status' => 'success', 'message' => 'Emergency Contact Information saved Successfully!']);
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
    public function update(Request $request, EmergencyContact $emergencyContact)
    {
        $request->validate([
            'contact_relationship' => 'required|string',
            'contact_name' => 'required|string',
            'contact_address' => 'required|string',
            'contact_phone' => 'required|string',
        ]);

        $emergencyContact->update($request->all());

        return redirect()->back()->with('success', 'Emergency Contact Information Updated Successfully!!');
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
