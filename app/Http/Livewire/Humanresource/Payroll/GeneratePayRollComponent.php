<?php

namespace App\Http\Livewire\Humanresource\Payroll;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Department;
use App\Models\Humanresource\Employee;
use App\Models\Settings\GeneralSetting;

class GeneratePayRollComponent extends Component
{
    public $showList = false, $allEmployees = false;
    public $from_date, $to_date, $department_id, $employee_id;
    public $usd_rate, $show_month, $global=null;
    public $emp_payroll = [];
    public function mount()
    {
        if($this->show_month == null){
            $this->show_month = date('m');
        }
        if($this->usd_rate == ''){
        $this->global = GeneralSetting::latest()->first();
        $this->usd_rate = $this->global?->usd_rate;
        }
    }

    public function generatePayroll()
    {
        $this->emp_payroll = Employee::with(['department','departmentunit','officialContract'])
        ->when($this->employee_id, function ($query) {$query->where('id', $this->employee_id);})
        ->when($this->department_id, function ($query) {$query->where('department_id', $this->department_id);})
        ->get();
    }

    public function render()
    {
              // $from = Carbon::parse($this->from_date)->toDateTimeString();
            // $to = Carbon::parse($this->to_date)->addHour(23)->addMinutes(59)->toDateTimeString();
        $data['employees'] = Employee::where('status', 'Active')->when($this->department_id, function ($query) {$query->where('department_id', $this->department_id);})
        ->orderBy('surname', 'asc')->get();
        $data['departments'] = Department::where('type', 'Department')->orWhere('type', 'Unit')->orWhere('type', 'Laboratory')->orderBy('department_name', 'asc')->get();
       
        
        return view('livewire.humanresource.payroll.generate-pay-roll-component',$data)->layout('humanResource\layouts\app');
    }
}
