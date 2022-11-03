<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\TrainingProgram;
use Illuminate\Http\Request;

class TrainingProgramController extends Controller
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

    public function download(Request $request, $emp_id, $id)
    {
        $training = TrainingProgram::findOrFail($id);
        // return $award[0]->award_document;
        $file = storage_path('app/').$training->certificate;

        $headers = ['Content-Type: application/pdf'];

        if (file_exists($file)) {
            return \Response::download($file, $emp_id.'-Certificate.pdf', $headers);
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
            'organised_by' => 'required|string',
            'training_name' => 'required|string',
            'training_length' => 'required|string',
        ]);

        $trainingProgram = new TrainingProgram();
        $certificatePath = '';

        if ($request->hasFile('certificate')) {
            $certificateName = date('YmdHis').'.'.$request->file('certificate')->extension();
            $certificatePath = $request->file('certificate')->storeAs('training_certificates', $certificateName);
        } else {
            $certificatePath = '';
        }
        $trainingProgram->employee_id = $request->employee_id;
        $trainingProgram->start_date = $request->start_date;
        $trainingProgram->end_date = $request->end_date;
        $trainingProgram->organised_by = $request->organised_by;
        $trainingProgram->training_name = $request->training_name;
        $trainingProgram->training_length = $request->training_length;
        $trainingProgram->training_description = $request->training_description;
        $trainingProgram->certificate = $certificatePath;

        if ($trainingProgram->save()) {
            return response()->json(['status' => 'success', 'message' => 'Training  Information saved Successfully!']);
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
    public function update(Request $request, TrainingProgram $trainingProgram)
    {
        $request->validate([
            'organised_by' => 'required|string',
            'training_name' => 'required|string',
            'training_length' => 'required|string',
        ]);

        // $trainingProgram = new TrainingProgram();
        $certificatePath = '';
        $storagePath1 = storage_path('app/').$trainingProgram->certificate;

        if ($request->hasFile('certificate')) {
            $certificateName = date('YmdHis').'.'.$request->file('certificate')->extension();
            $certificatePath = $request->file('certificate')->storeAs('training_certificates', $certificateName);
            if (file_exists($storagePath1)) {
                @unlink($storagePath1);
            }
        } else {
            $certificatePath = $trainingProgram->certificate;
        }
        $trainingProgram->start_date = $request->start_date;
        $trainingProgram->end_date = $request->end_date;
        $trainingProgram->organised_by = $request->organised_by;
        $trainingProgram->training_name = $request->training_name;
        $trainingProgram->training_length = $request->training_length;
        $trainingProgram->training_description = $request->training_description;
        $trainingProgram->certificate = $certificatePath;

        $trainingProgram->update();

        return redirect()->back()->with('success', 'Training Information Successfully Updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingProgram $trainingProgram)
    {
        $storagePath1 = storage_path('app/').$trainingProgram->certificate;
        if (file_exists($storagePath1)) {
            @unlink($storagePath1);
        }
        $trainingProgram->delete();

        return redirect()->back()->with('success', 'Training Information Deleted Successfully!!');
    }
}
