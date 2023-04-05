<?php

namespace App\Http\Livewire\Inventory\Dashboards;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\inventory\invRequest;
use App\Models\inventory\invUserdeparment;
use App\Models\inventory\inv_department_Item;

class UserDashboardComponent extends Component
{
    public $department_id,$department_namename;

    
    public function pathFinder($department_id)
    {
        if (session()->has('department')) {
            session()->forget('department');
        }
        $userid = auth()->user()->id;
        $unit = invUserdeparment::leftJoin('departments', 'inv_userdeparments.department_id', '=', 'departments.id')
        ->where(['inv_userdeparments.user_id'=> $userid, 'inv_userdeparments.department_id' => $department_id])->first();
        session(['department_name' => $unit->department_name]);
        session(['department' => $unit->department_id]);
    }
    public function render()
    {
        if (session()->has('department')) {
            $this->department_id = session('department');
            $this->department_namename = session('department_name');

            $data['items'] = inv_department_Item::where('department_id', session('department'))->get();
            $myRequests = invRequest::where('inv_requests.request_state')->where('inv_requests.is_active', 1)->where('department_id', $this->department_id);
            $data['requests'] = $myRequests->get();
            $data['pendingRequests'] = $myRequests->with('requester','approver','department')->where(['inv_requests.is_active' => 1, 'inv_requests.request_state' => 'Not Approved'])->limit(10)->offset(0)->orderBy('inv_requests.id', 'DESC')->get();
 
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
            $data['stockwarning'] = inv_department_Item::leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
            ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
            ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
            ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->select(DB::raw('*', 'SELECT inv_department__items.qty_left - inv_items.min_qty as minQty'), 'inv_items.id as item_id')
            ->limit(5)->get();
            DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
        }
        else{
            $data['deparments'] = invUserdeparment::where('user_id',auth()->user()->id)->get();
        }
        return view('livewire.inventory.dashboards.user-dashboard-component')->layout('inventdashboard.layouts.app');;
    }
}
