<?php

namespace App\Http\Controllers\inventory;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\inventory\invItems;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\inventory\inv_department_Item;

class DepartmentItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = invItems::leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('*', 'inv_items.id as item_id')
        ->get();
        $units = Department::orderBy('department_name', 'asc')->get();
        $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
        ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('*', 'inv_department__items.id as item_id')
        ->get();

        return view('inventdashboard.Departmentitems', compact('values', 'items', 'units'));
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
            'department_id' => 'required',
            'inv_item_id' => 'required',
        ]);

        foreach ($request->input('department_id') as $value) {
            $department_id = $value;
            $inv_item_id = $request->input('inv_item_id');
            $isExist = inv_department_Item::select('*')
            ->where('inv_item_id', $inv_item_id)
            ->where('department_id', $department_id)
            ->where('brand', $request->input('brand'))
            ->exists();
            if ($isExist) {
                inv_department_Item::where('inv_item_id', $inv_item_id)
                ->where('department_id', $department_id)->update(['is_active' => '1']);

            //return redirect()->back()->with('error', 'Some Records already exists !!');
            } else {
                $value = new  inv_department_Item();
                $value->inv_item_id = $inv_item_id;
                $value->department_id = $department_id;
                $value->brand = $request->input('brand');
                $value->save();
            }
        }
        Session::flash('alert', ['type' => 'success',  'message' => 'value created successfully!']);
        return redirect()->back()->with('success', 'Record Successfully added !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $value = inv_department_Item::find($id);
        $value->delete();

        return redirect()->back()->with('success', 'Record deleted successfully !!');
    }
}
