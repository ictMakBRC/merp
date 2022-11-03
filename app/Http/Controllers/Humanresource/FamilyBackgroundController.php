<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\FamilyBackground;
use Illuminate\Http\Request;

class FamilyBackgroundController extends Controller
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
            'member_type' => 'required|string',
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'address' => 'required|string',
            'contact' => 'required|string',
            'occupation' => 'required|string',

        ]);

        if (FamilyBackground::create($request->all())) {
            return response()->json(['status' => 'success', 'message' => 'Family Background Information saved Successfully!']);
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
    public function update(Request $request, FamilyBackground $familyBackground)
    {
        $request->validate([
            'member_type' => 'required|string',
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'address' => 'required|string',
            'contact' => 'required|string',
            'occupation' => 'required|string',

        ]);

        $familyBackground->update($request->all());

        return redirect()->back()->with('success', 'Family Background Information Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyBackground $familyBackground)
    {
        $familyBackground->delete();

        return redirect()->back()->with('success', 'Family Background Information Deleted Successfully!!');
    }
}
