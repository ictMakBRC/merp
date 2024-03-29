<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\inventory\invUnits;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = invUnits::orderBy('id', 'desc')->get();

        return view('inventdashboard.units')->with('values', $values);
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
            'unit_name' => 'required', ]);
        $value = new invUnits;
        $value->unit_name = $request->input('unit_name');
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
            'unit_name' => 'required',
            'isActive' => 'required',
        ]);
        $value = invUnits::find($id);
        $value->unit_name = $request->input('unit_name');
        $value->is_active = $request->input('isActive');
        // $value->user_id = auth()->user()->id;
        $value->update();

        return redirect()->back()->with('success', 'Record Successfully Updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = invUnits::find($id);
        $value->delete();

        return redirect()->back()->with('success', 'Record deleted successfully !!');
    }
}
