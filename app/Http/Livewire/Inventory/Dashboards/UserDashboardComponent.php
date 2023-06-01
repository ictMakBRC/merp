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
    public $userid, $my_department;
    
    public function selectDepartment()
    {

        if (session()->has('department')) {
            session()->forget('department');
        }
        $this->userid = auth()->user()->id;
        $this->validate([
            'my_department' => 'required',
        ]);
        $unit = invUserdeparment::with('department')->where(['user_id'=> $this->userid, 'department_id' => $this->my_department])->first();

        // dd($unit);
        session(['department_name' => $unit->department->department_name??'']);
        session(['department' => $unit->department_id]);
        return redirect(request()->header('Referer'));
    }
    
    public function render()
    {
        if (session()->has('department')) {
            $this->department_id = session('department');
            $this->department_namename = session('department_name');

            $data['items'] = inv_department_Item::where('department_id', session('department'))->get();
            $myRequests = invRequest::where('inv_requests.is_active', 1)->where('department_id', $this->department_id);
            $data['requests'] = $myRequests->get();
            $data['requestsPendingCount'] = $myRequests->where(['inv_requests.is_active' => 1, 'inv_requests.request_state' => 'Submitted'])->count();
            $data['pendingRequests'] = $myRequests->with('requester','approver','department')->where(['inv_requests.is_active' => 1, 'inv_requests.request_state' => 'Submitted'])->limit(10)->offset(0)->orderBy('inv_requests.id', 'DESC')->get();
         
            $data['stockwarning'] = DB::select(DB::raw("SELECT  *, inv_items.id as item_id
            FROM `inv_department__items` 
            left join `inv_items` on `inv_department__items`.`inv_item_id` = `inv_items`.`id` 
            left join `inv_subunits` on `inv_items`.`inv_subunit_id` = `inv_subunits`.`id` 
            left join `inv_uoms` on `inv_items`.`inv_uom_id` = `inv_uoms`.`id`
            WHERE inv_department__items.qty_left - inv_items.min_qty <= 0 AND inv_department__items.department_id = '$this->department_id'"));
            DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
        }
            $data['deparments'] = invUserdeparment::with('department')->where('user_id',auth()->user()->id)->get();
        

        
        return view('livewire.inventory.dashboards.user-dashboard-component',$data)->layout('inventdashboard.layouts.app');
    }
}
