<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invItems;
use App\Models\inventory\invSubUnits;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Department::orderBy('name', 'asc')->get();
        $subunits = invSubUnits::orderBy('subunit_name', 'asc')->get();
        $items = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
        ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('*', 'inv_items.id as item_id')
        ->get();

        return view('inventdashboard.reports', compact('units', 'subunits', 'items'));
    }

    public function getDptData(Request $request)
    {
        if ($request->dpt_id == 0) {
            // $itemData1 = invSubUnits::select("subunit_name","id")->get();
            $itemData = invItems::leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->select('*', 'inv_items.id as item_id')
            ->get();
            $item = array_merge(compact('itemData', 'itemData1'));
        } else {
            //  $itemData1 = invSubUnits::where("department_id",$request->dpt_id)->select("subunit_name","id")->get();
            $itemData = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
            ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->select('uom_name', 'item_name', 'inv_items.id as item_id')
            ->where('inv_items.department_id', $request->dpt_id)
            ->get();
            $item = array_merge(compact('itemData', 'itemData1'));
        }

        return response()->json($item);
    }

    public function getSubDptData(Request $request)
    {
        $item = invItems::leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('uom_name', 'item_name', 'inv_items.id as item_id')
        ->where('inv_items.inv_subunit_id', $request->sub_id)
        ->get();

        return response()->json($item);
    }

    public function getSubDptData2(Request $request)
    {
        $item = invItems::leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('uom_name', 'item_name', 'inv_items.id as item_id')
        ->where('inv_items.inv_subunit_id', $request->sub_id)
        ->get();

        return response()->json($item);
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
