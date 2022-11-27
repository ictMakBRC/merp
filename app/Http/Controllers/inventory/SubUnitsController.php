<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\inventory\invSubunits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valueUnites = Department::orderBy('id', 'desc')->get();
        $values = DB::table('inv_subunits')
        ->select('*', 'inv_subunits.id as SubUnitId', 'inv_subunits.is_active AS SuActive')
        ->get();

        return view('inventdashboard.SubUnits', compact('valueUnites', 'values'));
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
        $this->validate($request, [
            // 'unit_name'=>'required',
            'subunit_name' => 'required',
        ]);
        $value = new invSubunits();
        // $value->department_id = $request->input('unit_name');
        $value->subunit_name = $request->input('subunit_name');
        // $value->user_id = auth()->user()->id;
        $value->save();

        return redirect()->back()->with('success', 'Record Successfully added !!');
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
        $this->validate($request, [
            //'unit_name'=>'required',
            'subunit_name' => 'required',
            'isActive' => 'required',
        ]);
        $value = invSubunits::find($id);
        // $value->department_id = $request->input('unit_name');
        $value->subunit_name = $request->input('subunit_name');
        $value->is_active = $request->input('isActive');
        // $value->user_id = auth()->user()->id;
        $value->update();

        return redirect()->back()->with('success', 'Record Successfully updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = invSubunits::find($id);
        $value->delete();

        return redirect()->back()->with('success', 'Record deleted successfully !!');
    }
}
