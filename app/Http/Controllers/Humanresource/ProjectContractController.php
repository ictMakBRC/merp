<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\ProjectContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProjectContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = ProjectContract::with('employee:id,emp_id,surname,other_name,first_name', 'project:id,department_name', 'position:id,name')->latest()->get();
        //return $contracts;
        return view('humanResource.manageProjectContracts', compact('contracts'));
    }

    public function download(Request $request, $emp_id, $id)
    {
        $contract = ProjectContract::findOrFail($id);
        $file = storage_path('app/').$contract->contract_file;

        $headers = ['Content-Type: application/pdf'];

        if (file_exists($file)) {
            return \Response::download($file, $emp_id.'-ProjectContract.pdf', $headers);
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
            'project_id' => 'required|integer',
            'position_id' => 'required|integer',
            'contract_name' => 'required|string',
            'gross_salary' => 'required|numeric',
            'currency' => 'required|string',
        ]);
        $runningContract = ProjectContract::where(['employee_id' => $request->employee_id, 'project_id' => $request->project_id, 'status' => 'Running'])->first();
        $projectContract = new ProjectContract();
        $contractPath = '';

        $projectContract->employee_id = $request->employee_id;
        $projectContract->position_id = $request->position_id;
        $projectContract->project_id = $request->project_id;
        $projectContract->contract_name = $request->contract_name;
        $projectContract->start_date = $request->start_date;
        $projectContract->end_date = $request->end_date;
        $projectContract->fte = $request->fte;
        $projectContract->gross_salary = $request->gross_salary;
        $projectContract->currency = $request->currency;

        if ($request->hasFile('contract_file')) {
            $contractName = date('YmdHis').'.'.$request->file('contract_file')->extension();
            $contractPath = $request->file('contract_file')->storeAs('project_contracts', $contractName);
        } else {
            $contractPath = '';
        }

        $projectContract->contract_file = $contractPath;

        //Check for any running contract
        if ($runningContract) {
            $previousContract = ProjectContract::findOrFail($runningContract->id);
            $previousContract->status = 'Terminated';
            $previousContract->update();

            if ($projectContract->save()) {
                return response()->json(['status' => 'success', 'message' => 'Contract Succesfully saved but Previously Running Contract on the same Project has been Terminated!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Oops! something went wrong, record could not be saved']);
            }
        } else {
            if ($projectContract->save()) {
                return response()->json(['status' => 'success', 'message' => 'Contract Succesfully saved!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Oops! something went wrong, record could not be saved']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//Passing employee_id instead of ProjectContract id
    {
        if (Auth::user()->employee_id == $id) {
            $contracts = ProjectContract::with('employee:id,emp_id,surname,other_name,first_name', 'project:id,department_name', 'position:id,name')
            ->where('employee_id', $id)->latest()->get();

            return view('humanResource.manageProjectContracts', compact('contracts'));
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
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
        //
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
