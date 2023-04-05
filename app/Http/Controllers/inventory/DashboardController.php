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
        if (Auth::user()->hasPermission(['manageInventory']) || Auth::user()->hasRole(['InvAdmin'])) {

            return to_route('inv_admin.dashboard');
        } elseif (Auth::user()->hasPermission(['requestInventory', 'inventory-approve'])) {
            return to_route('inv_user.dashboard');
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
