<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class HrDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::with('parent:id,department_name')->where('type', '!=', 'Project')->latest()->get();
        $parents = Department::select('id', 'department_name')->where('type', '!=', 'Project')->latest()->get();
        // return $parents;
        return view('humanResource.manageDepartments', compact('departments', 'parents'));
    }

    public function projectsView()
    {
        $departments = Department::where('type', 'Project')->latest()->get();

        return view('humanResource.manageProjects', compact('departments'));
    }

    public function getUnits($id)
    {
        $units = Department::select(['id', 'department_name'])->where('parent_department', $id)->where('status', 'Active')->get();
        // $department=Department::findOrFail($id);
        // if($department->prefix!='BRC'){
        //     $emp_id='BRC/'.$department->prefix.'-'.$department->autonumber;
        // }else{
        //     $emp_id=$department->prefix.'-'.$department->autonumber;
        // }
        // $department->update(['autonumber'=>($department->autonumber+1)]);
        return response()->json([$units]);
    }

    public function changeunit($id)
    {
        $units = Department::select(['id', 'department_name'])->where('parent_department', $id)->where('status', 'Active')->get();
        // $department=Department::findOrFail($id);
        // $emp_id='BRC/'.$department->prefix.'-'.$department->autonumber;
        // $department->update(['autonumber'=>($department->autonumber+1)]);

        return response()->json($units);
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
            'department_name' => 'required', 'string', 'max:255',
            'type' => 'required', 'string',
            'status' => 'required', 'string',
        ]);

        Department::create($request->all());

        return redirect()->back()->with('success', 'Department Successfully Created !!');
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
        $department = Department::findOrFail($id);
        $request->validate([
            'department_name' => 'required', 'string', 'max:255',
            'type' => 'required', 'string',
            'description' => 'required', 'string', 'max:255',
            'status' => 'required', 'string',
        ]);

        $department->update($request->all());

        return redirect()->back()->with('success', 'Department Successfully Updated !!');
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
