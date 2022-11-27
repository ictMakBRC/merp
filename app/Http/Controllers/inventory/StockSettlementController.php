<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\inventory\invRequest;
use Illuminate\Http\Request;

class StockSettlementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = invRequest::leftJoin('departments', 'inv_requests.borrower_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_type', '=', 'External')
        ->where('inv_requests.request_state', 'Approved')->get();

        return view('inventdashboard.requestsSubmitted', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unsettled(Request $dpt, $item)
    {
        $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_state', '!=', 'open')
        ->where('inv_requests.user_id', auth()->user()->id)
        ->where('inv_requests.is_active', 1)->get();

        return view('inventdashboard.s', compact('values'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
