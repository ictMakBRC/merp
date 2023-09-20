<?php

namespace App\Http\Livewire\Humanresource\Payroll;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Department;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\HrOffice;
use App\Jobs\HumanResource\SendPaySlip;
use App\Models\Settings\GeneralSetting;
class MyEmployeeComponent extends Component
{
 
    public $showList = false, $allEmployees = false;
    public $from_date, $to_date, $department_id, $employee_id;
    public $usd_rate, $show_month, $global=null;
    public $emp_payroll;
    public $employeeIds = [];
    public $selectedEmployeeIds=[];    
    public $approver_id=0;
    public $prepper_id=0;

    public function mount()
    {
        if($this->show_month == null){
            $this->show_month = date('Y-m');
        }
        if($this->usd_rate == ''){
        $this->global = GeneralSetting::latest()->first();
        $this->usd_rate = $this->global?->usd_rate;
        }
        $this->employee_id=auth()->user()->id;
        $this->emp_payroll=collect([]);
    }

    public function generatePayroll()
    {
        $this->emp_payroll = Employee::with(['department','departmentunit','officialContract'])
        ->where('id', auth()->user()->employee_id)
        ->get()??collect([]);

        $this->employeeIds=$this->emp_payroll->pluck('id')->toArray();
    }

    public function sendPayslip()
    {
        if(count($this->selectedEmployeeIds)>0){

            try {
                SendPaySlip::dispatch($this->selectedEmployeeIds);
                // $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Payslip sent successfully']);
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'message' => 'Payslip sent',
                    'text' => 'Payslip have/has been sent successfully',
                ]);

            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'error',
                    'message' => 'Oops! Sending failed!',
                    'text' => 'Something went wrong and Payslip could not be sent. Please try again.',
                ]);
            }

        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'warning',
                'message' => 'Oops! Not Found!',
                'text' => 'No Employees selected for this operation!',
            ]);
        }
    }

    public function render()
    {
        $data['issuers']=HrOffice::all();
              // $from = Carbon::parse($this->from_date)->toDateTimeString();
            // $to = Carbon::parse($this->to_date)->addHour(23)->addMinutes(59)->toDateTimeString();
        $data['employees'] = Employee::where('status', 'Active')->when($this->department_id, function ($query) {$query->where('department_id', $this->department_id);})
        ->orderBy('surname', 'asc')->get();
        $data['departments'] = Department::where('type', 'Department')->orWhere('type', 'Unit')->orWhere('type', 'Laboratory')->orderBy('department_name', 'asc')->get();
       
        
        return view('livewire.humanresource.payroll.my-employee-component',$data)->layout('humanResource.layouts.app');
    }
}
