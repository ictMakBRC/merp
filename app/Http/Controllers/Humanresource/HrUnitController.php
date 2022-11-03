<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentUnit;
use Illuminate\Http\Request;

class HrUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        // $units = DepartmentUnit::with('department:id,department_name')->get();
        $units = Department::where('type', '!=', 'Unit')->latest()->get();

        return view('humanResource.manageUnits', compact('units', 'departments'));
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
            'department_id' => 'required', 'string', 'max:255', 'unique:stations',
            'unit_name' => 'required', 'string', 'max:255',
            'belongs_to' => 'required', 'string',
            'status' => 'required', 'string',
        ]);

        DepartmentUnit::create($request->all());

        return redirect()->back()->with('success', 'Unit Successfully added !!');
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

    public function getUnits($id)
    {
        $units = DepartmentUnit::select(['id', 'unit_name'])->where('department_id', $id)->where('status', 'Active')->get();

        return response()->json($units);
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
        $departmentunit = DepartmentUnit::findOrFail($id);
        $request->validate([
            'department_id' => 'required', 'string', 'max:255',
            'unit_name' => 'required', 'string', 'max:255',
            'belongs_to' => 'required', 'string',
            'status' => 'required', 'string',
        ]);

        $departmentunit->update($request->all());

        return redirect()->back()->with('success', 'Unit Successfully Updated !!');
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
