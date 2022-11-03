<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\DesignationHistory;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\OfficialContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OfficialContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['HrUser'])) {
            $contracts = OfficialContract::with('employee:id,emp_id,surname,other_name,first_name')
            ->where('employee_id', Auth::user()->employee_id)->latest()->get();
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $contracts = OfficialContract::with('employee:id,emp_id,surname,other_name,first_name')
            ->where('department_id', Auth::user()->employee->department_id)->latest()->get();
        } elseif (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $contracts = OfficialContract::with('employee:id,emp_id,surname,other_name,first_name')->latest()->get();
        }
        //return $contracts;
        return view('humanResource.manageOfficialContracts', compact('contracts'));
    }

    public function download(Request $request, $emp_id, $id)
    {
        $contract = OfficialContract::findOrFail($id);
        $file = storage_path('app/').$contract->contract_file;

        $headers = ['Content-Type: application/pdf'];

        if (file_exists($file)) {
            return \Response::download($file, $emp_id.'-OfficialContract.pdf', $headers);
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

    public function expiryAlert()
    {
        return view('emails.contractExpiryAlert');
        //return view('emails.birthdayAlert');
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
            'contract_name' => 'required|string',
            'gross_salary' => 'required|numeric',
        ]);

        $runningContract = OfficialContract::where(['employee_id' => $request->employee_id, 'status' => 'Running'])->first();
        $currentHistory = DesignationHistory::where(['employee_id' => $request->employee_id])->latest()->first();
        $employee = Employee::where(['id' => $request->employee_id])->first();
        //return $employee;
        $officialContract = new OfficialContract();
        $designationHistory = new DesignationHistory();
        $contractPath = '';

        $officialContract->employee_id = $request->employee_id;
        $officialContract->department_id = $employee->department_id;
        $officialContract->contract_name = $request->contract_name;
        $officialContract->start_date = $request->start_date;
        $officialContract->end_date = $request->end_date;
        $officialContract->gross_salary = $request->gross_salary;

        $designationHistory->employee_id = $request->employee_id;
        $designationHistory->emp_id = $employee->emp_id;
        $designationHistory->department_id = $employee->department_id;
        $designationHistory->station_id = $employee->station_id;
        if ($currentHistory) {//check for presence of designation history
            $designationHistory->from = $currentHistory->to;
        } else {
            $designationHistory->from = null;
        }
        $designationHistory->to = $employee->designation_id;
        $designationHistory->supervisor = $employee->reporting_to;

        if ($request->hasFile('contract_file')) {
            $contractName = date('YmdHis').'.'.$request->file('contract_file')->extension();
            $contractPath = $request->file('contract_file')->storeAs('official_contracts', $contractName);
        } else {
            $contractPath = '';
        }

        $officialContract->contract_file = $contractPath;

        //Check for any running contract
        if ($runningContract) {
            $previousContract = OfficialContract::findOrFail($runningContract->id);
            $previousContract->status = 'Terminated';

            $previousContract->update();
            $officialContract->save();
            $designationHistory->official_contract_id = $officialContract->id;
            // $designationHistory->save();

            if ($designationHistory->save()) {
                return response()->json(['status' => 'success', 'message' => 'Contract Succesfully saved but a Previously Running Contract has been Terminated!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Oops! something went wrong, record could not be saved']);
            }
        } else {
            $officialContract->save();
            $designationHistory->official_contract_id = $officialContract->id;
            $designationHistory->save();

            if ($designationHistory->save()) {
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
    public function show($id)//Passing employee_id instead of officialContract id
    {
        if (Auth::user()->employee_id == $id) {
            $contracts = OfficialContract::with('employee:id,emp_id,surname,other_name,first_name')
            ->where('employee_id', $id)->latest()->get();

            return view('humanResource.manageOfficialContracts', compact('contracts'));
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
