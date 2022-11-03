<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\asset\AssetIssue;
use App\Models\asset\AssetMaintenanceInfo;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AssetMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        $vendors = Vendor::all();
        $maintenanceInfo = AssetMaintenanceInfo::with(['authorisedby:id,name', 'externalvendor:id,vendor_name', 'internalvendor:id,name', 'issue', 'issue.asset:id,asset_name,barcode', 'issue.sourcedept:id,department_name', 'issue.createdby:id,name'])->get();

        //return $maintenanceInfo;
        return view('assets.manageMaintenance', compact('maintenanceInfo', 'users', 'vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $issues = AssetIssue::all();
        $vendors = Vendor::all();

        return view('assets.maintenanceInfo', compact('users', 'vendors', 'issues'));
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
            'type' => ['required', 'string'],
            'authorised_by' => 'integer|required',
            'issue_ref' => 'integer|required|unique:asset_maintenance_info',
            'vendor' => 'string',
            'internal_vendor' => 'string',
            'description' => 'string|required',
            'recommendation' => 'string',
            'maintenance_date' => 'date',
            'next_maintenance' => 'date',
        ]);
        $info = new AssetMaintenanceInfo();
        if ($request->vendor == 'NULL') {
            //    return $request;
            $info->type = $request->input('type');
            $info->authorised_by = $request->input('authorised_by');
            $info->issue_ref = $request->input('issue_ref');
            $info->internal_vendor = $request->input('internal_vendor');
            $info->description = $request->input('description');
            $info->recommendation = $request->input('recommendation');
            $info->maintenance_date = $request->input('maintenance_date');
            $info->next_maintenance = $request->input('next_maintenance');
            $info->save();

            return redirect()->back()->with('success', 'Maintenance Information Successfully added !!');
        } elseif ($request->internal_vendor == 'NULL') {
            // return $request;
            AssetMaintenanceInfo::create($request->all());

            return redirect()->back()->with('success', 'Maintenance Information Successfully added !!');
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
    public function edit(AssetMaintenanceInfo $maintenance)
    {
        $users = User::all();
        $vendors = Vendor::all();
        $maintenance->load('authorisedby:id,name', 'externalvendor:id,vendor_name', 'internalvendor:id,name', 'issue', 'issue.asset:id,asset_name,barcode', 'issue.sourcedept:id,department_name', 'issue.createdby:id,name')->get();
        // return $maintenance;
        return view('assets.editMaintenanceInfo', compact('maintenance', 'users', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetMaintenanceInfo $maintenance)
    {
        $request->validate([
            'type' => ['required', 'string'],
            'authorised_by' => 'integer|required',
            'issue_ref' => 'integer|required',
            'vendor' => 'string',
            'internal_vendor' => 'string',
            'description' => 'string|required',
            'recommendation' => 'string',
            'maintenance_date' => 'date',
            'next_maintenance' => 'date',
        ]);
        // $info = new AssetMaintenanceInfo();
        if ($request->vendor == 'NULL') {
            // return $request;
            $maintenance->type = $request->input('type');
            $maintenance->authorised_by = $request->input('authorised_by');
            $maintenance->issue_ref = $request->input('issue_ref');
            $maintenance->internal_vendor = $request->input('internal_vendor');
            $maintenance->description = $request->input('description');
            $maintenance->recommendation = $request->input('recommendation');
            $maintenance->maintenance_date = $request->input('maintenance_date');
            $maintenance->next_maintenance = $request->input('next_maintenance');
            $maintenance->update();

            return redirect()->route('maintenance.index')->with('success', 'Maintenance Information Successfully Updated !!');
        } elseif ($request->internal_vendor == 'NULL') {
            //  return $request;
            $maintenance->update($request->all());

            return redirect()->route('maintenance.index')->with('success', 'Maintenance Information Successfully Updated !!');
        }
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
