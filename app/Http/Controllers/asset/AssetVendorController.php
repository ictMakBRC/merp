<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AssetVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vendors = Vendor::all();

        return view('assets.manageVendor', compact('vendors'));
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
            'vendor_name' => ['required', 'string', 'max:255', 'unique:vendors'],
            'address' => ['string'],
            'belongs_to' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'email' => ['string', 'email'],
            'comment' => ['string'],
        ]);

        Vendor::create($request->all());

        return redirect()->back()->with('success', 'Vendor Successfully Created !!');
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
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'vendor_name' => ['required', 'string', 'max:255'],
            'address' => ['string'],
            'belongs_to' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'email' => ['string', 'email'],
            'comment' => ['string'],
        ]);

        $vendor->update($request->all());

        return redirect()->back()->with('success', 'Vendor Successfully updated !!');
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
