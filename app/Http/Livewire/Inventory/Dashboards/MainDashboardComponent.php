<?php

namespace App\Http\Livewire\Inventory\Dashboards;

use Livewire\Component;
use App\Models\Department;
use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invItems;
use Illuminate\Support\Facades\DB;
use App\Models\inventory\invRequest;
use App\Models\inventory\invSubunits;

class MainDashboardComponent extends Component
{
    public function render()
    {
        $data['items'] = invItems::count();
        $data['departments'] = Department::count();
        $data['subunits'] = invSubunits::count();
        $data['requests'] = invRequest::where('inv_requests.request_state', 'signed')->where('inv_requests.is_active', 1)->count();
        $data['values'] = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
            ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
            ->select('request_state', 'request_type', 'request_code', 'departments.department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
            ->where('inv_requests.request_state', 'signed')
            ->where('inv_requests.is_active', 1)->limit(5)->offset(0)->orderBy('inv_requests.id', 'DESC')->get();
            $data['stockwarning1'] = inv_department_Item ::leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
            ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
            ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
            ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
            ->select(DB::raw('*', 'SELECT inv_department__items.qty_left - inv_items.min_qty as minQty'), 'inv_items.id as item_id')
            ->limit(5)->get();
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
            $data['stockwarning'] = DB::select(DB::raw('SELECT  *, inv_items.id as item_id
          FROM `inv_department__items` 
          left join `departments` on `inv_department__items`.`department_id` = `departments`.`id` 
          left join `inv_items` on `inv_department__items`.`inv_item_id` = `inv_items`.`id` 
          left join `inv_subunits` on `inv_items`.`inv_subunit_id` = `inv_subunits`.`id` 
          left join `inv_uoms` on `inv_items`.`inv_uom_id` = `inv_uoms`.`id`
          WHERE inv_department__items.qty_left - inv_items.min_qty <= 0'));
            DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");

        // $data['samplesAccepted'] = SampleReception::where('created_by', auth()->user()->id)
        // ->when($this->view == 'today', function ($query) {$query->whereDay('created_at', '=', date('d'));})
        // ->when($this->view == 'week', function ($query) {$query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();})
        // ->when($this->view == 'month', function ($query) {$query->whereMonth('created_at', '=', date('m'))->count();})
        // ->when($this->view == 'year', function ($query) {$query->whereYear('created_at', '=', date('Y'))->count();})        
        // ->sum('samples_accepted');
        return view('livewire.inventory.dashboards.main-dashboard-component',$data)->layout('inventdashboard.layouts.app');
    }
}
