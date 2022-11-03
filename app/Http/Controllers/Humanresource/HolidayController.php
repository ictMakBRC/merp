<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = Holiday::all();

        return view('humanResource.manageHolidays', compact('holidays'));
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
            'title' => 'required', 'string', 'max:255',
            'holiday_type' => 'required', 'string',
            'start_date' => 'required', 'date',
        ]);

        Holiday::create($request->all());

        return redirect()->back()->with('success', 'Holiday Successfully Created !!');
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
        $holiday = Holiday::findOrFail($id);
        $request->validate([
            'title' => 'required', 'string', 'max:255',
            'holiday_type' => 'required', 'string',
            'start_date' => 'required', 'date',
        ]);

        $holiday->update($request->all());

        return redirect()->back()->with('success', 'Holiday Successfully Updated !!');
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
