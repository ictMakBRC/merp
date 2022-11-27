<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invSubUnits;
use Illuminate\Http\Request;

class ReportStockStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->dpt_id == 0) {
            $this->validate($request, [
                'department_id' => 'required',
                'inv_subunit_id' => 'required',
                'inv_items_id' => 'required',
            ]);
            $dpt = $request->input('department_id');
            $subdpt = $request->input('inv_subunit_id');
            $item = $request->input('inv_items_id');

            if ($dpt == 0 and $subdpt == 0 and $item == 0) {
                $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
                ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
                ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
                ->select('*', 'inv_items.id as item_id')
                ->get();
                $dpt = 'All';
                $sub = 'All';
                $item = 'All';
                $disp = '';
                $subDis = '';

                return view('inventdashboard.reportStockView', compact('values', 'dpt', 'sub', 'item', 'disp', 'subDis'));
            } elseif ($dpt != 0 and $subdpt == 0 and $item == 0) {
                $department = Department::where('id', $dpt)->get();
                $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
                ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
                ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
                ->where('inv_department__items.department_id', $dpt)
                ->select('*', 'inv_items.id as item_id')
                ->get();
                foreach ($department as $data) {
                    $dpt = $data->name;
                }

                $sub = 'All';
                $item = 'All';
                $disp = 'd-none';
                $subDis = '';

                return view('inventdashboard.reportStockView', compact('values', 'dpt', 'sub', 'item', 'disp', 'subDis'));
            } elseif ($dpt != 0 and $subdpt != 0 and $item == 0) {
                $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
                ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
                ->where('inv_items.department_id', $dpt)
                ->where('inv_items.inv_subunit_id', $subdpt)
                ->select('*', 'inv_items.id as item_id')
                ->get();
                $subunits = invSubUnits::leftJoin('departments', 'inv_subunits.department_id', '=', 'departments.id')->where('inv_subunits.id', $subdpt)->get();
                foreach ($subunits as $data) {
                    $dpt = $data->name;
                    $sub = $data->subunit_name;
                }

                $item = 'All';
                $disp = 'd-none';
                $subDis = 'd-none';

                return view('inventdashboard.reportStockView', compact('values', 'dpt', 'sub', 'item', 'disp', 'subDis'));
            } elseif ($dpt != 0 and $subdpt != 0 and $item != 0) {
                $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
               ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
                ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
                ->where('inv_items.department_id', $dpt)
                ->where('inv_items.inv_subunit_id', $subdpt)
                ->where('inv_items.id', $item)
                ->select('*', 'inv_items.id as item_id')
                ->get();
                $item = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
                ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')->where('inv_items.id', $item)->get();
                foreach ($item as $data) {
                    $dpt = $data->name;
                    $sub = $data->subunit_name;
                    $item = $data->item_name;
                }
                $disp = 'd-none';
                $subDis = 'd-none';

                return view('inventdashboard.reportStockView', compact('values', 'dpt', 'sub', 'item', 'disp', 'subDis'));
            } elseif ($dpt == 0 and $subdpt == 0 and $item != 0) {
                $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
               ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
                ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
                //->where('inv_items.department_id',$dpt)
                //->where('inv_items.inv_subunit_id',$subdpt)
                ->where('inv_items.id', $item)
                ->select('*', 'inv_items.id as item_id')
                ->get();
                $item = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
                ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')->where('inv_items.id', $item)->get();
                foreach ($item as $data) {
                    $dpt = $data->name;
                    $sub = $data->subunit_name;
                    $item = $data->item_name;
                }
                $disp = 'd-none';
                $subDis = 'd-none';

                return view('inventdashboard.reportStockView', compact('values', 'dpt', 'sub', 'item', 'disp', 'subDis'));
            } elseif ($dpt == 0 and $subdpt != 0 and $item != 0) {
                $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
                ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
                //->where('inv_items.department_id',$dpt)
                ->where('inv_items.inv_subunit_id', $subdpt)
                ->where('inv_items.id', $item)
                ->select('*', 'inv_items.id as item_id')
                ->get();
                $item = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
                  ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')->where('inv_items.id', $item)->get();
                foreach ($item as $data) {
                    $dpt = $data->name;
                    $sub = $data->subunit_name;
                    $item = $data->item_name;
                }
                $disp = 'd-none';
                $subDis = 'd-none';

                return view('inventdashboard.reportStockView', compact('values', 'dpt', 'sub', 'item', 'disp', 'subDis'));
            } elseif ($dpt == 0 and $subdpt != 0 and $item == 0) {
                $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
                 ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
                ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
                ->where('inv_items.inv_subunit_id', $subdpt)
                ->select('*', 'inv_items.id as item_id')
                ->get();
                $sub = '';
                $subunits = invSubUnits::where('inv_subunits.id', $subdpt)->get();
                foreach ($subunits as $data) {
                    $sub = $data->subunit_name;
                }
                $dpt = 'All';
                $item = 'All';
                $disp = '';
                $subDis = 'd-none';

                return view('inventdashboard.reportStockView', compact('values', 'dpt', 'sub', 'item', 'disp', 'subDis'));
            }
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
