<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\asset\InsuranceType;
use Illuminate\Http\Request;

class AssetInsuranceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = InsuranceType::all();

        return view('assets.insuranceType', compact('types'));
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
            'type' => ['required', 'string', 'max:255', 'unique:insurance_types'],
            'description' => ['string'],
        ]);

        InsuranceType::create($request->all());

        return redirect()->back()->with('success', 'Insurance Type Successfully added !!');
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
    public function update(Request $request, InsuranceType $insurancetype)
    {
        //
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'description' => ['string'],
        ]);

        $insurancetype->update($request->all());

        return redirect()->back()->with('success', 'Insurance Type Successfully Updated !!');
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
