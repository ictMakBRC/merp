<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\inventory\invStores;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = invStores::orderBy('id', 'desc')->get();

        return view('inventdashboard.stores')->with('values', $values);
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
            'store_location' => 'required',
            'store_name' => 'required',
            'store_description' => 'required',
        ]);
        $value = new invStores;
        $value->store_location = $request->input('store_location');
        $value->store_name = $request->input('store_name');
        $value->store_description = $request->input('store_description');
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
            'store_location' => 'required',
            'store_name' => 'required',
            'store_description' => 'required',
            'isActive' => 'required',
        ]);
        $value = invStores::find($id);
        $value->store_location = $request->input('store_location');
        $value->store_name = $request->input('store_name');
        $value->store_description = $request->input('store_description');
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
        $value = invStores::find($id);
        $value->delete();

        return redirect()->back()->with('success', 'Record deleted successfully !!');
    }
}
