<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stations = Station::all();

        return view('assets.station', compact('stations'));
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
            'station_name' => 'required', 'string', 'max:255', 'unique:stations',
            'description' => 'required', 'string', 'max:255',
            'status' => 'required', 'string',
        ]);

        Station::create($request->all());

        return redirect()->back()->with('success', 'Station Successfully added !!');
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
    public function update(Request $request, Station $station)
    {
        //
        $request->validate([
            'station_name' => 'required', 'string', 'max:255',
            'description' => 'required', 'string', 'max:255',
            'status' => 'required', 'string',
        ]);

        $station->update($request->all());

        return redirect()->back()->with('success', 'Station Successfully Updated !!');
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
