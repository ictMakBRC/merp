<?php

namespace App\Http\Livewire\Humanresource\Payroll;

use App\Models\Humanresource\Employee;
use App\Models\Humanresource\Payroll\ApprovalChain;
use App\Models\Humanresource\Payroll\ApproverChain;
use App\Models\Settings\GeneralSetting;
use Livewire\Component;

class PayRollSettingsComponent extends Component
{
    public $usd_rate;
    public $employee_nssf;
    public $employer_nssf;
    public $paye;
    public $vat;
    public $eur_rate;
    public $gbp_rate;
    public $status;
    public $type='Prepper';
    public $search='';

    public function addPrepperEmployee($id)
    {
        $user = ApprovalChain::where(['employee_id'=>$id, 'type'=>'Prepper'])->first();
        if(!$user){
        $employee = new ApprovalChain();
        $employee->employee_id = $id;
        $employee->type = 'Prepper';
        $employee->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Prepper successfully saved']);
        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Sorry',
                'text' => 'User not added',
            ]);
        }
    }
    public function addApproverEmployee($id)
    {
        $user = ApprovalChain::where(['employee_id'=>$id, 'type'=>'Approver'])->first();
        if(!$user){
        $employee = new ApprovalChain();
        $employee->employee_id = $id;
        $employee->type = 'Approver';
        $employee->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Approver successfully saved']);
        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Sorry',
                'text' => 'User not added',
            ]);
        }
    }
    public function removeUser($id)
    {
        $user = ApprovalChain::where('id',$id)->first();
        $user->delete();
       
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Prepper successfully saved']);
      
    }
    public function addNewRates()
    {
        $general_setting = new GeneralSetting();
        $general_setting->usd_rate = $this->usd_rate;
        $general_setting->employee_nssf = $this->employee_nssf;
        $general_setting->employer_nssf = $this->employer_nssf;
        $general_setting->paye =$this->paye;
        $general_setting->vat =  $this->vat;
        $general_setting->eur_rate = $this->eur_rate;
        $general_setting->gbp_rate = $this->gbp_rate;
        $general_setting->status = 1;
        $general_setting->created_by = auth()->user()->id;
        $general_setting->save();
        if($general_setting){            
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Setting saved successfully']);
            $previous = GeneralSetting::where('id','!=',$general_setting->id)->update(['status'=>0]);
        }
    }
    public function settings()
    {
        return GeneralSetting::orderBy('id','DESC');
    }
    public function render()
    {
        $data['employees']=Employee::search($this->search)->where('email','!=','ict.makbrc@gmail.com')->get();
        $data['approvalers']=ApprovalChain::with('employee')->where('status', 'Active')->get();
        
        $general_setting=$this->settings()->where('status',1)->latest()->first();
        if($general_setting){
            $this->usd_rate = $general_setting->usd_rate;
            $this->employee_nssf = $general_setting->employee_nssf;
            $this->employer_nssf= $general_setting->employer_nssf;
            $this->paye= $general_setting->paye;
            $this->vat= $general_setting->vat;
            $this->eur_rate= $general_setting->eur_rate;
            $this->gbp_rate= $general_setting->gbp_rate;
            $this->status= $general_setting->status;
        }
        $data['all_settings']=$this->settings()->get();

        return view('livewire.humanresource.payroll.pay-roll-settings-component',$data)->layout('humanResource.layouts.app');
    }
}
