<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'employee_id' => 'required|integer',
            'company' => 'required|string',
            'position_held' => 'required|string',
            'employment_type' => 'required|string',
            'service_length' => 'required|string',
        ]);

        if (WorkExperience::create($request->all())) {
            return response()->json(['status' => 'success', 'message' => 'Work Experience  Information saved Successfully!']);
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
    public function update(Request $request, WorkExperience $workExperience)
    {
        $request->validate([
            'company' => 'required|string',
            'position_held' => 'required|string',
            'employment_type' => 'required|string',
            'service_length' => 'required|string',
        ]);

        $workExperience->update($request->all());

        return redirect()->back()->with('success', 'Work Experience Successfully updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkExperience $workExperience)
    {
        $workExperience->delete();

        return redirect()->back()->with('success', 'Work Experience Successfully deleted !!');
    }
}
