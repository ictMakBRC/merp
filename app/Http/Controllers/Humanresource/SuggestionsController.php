<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Humanresource\Suggestion;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['HrAdmin|SuperAdmin|HrSupervisor|HrUser'])) {
            return view('humanResource.allSuggestions');
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
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
            'suggestion' => 'required|string',
        ]);

        Suggestion::create([
            'suggestion' => $request->suggestion,
            'source_dept' => Auth::user()->employee->department->id,
            'created_by' => Auth::id(),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Suggestion Successfully Sent to the Suggestion Box!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Suggestion::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Suggestion Successfully deleted!');
    }
}
