<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\BankingInformation;
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
            'bank_name' => 'required|string',
            'branch' => 'required|string',
            'account_name' => 'required|string',
            'currency' => 'required|string',
            'account_number' => 'required|string|unique:banking_information',
        ]);

        if (BankingInformation::create($request->all())) {
            return response()->json(['status' => 'success', 'message' => 'Banking Information saved Successfully!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Oops! something went wrong, record could not be saved']);
        }
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
        ]);

        $bankingInformation->update($request->all());

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
