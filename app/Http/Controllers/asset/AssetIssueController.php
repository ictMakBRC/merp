<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\asset\Asset;
use App\Models\asset\AssetIssue;
use App\Models\Department;
use Illuminate\Http\Request;

class AssetIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = AssetIssue::with('asset:id,asset_name,barcode',
        'station:id,station_name', 'sourcedept:id,department_name',
        'destinationdept:id,department_name', 'createdby:id,name')
        ->where('issue_status', '=', 'Pending')->orderBy('created_at', 'desc')->get();
        // return $issues;
        return view('assets.manageIssues', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::select('id', 'department_name')->get();
        $assets = Asset::select('id', 'asset_name')->get();

        return view('assets.reportIssue', compact('departments', 'assets'));
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
            'reference' => ['required', 'integer', 'unique:asset_issues'],
            'subject' => 'string|required',
            'issue_type' => 'string|required',
            'asset_id' => 'integer|required',
            'priority' => 'string|required',
            'deadline' => 'date|required',
            'station_id' => 'integer|required',
            'source_dept' => 'integer|required',
            'destination_dept' => 'integer|required',
            'description' => 'string|required',
        ]);

        AssetIssue::create($request->all());

        return redirect()->route('issues.index')->with('success', 'Issue Submitted Successfully!!');
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
    public function edit(AssetIssue $issue)
    {
        $departments = Department::select('id', 'department_name')->get();
        $assets = Asset::select('id', 'asset_name')->get();
        $assetIssue = $issue->load('asset:id,asset_name', 'station:id,station_name', 'sourcedept:id,department_name', 'destinationdept:id,department_name');
        //return $assetIssue;
        return view('assets.editIssue', compact('assetIssue', 'assets', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetIssue $issue)
    {
        $request->validate([
            'reference' => ['required', 'integer'],
            'subject' => 'string|required',
            'issue_type' => 'string|required',
            'asset_id' => 'integer|required',
            'priority' => 'string|required',
            'deadline' => 'date|required',
            'station_id' => 'integer|required',
            'source_dept' => 'integer|required',
            'destination_dept' => 'integer|required',
            'description' => 'string|required',

        ]);

        $issue->update($request->all());

        return redirect()->route('issues.index')->with('success', 'Issue Updated Successfully!!');
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
