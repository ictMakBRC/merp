<?php

namespace App\Http\Livewire\Inventory\User;

use Livewire\Component;
use App\Models\inventory\invRequest;

class MyRequestsComponent extends Component
{
    public function defaultRoute()
    {
        return to_route('inv_user.dashboard')->with('error', 'Please selecte a departmet');
    }
    public function render()
    {
        if (auth()->user()->hasRole(['InvSupervisor', 'InvUser']) && session('department') != null) {
            $data['requests']= invRequest::with('requester','approver')->where(['user_id'=> auth()->user()->id, 'department_id'=> session('department')])->get();
        } else {           
            $this->defaultRoute();
            $data['requests']= [];
        }
        return view('livewire.inventory.user.my-requests-component',$data)->layout('inventdashboard.layouts.app');
    }
}
