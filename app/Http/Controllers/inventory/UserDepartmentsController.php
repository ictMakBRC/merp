<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\inventory\invUserdeparment;
use App\Models\User;
use Illuminate\Http\Request;

class UserDepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::orderBy('department_name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        $values = invUserdeparment::leftJoin('users', 'inv_userdeparments.user_id', '=', 'users.id')
        ->leftJoin('departments', 'inv_userdeparments.department_id', '=', 'departments.id')
        ->select('*', 'inv_userdeparments.id as duser_id', 'department_name as dname', 'users.name as uname')
        ->get();

        return view('inventdashboard.deparmentUsers', compact('values', 'departments', 'users'));
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
        $this->validate($request, [
            'user_id' => 'required',
            'department_id' => 'required',

        ]);
        $isExist = invUserdeparment::select('*')
        ->where('user_id', $request->input('user_id'))
        ->where('department_id', $request->input('department_id'))
        ->exists();
        if ($isExist) {
            return redirect()->back()->with('error', 'Records already exists !!');
        } else {
            $value = new invUserdeparment;
            $value->user_id = $request->input('user_id');
            $value->department_id = $request->input('department_id');
            $value->role = $request->input('role');
            // $value->user_id = auth()->user()->id;
            $value->save();

            return redirect()->back()->with('success', 'Record Successfully added !!');
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
