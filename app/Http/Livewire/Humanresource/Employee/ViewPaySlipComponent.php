<?php

namespace App\Http\Livewire\Humanresource\Employee;

use Carbon\Carbon;
use Livewire\Component;
// use Barryvdh\DomPDF\PDF;
use PDF;
use App\Models\Humanresource\Employee;
use App\Models\Settings\GeneralSetting;
use App\Models\Humanresource\OfficialContract;
use App\Models\Humanresource\BankingInformation;

class ViewPaySlipComponent extends Component
{
    public $month, $today_date;
    public $emp_id;
    public $all_contracts = true;

    public function mount($id)
    {
        if($this->month==""){
            $this->month = Carbon::today()->format('Y-m-d');
        }
        $this->emp_id = $id;
        $this->today_date =  Carbon::today()->addDays(1)->format('Y-m-d');
    }

    public function downloadPayslip()
    {
        $month = $this->month;
        $global = GeneralSetting::latest()->first();
        $employee = Employee::with(['designation','department','departmentunit','officialContract'])->where('id', $this->emp_id)->first();
        $bank_account = BankingInformation::where(['employee_id'=> $this->emp_id, 'is_default'=>1])->latest()->first();
        if(!$bank_account){            
            $bank_account = BankingInformation::where('employee_id', $this->emp_id)->latest()->first();
        }
        //return View('reports.sample-management.downloadReport', compact('testResult'));
        $pdf = PDF::loadView('livewire.humanresource.employee.view-pay-slip-component', compact('employee','bank_account','month','global'));
        $pdf->setPaper('a4', 'portrait');   //horizontal
        $pdf->getDOMPdf()->set_option('isPhpEnabled', true);

        return  $pdf->stream($employee->surname.'.pdf');


        // return $pdf->download($testResult->sample->participant->identity.rand().'.pdf');
    }
    public function render()
    {
       
       
        $data['global'] = GeneralSetting::latest()->first();
        $data['employee'] = Employee::with(['designation','department','departmentunit','officialContract'])->where('id', $this->emp_id)->first();
        $data['bank_account'] = BankingInformation::where(['employee_id'=> $this->emp_id, 'is_default'=>1])->latest()->first();
        if(!$data['bank_account']){            
            $data['bank_account'] = BankingInformation::where('employee_id', $this->emp_id)->latest()->first();
        }
        return view('livewire.humanresource.employee.view-pay-slip-component',$data)->layout('humanResource\layouts\app');
    }
}
