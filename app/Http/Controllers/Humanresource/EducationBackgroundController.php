<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\EducationBackground;
use Illuminate\Http\Request;

class EducationBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function download(Request $request, $emp_id, $id, $level)
    {
        $award = EducationBackground::findOrFail($id);

        $file = storage_path('app/').$award->award_document;

        $headers = ['Content-Type: application/pdf'];

        if (file_exists($file)) {
            return \Response::download($file, $emp_id.$level.'-Award.pdf', $headers);
        } else {
            echo 'File not found.';
        }
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
            'employee_id' => 'required|integer',
            'level' => 'required|string',
            'school' => 'required|string',
            'award' => 'required|string',
        ]);

        $educationBackground = new EducationBackground();
        $awardPath = '';

        if ($request->hasFile('award_document')) {
            $awardName = date('YmdHis').'.'.$request->file('award_document')->extension();
            $awardPath = $request->file('award_document')->storeAs('award_documents', $awardName);
        } else {
            $awardPath = '';
        }
        $educationBackground->employee_id = $request->employee_id;
        $educationBackground->level = $request->level;
        $educationBackground->school = $request->school;
        $educationBackground->start_date = $request->start_date;
        $educationBackground->end_date = $request->end_date;
        $educationBackground->award = $request->award;
        $educationBackground->award_document = $awardPath;

        if ($educationBackground->save()) {
            return response()->json(['status' => 'success', 'message' => 'Education Information saved Successfully!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Oops! something went wrong, record could not be saved']);
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
    public function update(Request $request, EducationBackground $educationBackground)
    {
        $request->validate([
            'level' => 'required|string',
            'school' => 'required|string',
            'award' => 'required|string',
        ]);

        $awardPath = '';
        $storagePath1 = storage_path('app/').$educationBackground->award_document;

        if ($request->hasFile('award_document')) {
            $awardName = date('YmdHis').'.'.$request->file('award_document')->extension();
            $awardPath = $request->file('award_document')->storeAs('award_documents', $awardName);
            if (file_exists($storagePath1)) {
                @unlink($storagePath1);
            }
        } else {
            $awardPath = $educationBackground->award_document;
        }

        $educationBackground->level = $request->level;
        $educationBackground->school = $request->school;
        $educationBackground->start_date = $request->start_date;
        $educationBackground->end_date = $request->end_date;
        $educationBackground->award = $request->award;
        $educationBackground->award_document = $awardPath;

        $educationBackground->update();

        return redirect()->back()->with('success', 'Education Information Updated added !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EducationBackground $educationBackground)
    {
        $awardPath = storage_path('app/').$educationBackground->award_document;
        if (file_exists($awardPath)) {
            @unlink($awardPath);
        }
        $educationBackground->delete();

        return redirect()->back()->with('success', 'Education Information Deleted Successfully!!');
    }
}
