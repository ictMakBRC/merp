<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invRequest;
use App\Models\inventory\invSubunits;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('department')) {
            $dptId = session('department');
            $dptname = session('department_name');
            if (Auth::user()->hasRole(['InvSupervisor', 'InvUser']) && session('department') != null) {
                $items = inv_department_Item::where('department_id', session('department'))->get();
                // $departments = Department::count();
                // $subunits = invSubunits::count();
                $requests = invRequest::where('inv_requests.request_state', 'signed')->where('inv_requests.is_active', 1)->where('department_id', session('department'))->count();
                $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
                ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
                ->select('request_state', 'request_type', 'request_code', 'departments.department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
                ->where('inv_requests.request_state', 'signed')->where('department_id', $dptId)
                ->where('inv_requests.is_active', 1)->limit(5)->offset(0)->orderBy('inv_requests.id', 'DESC')->get();
                $stockwarning1 = inv_department_Item::leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
                ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
                ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
                ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
                ->select(DB::raw('*', 'SELECT inv_department__items.qty_left - inv_items.min_qty as minQty'), 'inv_items.id as item_id')
                ->where('department_id', $dptId)
                ->limit(5)->get();
                DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
                $stockwarning = DB::select(DB::raw("SELECT  *, inv_items.id as item_id
            FROM `inv_department__items` 
            left join `departments` on `inv_department__items`.`department_id` = `departments`.`id` 
            left join `inv_items` on `inv_department__items`.`inv_item_id` = `inv_items`.`id` 
            left join `inv_subunits` on `inv_items`.`inv_subunit_id` = `inv_subunits`.`id` 
            left join `inv_uoms` on `inv_items`.`inv_uom_id` = `inv_uoms`.`id`
            WHERE department_id ='$dptId' AND inv_department__items.qty_left - inv_items.min_qty <= 0"));
                DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");

                return view('inventdashboard.Managedashboard', compact('items', 'requests', 'values', 'stockwarning'))->with('success', 'Welcome '.auth()->user()->name.', you are now managing '.$dptname.' Department');
            } else {
                abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
            }
        } else {
            return redirect('inventory/req/manage')->with('error', 'Please selecte a departmet');
        }
    }

    public function stock()
    {
        if (Auth::user()->hasRole(['InvSupervisor', 'InvUser']) && session('department') != null) {
            $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
            ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
            ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
            ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->select('*', 'inv_items.id as item_id', 'departments.id as dptId')
            ->where('department_id', session('department'))
            ->get();

            return view('inventdashboard.stocklevels', compact('values'));
        } else {
            return redirect('inventory/req/manage')->with('error', 'Please selecte a departmet');
        }
    }

    public function reports()
    {
        if (Auth::user()->hasRole(['InvSupervisor', 'InvUser']) && session('department') != null) {
            $subunits = invSubUnits::orderBy('subunit_name', 'asc')->get();
            $items = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
            ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
            ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
            ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->select('*', 'inv_items.id as item_id', 'departments.id as dptId')
            ->where('department_id', session('department'))
            ->get();

            return view('inventdashboard.reportsManagement', compact('items', 'subunits'));
        } else {
            return redirect('inventory/req/manage')->with('error', 'Please selecte a departmet');
        }
    }

    public function getSubDptItems(Request $request)
    {
        if ($request->sub_id != 0) {
            $item = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
            ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
            ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
            ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->where('department_id', session('department'))
            ->select('uom_name', 'item_name', 'inv_items.id as item_id')
            ->where('inv_items.inv_subunit_id', $request->sub_id)
            ->get();

            return response()->json($item);
        } else {
            $item = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
            ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
            ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
            ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->where('department_id', session('department'))
            ->select('uom_name', 'item_name', 'inv_items.id as item_id')
            //->where('inv_items.inv_subunit_id',$request->sub_id)
            ->get();

            return response()->json($item);
        }
    }
}
