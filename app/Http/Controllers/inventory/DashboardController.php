<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invItems;
use App\Models\inventory\invRequest;
use App\Models\inventory\invSubunits;
use App\Models\inventory\invUserdeparment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole(['InvAdmin'])) {
            $items = invItems::count();
            $departments = Department::count();
            $subunits = invSubunits::count();
            $requests = invRequest::where('inv_requests.request_state', 'signed')->where('inv_requests.is_active', 1)->count();
            $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
            ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
            ->select('request_state', 'request_type', 'request_code', 'departments.department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
            ->where('inv_requests.request_state', 'signed')
            ->where('inv_requests.is_active', 1)->limit(5)->offset(0)->orderBy('inv_requests.id', 'DESC')->get();
            $stockwarning1 = inv_department_Item::leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
            ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
            ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
            ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->select(DB::raw('*', 'SELECT inv_department__items.qty_left - inv_items.min_qty as minQty'), 'inv_items.id as item_id')
            ->limit(5)->get();
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
            $stockwarning = DB::select(DB::raw('SELECT  *, inv_items.id as item_id
          FROM `inv_department__items` 
          left join `departments` on `inv_department__items`.`department_id` = `departments`.`id` 
          left join `inv_items` on `inv_department__items`.`inv_item_id` = `inv_items`.`id` 
          left join `inv_subunits` on `inv_items`.`inv_subunit_id` = `inv_subunits`.`id` 
          left join `inv_uoms` on `inv_items`.`inv_uom_id` = `inv_uoms`.`id`
          WHERE inv_department__items.qty_left - inv_items.min_qty <= 0'));
            DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");

            return view('inventdashboard.dashboard', compact('items', 'requests', 'departments', 'subunits', 'values', 'stockwarning'));
        } elseif (Auth::user()->hasRole(['InvSupervisor', 'InvUser'])) {
            return redirect('inventory/request/new');
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    public function pickDpt()
    {
        if (session()->has('department')) {
            session()->forget('department');
        }
        $userid = auth()->user()->id;
        $units = invUserdeparment::leftJoin('departments', 'inv_userdeparments.department_id', '=', 'departments.id')
        ->where('inv_userdeparments.user_id', $userid)
        ->get();

        return view('inventdashboard.UserStockselectdepartment', compact('units'));
    }

    public function pathFinder(Request $request)
    {
        if (session()->has('department')) {
            session()->forget('department');
        }
        $this->validate($request, [
            'department_id' => 'required',
        ]);
        $userid = auth()->user()->id;
        $unit = invUserdeparment::leftJoin('departments', 'inv_userdeparments.department_id', '=', 'departments.id')
        ->where('inv_userdeparments.user_id', $userid)->where('inv_userdeparments.department_id', $request->department_id)->first();
        session(['department_name' => $unit->department_name]);
        session(['department' => $unit->department_id]);

        return redirect('inventory/manage/dashboard');
    }
}
