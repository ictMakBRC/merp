<?php

namespace App\Http\Livewire\Humanresource\Payroll;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Department;
use App\Models\Humanresource\Employee;
use App\Jobs\HumanResource\SendPaySlip;
use App\Models\Settings\GeneralSetting;
use App\Models\Humanresource\ProjectContract;
use App\Jobs\HumanResource\SendProjectPaySlip;

class GenerateProjectPayRollComponent extends Component
{
    public $showList = false, $allEmployees = false;
    public $from_date, $to_date, $department_id, $employee_id;
    public $usd_rate, $show_month, $global=null, $currency;
    public $emp_payroll;
    public $employeeIds = [];
    public $selectedEmployeeIds=[];

    public function mount()
    {
        if($this->show_month == null){
            $this->show_month = date('m');
        }
        if($this->usd_rate == ''){
        $this->global = GeneralSetting::latest()->first();
        $this->usd_rate = $this->global?->usd_rate;
        }

        $this->emp_payroll=collect([]);
    }

    public function generatePayroll()
    {
     
        $this->validate([
            'department_id' => 'required|numeric',
            'currency' => 'required|string',
        ]);
        $this->emp_payroll = ProjectContract::with('employee','project')->where('project_id', $this->department_id)
        ->when($this->employee_id, function ($query) {$query->where('id', $this->employee_id);})
        ->when($this->currency, function ($query) {$query->where('currency', $this->currency);})->get();

        $this->employeeIds=$this->emp_payroll->pluck('id')->toArray();
    }

    public function sendPayslip()
    {
        if(count($this->selectedEmployeeIds)>0){
            // dd($this->selectedEmployeeIds);
            try {
              $pp =  SendProjectPaySlip::dispatch($this->selectedEmployeeIds);
            //   dd($pp);
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
             
        $data['employees'] = ProjectContract::with('employee')->where('project_id', $this->department_id)
        ->when($this->currency, function ($query) {$query->where('currency', $this->currency);})->get();
        $data['projectContracts'] = ProjectContract::with('project')->distinct()->get('project_id');
       
        return view('livewire.humanresource.payroll.generate-project-pay-roll-component',$data)->layout('humanResource.layouts.app');
    }
}
