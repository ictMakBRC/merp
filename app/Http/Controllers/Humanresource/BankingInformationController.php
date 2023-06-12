<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\BankingInformation;
use App\Models\Humanresource\Employee;
use Illuminate\Http\Request;

class BankingInformationController extends Controller
{
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
            'is_default' => 'required|integer',
            'bank_name' => 'required|string',
            'branch' => 'required|string',
            'account_name' => 'required|string',
            'currency' => 'required|string',
            'account_number' => 'required|string|unique:banking_information',
        ]);

        $bankingInfo = new BankingInformation();
        $bankingInfo->employee_id = $request->employee_id;
        $bankingInfo->is_default = $request->is_default;
        $bankingInfo->bank_name = $request->bank_name;
        $bankingInfo->account_number = $request->account_number;
        $bankingInfo->branch = $request->branch;
        $bankingInfo->account_name = $request->account_name;
        $bankingInfo->currency = $request->currency;
        $bankingInfo->save();
            if($request->is_default ==1){
                Employee::where('id',$request->employee_id)->update(['active_bank_account'=>$bankingInfo->id]);
                BankingInformation::where('employee_id', $request->employee_id)->where('id', '!=', $bankingInfo->id)->update(['is_default'=>'0']);
            }
            return redirect()->back()->with('success', 'Banking Information created Successfully!!');
            // if (BankingInformation::create($request->all())) {
            //     if($request->is_default ==1){
            //         Employee::where('id',$request->employee_id)->update(['active_bank_account'=>$request->id]);
            //         BankingInformation::where('employee_id', $request->employee_id)->where('id', '!=', $request->id)->update(['is_default'=>'0']);
            //     }
            //     return response()->json(['status' => 'success', 'message' => 'Banking Information saved Successfully!']);
            // } else {
            //     return response()->json(['status' => 'error', 'message' => 'Oops! something went wrong, record could not be saved']);
            // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankingInformation $bankingInformation)
    {
        // $bankinginformation=BankingInformation::findOrFail($id);

        $request->validate([
            'bank_name' => 'required|string',
            'branch' => 'required|string',
            'account_name' => 'required|string',
            'currency' => 'required|string',
            'account_number' => 'required|string',
            'is_default'=>'required',
        ]);

        
        // $bankingInformation = BankingInformation::where('id',$bankingInformation);
        $bankingInformation->employee_id = $request->employee_id;
        $bankingInformation->is_default = $request->is_default;
        $bankingInformation->bank_name = $request->bank_name;
        $bankingInformation->branch = $request->branch;
        $bankingInformation->account_name = $request->account_name;
        $bankingInformation->currency = $request->currency;
        $bankingInformation->save();
            if($request->is_default ==1){
                Employee::where('id',$request->employee_id)->update(['active_bank_account'=>$bankingInformation->id]);
                BankingInformation::where('employee_id', $request->employee_id)->where('id', '!=', $bankingInformation->id)->update(['is_default'=>'0']);
            }

        // $bankingInformation->update($request->all());

        return redirect()->back()->with('success', 'Banking Information Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankingInformation $bankingInformation)
    {
        $bankingInformation->delete();

        return redirect()->back()->with('success', 'Banking Information Deleted Successfully!!');
    }
}
